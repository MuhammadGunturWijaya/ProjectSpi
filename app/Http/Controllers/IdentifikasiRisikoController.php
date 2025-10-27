<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifikasiRisiko;
use App\Models\Bagian;
class IdentifikasiRisikoController extends Controller
{

    public function index()
    {
        $risikos = IdentifikasiRisiko::all();
        return view('identifikasi.index', compact('risikos'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string|max:255',
            'unit' => 'required|string|max:255', // wajib, sesuai form select
            'proses_bisnis' => 'required|string|max:255',
            'kategori_risiko' => 'required|string|max:255',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string|max:255',
            'skor_likelihood' => 'required|integer|min:1|max:5',
            'skor_impact' => 'required|integer|min:1|max:5',
            'skor_level' => 'nullable|string|max:50',

            'pengendalian_intern_ada' => 'nullable|string|max:50',
            'pengendalian_intern_memadai' => 'nullable|string|max:50',
            'pengendalian_intern_dijalankan' => 'nullable|integer|min:0|max:100',

            'residu_likelihood' => 'nullable|integer|min:1|max:5',
            'residu_impact' => 'nullable|integer|min:1|max:5',
            'residu_level' => 'nullable|string|max:50',

            'mitigasi_opsi' => 'nullable|string|max:255',
            'mitigasi_deskripsi' => 'nullable|string',

            'akhir_likelihood' => 'nullable|integer|min:1|max:5',
            'akhir_impact' => 'nullable|integer|min:1|max:5',
            'akhir_level' => 'nullable|string|max:50',
        ]);

        // Hitung level-level otomatis
        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        // Simpan ke database
        IdentifikasiRisiko::create([
            'abjad' => $validated['abjad'],
            'tujuan' => $validated['tujuan'],
            'bagian' => $validated['unit'], // <-- simpan unit ke kolom bagian
            'proses_bisnis' => $validated['proses_bisnis'],
            'kategori_risiko' => $validated['kategori_risiko'],
            'uraian_risiko' => $validated['uraian_risiko'],
            'penyebab_risiko' => $validated['penyebab_risiko'],
            'sumber_risiko' => $validated['sumber_risiko'],
            'akibat' => $validated['akibat'],
            'pemilik_risiko' => $validated['pemilik_risiko'],
            'skor_likelihood' => $validated['skor_likelihood'],
            'skor_impact' => $validated['skor_impact'],
            'skor_level' => $validated['skor_level'],
            'pengendalian_intern_ada' => $validated['pengendalian_intern_ada'] ?? null,
            'pengendalian_intern_memadai' => $validated['pengendalian_intern_memadai'] ?? null,
            'pengendalian_intern_dijalankan' => $validated['pengendalian_intern_dijalankan'] ?? null,
            'residu_likelihood' => $validated['residu_likelihood'] ?? null,
            'residu_impact' => $validated['residu_impact'] ?? null,
            'residu_level' => $validated['residu_level'] ?? null,
            'mitigasi_opsi' => $validated['mitigasi_opsi'] ?? null,
            'mitigasi_deskripsi' => $validated['mitigasi_deskripsi'] ?? null,
            'akhir_likelihood' => $validated['akhir_likelihood'] ?? null,
            'akhir_impact' => $validated['akhir_impact'] ?? null,
            'akhir_level' => $validated['akhir_level'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Data risiko berhasil disimpan!');
    }


    public function create()
    {
        return view('identifikasi.editRisiko');
    }

    public function edit($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        return view('identifikasi.editRisiko', compact('risiko'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string|max:255',
            'proses_bisnis' => 'required|string|max:255',
            'kategori_risiko' => 'required|string|max:255',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string|max:255',

            // validasi tambahan field baru
            'departemen' => 'required|string|max:255',
            'skor_likelihood' => 'required|integer|min:1|max:5',
            'skor_impact' => 'required|integer|min:1|max:5',
            'skor_level' => 'required|string|max:50',

            'pengendalian_intern_ada' => 'required|string|max:50',
            'pengendalian_intern_memadai' => 'required|string|max:50',
            'pengendalian_intern_dijalankan' => 'required|string|max:50',

            'residu_likelihood' => 'required|integer|min:1|max:5',
            'residu_impact' => 'required|integer|min:1|max:5',
            'residu_level' => 'required|string|max:50',

            'mitigasi_opsi' => 'required|string|max:255',
            'mitigasi_deskripsi' => 'required|string',

            'akhir_likelihood' => 'required|integer|min:1|max:5',
            'akhir_impact' => 'required|integer|min:1|max:5',
            'akhir_level' => 'required|string|max:50',
        ]);

        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->update($request->all());

        return redirect()->route('identifikasi.risiko.index')
            ->with('success', 'Data risiko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()->route('identifikasi.risiko.index')
            ->with('success', 'Data risiko berhasil dihapus!');
    }

    public function evaluasiMr()
    {
        $risikos = IdentifikasiRisiko::all();
        $bagians = IdentifikasiRisiko::whereNotNull('bagian')
            ->distinct()
            ->pluck('bagian'); // ambil semua bagian unik, yang ada isinya

       
        return view('identifikasi.evaluasiMr', compact('risikos', 'bagians'));

    }


    // --------------------

    // Form tambah risiko baru
    public function createEvaluasiMr()
    {
        $bagians = Bagian::all(); // ambil semua unit/bagian
        return view('identifikasi.evaluasiMr_form', compact('bagians'));
    }


    public function editEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $bagians = Bagian::all(); // ambil semua unit/bagian
        return view('identifikasi.evaluasiMr_form', compact('risiko', 'bagians'));
    }


    // Simpan data risiko baru
    public function storeEvaluasiMr(Request $request)
    {
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string',
            'unit' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'proses_bisnis' => 'required|string',
            'kategori_risiko' => 'required|string',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string',
            'skor_likelihood' => 'required|integer|min:1|max:5',
            'skor_impact' => 'required|integer|min:1|max:5',

            // pengendalian intern
            'pengendalian_intern_ada' => 'nullable|in:ya,tidak',
            'pengendalian_intern_memadai' => 'nullable|in:ya,tidak',
            'pengendalian_intern_dijalankan' => 'nullable|integer|min:0|max:100',

            // keterangan baru
            'pengendalian_intern_ada_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_memadai_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_dijalankan_keterangan' => 'nullable|string|max:255',

            // residu
            'residu_likelihood' => 'nullable|integer|min:1|max:5',
            'residu_impact' => 'nullable|integer|min:1|max:5',

            // mitigasi
            'mitigasi_opsi' => 'nullable|string|max:255',
            'mitigasi_opsi_keterangan' => 'nullable|string|max:255',
            'mitigasi_deskripsi' => 'nullable|string',

            // akhir
            'akhir_likelihood' => 'nullable|integer|min:1|max:5',
            'akhir_impact' => 'nullable|integer|min:1|max:5',
        ]);

        // hitung level-level
        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        // simpan ke tabel identifikasi_risiko
        $risiko = new IdentifikasiRisiko();
        $risiko->abjad = $validated['abjad'];
        $risiko->tujuan = $validated['tujuan'];
        $risiko->bagian = $validated['unit']; // <-- unit ke kolom bagian
        $risiko->departemen = $validated['departemen'];
        $risiko->proses_bisnis = $validated['proses_bisnis'];
        $risiko->kategori_risiko = $validated['kategori_risiko'];
        $risiko->uraian_risiko = $validated['uraian_risiko'];
        $risiko->penyebab_risiko = $validated['penyebab_risiko'];
        $risiko->sumber_risiko = $validated['sumber_risiko'];
        $risiko->akibat = $validated['akibat'];
        $risiko->pemilik_risiko = $validated['pemilik_risiko'];

        // PENGENDALIAN INTERN
        $risiko->pengendalian_intern_ada = $validated['pengendalian_intern_ada'] ?? null;
        $risiko->pengendalian_intern_memadai = $validated['pengendalian_intern_memadai'] ?? null;
        $risiko->pengendalian_intern_dijalankan = $validated['pengendalian_intern_dijalankan'] ?? null;
        $risiko->pengendalian_intern_ada_keterangan = $validated['pengendalian_intern_ada_keterangan'] ?? null;
        $risiko->pengendalian_intern_memadai_keterangan = $validated['pengendalian_intern_memadai_keterangan'] ?? null;
        $risiko->pengendalian_intern_dijalankan_keterangan = $validated['pengendalian_intern_dijalankan_keterangan'] ?? null;

        // SKOR AWAL
        $risiko->skor_likelihood = $validated['skor_likelihood'];  // <-- pastikan ini ditambahkan
        $risiko->skor_impact = $validated['skor_impact'];          // <-- pastikan ini ditambahkan
        $risiko->skor_level = $validated['skor_level'];

        // RESIDU
        $risiko->residu_likelihood = $validated['residu_likelihood'] ?? null;
        $risiko->residu_impact = $validated['residu_impact'] ?? null;
        $risiko->residu_level = $validated['residu_level'] ?? null;

        // MITIGASI
        $risiko->mitigasi_opsi = $validated['mitigasi_opsi'] ?? null;
        $risiko->mitigasi_opsi_keterangan = $validated['mitigasi_opsi_keterangan'] ?? null;
        $risiko->mitigasi_deskripsi = $validated['mitigasi_deskripsi'] ?? null;

        // SKOR AKHIR
        $risiko->akhir_likelihood = $validated['akhir_likelihood'] ?? null;
        $risiko->akhir_impact = $validated['akhir_impact'] ?? null;
        $risiko->akhir_level = $validated['akhir_level'] ?? null;

        $risiko->save();


        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil ditambahkan!');
    }


    public function updateEvaluasiMr(Request $request, $id)
    {
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string',
            'unit' => 'required|string|max:255', // <-- ambil dari select unit
            'proses_bisnis' => 'required|string',
            'kategori_risiko' => 'required|string',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string',
            'skor_likelihood' => 'required|integer|min:1|max:5',
            'skor_impact' => 'required|integer|min:1|max:5',

            // pengendalian intern
            'pengendalian_intern_ada' => 'nullable|in:ya,tidak',
            'pengendalian_intern_memadai' => 'nullable|in:ya,tidak',
            'pengendalian_intern_dijalankan' => 'nullable|integer|min:0|max:100',

            // keterangan baru
            'pengendalian_intern_ada_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_memadai_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_dijalankan_keterangan' => 'nullable|string|max:255',

            // residu
            'residu_likelihood' => 'nullable|integer|min:1|max:5',
            'residu_impact' => 'nullable|integer|min:1|max:5',

            // mitigasi
            'mitigasi_opsi' => 'nullable|string|max:255',
            'mitigasi_opsi_keterangan' => 'nullable|string|max:255',
            'mitigasi_deskripsi' => 'nullable|string',

            // akhir
            'akhir_likelihood' => 'nullable|integer|min:1|max:5',
            'akhir_impact' => 'nullable|integer|min:1|max:5',
        ]);

