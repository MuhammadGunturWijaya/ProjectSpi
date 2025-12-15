<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\BidangPengaduan;
use App\Models\RoleBidang;
class PengaduanController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        // Base query
        $query = Pengaduan::with(['bidangPengaduan', 'roleBidang']);

        // Filter berdasarkan role
        if ($user->role === 'admin') {
            // Admin melihat semua
        } else {
            // Ambil role bidang berdasarkan nama_role user
            $roleBidang = \App\Models\RoleBidang::where('nama_role', $user->role)->first();

            if ($roleBidang) {
                // Hanya tampilkan pengaduan sesuai bidang & role yang menangani
                $query->where(function ($q) use ($user, $roleBidang) {
                    $q->where('user_id', $user->id)
                        ->orWhere('bidang_id', $roleBidang->id)
                        ->orWhere('role_bidang_id', $roleBidang->id);
                });
            } else {
                // Jika role bidang tidak ditemukan, tampilkan kosong
                $pengaduans = collect();
                return view('admin.pengaduanIndex', compact('pengaduans'));
            }
        }

        // ✅ FITUR SEARCH - Filter berdasarkan input pencarian
        if ($request->filled('kode_verifikasi')) {
            $query->where('kode_verifikasi', 'like', '%' . $request->kode_verifikasi . '%');
        }

        if ($request->filled('kode_aduan')) {
            $query->where('kode_aduan', 'like', '%' . $request->kode_aduan . '%');
        }

        if ($request->filled('perihal')) {
            $query->where('perihal', 'like', '%' . $request->perihal . '%');
        }

        // Ambil hasil dengan sorting terbaru
        $pengaduans = $query->latest()->get();

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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);

        try {
            $validated = $request->validate([
                'verification_checks' => 'required|string',
                'verification_notes' => 'nullable|string',
                'action' => 'required|in:approve,reject',
                'bidang_id' => 'required_if:action,approve|nullable|exists:bidang_pengaduan,id',
                // ✅ UBAH JADI role_bidang_id
                'role_bidang_id' => 'required_if:action,approve|nullable|exists:role_bidang,id',
            ], [
                'bidang_id.required_if' => 'Bidang harus dipilih saat menyetujui pengaduan.',
                'bidang_id.exists' => 'Bidang yang dipilih tidak valid.',
                'role_bidang_id.required_if' => 'Role harus dipilih saat menyetujui pengaduan.',
                'role_bidang_id.exists' => 'Role yang dipilih tidak valid.',
            ]);

            $verificationChecks = $request->verification_checks;
            if (is_string($verificationChecks)) {
                $verificationChecks = json_decode($verificationChecks, true);
            }

            if (empty($verificationChecks) || count($verificationChecks) === 0) {
                return redirect()->back()->with('error', 'Harap verifikasi minimal satu field sebelum melanjutkan.');
            }

            $pengaduan->verification_checks = json_encode($verificationChecks);
            $pengaduan->verification_notes = $request->verification_notes;
            $pengaduan->verified_by = auth()->id();
            $pengaduan->verified_at = now();

            $message = '';
            $flashType = 'success';

            if ($request->action === 'approve') {
                // ✅ SIMPAN BIDANG_ID DAN ROLE_BIDANG_ID
                $pengaduan->bidang_id = $request->bidang_id;
                $pengaduan->role_bidang_id = $request->role_bidang_id; // ← UBAH INI

                $pengaduan->status = 'tindak_lanjut';
                $pengaduan->rejection_reason = null;
                $pengaduan->rejected_at = null;
                $pengaduan->rejected_by = null;
                $pengaduan->fields_to_fix = null;
                $pengaduan->updated_fields = null;

                $bidang = \App\Models\BidangPengaduan::find($request->bidang_id);
                $role = \App\Models\RoleBidang::find($request->role_bidang_id); // ← UBAH INI

                $message = "Verifikasi **BERHASIL** disetujui. Laporan dilanjutkan ke tahap **Tindak Lanjut** dan diteruskan ke bidang **{$bidang->nama_bidang}** dengan role **{$role->nama_role}**.";

            } else {
                // ... kode reject tetap sama
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
                $pengaduan->updated_fields = null;

                $flashType = 'warning';
                $message = 'Laporan **BERHASIL** dikembalikan ke pelapor.';
            }

            $pengaduan->save();

            return redirect()->route('pengaduan.index')->with($flashType, $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            \Log::error("Error processing verification for pengaduan ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Verifikasi **GAGAL** diproses. (Detail: ' . $e->getMessage() . ')');
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
            'bukti_file' => 'nullable|array|max:10',
            'bukti_file.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf,doc,docx|max:5120', // 5MB per file
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
                $rules['bukti_file.*'] = 'nullable|file|mimes:jpeg,jpg,png,pdf,doc,docx|max:5120';
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
        // Handle bukti file jika perlu diperbaiki
        if (in_array('bukti_file', $fieldsToFix) && $request->hasFile('bukti_file')) {
            $validated = $request->validate([
                'bukti_file' => 'nullable|array|max:10',
                'bukti_file.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf,doc,docx|max:5120'
            ]);

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
        $pengaduan = Pengaduan::with([
            'user',
            'bidangPengaduan',
            'roleBidang',
            'tanggapanAdminBy'
        ])->findOrFail($id);

        $user = auth()->user();

        // Admin bisa lihat semua

        if ($user->role !== 'admin') {
            $roleBidang = \App\Models\RoleBidang::where('nama_role', $user->role)->first();

            // Cek apakah pengaduan sesuai bidang/role user
            $authorized = $pengaduan->user_id === $user->id ||
                ($roleBidang && (
                    $pengaduan->bidang_id == $roleBidang->id ||
                    $pengaduan->role_bidang_id == $roleBidang->id
                ));

            if (!$authorized) {
                abort(403, 'Akses ditolak.');
            }
        }

        $bidangPengaduans = \App\Models\BidangPengaduan::where('is_active', true)->get();
        $roles = \App\Models\RoleBidang::where('is_active', true)->get();

        return view('admin.pengaduanShow', compact('pengaduan', 'bidangPengaduans', 'roles'));
    }


    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang_pengaduan,id',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->bidang_id = $request->bidang_id;
        $pengaduan->status = 'diverifikasi';
        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diverifikasi dan diteruskan ke bidang terkait.');
    }

    public function submitTanggapanAdmin(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $user = auth()->user();

        // Debug sementara: tampilkan info user & pengaduan


        // --- Validasi hak akses ---
        if ($user->role !== 'admin' && $user->role_bidang_id !== $pengaduan->role_bidang_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan tanggapan pada pengaduan ini.');
        }

        // --- Validasi form ---
        $request->validate([
            'tanggapan_admin' => 'required|string|min:10'
        ], [
            'tanggapan_admin.required' => 'Tanggapan tidak boleh kosong.',
            'tanggapan_admin.min' => 'Tanggapan minimal 10 karakter.'
        ]);

        // --- Simpan tanggapan ---
        $pengaduan->tanggapan_admin = $request->tanggapan_admin;
        $pengaduan->tanggapan_admin_at = now();
        $pengaduan->tanggapan_admin_by = $user->id;
        $pengaduan->status = 'tanggapan_pelapor'; // menunggu tanggapan pelapor

        // Tambahkan ke riwayat
        $pengaduan->addTanggapanHistory('admin', $request->tanggapan_admin, $user->id);

        $pengaduan->save();

        return redirect()->back()->with(
            'success',
            '✅ Tanggapan berhasil dikirim ke pelapor. Status pengaduan diubah menjadi "Tanggapan Pelapor".'
        );
    }



    /**
     * ✅ SUBMIT TANGGAPAN PELAPOR (User)
     */
    public function submitTanggapanPelapor(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $user = auth()->user();

        // Validasi: hanya pelapor yang bisa menanggapi
        if ($user->id !== $pengaduan->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan tanggapan pada pengaduan ini.');
        }

        $request->validate([
            'status_kepuasan' => 'required|in:puas,tidak_puas',
            'tanggapan_pelapor' => 'required_if:status_kepuasan,tidak_puas|nullable|string|min:10'
        ], [
            'status_kepuasan.required' => 'Silakan pilih status kepuasan Anda.',
            'tanggapan_pelapor.required_if' => 'Jika tidak puas, harap berikan tanggapan atau masukan.',
            'tanggapan_pelapor.min' => 'Tanggapan minimal 10 karakter.'
        ]);

        $pengaduan->status_kepuasan = $request->status_kepuasan;
        $pengaduan->tanggapan_pelapor = $request->tanggapan_pelapor;
        $pengaduan->tanggapan_pelapor_at = now();

        if ($request->status_kepuasan === 'puas') {
            // Jika puas, pengaduan selesai
            $pengaduan->status = 'selesai';
            $message = '✅ Terima kasih atas tanggapan Anda! Pengaduan ini telah **diselesaikan**.';
        } else {
            // Jika tidak puas, kembali ke tindak lanjut
            $pengaduan->status = 'tindak_lanjut';
            $pengaduan->tanggapan_admin = null; // Reset tanggapan admin
            $pengaduan->tanggapan_admin_at = null;

            // Tambah ke history
            $pengaduan->addTanggapanHistory('pelapor', $request->tanggapan_pelapor, $user->id);

            $message = '⚠️ Tanggapan Anda telah dikirim. Pengaduan akan **ditindaklanjuti kembali** oleh pihak berwenang.';
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.create')->with('success', $message);
    }

    /**
     * ✅ VIEW DETAIL TANGGAPAN (untuk user melihat tanggapan yang diberikan)
     */
    public function viewTanggapan($id)
    {
        $pengaduan = Pengaduan::with([
            'user',
            'bidangPengaduan',
            'roleBidang',
            'tanggapanAdminBy'
        ])->findOrFail($id);

        // Cek akses
        if (auth()->id() !== $pengaduan->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('pengaduan.tanggapan', compact('pengaduan'));
    }


    public function storeTanggapan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_kepuasan' => 'required|in:puas,tidak_puas',
            'tanggapan_pelapor' => 'required_if:status_kepuasan,tidak_puas|nullable|string|min:10',
        ], [
            'status_kepuasan.required' => 'Status kepuasan wajib dipilih',
            'tanggapan_pelapor.required_if' => 'Tanggapan wajib diisi jika Anda tidak puas',
            'tanggapan_pelapor.min' => 'Tanggapan minimal 10 karakter',
        ]);

        // Cari laporan berdasarkan ID
        $laporan = Pengaduan::findOrFail($id);

        // Pastikan laporan milik user yang login
        if ($laporan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menanggapi laporan ini.');
        }

        // Pastikan status laporan adalah 'tanggapan_pelapor'
        if ($laporan->status !== 'tanggapan_pelapor') {
            return redirect()->back()->with('error', 'Laporan ini tidak memerlukan tanggapan saat ini.');
        }

        // Simpan data tanggapan dan status kepuasan
        $laporan->tanggapan_pelapor = $request->tanggapan_pelapor;
        $laporan->status_kepuasan = $request->status_kepuasan;
        $laporan->tanggapan_pelapor_at = now();

        // Tentukan status berdasarkan kepuasan
        if ($request->status_kepuasan === 'puas') {
            // Jika puas, pengaduan selesai
            $laporan->status = 'selesai';
            $message = '✅ Terima kasih atas tanggapan Anda! Pengaduan ini telah **diselesaikan**.';

            // Tambah ke history
            $laporan->addTanggapanHistory('pelapor', 'Pelapor menyatakan PUAS dengan tanggapan', auth()->id());

        } else {
            // Jika tidak puas, kembali ke tindak lanjut
            $laporan->status = 'tindak_lanjut';

            // Reset tanggapan admin agar bisa ditanggapi ulang
            $laporan->tanggapan_admin = null;
            $laporan->tanggapan_admin_at = null;
            $laporan->tanggapan_admin_by = null;

            // Tambah ke history dengan tanggapan pelapor
            $laporan->addTanggapanHistory('pelapor', $request->tanggapan_pelapor, auth()->id());

            $message = '⚠️ Tanggapan Anda telah dikirim. Pengaduan akan **ditindaklanjuti kembali** oleh pihak berwenang.';
        }

        $laporan->save();

        // Redirect ke halaman form pengaduan dengan pesan sukses
        return redirect()->route('pengaduan.create')->with('success', $message);
    }

    /**
     * Menampilkan halaman tanggapan (opsional, jika Anda ingin halaman terpisah)
     */
    public function showTanggapan($id)
    {
        $laporan = Pengaduan::with('roleBidang')->findOrFail($id);

        // Pastikan laporan milik user yang login
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat tanggapan ini.');
        }

        return view('pengaduan.tanggapan', compact('laporan'));
    }

    /**
     * Menampilkan halaman feedback untuk laporan yang ditolak
     */
    public function showFeedback($id)
    {
        $laporan = Pengaduan::findOrFail($id);

        // Pastikan laporan milik user yang login
        if ($laporan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat feedback ini.');
        }

        // Pastikan laporan memiliki feedback (rejected_at tidak null)
        if (!$laporan->rejected_at) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Laporan ini tidak memiliki feedback.');
        }

        return view('pengaduan.feedback', compact('laporan'));
    }

}