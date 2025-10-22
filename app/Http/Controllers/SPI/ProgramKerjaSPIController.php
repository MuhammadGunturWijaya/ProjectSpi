<?php

namespace App\Http\Controllers\SPI;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerjaSPI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProgramKerjaSPIController extends Controller
{
    // Halaman utama Program Kerja SPI
    public function index()
    {
        $title = "PROGRAM KERJA SPI";

        // Bisa ditambahkan filter jenis jika ada kategori
        $programKerjaAudit = ProgramKerjaSPI::where('jenis', 'audit')->take(4)->get();
        $programKerjaReviu = ProgramKerjaSPI::where('jenis', 'reviu')->take(4)->get();
        $programKerjaMonev = ProgramKerjaSPI::where('jenis', 'monev')->take(4)->get();

        return view('program-kerja.index', compact('title', 'programKerjaAudit', 'programKerjaReviu', 'programKerjaMonev'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $programKerja = new ProgramKerjaSPI();
        $programKerja->jenis = $request->jenis;
        $programKerja->judul = $request->judul;
        $programKerja->tahun = $request->tahun;
        $programKerja->kata_kunci = $request->kata_kunci;
        $programKerja->abstrak = $request->abstrak;
        $programKerja->catatan = $request->catatan;

        // Metadata lengkap seperti Instrumen
        $programKerja->tipe_dokumen = $request->tipe_dokumen;
        $programKerja->judul_meta = $request->judul_meta;
        $programKerja->teu = $request->teu;
        $programKerja->nomor = $request->nomor;
        $programKerja->bentuk = $request->bentuk;
        $programKerja->bentuk_singkat = $request->bentuk_singkat;
        $programKerja->tahun_meta = $request->tahun_meta;
        $programKerja->tempat_penetapan = $request->tempat_penetapan;
        $programKerja->tanggal_penetapan = $request->tanggal_penetapan;
        $programKerja->tanggal_pengundangan = $request->tanggal_pengundangan;
        $programKerja->tanggal_berlaku = $request->tanggal_berlaku;
        $programKerja->sumber = $request->sumber;
        $programKerja->subjek = $request->subjek;
        $programKerja->status = $request->status;
        $programKerja->bahasa = $request->bahasa;
        $programKerja->lokasi = $request->lokasi;
        $programKerja->bidang = $request->bidang;

        // File PDF
        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('ProgramKerjaSPI_pdfs', 'public');
            $programKerja->file_pdf = $path;
        }

        $programKerja->mencabut = $request->mencabut;
        $programKerja->save();

        return redirect()->back()->with('success', 'Program Kerja SPI berhasil disimpan.');
    }

    // Detail halaman
    public function show($id)
    {
        $programKerja = ProgramKerjaSPI::findOrFail($id);
        return view('program-kerja.detail', compact('programKerja'));
    }

    // Detail JSON
    public function getDetail($id)
    {
        $programKerja = ProgramKerjaSPI::findOrFail($id);

        return response()->json([
            'judul' => $programKerja->judul,
            'tahun' => $programKerja->tahun,
            'kata_kunci' => $programKerja->kata_kunci ?? '',
            'abstrak' => $programKerja->abstrak ?? '',
            'catatan' => $programKerja->catatan ?? '',

            'tipe_dokumen' => $programKerja->tipe_dokumen ?? '',
            'judul_meta' => $programKerja->judul_meta ?? '',
            'teu' => $programKerja->teu ?? '',
            'nomor' => $programKerja->nomor ?? '',
            'bentuk' => $programKerja->bentuk ?? '',
            'bentuk_singkat' => $programKerja->bentuk_singkat ?? '',
            'tahun_meta' => $programKerja->tahun_meta ?? '',
            'tempat_penetapan' => $programKerja->tempat_penetapan ?? '',
            'tanggal_penetapan' => $programKerja->tanggal_penetapan ? date('d F Y', strtotime($programKerja->tanggal_penetapan)) : '',
            'tanggal_pengundangan' => $programKerja->tanggal_pengundangan ? date('d F Y', strtotime($programKerja->tanggal_pengundangan)) : '',
            'tanggal_berlaku' => $programKerja->tanggal_berlaku ? date('d F Y', strtotime($programKerja->tanggal_berlaku)) : '',

            'sumber' => $programKerja->sumber ?? '',
            'subjek' => $programKerja->subjek ?? '',
            'status' => $programKerja->status ?? '',
            'bahasa' => $programKerja->bahasa ?? '',
            'lokasi' => $programKerja->lokasi ?? '',
            'bidang' => $programKerja->bidang ?? '',

            'file_pdf' => $programKerja->file_pdf ? asset('storage/' . trim($programKerja->file_pdf)) : null,
            'mencabut' => $programKerja->mencabut ? str_replace("\r", '', trim($programKerja->mencabut)) : null,
        ]);
    }

    // Edit halaman
    public function edit($id)
    {
        $programKerja = ProgramKerjaSPI::findOrFail($id);
        return view('program-kerja.edit', compact('programKerja'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $programKerja = ProgramKerjaSPI::findOrFail($id);

        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $programKerja->jenis = $request->jenis;
        $programKerja->judul = $request->judul;
        $programKerja->tahun = $request->tahun;
        $programKerja->kata_kunci = $request->kata_kunci;
        $programKerja->abstrak = $request->abstrak;
        $programKerja->catatan = $request->catatan;

        // Metadata lengkap
        $programKerja->tipe_dokumen = $request->tipe_dokumen;
        $programKerja->judul_meta = $request->judul_meta;
        $programKerja->teu = $request->teu;
        $programKerja->nomor = $request->nomor;
        $programKerja->bentuk = $request->bentuk;
        $programKerja->bentuk_singkat = $request->bentuk_singkat;
        $programKerja->tahun_meta = $request->tahun_meta;
        $programKerja->tempat_penetapan = $request->tempat_penetapan;
        $programKerja->tanggal_penetapan = $request->tanggal_penetapan;
        $programKerja->tanggal_pengundangan = $request->tanggal_pengundangan;
        $programKerja->tanggal_berlaku = $request->tanggal_berlaku;
        $programKerja->sumber = $request->sumber;
        $programKerja->subjek = $request->subjek;
        $programKerja->status = $request->status;
        $programKerja->bahasa = $request->bahasa;
        $programKerja->lokasi = $request->lokasi;
        $programKerja->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($programKerja->file_pdf && Storage::disk('public')->exists($programKerja->file_pdf)) {
                Storage::disk('public')->delete($programKerja->file_pdf);
            }
            $path = $request->file('file_pdf')->store('ProgramKerjaSPI_pdfs', 'public');
            $programKerja->file_pdf = $path;
        }

        $programKerja->mencabut = $request->mencabut;

        $programKerja->save();

        return redirect()->back()->with('success', 'Program Kerja SPI berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $programKerja = ProgramKerjaSPI::findOrFail($id);

        if ($programKerja->file_pdf && Storage::disk('public')->exists($programKerja->file_pdf)) {
            Storage::disk('public')->delete($programKerja->file_pdf);
        }

        $programKerja->delete();

        return redirect()->back()->with('success', 'Program Kerja SPI berhasil dihapus.');
    }

    public function showByJenis($jenis)
    {
        $programKerjaList = ProgramKerjaSPI::where('jenis', $jenis)->get();

        $judul = match ($jenis) {
            'spi' => 'Program Kerja SPI',
            'audit' => 'Program Kerja SPI Audit',
            'reviu' => 'Program Kerja SPI Reviu',
            'monev' => 'Program Kerja SPI Monev',
            default => 'Program Kerja SPI',
        };

        return view('program-kerja.index', compact('programKerjaList', 'judul'));
    }


    // Lihat semua
    public function lihat($jenis = null)
    {
        $title = $jenis ? strtoupper($jenis) . ' PROGRAM KERJA SPI' : "DAFTAR PROGRAM KERJA SPI";
        $programKerjaList = $jenis ? ProgramKerjaSPI::where('jenis', $jenis)->get() : ProgramKerjaSPI::all();

        return view('program-kerja.lihat', compact('title', 'programKerjaList', 'jenis'));
    }


}
