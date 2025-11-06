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

    public function index()
    {
        // Ambil semua data pengaduan (misalnya urutkan terbaru dulu)
        $pengaduans = Pengaduan::latest()->get();

        // Kirim ke view admin.pengaduanIndex
        return view('admin.pengaduanIndex', compact('pengaduans'));
    }

    /**
     * ✅ AUTO-SAVE VERIFICATION - Setiap klik ceklis/silang langsung ke database
     */
    public function autoSaveVerification(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $pengaduan = Pengaduan::findOrFail($id);

        // Hanya bisa verifikasi jika status diverifikasi
        if ($pengaduan->status !== 'diverifikasi') {
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 400);
        }

        try {
            $verificationChecks = $request->verification_checks;
            if (is_string($verificationChecks)) {
                $verificationChecks = json_decode($verificationChecks, true);
            }

            // ✅ SIMPAN KE DATABASE - Setiap klik langsung tersimpan
            $pengaduan->verification_checks = json_encode($verificationChecks);
            $pengaduan->verification_notes = $request->verification_notes;
            $pengaduan->last_verified_at = now();
            $pengaduan->save();

            return response()->json([
                'success' => true,
                'message' => 'Tersimpan otomatis',
                'data' => [
                    'verification_checks' => $verificationChecks,
                    'timestamp' => now()->format('H:i:s')
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
     * ✅ PROCESS VERIFICATION - Approve atau Reject
     */
    public function processVerification(Request $request, $id)
    {
        // 1. Otorisasi dan Validasi
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        try {
            $validated = $request->validate([
                'verification_checks' => 'required|string',
                'verification_notes' => 'nullable|string',
                'action' => 'required|in:approve,reject'
            ]);

            $verificationChecks = $request->verification_checks;
            if (is_string($verificationChecks)) {
                $verificationChecks = json_decode($verificationChecks, true);
            }

            if (empty($verificationChecks) || count($verificationChecks) === 0) {
                return redirect()->back()->with('error', 'Harap verifikasi minimal satu field sebelum melanjutkan.');
            }

            // 🔑 KUNCI UTAMA: Simpan data verifikasi PERMANEN di kolom terpisah
            // Data ini TIDAK akan dihapus meskipun status berubah
            $pengaduan->verification_checks = json_encode($verificationChecks);
            $pengaduan->verification_notes = $request->verification_notes;
            $pengaduan->verified_by = auth()->id();
            $pengaduan->verified_at = now();

            $message = '';
            $flashType = 'success';

            // 3. Logika Aksi (Approve/Reject)
            if ($request->action === 'approve') {
                $pengaduan->status = 'tindak_lanjut';
                $pengaduan->rejection_reason = null;
                $pengaduan->rejected_at = null;
                $pengaduan->rejected_by = null;
                $pengaduan->fields_to_fix = null;
                $pengaduan->updated_fields = null; // 🆕 Clear setelah approve

                $message = 'Verifikasi **BERHASIL** disetujui. Laporan dilanjutkan ke tahap **Tindak Lanjut**.';

            } else {
                $pengaduan->status = 'laporan_dikirim';
                $pengaduan->rejection_reason = $request->verification_notes;
                $pengaduan->rejected_at = now();
                $pengaduan->rejected_by = auth()->id();

                $fieldsToFix = [];
                foreach ($verificationChecks as $field => $status) {
                    if ($status === 'no') {
                        $fieldsToFix[] = $field;
                    }
                }

                $pengaduan->fields_to_fix = json_encode($fieldsToFix);
                $pengaduan->updated_fields = null; // 🆕 Clear setelah reject

                $flashType = 'warning';
                $message = 'Laporan **BERHASIL** dikembalikan ke pelapor (Status: **Laporan Dikirim**). Pelapor perlu memperbaiki **' . count($fieldsToFix) . ' field** yang ditandai. Data verifikasi sebelumnya tetap tersimpan.';
            }

            $pengaduan->save();

            // 5. Berhasil Kirim
            return redirect()->route('pengaduan.index')->with($flashType, $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            \Log::error("Error processing verification for pengaduan ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Verifikasi **GAGAL** diproses karena kesalahan sistem. Silakan coba lagi. (Detail: ' . $e->getMessage() . ')');
        }
    }

    // 🆕 BONUS: Method untuk reset verification (jika diperlukan)
    public function resetVerification($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        // Reset semua data verifikasi
        $pengaduan->verification_checks = null;
        $pengaduan->verification_notes = null;
        $pengaduan->verified_by = null;
        $pengaduan->verified_at = null;
        $pengaduan->rejection_reason = null;
        $pengaduan->rejected_at = null;
        $pengaduan->rejected_by = null;
        $pengaduan->fields_to_fix = null;
        $pengaduan->last_verified_at = null;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Data verifikasi berhasil direset.');
    }


    /**
     * ✅ VIEW FEEDBACK - Pelapor lihat field mana yang perlu diperbaiki
     */
    public function viewFeedback($id)
    {
        $pengaduan = Pengaduan::with(['rejectedBy'])->findOrFail($id);

        // Cek authorization
        if (auth()->id() !== $pengaduan->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('pengaduan.feedback', compact('pengaduan'));
    }

    public function create()
    {
        $userLaporans = collect();

        if (auth()->check()) {
            $userLaporans = Pengaduan::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pengaduan.create', compact('userLaporans'));
    }


    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $validated = $request->validate([
            // Uraian Pengaduan
            'tanggal_pengaduan' => 'required|date',
            'perihal' => 'required|string|max:255',
            'uraian' => 'required|string',
            'bukti_file.*' => 'nullable|file|max:102400', // 100MB per file
            'link_video' => 'nullable|url|max:255',

            // Informasi Pendukung
            'usia' => 'required|integer|min:10|max:100',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
            'pekerjaan_lain' => 'nullable|string|max:255',
            'waktu_hubung' => 'required|string',
            'waktu_lain' => 'nullable|string|max:255',

            // Pelanggaran & Kontak
            'pelanggaran' => 'required|array|min:1',
            'pelanggaran_lain' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',

            // Tempat & Waktu Kejadian
            'tanggal_kejadian' => 'required|date',
            'jam_kejadian' => 'required',
            'tempat_kejadian' => 'required|string',
            'tempat_lain' => 'nullable|string|max:255',

            // Data Terlapor
            'terlapor' => 'nullable|array',
            'terlapor.*.nama' => 'required|string|max:255',
            'terlapor.*.nip' => 'required|string|max:50',
            'terlapor.*.satuan_kerja' => 'required|string',
            'terlapor.*.jabatan' => 'required|string',
            'terlapor.*.jenis_kelamin' => 'required|string',

            // Pernyataan
            'identitas_diketahui' => 'required|in:Ya,Tidak',
            'pihak_terkait' => 'nullable|string',
        ]);

        // 2. GENERATE KODE UNIK
        $kodeVerifikasi = 'VRF-' . strtoupper(Str::random(6));
        $kodeAduan = 'ADN-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // 3. SIMPAN DATA KE DATABASE
        $pengaduan = new Pengaduan();

        // Set User ID (jika login)
        $pengaduan->user_id = auth()->check() ? auth()->id() : null;

        // Tambahkan kode otomatis
        $pengaduan->kode_verifikasi = $kodeVerifikasi;
        $pengaduan->kode_aduan = $kodeAduan;

        // Uraian Pengaduan
        $pengaduan->tanggal_pengaduan = $request->tanggal_pengaduan;
        $pengaduan->perihal = $request->perihal;
        $pengaduan->uraian = $request->uraian;
        $pengaduan->link_video = $request->link_video;

        // Handle Upload File Bukti
        if ($request->hasFile('bukti_file')) {
            $files = [];
            foreach ($request->file('bukti_file') as $file) {
                $files[] = $file->store('bukti', 'public');
            }
            $pengaduan->bukti_file = json_encode($files);
        }

        // Informasi Pendukung
        $pengaduan->usia = $request->usia;
        $pengaduan->pendidikan = $request->pendidikan;
        $pengaduan->pekerjaan = $request->pekerjaan;
        $pengaduan->pekerjaan_lain = $request->pekerjaan_lain;
        $pengaduan->waktu_hubung = $request->waktu_hubung;
        $pengaduan->waktu_lain = $request->waktu_lain;

        // Pelanggaran (Array)
        $pengaduan->pelanggaran = json_encode($request->pelanggaran);
        $pengaduan->pelanggaran_lain = $request->pelanggaran_lain;

        // Kontak (Gabungkan Email, Telepon, WhatsApp)
        $kontak = [];
        if ($request->filled('email'))
            $kontak[] = 'Email: ' . $request->email;
        if ($request->filled('telepon'))
            $kontak[] = 'Telepon: ' . $request->telepon;
        if ($request->filled('whatsapp'))
            $kontak[] = 'WhatsApp: ' . $request->whatsapp;
        $pengaduan->kontak = json_encode($kontak);

        // Tempat & Waktu Kejadian
        $pengaduan->tanggal_kejadian = $request->tanggal_kejadian;
        $pengaduan->jam_kejadian = $request->jam_kejadian;
        $pengaduan->tempat_kejadian = $request->tempat_kejadian;
        $pengaduan->tempat_lain = $request->tempat_lain;

        // Data Terlapor (Array of Objects)
        if ($request->has('terlapor')) {
            $pengaduan->terlapor = json_encode($request->terlapor);
        }

        // Pernyataan
        $pengaduan->identitas_diketahui = $request->identitas_diketahui;
        $pengaduan->pihak_terkait = $request->pihak_terkait;

        // ✅ Status Awal & Revision Count
        $pengaduan->status = 'laporan_dikirim';
        $pengaduan->revision_count = 0;

        // 4. SIMPAN KE DATABASE
        $pengaduan->save();

        // 5. REDIRECT DENGAN PESAN SUKSES
        return redirect()->route('pengaduan.create')
            ->with('success', '✅ Pengaduan berhasil dikirim! Kode Aduan: ' . $kodeAduan . ' | Kode Verifikasi: ' . $kodeVerifikasi);
    }


    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:laporan_dikirim,diverifikasi,tindak_lanjut,tanggapan_pelapor,selesai'
        ]);

        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Cek authorization
        if (auth()->user()->role !== 'admin' && auth()->id() !== $pengaduan->user_id) {
            abort(403, 'Akses ditolak.');
        }

        // ✅ Langsung foreach - Laravel otomatis convert JSON ke array
        if ($pengaduan->bukti_file && is_array($pengaduan->bukti_file)) {
            foreach ($pengaduan->bukti_file as $file) {
                \Storage::disk('public')->delete($file);
            }
        }

        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }

    /**
     * ✅ EDIT LAPORAN - Hanya field yang disilang yang bisa diedit
     */
    public function edit($id)
    {
        // 1. Ambil data pengaduan
        $pengaduan = Pengaduan::findOrFail($id);

        // 2. Ambil dan dekode daftar field yang perlu diperbaiki
        // Kolom 'fields_to_fix' menyimpan daftar field dalam format JSON string (misalnya: '["nama", "alamat"]').
        // Fungsi json_decode akan mengubahnya menjadi array PHP.
        $fieldsToFix = json_decode($pengaduan->fields_to_fix ?? '[]', true);

        // 3. Tampilkan view 'edit' dengan data pengaduan dan fieldsToFix
        return view('pengaduan.edit', compact('pengaduan', 'fieldsToFix'));
    }


    /**
     * ✅ UPDATE LAPORAN - Hanya update field yang disilang
     * 🆕 DITAMBAHKAN: Increment revision_count setiap kali pelapor update
     */
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (auth()->id() !== $pengaduan->user_id) {
            abort(403, 'Akses ditolak.');
        }

        // ✅ Simpan status lama untuk tracking
        $oldStatus = $pengaduan->status;

        // ✅ Ambil field yang perlu diperbaiki
        $fieldsToFix = json_decode($pengaduan->fields_to_fix, true) ?? [];

        // 🆕 Array untuk tracking field yang diupdate
        $updatedFields = [];

        // ✅ Validasi hanya field yang perlu diperbaiki
        $rules = [];
        foreach ($fieldsToFix as $field) {
            // Mapping field ke validation rules
            switch ($field) {
                case 'tanggal_pengaduan':
                    $rules['tanggal_pengaduan'] = 'required|date';
                    break;
                case 'perihal':
                    $rules['perihal'] = 'required|string|max:255';
                    break;
                case 'uraian':
                    $rules['uraian'] = 'required|string';
                    break;
                case 'usia':
                    $rules['usia'] = 'required|integer|min:10|max:100';
                    break;
                case 'pendidikan':
                    $rules['pendidikan'] = 'required|string';
                    break;
                case 'pekerjaan':
                    $rules['pekerjaan'] = 'required|string';
                    break;
                case 'waktu_hubung':
                    $rules['waktu_hubung'] = 'required|string';
                    break;
                case 'tanggal_kejadian':
                    $rules['tanggal_kejadian'] = 'required|date';
                    break;
                case 'jam_kejadian':
                    $rules['jam_kejadian'] = 'required';
                    break;
                case 'tempat_kejadian':
                    $rules['tempat_kejadian'] = 'required|string';
                    break;
                case 'identitas_diketahui':
                    $rules['identitas_diketahui'] = 'required|string';
                    break;
                case 'pihak_terkait':
                    $rules['pihak_terkait'] = 'nullable|string';
                    break;
            }

            // Handle nested fields (kontak_email, kontak_telepon, dll)
            if (strpos($field, 'kontak_') === 0) {
                $kontakKey = str_replace('kontak_', '', $field);
                $rules["kontak.{$kontakKey}"] = 'nullable|string';
            }

            // Handle pelanggaran array
            if (strpos($field, 'pelanggaran_') === 0) {
                $rules['pelanggaran'] = 'nullable|array';
            }

            // Handle terlapor array
            if (strpos($field, 'terlapor_') === 0) {
                $rules['terlapor'] = 'nullable|array';
            }

            // Handle bukti file
            if (strpos($field, 'bukti_file_') === 0) {
                $rules['bukti_file.*'] = 'nullable|file|max:102400';
            }

            // Handle link video
            if ($field === 'link_video') {
                $rules['link_video'] = 'nullable|url|max:255';
            }
        }

        $validated = $request->validate($rules);

        // ✅ Update hanya field yang diperbaiki + TRACK perubahan
        foreach ($validated as $key => $value) {
            // Skip nested arrays, handle them separately
            if (!in_array($key, ['kontak', 'pelanggaran', 'terlapor', 'bukti_file'])) {
                // 🆕 Cek apakah value berubah
                if ($pengaduan->$key != $value) {
                    $updatedFields[] = $key;
                }
                $pengaduan->$key = $value;
            }
        }

        // Handle kontak jika perlu diperbaiki
        if (
            in_array('kontak_email', $fieldsToFix) ||
            in_array('kontak_telepon', $fieldsToFix) ||
            in_array('kontak_whatsapp', $fieldsToFix)
        ) {
            $oldKontak = $pengaduan->kontak;
            $newKontak = json_encode([
                'email' => $request->email,
                'telepon' => $request->telepon,
                'whatsapp' => $request->whatsapp,
            ]);

            if ($oldKontak != $newKontak) {
                $updatedFields[] = 'kontak';
            }
            $pengaduan->kontak = $newKontak;
        }

        // Handle pelanggaran jika perlu diperbaiki
        $pelanggaranNeedsFix = false;
        foreach ($fieldsToFix as $field) {
            if (strpos($field, 'pelanggaran') === 0) {
                $pelanggaranNeedsFix = true;
                break;
            }
        }
        if ($pelanggaranNeedsFix && $request->has('pelanggaran')) {
            $oldPelanggaran = $pengaduan->pelanggaran;
            $newPelanggaran = $request->pelanggaran;

            if (json_encode($oldPelanggaran) != json_encode($newPelanggaran)) {
                $updatedFields[] = 'pelanggaran';
            }

            $pengaduan->pelanggaran = $request->pelanggaran;
            $pengaduan->pelanggaran_lain = $request->pelanggaran_lain;
        }

        // Handle terlapor jika perlu diperbaiki
        $terlaporNeedsFix = false;
        foreach ($fieldsToFix as $field) {
            if (strpos($field, 'terlapor') === 0) {
                $terlaporNeedsFix = true;
                break;
            }
        }
        if ($terlaporNeedsFix && $request->has('terlapor')) {
            $oldTerlapor = $pengaduan->terlapor;
            $newTerlapor = json_encode($request->terlapor);

            if ($oldTerlapor != $newTerlapor) {
                $updatedFields[] = 'terlapor';
            }

            $pengaduan->terlapor = $newTerlapor;
        }

        // Handle file upload jika perlu diperbaiki
        if (in_array('bukti_file', $fieldsToFix) && $request->hasFile('bukti_file')) {
            $files = [];
            foreach ($request->file('bukti_file') as $file) {
                $files[] = $file->store('bukti', 'public');
            }
            $updatedFields[] = 'bukti_file';
            $pengaduan->bukti_file = json_encode($files);
        }

        // Handle link video jika perlu diperbaiki
        if (in_array('link_video', $fieldsToFix)) {
            if ($pengaduan->link_video != $request->link_video) {
                $updatedFields[] = 'link_video';
            }
            $pengaduan->link_video = $request->link_video;
        }

        // Update data tambahan jika ada
        if (in_array('pekerjaan', $fieldsToFix)) {
            $pengaduan->pekerjaan_lain = $request->pekerjaan_lain;
        }
        if (in_array('waktu_hubung', $fieldsToFix)) {
            $pengaduan->waktu_lain = $request->waktu_lain;
        }
        if (in_array('tempat_kejadian', $fieldsToFix)) {
            $pengaduan->tempat_lain = $request->tempat_lain;
        }

        // ✅ Reset status kembali ke diverifikasi untuk review ulang
        $pengaduan->status = 'diverifikasi';
        $pengaduan->rejection_reason = null;
        $pengaduan->rejected_at = null;
        $pengaduan->rejected_by = null;
        $pengaduan->fields_to_fix = null;

        // 🆕 PENTING: Increment revision_count setiap kali pelapor melakukan perbaikan
        if ($oldStatus === 'laporan_dikirim') {
            $pengaduan->revision_count = ($pengaduan->revision_count ?? 0) + 1;
            $pengaduan->last_revision_at = now();

            // 🆕 Simpan field yang diupdate untuk ditampilkan ke admin
            $pengaduan->updated_fields = json_encode($updatedFields);
        }

        // 🔑 KUNCI: JANGAN reset verification_checks
        // Data ceklis/silang tetap tersimpan dan akan muncul kembali
        // $pengaduan->verification_checks = null;  // ❌ JANGAN DI-UNCOMMENT!
        // $pengaduan->verified_at = null;           // ❌ JANGAN DI-UNCOMMENT!
        // $pengaduan->verified_by = null;           // ❌ JANGAN DI-UNCOMMENT!
        // $pengaduan->last_verified_at = null;      // ❌ JANGAN DI-UNCOMMENT!

        $pengaduan->save();

        return redirect()->route('pengaduan.create')->with('success', 'Perbaikan berhasil dikirim! Laporan akan diverifikasi ulang oleh admin.');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['user'])->findOrFail($id);

        // Opsional: batasi hanya admin yang boleh membuka halaman ini
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.pengaduanShow', compact('pengaduan'));
    }

}