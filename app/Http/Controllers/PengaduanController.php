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
}
