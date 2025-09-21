<?php

namespace App\Http\Controllers\Piagam;

use App\Http\Controllers\Controller;
use App\Models\PiagamSPI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PiagamSPIController extends Controller
{
    public function index()
    {
        $title = "PIAGAM SPI";
        $piagams = PiagamSPI::all();

        return view('PiagamSPI.index', compact('title', 'piagams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $piagam = new PiagamSPI();
        $piagam->judul = $request->judul;
        $piagam->tahun = $request->tahun;
        $piagam->kata_kunci = $request->kata_kunci;
        $piagam->abstrak = $request->abstrak;
        $piagam->catatan = $request->catatan;
        // metadata sama persis dengan konsideran…
        $piagam->tipe_dokumen = $request->tipe_dokumen;
        $piagam->judul_meta = $request->judul_meta;
        $piagam->teu = $request->teu;
        $piagam->nomor = $request->nomor;
        $piagam->bentuk = $request->bentuk;
        $piagam->bentuk_singkat = $request->bentuk_singkat;
        $piagam->tahun_meta = $request->tahun_meta;
        $piagam->tempat_penetapan = $request->tempat_penetapan;
        $piagam->tanggal_penetapan = $request->tanggal_penetapan;
        $piagam->tanggal_pengundangan = $request->tanggal_pengundangan;
        $piagam->tanggal_berlaku = $request->tanggal_berlaku;
        $piagam->sumber = $request->sumber;
        $piagam->subjek = $request->subjek;
        $piagam->status = $request->status;
        $piagam->bahasa = $request->bahasa;
        $piagam->lokasi = $request->lokasi;
        $piagam->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PiagamSPI_pdfs', 'public');
            $piagam->file_pdf = $path;
        }

        $piagam->mencabut = $request->mencabut;
        $piagam->save();

        return redirect()->back()->with('success', 'Piagam SPI berhasil disimpan.');
    }

    public function show($id)
    {
        $piagam = PiagamSPI::findOrFail($id);
        return view('PiagamSPI.detail', compact('piagam'));
    }

    public function edit($id)
    {
        $piagam = PiagamSPI::findOrFail($id);
        return view('PiagamSPI.edit', compact('piagam'));
    }

    public function update(Request $request, $id)
    {
        $piagam = PiagamSPI::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $piagam->judul = $request->judul;
        $piagam->tahun = $request->tahun;
        $piagam->kata_kunci = $request->kata_kunci;
        $piagam->abstrak = $request->abstrak;
        $piagam->catatan = $request->catatan;
        $piagam->tipe_dokumen = $request->tipe_dokumen;
        $piagam->judul_meta = $request->judul_meta;
        $piagam->teu = $request->teu;
        $piagam->nomor = $request->nomor;
        $piagam->bentuk = $request->bentuk;
        $piagam->bentuk_singkat = $request->bentuk_singkat;
        $piagam->tahun_meta = $request->tahun_meta;
        $piagam->tempat_penetapan = $request->tempat_penetapan;
        $piagam->tanggal_penetapan = $request->tanggal_penetapan;
        $piagam->tanggal_pengundangan = $request->tanggal_pengundangan;
        $piagam->tanggal_berlaku = $request->tanggal_berlaku;
        $piagam->sumber = $request->sumber;
        $piagam->subjek = $request->subjek;
        $piagam->status = $request->status;
        $piagam->bahasa = $request->bahasa;
        $piagam->lokasi = $request->lokasi;
        $piagam->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($piagam->file_pdf && Storage::disk('public')->exists($piagam->file_pdf)) {
                Storage::disk('public')->delete($piagam->file_pdf);
            }
            $path = $request->file('file_pdf')->store('PiagamSPI_pdfs', 'public');
            $piagam->file_pdf = $path;
        }

        $piagam->mencabut = $request->mencabut;
        $piagam->save();

        return redirect()->back()->with('success', 'Piagam SPI berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $piagam = PiagamSPI::findOrFail($id);

        if ($piagam->file_pdf && Storage::disk('public')->exists($piagam->file_pdf)) {
            Storage::disk('public')->delete($piagam->file_pdf);
        }

        $piagam->delete();

        return redirect()->back()->with('success', 'Piagam SPI berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PIAGAM SPI";
        $piagams = PiagamSPI::all();
        return view('PiagamSPI.lihat', compact('title', 'piagams'));
    }

    public function showJson($id)
    {
        return response()->json(PiagamSPI::findOrFail($id));
    }

}
