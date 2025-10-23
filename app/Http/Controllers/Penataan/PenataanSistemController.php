<?php

namespace App\Http\Controllers\Penataan;

use App\Http\Controllers\Controller;
use App\Models\PenataanSistem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PenataanSistemController extends Controller
{
    public function index()
    {
        $title = "PENATAAN SISTEM";
        $penataans = PenataanSistem::all();
         $popular = PenataanSistem::where('created_at', '>=', now()->subDays(14))
            ->orderByDesc('views')
            ->take(10)
            ->get();

        return view('PenataanSistem.index', compact('title', 'penataans', 'popular'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $penataan = new PenataanSistem();
        $penataan->judul = $request->judul;
        $penataan->tahun = $request->tahun;
        $penataan->kata_kunci = $request->kata_kunci;
        $penataan->abstrak = $request->abstrak;
        $penataan->catatan = $request->catatan;
        $penataan->tipe_dokumen = $request->tipe_dokumen;
        $penataan->judul_meta = $request->judul_meta;
        $penataan->teu = $request->teu;
        $penataan->nomor = $request->nomor;
        $penataan->bentuk = $request->bentuk;
        $penataan->bentuk_singkat = $request->bentuk_singkat;
        $penataan->tahun_meta = $request->tahun_meta;
        $penataan->tempat_penetapan = $request->tempat_penetapan;
        $penataan->tanggal_penetapan = $request->tanggal_penetapan;
        $penataan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $penataan->tanggal_berlaku = $request->tanggal_berlaku;
        $penataan->sumber = $request->sumber;
        $penataan->subjek = $request->subjek;
        $penataan->status = $request->status;
        $penataan->bahasa = $request->bahasa;
        $penataan->lokasi = $request->lokasi;
        $penataan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PenataanSistem_pdfs', 'public');
            $penataan->file_pdf = $path;
        }

        $penataan->mencabut = $request->mencabut;
        $penataan->save();

        return redirect()->back()->with('success', 'Penataan Sistem berhasil disimpan.');
    }

    public function show($id)
    {
        $penataan = PenataanSistem::findOrFail($id);
        $penataan->increment('views');
        return view('PenataanSistem.detail', compact('penataan'));
    }

    public function edit($id)
    {
        $penataan = PenataanSistem::findOrFail($id);
        return view('PenataanSistem.edit', compact('penataan'));
    }

    public function update(Request $request, $id)
    {
        $penataan = PenataanSistem::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'tahun'    => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $penataan->judul = $request->judul;
        $penataan->tahun = $request->tahun;
        $penataan->kata_kunci = $request->kata_kunci;
        $penataan->abstrak = $request->abstrak;
        $penataan->catatan = $request->catatan;
        $penataan->tipe_dokumen = $request->tipe_dokumen;
        $penataan->judul_meta = $request->judul_meta;
        $penataan->teu = $request->teu;
        $penataan->nomor = $request->nomor;
        $penataan->bentuk = $request->bentuk;
        $penataan->bentuk_singkat = $request->bentuk_singkat;
        $penataan->tahun_meta = $request->tahun_meta;
        $penataan->tempat_penetapan = $request->tempat_penetapan;
        $penataan->tanggal_penetapan = $request->tanggal_penetapan;
        $penataan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $penataan->tanggal_berlaku = $request->tanggal_berlaku;
        $penataan->sumber = $request->sumber;
        $penataan->subjek = $request->subjek;
        $penataan->status = $request->status;
        $penataan->bahasa = $request->bahasa;
        $penataan->lokasi = $request->lokasi;
        $penataan->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($penataan->file_pdf && Storage::disk('public')->exists($penataan->file_pdf)) {
                Storage::disk('public')->delete($penataan->file_pdf);
            }
            $path = $request->file('file_pdf')->store('PenataanSistem_pdfs', 'public');
            $penataan->file_pdf = $path;
        }

        $penataan->mencabut = $request->mencabut;
        $penataan->save();

        return redirect()->back()->with('success', 'Penataan Sistem berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penataan = PenataanSistem::findOrFail($id);

        if ($penataan->file_pdf && Storage::disk('public')->exists($penataan->file_pdf)) {
            Storage::disk('public')->delete($penataan->file_pdf);
        }

        $penataan->delete();

        return redirect()->back()->with('success', 'Penataan Sistem berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PENATAAN SISTEM";
        $penataans = PenataanSistem::all();
        return view('PenataanSistem.lihat', compact('title', 'penataans'));
    }

    public function showJson($id)
    {
        return response()->json(PenataanSistem::findOrFail($id));
    }
}
