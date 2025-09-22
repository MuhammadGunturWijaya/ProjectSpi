<?php

namespace App\Http\Controllers\Peningkatan;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanKualitas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PeningkatanKualitasController extends Controller
{
    public function index()
    {
        $title = "PENINGKATAN KUALITAS";
        $peningkatans = PeningkatanKualitas::all();

        return view('PeningkatanKualitas.index', compact('title', 'peningkatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $peningkatan = new PeningkatanKualitas();
        $peningkatan->judul = $request->judul;
        $peningkatan->tahun = $request->tahun;
        $peningkatan->kata_kunci = $request->kata_kunci;
        $peningkatan->abstrak = $request->abstrak;
        $peningkatan->catatan = $request->catatan;
        $peningkatan->tipe_dokumen = $request->tipe_dokumen;
        $peningkatan->judul_meta = $request->judul_meta;
        $peningkatan->teu = $request->teu;
        $peningkatan->nomor = $request->nomor;
        $peningkatan->bentuk = $request->bentuk;
        $peningkatan->bentuk_singkat = $request->bentuk_singkat;
        $peningkatan->tahun_meta = $request->tahun_meta;
        $peningkatan->tempat_penetapan = $request->tempat_penetapan;
        $peningkatan->tanggal_penetapan = $request->tanggal_penetapan;
        $peningkatan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $peningkatan->tanggal_berlaku = $request->tanggal_berlaku;
        $peningkatan->sumber = $request->sumber;
        $peningkatan->subjek = $request->subjek;
        $peningkatan->status = $request->status;
        $peningkatan->bahasa = $request->bahasa;
        $peningkatan->lokasi = $request->lokasi;
        $peningkatan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PeningkatanKualitas_pdfs', 'public');
            $peningkatan->file_pdf = $path;
        }

        $peningkatan->mencabut = $request->mencabut;
        $peningkatan->save();

        return redirect()->back()->with('success', 'Peningkatan Kualitas berhasil disimpan.');
    }

    public function show($id)
    {
        $peningkatan = PeningkatanKualitas::findOrFail($id);
        return view('PeningkatanKualitas.detail', compact('peningkatan'));
    }

    public function edit($id)
    {
        $peningkatan = PeningkatanKualitas::findOrFail($id);
        return view('PeningkatanKualitas.edit', compact('peningkatan'));
    }

    public function update(Request $request, $id)
    {
        $peningkatan = PeningkatanKualitas::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'tahun'    => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $peningkatan->judul = $request->judul;
        $peningkatan->tahun = $request->tahun;
        $peningkatan->kata_kunci = $request->kata_kunci;
        $peningkatan->abstrak = $request->abstrak;
        $peningkatan->catatan = $request->catatan;
        $peningkatan->tipe_dokumen = $request->tipe_dokumen;
        $peningkatan->judul_meta = $request->judul_meta;
        $peningkatan->teu = $request->teu;
        $peningkatan->nomor = $request->nomor;
        $peningkatan->bentuk = $request->bentuk;
        $peningkatan->bentuk_singkat = $request->bentuk_singkat;
        $peningkatan->tahun_meta = $request->tahun_meta;
        $peningkatan->tempat_penetapan = $request->tempat_penetapan;
        $peningkatan->tanggal_penetapan = $request->tanggal_penetapan;
        $peningkatan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $peningkatan->tanggal_berlaku = $request->tanggal_berlaku;
        $peningkatan->sumber = $request->sumber;
        $peningkatan->subjek = $request->subjek;
        $peningkatan->status = $request->status;
        $peningkatan->bahasa = $request->bahasa;
        $peningkatan->lokasi = $request->lokasi;
        $peningkatan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($peningkatan->file_pdf && Storage::disk('public')->exists($peningkatan->file_pdf)) {
                Storage::disk('public')->delete($peningkatan->file_pdf);
            }
            $path = $request->file('file_pdf')->store('PeningkatanKualitas_pdfs', 'public');
            $peningkatan->file_pdf = $path;
        }

        $peningkatan->mencabut = $request->mencabut;
        $peningkatan->save();

        return redirect()->back()->with('success', 'Peningkatan Kualitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peningkatan = PeningkatanKualitas::findOrFail($id);

        if ($peningkatan->file_pdf && Storage::disk('public')->exists($peningkatan->file_pdf)) {
            Storage::disk('public')->delete($peningkatan->file_pdf);
        }

        $peningkatan->delete();

        return redirect()->back()->with('success', 'Peningkatan Kualitas berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PENINGKATAN KUALITAS";
        $peningkatans = PeningkatanKualitas::all();
        return view('PeningkatanKualitas.lihat', compact('title', 'peningkatans'));
    }

    public function showJson($id)
    {
        return response()->json(PeningkatanKualitas::findOrFail($id));
    }
}
