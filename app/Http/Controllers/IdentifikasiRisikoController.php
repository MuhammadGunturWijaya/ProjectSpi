<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifikasiRisiko;

class IdentifikasiRisikoController extends Controller
{

    public function index()
    {
        $risikos = IdentifikasiRisiko::all();
        return view('identifikasi.index', compact('risikos'));
    }

    public function store(Request $request)
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

            // tambahan field baru
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

        IdentifikasiRisiko::create($request->all());

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
        $risikos = \App\Models\IdentifikasiRisiko::all();
        return view('identifikasi.evaluasiMr', compact('risikos'));
    }

    // --------------------

    // Form tambah risiko baru
    public function createEvaluasiMr()
    {
        return view('identifikasi.evaluasiMr_form'); // bukan evaluasiMr_create
    }

    public function editEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        return view('identifikasi.evaluasiMr_form', compact('risiko')); // bukan evaluasiMr_edit
    }


    // Simpan data risiko baru
    public function storeEvaluasiMr(Request $request)
    {
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string',
            'proses_bisnis' => 'required|string',
            'kategori_risiko' => 'required|string',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string',
            'likelihood' => 'required|integer|min:1|max:5',
            'impact' => 'required|integer|min:1|max:5',
        ]);

        // hitung level otomatis
        $validated['level'] = $validated['likelihood'] * $validated['impact'];

        IdentifikasiRisiko::create($validated);

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil ditambahkan!');

    }


    // Update data risiko
    public function updateEvaluasiMr(Request $request, $id)
    {
        $validated = $request->validate([
            'abjad' => 'required|string|max:5',
            'tujuan' => 'required|string',
            'proses_bisnis' => 'required|string',
            'kategori_risiko' => 'required|string',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string',
            'likelihood' => 'required|integer|min:1|max:5',
            'impact' => 'required|integer|min:1|max:5',
        ]);

        // hitung level otomatis
        $validated['level'] = $validated['likelihood'] * $validated['impact'];

        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->update($validated);

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil diperbarui!');

    }

    public function destroyEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()->route('evaluasiMr.index')->with('success', 'Data risiko berhasil dihapus!');
    }



}
