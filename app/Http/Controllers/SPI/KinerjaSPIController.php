<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\KinerjaSPI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KinerjaSPIController extends Controller
{
    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $kinerja = new KinerjaSPI();
        $kinerja->judul = $request->judul;
        $kinerja->tahun = $request->tahun;
        $kinerja->kata_kunci = $request->kata_kunci;
        $kinerja->abstrak = $request->abstrak;
        $kinerja->catatan = $request->catatan;

        // Metadata lengkap
        $kinerja->tipe_dokumen = $request->tipe_dokumen;
        $kinerja->judul_meta = $request->judul_meta;
        $kinerja->teu = $request->teu;
        $kinerja->nomor = $request->nomor;
        $kinerja->bentuk = $request->bentuk;
        $kinerja->bentuk_singkat = $request->bentuk_singkat;
        $kinerja->tahun_meta = $request->tahun_meta;
        $kinerja->tempat_penetapan = $request->tempat_penetapan;
        $kinerja->tanggal_penetapan = $request->tanggal_penetapan;
        $kinerja->tanggal_pengundangan = $request->tanggal_pengundangan;
        $kinerja->tanggal_berlaku = $request->tanggal_berlaku;
        $kinerja->sumber = $request->sumber;
        $kinerja->subjek = $request->subjek;
        $kinerja->status = $request->status;
        $kinerja->bahasa = $request->bahasa;
        $kinerja->lokasi = $request->lokasi;
        $kinerja->bidang = $request->bidang;

        // File PDF
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('', $filename, 'public');
            $kinerja->file_pdf = $filename;
        }

        $kinerja->mencabut = $request->mencabut;
        $kinerja->save();

        return redirect()->back()->with('success', 'Kinerja SPI berhasil disimpan.');
    }

    // Halaman detail
    public function show($id)
    {
        $kinerja = KinerjaSPI::findOrFail($id);
        $kinerja->increment('views');
        return view('kinerja-spi.detail', compact('kinerja'));
    }

    // Detail dalam format JSON
    public function getDetail($id)
    {
        $kinerja = KinerjaSPI::findOrFail($id);

        return response()->json([
            'judul' => $kinerja->judul,
            'tahun' => $kinerja->tahun,
            'kata_kunci' => $kinerja->kata_kunci ?? '',
            'abstrak' => $kinerja->abstrak ?? '',
            'catatan' => $kinerja->catatan ?? '',
            'tipe_dokumen' => $kinerja->tipe_dokumen ?? '',
            'judul_meta' => $kinerja->judul_meta ?? '',
            'teu' => $kinerja->teu ?? '',
            'nomor' => $kinerja->nomor ?? '',
            'bentuk' => $kinerja->bentuk ?? '',
            'bentuk_singkat' => $kinerja->bentuk_singkat ?? '',
            'tahun_meta' => $kinerja->tahun_meta ?? '',
            'tempat_penetapan' => $kinerja->tempat_penetapan ?? '',
            'tanggal_penetapan' => $kinerja->tanggal_penetapan ? date('d F Y', strtotime($kinerja->tanggal_penetapan)) : '',
            'tanggal_pengundangan' => $kinerja->tanggal_pengundangan ? date('d F Y', strtotime($kinerja->tanggal_pengundangan)) : '',
            'tanggal_berlaku' => $kinerja->tanggal_berlaku ? date('d F Y', strtotime($kinerja->tanggal_berlaku)) : '',
            'sumber' => $kinerja->sumber ?? '',
            'subjek' => $kinerja->subjek ?? '',
            'status' => $kinerja->status ?? '',
            'bahasa' => $kinerja->bahasa ?? '',
            'lokasi' => $kinerja->lokasi ?? '',
            'bidang' => $kinerja->bidang ?? '',
            'file_pdf' => $kinerja->file_pdf ? asset('storage/' . trim($kinerja->file_pdf)) : null,
            'mencabut' => $kinerja->mencabut ? str_replace("\r", '', trim($kinerja->mencabut)) : null,
        ]);
    }

    // Edit halaman
    public function edit($id)
    {
        $kinerja = KinerjaSPI::findOrFail($id);
        return view('kinerja-spi.edit', compact('kinerja'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $kinerja = KinerjaSPI::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $kinerja->judul = $request->judul;
        $kinerja->tahun = $request->tahun;
        $kinerja->kata_kunci = $request->kata_kunci;
        $kinerja->abstrak = $request->abstrak;
        $kinerja->catatan = $request->catatan;
        $kinerja->tipe_dokumen = $request->tipe_dokumen;
        $kinerja->judul_meta = $request->judul_meta;
        $kinerja->teu = $request->teu;
        $kinerja->nomor = $request->nomor;
        $kinerja->bentuk = $request->bentuk;
        $kinerja->bentuk_singkat = $request->bentuk_singkat;
        $kinerja->tahun_meta = $request->tahun_meta;
        $kinerja->tempat_penetapan = $request->tempat_penetapan;
        $kinerja->tanggal_penetapan = $request->tanggal_penetapan;
        $kinerja->tanggal_pengundangan = $request->tanggal_pengundangan;
        $kinerja->tanggal_berlaku = $request->tanggal_berlaku;
        $kinerja->sumber = $request->sumber;
        $kinerja->subjek = $request->subjek;
        $kinerja->status = $request->status;
        $kinerja->bahasa = $request->bahasa;
        $kinerja->lokasi = $request->lokasi;
        $kinerja->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($kinerja->file_pdf && Storage::disk('public')->exists($kinerja->file_pdf)) {
                Storage::disk('public')->delete($kinerja->file_pdf);
            }

            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('', $filename, 'public');
            $kinerja->file_pdf = $filename;
        }

        $kinerja->mencabut = $request->mencabut;
        $kinerja->save();

        return redirect()->back()->with('success', 'Kinerja SPI berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $kinerja = KinerjaSPI::findOrFail($id);

        if ($kinerja->file_pdf && Storage::disk('public')->exists($kinerja->file_pdf)) {
            Storage::disk('public')->delete($kinerja->file_pdf);
        }

        $kinerja->delete();
        return redirect()->back()->with('success', 'Kinerja SPI berhasil dihapus.');
    }

    // Lihat semua
    public function lihat()
    {
        $title = "DAFTAR KINERJA SPI";
        $kinerjaList = KinerjaSPI::all();

        return view('kinerja-spi.lihat', compact('title', 'kinerjaList'));
    }

    // Search Kinerja
    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $nomor = $request->input('nomor');
        $tahun = $request->input('tahun');
        $bidang = $request->input('bidang');
        $subjek = $request->input('subjek');

        $query = KinerjaSPI::query();

        if ($keyword) {
            $keywords = explode(' ', $keyword);
            foreach ($keywords as $word) {
                $query->where(function ($q) use ($word) {
                    $q->where('judul', 'like', "%{$word}%")
                        ->orWhere('abstrak', 'like', "%{$word}%")
                        ->orWhere('kata_kunci', 'like', "%{$word}%")
                        ->orWhere('catatan', 'like', "%{$word}%");
                });
            }
        }

        if ($nomor)
            $query->where('nomor', 'like', "%{$nomor}%");
        if ($tahun)
            $query->where('tahun', $tahun);
        if ($bidang)
            $query->where('bidang', 'like', "%{$bidang}%");
        if ($subjek)
            $query->where('subjek', 'like', "%{$subjek}%");

        $kinerjaList = $query->paginate(10)->appends($request->all());
        $title = "Hasil Pencarian Kinerja SPI";

        return view('kinerja-spi.search', compact(
            'kinerjaList',
            'keyword',
            'nomor',
            'tahun',
            'bidang',
            'subjek',
            'title'
        ));
    }
}