        // hitung level-level
        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        // update data
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->update([
            'abjad' => $validated['abjad'],
            'tujuan' => $validated['tujuan'],
            'bagian' => $validated['unit'], // <-- update kolom bagian dari unit
            'departemen' => $validated['departemen'],
            'proses_bisnis' => $validated['proses_bisnis'],
            'kategori_risiko' => $validated['kategori_risiko'],
            'uraian_risiko' => $validated['uraian_risiko'],
            'penyebab_risiko' => $validated['penyebab_risiko'],
            'sumber_risiko' => $validated['sumber_risiko'],
            'akibat' => $validated['akibat'],
            'pemilik_risiko' => $validated['pemilik_risiko'],
            'pengendalian_intern_ada' => $validated['pengendalian_intern_ada'] ?? null,
            'pengendalian_intern_memadai' => $validated['pengendalian_intern_memadai'] ?? null,
            'pengendalian_intern_dijalankan' => $validated['pengendalian_intern_dijalankan'] ?? null,
            'pengendalian_intern_ada_keterangan' => $validated['pengendalian_intern_ada_keterangan'] ?? null,
            'pengendalian_intern_memadai_keterangan' => $validated['pengendalian_intern_memadai_keterangan'] ?? null,
            'pengendalian_intern_dijalankan_keterangan' => $validated['pengendalian_intern_dijalankan_keterangan'] ?? null,
            'skor_likelihood' => $validated['skor_likelihood'], // TAMBAHKAN INI
            'skor_impact' => $validated['skor_impact'],         // TAMBAHKAN INI
            'skor_level' => $validated['skor_level'],           // sudah ada
            'residu_likelihood' => $validated['residu_likelihood'] ?? null,
            'residu_impact' => $validated['residu_impact'] ?? null,
            'residu_level' => $validated['residu_level'] ?? null,
            'mitigasi_opsi' => $validated['mitigasi_opsi'] ?? null,
            'mitigasi_opsi_keterangan' => $validated['mitigasi_opsi_keterangan'] ?? null,
            'mitigasi_deskripsi' => $validated['mitigasi_deskripsi'] ?? null,
            'akhir_likelihood' => $validated['akhir_likelihood'] ?? null,
            'akhir_impact' => $validated['akhir_impact'] ?? null,
            'akhir_level' => $validated['akhir_level'] ?? null,
            'skor_level' => $validated['skor_level'],
        ]);

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil diperbarui!');
    }



    public function destroyEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil dihapus!');
    }



}
