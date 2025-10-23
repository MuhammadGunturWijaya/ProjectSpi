<?php

namespace App\Http\Controllers\Pengawasan;

use App\Http\Controllers\Controller;
use App\Models\PenguatanPengawasan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PenguatanPengawasanController extends Controller
{
    public function index()
    {
        $title = "PENGUATAN PENGAWASAN";
        $penguatans = PenguatanPengawasan::all();
        $popular = PenguatanPengawasan::where('created_at', '>=', now()->subDays(14))
            ->orderByDesc('views')
            ->take(10)
            ->get();

        return view('PenguatanPengawasan.index', compact('title', 'penguatans', 'popular'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $penguatan = new PenguatanPengawasan();
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
            $path = $request->file('file_pdf')->store('PenguatanPengawasan_pdfs', 'public');
            $penguatan->file_pdf = $path;
        }

        $penguatan->mencabut = $request->mencabut;
        $penguatan->save();

        return redirect()->back()->with('success', 'Penguatan Pengawasan berhasil disimpan.');
    }

    public function show($id)
    {
        $penguatan = PenguatanPengawasan::findOrFail($id);
        $penguatan->increment('views');
        return view('PenguatanPengawasan.detail', compact('penguatan'));
    }

    public function edit($id)
    {
        $penguatan = PenguatanPengawasan::findOrFail($id);
        return view('PenguatanPengawasan.edit', compact('penguatan'));
    }

    public function update(Request $request, $id)
    {
        $penguatan = PenguatanPengawasan::findOrFail($id);

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
            $path = $request->file('file_pdf')->store('PenguatanPengawasan_pdfs', 'public');
            $penguatan->file_pdf = $path;
        }

        $penguatan->mencabut = $request->mencabut;
        $penguatan->save();

        return redirect()->back()->with('success', 'Penguatan Pengawasan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penguatan = PenguatanPengawasan::findOrFail($id);

        if ($penguatan->file_pdf && Storage::disk('public')->exists($penguatan->file_pdf)) {
            Storage::disk('public')->delete($penguatan->file_pdf);
        }

        $penguatan->delete();

        return redirect()->back()->with('success', 'Penguatan Pengawasan berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PENGUATAN PENGAWASAN";
        $penguatans = PenguatanPengawasan::all();
        return view('PenguatanPengawasan.lihat', compact('title', 'penguatans'));
    }

    public function showJson($id)
    {
        return response()->json(PenguatanPengawasan::findOrFail($id));
    }
}
