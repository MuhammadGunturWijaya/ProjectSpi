<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifikasiRisiko;
use App\Models\IdentifikasiRisikoHistory;
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
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
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

        // Hitung skor level otomatis
        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        IdentifikasiRisiko::create([
            'abjad' => $validated['abjad'],
            'tujuan' => $validated['tujuan'],
            'bagian' => $validated['unit'],
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

    public function evaluasiMr()
    {
        $risikos = IdentifikasiRisiko::all();
        $bagians = IdentifikasiRisiko::whereNotNull('bagian')->distinct()->pluck('bagian');
        return view('identifikasi.evaluasiMr', compact('risikos', 'bagians'));
    }

    public function createEvaluasiMr()
    {
        $bagians = Bagian::all();
        return view('identifikasi.evaluasiMr_form', compact('bagians'));
    }

    public function editEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::with('histories')->findOrFail($id);
        $bagians = Bagian::all();
        return view('identifikasi.evaluasiMr_form', compact('risiko', 'bagians'));
    }

    public function storeEvaluasiMr(Request $request)
    {
        $validated = $request->validate([
            'tanggal_evaluasi' => 'required|date',
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
            'pengendalian_intern_ada' => 'nullable|in:ya,tidak',
            'pengendalian_intern_memadai' => 'nullable|in:ya,tidak',
            'pengendalian_intern_dijalankan' => 'nullable|integer|min:0|max:100',
            'pengendalian_intern_ada_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_memadai_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_dijalankan_keterangan' => 'nullable|string|max:255',
            'residu_likelihood' => 'nullable|integer|min:1|max:5',
            'residu_impact' => 'nullable|integer|min:1|max:5',
            'mitigasi_opsi' => 'nullable|string|max:255',
            'mitigasi_opsi_keterangan' => 'nullable|string|max:255',
            'mitigasi_deskripsi' => 'nullable|string',
            'akhir_likelihood' => 'nullable|integer|min:1|max:5',
            'akhir_impact' => 'nullable|integer|min:1|max:5',
            'akhir_level' => 'nullable|string|max:50',
            'residu_level' => 'nullable|string|max:50',
        ]);

        // Hitung level-level otomatis
        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        // Simpan data utama risiko
        $risiko = new IdentifikasiRisiko($validated);
        $risiko->bagian = $validated['unit'];
        $risiko->save();

        // Simpan history evaluasi
        IdentifikasiRisikoHistory::create([
            'identifikasi_risiko_id' => $risiko->id,
            'tanggal_evaluasi' => $validated['tanggal_evaluasi'],
            'abjad' => $validated['abjad'],
            'tujuan' => $validated['tujuan'],
            'unit' => $validated['unit'],
            'bagian' => $validated['unit'],
            'departemen' => $validated['departemen'],
            'proses_bisnis' => $validated['proses_bisnis'],
            'kategori_risiko' => $validated['kategori_risiko'],
            'uraian_risiko' => $validated['uraian_risiko'],
            'penyebab_risiko' => $validated['penyebab_risiko'],
            'sumber_risiko' => $validated['sumber_risiko'],
            'akibat' => $validated['akibat'],
            'pemilik_risiko' => $validated['pemilik_risiko'],
            'skor_likelihood' => $validated['skor_likelihood'],
            'skor_impact' => $validated['skor_impact'],
            'skor_level' => $validated['skor_level'] ?? null,

            'pengendalian_intern_ada' => $validated['pengendalian_intern_ada'] ?? null,
            'pengendalian_intern_memadai' => $validated['pengendalian_intern_memadai'] ?? null,
            'pengendalian_intern_dijalankan' => $validated['pengendalian_intern_dijalankan'] ?? null,
            'pengendalian_intern_ada_keterangan' => $validated['pengendalian_intern_ada_keterangan'] ?? null,
            'pengendalian_intern_memadai_keterangan' => $validated['pengendalian_intern_memadai_keterangan'] ?? null,
            'pengendalian_intern_dijalankan_keterangan' => $validated['pengendalian_intern_dijalankan_keterangan'] ?? null,

            'residu_likelihood' => $validated['residu_likelihood'] ?? null,
            'residu_impact' => $validated['residu_impact'] ?? null,
            'residu_level' => $validated['residu_level'] ?? null,

            'mitigasi_opsi' => $validated['mitigasi_opsi'] ?? null,
            'mitigasi_opsi_keterangan' => $validated['mitigasi_opsi_keterangan'] ?? null,
            'mitigasi_deskripsi' => $validated['mitigasi_deskripsi'] ?? null,

            'akhir_likelihood' => $validated['akhir_likelihood'] ?? null,
            'akhir_impact' => $validated['akhir_impact'] ?? null,
            'akhir_level' => $validated['akhir_level'] ?? null,

        ]);





        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil ditambahkan!');
    }

    public function updateEvaluasiMr(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_evaluasi' => 'required|date',
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
            'pengendalian_intern_ada' => 'nullable|in:ya,tidak',
            'pengendalian_intern_memadai' => 'nullable|in:ya,tidak',
            'pengendalian_intern_dijalankan' => 'nullable|integer|min:0|max:100',
            'pengendalian_intern_ada_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_memadai_keterangan' => 'nullable|string|max:255',
            'pengendalian_intern_dijalankan_keterangan' => 'nullable|string|max:255',
            'residu_likelihood' => 'nullable|integer|min:1|max:5',
            'residu_impact' => 'nullable|integer|min:1|max:5',
            'mitigasi_opsi' => 'nullable|string|max:255',
            'mitigasi_opsi_keterangan' => 'nullable|string|max:255',
            'mitigasi_deskripsi' => 'nullable|string',
            'akhir_likelihood' => 'nullable|integer|min:1|max:5',
            'akhir_impact' => 'nullable|integer|min:1|max:5',
            'akhir_level' => 'nullable|string|max:50',
            'residu_level' => 'nullable|string|max:50',
        ]);

        $validated['skor_level'] = $validated['skor_likelihood'] * $validated['skor_impact'];
        if (isset($validated['residu_likelihood'], $validated['residu_impact'])) {
            $validated['residu_level'] = $validated['residu_likelihood'] * $validated['residu_impact'];
        }
        if (isset($validated['akhir_likelihood'], $validated['akhir_impact'])) {
            $validated['akhir_level'] = $validated['akhir_likelihood'] * $validated['akhir_impact'];
        }

        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->update($validated);
        $risiko->bagian = $validated['unit'];
        $risiko->save();

        // Tambah history baru setiap kali update
        IdentifikasiRisikoHistory::create([
            'identifikasi_risiko_id' => $risiko->id,
            'tanggal_evaluasi' => $validated['tanggal_evaluasi'],
            'abjad' => $validated['abjad'],
            'tujuan' => $validated['tujuan'],
            'unit' => $validated['unit'],
            'bagian' => $validated['unit'],
            'departemen' => $validated['departemen'],
            'proses_bisnis' => $validated['proses_bisnis'],
            'kategori_risiko' => $validated['kategori_risiko'],
            'uraian_risiko' => $validated['uraian_risiko'],
            'penyebab_risiko' => $validated['penyebab_risiko'],
            'sumber_risiko' => $validated['sumber_risiko'],
            'akibat' => $validated['akibat'],
            'pemilik_risiko' => $validated['pemilik_risiko'],
            'skor_likelihood' => $validated['skor_likelihood'],
            'skor_impact' => $validated['skor_impact'],
            'skor_level' => $validated['skor_level'] ?? null,

            'pengendalian_intern_ada' => $validated['pengendalian_intern_ada'] ?? null,
            'pengendalian_intern_memadai' => $validated['pengendalian_intern_memadai'] ?? null,
            'pengendalian_intern_dijalankan' => $validated['pengendalian_intern_dijalankan'] ?? null,
            'pengendalian_intern_ada_keterangan' => $validated['pengendalian_intern_ada_keterangan'] ?? null,
            'pengendalian_intern_memadai_keterangan' => $validated['pengendalian_intern_memadai_keterangan'] ?? null,
            'pengendalian_intern_dijalankan_keterangan' => $validated['pengendalian_intern_dijalankan_keterangan'] ?? null,

            'residu_likelihood' => $validated['residu_likelihood'] ?? null,
            'residu_impact' => $validated['residu_impact'] ?? null,
            'residu_level' => $validated['residu_level'] ?? null,

            'mitigasi_opsi' => $validated['mitigasi_opsi'] ?? null,
            'mitigasi_opsi_keterangan' => $validated['mitigasi_opsi_keterangan'] ?? null,
            'mitigasi_deskripsi' => $validated['mitigasi_deskripsi'] ?? null,

            'akhir_likelihood' => $validated['akhir_likelihood'] ?? null,
            'akhir_impact' => $validated['akhir_impact'] ?? null,
            'akhir_level' => $validated['akhir_level'] ?? null,

        ]);

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bagian = Bagian::findOrFail($id);
        $bagian->delete();
        return response()->json(['success' => true]);
    }

    public function updateBagian(Request $request, $id)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ]);

        $bagian = Bagian::findOrFail($id);
        $bagian->nama_bagian = $request->nama_bagian;
        $bagian->save();

        return response()->json(['success' => true]);
    }



    public function destroyEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->delete();
        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil dihapus!');
    }
}
