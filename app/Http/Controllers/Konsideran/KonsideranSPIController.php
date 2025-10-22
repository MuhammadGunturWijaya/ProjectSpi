<?php

namespace App\Http\Controllers\Konsideran;

use App\Http\Controllers\Controller;
use App\Models\KonsideranSPI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KonsideranSPIController extends Controller
{
    // Halaman utama Konsideran SPI
    public function index()
    {
        $title = "KONSIDERAN SPI";
        $konsiderans = KonsideranSPI::all();

        return view('KonsideranSPI.index', compact('title', 'konsiderans'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $Konsideran = new KonsideranSPI();

        $Konsideran->judul = $request->judul;
        $Konsideran->tahun = $request->tahun;
        $Konsideran->kata_kunci = $request->kata_kunci;
        $Konsideran->abstrak = $request->abstrak;
        $Konsideran->catatan = $request->catatan;

        // Metadata
        $Konsideran->tipe_dokumen = $request->tipe_dokumen;
        $Konsideran->judul_meta = $request->judul_meta;
        $Konsideran->teu = $request->teu;
        $Konsideran->nomor = $request->nomor;
        $Konsideran->bentuk = $request->bentuk;
        $Konsideran->bentuk_singkat = $request->bentuk_singkat;
        $Konsideran->tahun_meta = $request->tahun_meta;
        $Konsideran->tempat_penetapan = $request->tempat_penetapan;
        $Konsideran->tanggal_penetapan = $request->tanggal_penetapan;
        $Konsideran->tanggal_pengundangan = $request->tanggal_pengundangan;
        $Konsideran->tanggal_berlaku = $request->tanggal_berlaku;
        $Konsideran->sumber = $request->sumber;
        $Konsideran->subjek = $request->subjek;
        $Konsideran->status = $request->status;
        $Konsideran->bahasa = $request->bahasa;
        $Konsideran->lokasi = $request->lokasi;
        $Konsideran->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('KonsideranSPI_pdfs', 'public');
            $Konsideran->file_pdf = $path;
        }

        $Konsideran->mencabut = $request->mencabut;
        $Konsideran->save();

        return redirect()->back()->with('success', 'Konsideran SPI berhasil disimpan.');
    }

    public function show($id)
    {
        $Konsideran = KonsideranSPI::findOrFail($id);
        return view('KonsideranSPI.detail', compact('Konsideran'));
    }

    public function edit($id)
    {
        $Konsideran = KonsideranSPI::findOrFail($id);
        return view('KonsideranSPI.edit', compact('Konsideran'));
    }

    public function update(Request $request, $id)
    {
        $Konsideran = KonsideranSPI::findOrFail($id);

        $request->validate([

            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);


        $Konsideran->judul = $request->judul;
        $Konsideran->tahun = $request->tahun;
        $Konsideran->kata_kunci = $request->kata_kunci;
        $Konsideran->abstrak = $request->abstrak;
        $Konsideran->catatan = $request->catatan;

        $Konsideran->tipe_dokumen = $request->tipe_dokumen;
        $Konsideran->judul_meta = $request->judul_meta;
        $Konsideran->teu = $request->teu;
        $Konsideran->nomor = $request->nomor;
        $Konsideran->bentuk = $request->bentuk;
        $Konsideran->bentuk_singkat = $request->bentuk_singkat;
        $Konsideran->tahun_meta = $request->tahun_meta;
        $Konsideran->tempat_penetapan = $request->tempat_penetapan;
        $Konsideran->tanggal_penetapan = $request->tanggal_penetapan;
        $Konsideran->tanggal_pengundangan = $request->tanggal_pengundangan;
        $Konsideran->tanggal_berlaku = $request->tanggal_berlaku;
        $Konsideran->sumber = $request->sumber;
        $Konsideran->subjek = $request->subjek;
        $Konsideran->status = $request->status;
        $Konsideran->bahasa = $request->bahasa;
        $Konsideran->lokasi = $request->lokasi;
        $Konsideran->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($Konsideran->file_pdf && Storage::disk('public')->exists($Konsideran->file_pdf)) {
                Storage::disk('public')->delete($Konsideran->file_pdf);
            }

            $path = $request->file('file_pdf')->store('KonsideranSPI_pdfs', 'public');
            $Konsideran->file_pdf = $path;
        }

        $Konsideran->mencabut = $request->mencabut;
        $Konsideran->save();

        return redirect()->back()->with('success', 'Konsideran SPI berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $Konsideran = KonsideranSPI::findOrFail($id);

        if ($Konsideran->file_pdf && Storage::disk('public')->exists($Konsideran->file_pdf)) {
            Storage::disk('public')->delete($Konsideran->file_pdf);
        }

        $Konsideran->delete();

        return redirect()->back()->with('success', 'Konsideran SPI berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR KONSIDERAN SPI";
        $konsiderans = KonsideranSPI::all();
        return view('KonsideranSPI.lihat', compact('title', 'konsiderans'));
    }

}
