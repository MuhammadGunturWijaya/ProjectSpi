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
        // Ambil laporan user yang sedang login
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
            'kontak' => 'required|array',

            'tanggal_kejadian' => 'required|date',
            'jam_kejadian' => 'required',
            'tempat_kejadian' => 'required|string',

            'identitas_diketahui' => 'required|string',
        ]);

        // upload multiple file
        $files = [];
        if ($request->hasFile('bukti_file')) {
            foreach ($request->file('bukti_file') as $file) {
                $files[] = $file->store('bukti', 'public');
            }
        }

        // masukkan tambahan data ke $validated
        $validated['bukti_file'] = json_encode($files);
        $validated['pekerjaan_lain'] = $request->pekerjaan_lain;
        $validated['waktu_lain'] = $request->waktu_lain;
        $validated['pelanggaran_lain'] = $request->pelanggaran_lain;
        $validated['tempat_lain'] = $request->tempat_lain;
        $validated['terlapor'] = json_encode($request->terlapor);
        $validated['pihak_terkait'] = $request->pihak_terkait;

        // set status default (tidak dihapus)
        $validated['status'] = 'laporan_dikirim';

        // tambahkan user_id
        $validated['user_id'] = Auth::id();

        // simpan ke database
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



    // Menampilkan daftar pengaduan (untuk admin)
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // Ambil semua laporan milik user yang sedang login
        $userLaporans = Pengaduan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $pengaduans = Pengaduan::latest()->get();
        return view('admin.pengaduanIndex', compact('pengaduans', 'userLaporans'));
    }

    // Menampilkan detail pengaduan (untuk admin)
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
        $pengaduan = \App\Models\Pengaduan::findOrFail($id);

        // Hanya admin atau pemilik laporan yang boleh hapus
        if (auth()->user()->role !== 'admin' && $pengaduan->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        // Hapus file bukti jika ada
        if ($pengaduan->bukti_foto) {
            \Storage::disk('public')->delete($pengaduan->bukti_foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }


    public function delete(User $user, Pengaduan $pengaduan)
    {
        return $user->role === 'admin' || $user->id === $pengaduan->user_id;
    }

    public function createGuest()
    {
        // Buat akun dummy
        $dummyEmail = 'guest_' . Str::random(6) . '@example.com';
        $dummyPassword = Str::random(8);

        $user = User::create([
            'name' => 'Guest User',
            'email' => $dummyEmail,
            'password' => Hash::make($dummyPassword),
            'role' => 'guest', // bisa buat role khusus guest
        ]);

        // Login otomatis user dummy
        Auth::login($user);

        // Simpan password dummy di session agar bisa ditampilkan sekali
        session()->flash('guest_password', $dummyPassword);

        // Redirect ke halaman buat pengaduan
        return redirect()->route('pengaduan.create');
    }


}
