<?php

namespace App\Http\Controllers\Akuntabilitas;

use App\Http\Controllers\Controller;
use App\Models\PenguatanAkuntabilitas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PenguatanAkuntabilitasController extends Controller
{
    public function index()
    {
        $title = "PENGUATAN AKUNTABILITAS";
        $penguatans = PenguatanAkuntabilitas::all();

        return view('PenguatanAkuntabilitas.index', compact('title', 'penguatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $penguatan = new PenguatanAkuntabilitas();
        $penguatan->judul = $request->judul;
        $penguatan->tahun = $request->tahun;
        $penguatan->kata_kunci = $request->kata_kunci;
        $penguatan->abstrak = $request->abstrak;
        $penguatan->catatan = $request->catatan;
        $penguatan->tipe_dokumen = $request->tipe_dokumen;
        $penguatan->judul_meta = $request->judul_meta;
        $penguatan->teu = $request->teu;
        $penguatan->nomor = $request->nomor;
        $penguatan->bentuk = $request->bentuk;
        $penguatan->bentuk_singkat = $request->bentuk_singkat;
        $penguatan->tahun_meta = $request->tahun_meta;
        $penguatan->tempat_penetapan = $request->tempat_penetapan;
        $penguatan->tanggal_penetapan = $request->tanggal_penetapan;
        $penguatan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $penguatan->tanggal_berlaku = $request->tanggal_berlaku;
        $penguatan->sumber = $request->sumber;
        $penguatan->subjek = $request->subjek;
        $penguatan->status = $request->status;
        $penguatan->bahasa = $request->bahasa;
        $penguatan->lokasi = $request->lokasi;
        $penguatan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PenguatanAkuntabilitas_pdfs', 'public');
            $penguatan->file_pdf = $path;
        }

        $penguatan->mencabut = $request->mencabut;
        $penguatan->save();

        return redirect()->back()->with('success', 'Penguatan Akuntabilitas berhasil disimpan.');
    }

    public function show($id)
    {
        $penguatan = PenguatanAkuntabilitas::findOrFail($id);
        return view('PenguatanAkuntabilitas.detail', compact('penguatan'));
    }

    public function edit($id)
    {
        $penguatan = PenguatanAkuntabilitas::findOrFail($id);
        return view('PenguatanAkuntabilitas.edit', compact('penguatan'));
    }

    public function update(Request $request, $id)
    {
        $penguatan = PenguatanAkuntabilitas::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'tahun'    => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $penguatan->judul = $request->judul;
        $penguatan->tahun = $request->tahun;
        $penguatan->kata_kunci = $request->kata_kunci;
        $penguatan->abstrak = $request->abstrak;
        $penguatan->catatan = $request->catatan;
        $penguatan->tipe_dokumen = $request->tipe_dokumen;
        $penguatan->judul_meta = $request->judul_meta;
        $penguatan->teu = $request->teu;
        $penguatan->nomor = $request->nomor;
        $penguatan->bentuk = $request->bentuk;
        $penguatan->bentuk_singkat = $request->bentuk_singkat;
        $penguatan->tahun_meta = $request->tahun_meta;
        $penguatan->tempat_penetapan = $request->tempat_penetapan;
        $penguatan->tanggal_penetapan = $request->tanggal_penetapan;
        $penguatan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $penguatan->tanggal_berlaku = $request->tanggal_berlaku;
        $penguatan->sumber = $request->sumber;
        $penguatan->subjek = $request->subjek;
        $penguatan->status = $request->status;
        $penguatan->bahasa = $request->bahasa;
        $penguatan->lokasi = $request->lokasi;
        $penguatan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($penguatan->file_pdf && Storage::disk('public')->exists($penguatan->file_pdf)) {
                Storage::disk('public')->delete($penguatan->file_pdf);
            }
            $path = $request->file('file_pdf')->store('PenguatanAkuntabilitas_pdfs', 'public');
            $penguatan->file_pdf = $path;
        }

        $penguatan->mencabut = $request->mencabut;
        $penguatan->save();

        return redirect()->back()->with('success', 'Penguatan Akuntabilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penguatan = PenguatanAkuntabilitas::findOrFail($id);

        if ($penguatan->file_pdf && Storage::disk('public')->exists($penguatan->file_pdf)) {
            Storage::disk('public')->delete($penguatan->file_pdf);
        }

        $penguatan->delete();

        return redirect()->back()->with('success', 'Penguatan Akuntabilitas berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PENGUATAN AKUNTABILITAS";
        $penguatans = PenguatanAkuntabilitas::all();
        return view('PenguatanAkuntabilitas.lihat', compact('title', 'penguatans'));
    }

    public function showJson($id)
    {
        return response()->json(PenguatanAkuntabilitas::findOrFail($id));
    }
}
