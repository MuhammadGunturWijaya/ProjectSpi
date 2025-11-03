<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PengaduanController extends Controller
{
    // Form pengaduan masyarakat
    public function create()
    {
        $userLaporans = Pengaduan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengaduan.create', compact('userLaporans'));
    }

    // Menyimpan pengaduan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pengaduan' => 'required|date',
            'perihal' => 'required|string|max:255',
            'uraian' => 'required|string',
            'usia' => 'required|integer|min:10|max:100',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
            'waktu_hubung' => 'required|string',
            'pelanggaran' => 'required|array',
            'tanggal_kejadian' => 'required|date',
            'jam_kejadian' => 'required',
            'tempat_kejadian' => 'required|string',
            'identitas_diketahui' => 'required|string',

            'bukti_file.*' => 'nullable|file|max:102400|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,image/jpeg,image/png',
            'link_video' => 'nullable|url|max:255',
        ]);

        // Upload multiple file
        $files = [];
        if ($request->hasFile('bukti_file')) {
            foreach ($request->file('bukti_file') as $file) {
                $files[] = $file->store('bukti', 'public');
            }
        }

        $validated['bukti_file'] = json_encode($files);
        $validated['link_video'] = $request->link_video;

        // ✅ Simpan data tambahan
        $validated['bukti_file'] = json_encode($files);
        $validated['pekerjaan_lain'] = $request->pekerjaan_lain;
        $validated['waktu_lain'] = $request->waktu_lain;

        // ✅ Pelanggaran disimpan terpisah
        // $validated['pelanggaran'] = json_encode($request->pelanggaran);
        $validated['pelanggaran_lain'] = $request->pelanggaran_lain;

        $validated['tempat_lain'] = $request->tempat_lain;
        $validated['terlapor'] = json_encode($request->terlapor);
        $validated['pihak_terkait'] = $request->pihak_terkait;

        // ✅ Data kontak (email, telepon, whatsapp)
        $validated['kontak'] = json_encode([
            'email' => $request->email,
            'telepon' => $request->telepon,
            'whatsapp' => $request->whatsapp,
        ]);

        // ✅ Status default & user
        $validated['status'] = 'laporan_dikirim';
        $validated['user_id'] = Auth::id();

        // ✅ Simpan ke database
        Pengaduan::create($validated);

        return redirect()->route('pengaduan.create')->with('success', 'Pengaduan berhasil dikirim. Terima kasih!');
    }

    public function updateStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $userLaporans = Pengaduan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $pengaduans = Pengaduan::latest()->get();
        return view('admin.pengaduanIndex', compact('pengaduans', 'userLaporans'));
    }

    public function show($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        return view('admin.pengaduanShow', compact('pengaduan'));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $pengaduan->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        if ($pengaduan->bukti_foto) {
            \Storage::disk('public')->delete($pengaduan->bukti_foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.create')->with('success', 'Laporan berhasil dihapus.');
    }

    public function delete(User $user, Pengaduan $pengaduan)
    {
        return $user->role === 'admin' || $user->id === $pengaduan->user_id;
    }

    public function createGuest()
    {
        $dummyEmail = 'guest_' . Str::random(6) . '@example.com';
        $dummyPassword = Str::random(8);

        $user = User::create([
            'name' => 'Guest User',
            'email' => $dummyEmail,
            'password' => Hash::make($dummyPassword),
            'role' => 'guest',
        ]);

        Auth::login($user);
        session()->flash('guest_password', $dummyPassword);

        return redirect()->route('pengaduan.create');
    }

    public function verify($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        // Hanya bisa verifikasi jika status diverifikasi
        if ($pengaduan->status !== 'diverifikasi') {
            return redirect()->back()->with('error', 'Hanya laporan dengan status "Diverifikasi" yang dapat diverifikasi.');
        }

        return view('admin.pengaduanVerify', compact('pengaduan'));
    }

    public function autoSaveVerification(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $pengaduan = Pengaduan::findOrFail($id);

        // Hanya bisa auto-save jika status diverifikasi
        if ($pengaduan->status !== 'diverifikasi') {
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 400);
        }

        try {
            // Decode verification_checks jika berupa string
            $verificationChecks = $request->verification_checks;
            if (is_string($verificationChecks)) {
                $verificationChecks = json_decode($verificationChecks, true);
            }

            // Update data
            $pengaduan->verification_checks = json_encode($verificationChecks);
            $pengaduan->verification_notes = $request->verification_notes;
            $pengaduan->save();

            return response()->json([
                'success' => true,
                'message' => 'Verifikasi berhasil disimpan',
                'data' => [
                    'verification_checks' => $verificationChecks,
                    'verification_notes' => $request->verification_notes
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process final verification (existing method - updated)
     */
    public function processVerification(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        $validated = $request->validate([
            'verification_checks' => 'required|string',
            'verification_notes' => 'nullable|string',
            'action' => 'required|in:approve,reject'
        ]);

        // Decode verification_checks jika masih string
        $verificationChecks = $request->verification_checks;
        if (is_string($verificationChecks)) {
            $verificationChecks = json_decode($verificationChecks, true);
        }

        // Validasi: minimal ada satu field yang diverifikasi
        if (empty($verificationChecks) || count($verificationChecks) === 0) {
            return redirect()->back()->with('error', 'Harap verifikasi minimal satu field sebelum melanjutkan.');
        }

        // Simpan hasil verifikasi final
        $pengaduan->verification_checks = json_encode($verificationChecks);
        $pengaduan->verification_notes = $request->verification_notes;
        $pengaduan->verified_by = auth()->id();
        $pengaduan->verified_at = now();

        if ($request->action === 'approve') {
            // Lanjutkan ke tindak lanjut
            $pengaduan->status = 'tindak_lanjut';
            $message = 'Verifikasi berhasil! Laporan dilanjutkan ke tahap Tindak Lanjut.';
        } else {
            // Kembalikan ke pelapor
            $pengaduan->status = 'tanggapan_pelapor';
            $message = 'Laporan dikembalikan ke pelapor untuk perbaikan.';
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', $message);
    }

}
