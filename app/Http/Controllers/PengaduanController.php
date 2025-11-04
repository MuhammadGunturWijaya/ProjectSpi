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

            // 2. Persiapan Data Umum
            $pengaduan->verification_checks = json_encode($verificationChecks);
            $pengaduan->verification_notes = $request->verification_notes;
            $pengaduan->verified_by = auth()->id();
            $pengaduan->verified_at = now();

            $message = '';
            $flashType = 'success'; // Default type for success

            // 3. Logika Aksi (Approve/Reject)
            if ($request->action === 'approve') {
                // ✅ APPROVE: Semua data OK, lanjut ke tindak lanjut
                $pengaduan->status = 'tindak_lanjut';

                // Reset data rejection
                $pengaduan->rejection_reason = null;
                $pengaduan->rejected_at = null;
                $pengaduan->rejected_by = null;
                $pengaduan->fields_to_fix = null;

                $message = 'Verifikasi **BERHASIL** disetujui. Laporan dilanjutkan ke tahap **Tindak Lanjut**.';

            } else {
                // ❌ REJECT: Ada data yang perlu diperbaiki
                $pengaduan->status = 'tanggapan_pelapor'; // Status khusus untuk koreksi

                // Simpan catatan dan penandaan penolakan
                $pengaduan->rejection_reason = $request->verification_notes;
                $pengaduan->rejected_at = now();
                $pengaduan->rejected_by = auth()->id();

                // Kumpulkan field yang disilang ('no')
                $fieldsToFix = [];
                foreach ($verificationChecks as $field => $status) {
                    if ($status === 'no') {
                        $fieldsToFix[] = $field;
                    }
                }

                $pengaduan->fields_to_fix = json_encode($fieldsToFix);

                // Tipe pesan khusus (warning) karena dikembalikan
                $flashType = 'warning';
                $message = 'Laporan **BERHASIL** dikembalikan ke pelapor untuk perbaikan pada **' . count($fieldsToFix) . ' field** yang ditandai. Catatan dikirimkan ke pelapor.';
            }

            // 4. Simpan ke Database
            $pengaduan->save();

            // 5. Berhasil Kirim
            return redirect()->route('pengaduan.index')->with($flashType, $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gagal Kirim karena Validasi (misal: action tidak ada)
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // ❌ Gagal Kirim karena Error Sistem (Database, dll.)
            \Log::error("Error processing verification for pengaduan ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Verifikasi **GAGAL** diproses karena kesalahan sistem. Silakan coba lagi. (Detail: ' . $e->getMessage() . ')');
        }
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

        // 2. SIMPAN DATA KE DATABASE
        $pengaduan = new Pengaduan();

        // Set User ID (jika login)
        $pengaduan->user_id = auth()->check() ? auth()->id() : null;

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

        // Set Status Awal
        $pengaduan->status = 'laporan_dikirim';
        $pengaduan->revision_count = 0;

        // 3. SIMPAN KE DATABASE
        $pengaduan->save();

        // 4. REDIRECT DENGAN PESAN SUKSES
        return redirect()->route('pengaduan.create')
            ->with('success', '✅ Pengaduan berhasil dikirim! Data akan diverifikasi oleh admin.');
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
        $pengaduan = Pengaduan::findOrFail($id);

        // Cek authorization
        if (auth()->id() !== $pengaduan->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit pengaduan ini.');
        }

        // Cek apakah pengaduan dalam status yang bisa diedit
        if ($pengaduan->status !== 'tanggapan_pelapor' || !$pengaduan->rejected_at) {
            return redirect()->route('pengaduan.create')
                ->with('error', 'Pengaduan tidak dapat diedit pada status ini.');
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    /**
     * ✅ UPDATE LAPORAN - Hanya update field yang disilang
     */
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (auth()->id() !== $pengaduan->user_id) {
            abort(403, 'Akses ditolak.');
        }

        // ✅ Ambil field yang perlu diperbaiki
        $fieldsToFix = json_decode($pengaduan->fields_to_fix, true) ?? [];

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

        // ✅ Update hanya field yang diperbaiki
        foreach ($validated as $key => $value) {
            // Skip nested arrays, handle them separately
            if (!in_array($key, ['kontak', 'pelanggaran', 'terlapor', 'bukti_file'])) {
                $pengaduan->$key = $value;
            }
        }

        // Handle kontak jika perlu diperbaiki
        if (
            in_array('kontak_email', $fieldsToFix) ||
            in_array('kontak_telepon', $fieldsToFix) ||
            in_array('kontak_whatsapp', $fieldsToFix)
        ) {
            $pengaduan->kontak = json_encode([
                'email' => $request->email,
                'telepon' => $request->telepon,
                'whatsapp' => $request->whatsapp,
            ]);
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
            $pengaduan->terlapor = json_encode($request->terlapor);
        }

        // Handle file upload jika perlu diperbaiki
        if (in_array('bukti_file', $fieldsToFix) && $request->hasFile('bukti_file')) {
            $files = [];
            foreach ($request->file('bukti_file') as $file) {
                $files[] = $file->store('bukti', 'public');
            }
            $pengaduan->bukti_file = json_encode($files);
        }

        // Handle link video jika perlu diperbaiki
        if (in_array('link_video', $fieldsToFix)) {
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

        // Tandai bahwa ini adalah revisi
        $pengaduan->revision_count = ($pengaduan->revision_count ?? 0) + 1;
        $pengaduan->last_revision_at = now();

        // Reset verification checks agar admin bisa verifikasi ulang
        $pengaduan->verification_checks = null;
        $pengaduan->verified_at = null;
        $pengaduan->verified_by = null;
        $pengaduan->last_verified_at = null;

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