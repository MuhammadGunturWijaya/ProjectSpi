<?php

namespace App\Http\Controllers\Instrumen;

use App\Http\Controllers\Controller;
use App\Models\Instrumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InstrumenController  extends Controller
{
    // Halaman utama Instrumen pengawasan
    public function index()
    {
        $title = "INSTRUMEN PENGAWASAN";
        $InstrumenAudit = Instrumen::where('jenis', 'audit')->take(4)->get();
        $InstrumenReviu = Instrumen::where('jenis', 'reviu')->take(4)->get();
        $InstrumenMonev = Instrumen::where('jenis', 'monev')->take(4)->get();

        return view('InstrumenPengawasan.index', compact('title', 'InstrumenAudit', 'InstrumenReviu', 'InstrumenMonev'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $Instrumen = new Instrumen();
        $Instrumen->jenis = $request->jenis;
        $Instrumen->judul = $request->judul;
        $Instrumen->tahun = $request->tahun;
        $Instrumen->kata_kunci = $request->kata_kunci;
        $Instrumen->abstrak = $request->abstrak;
        $Instrumen->catatan = $request->catatan;

        // Metadata
        $Instrumen->tipe_dokumen = $request->tipe_dokumen;
        $Instrumen->judul_meta = $request->judul_meta;
        $Instrumen->teu = $request->teu;
        $Instrumen->nomor = $request->nomor;
        $Instrumen->bentuk = $request->bentuk;
        $Instrumen->bentuk_singkat = $request->bentuk_singkat;
        $Instrumen->tahun_meta = $request->tahun_meta;
        $Instrumen->tempat_penetapan = $request->tempat_penetapan;
        $Instrumen->tanggal_penetapan = $request->tanggal_penetapan;
        $Instrumen->tanggal_pengundangan = $request->tanggal_pengundangan;
        $Instrumen->tanggal_berlaku = $request->tanggal_berlaku;
        $Instrumen->sumber = $request->sumber;
        $Instrumen->subjek = $request->subjek;
        $Instrumen->status = $request->status;
        $Instrumen->bahasa = $request->bahasa;
        $Instrumen->lokasi = $request->lokasi;
        $Instrumen->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('Instrumen_pdfs', 'public');
            $Instrumen->file_pdf = $path;
        }

        $Instrumen->mencabut = $request->mencabut;
        $Instrumen->save();

        return redirect()->back()->with('success', 'Instrumen berhasil disimpan.');
    }

    public function show($id)
    {
        $Instrumen = Instrumen::findOrFail($id);
        return view('InstrumenPengawasan.detail-instrumen', compact('Instrumen'));
    }

    public function getDetail($id)
    {
        $Instrumen = Instrumen::findOrFail($id);

        return response()->json([
            'judul' => $Instrumen->judul,
            'tahun' => $Instrumen->tahun,
            'kata_kunci' => $Instrumen->kata_kunci ?? '',
            'abstrak' => $Instrumen->abstrak ?? '',
            'catatan' => $Instrumen->catatan ?? '',

            'tipe_dokumen' => $Instrumen->tipe_dokumen ?? '',
            'judul_meta' => $Instrumen->judul_meta ?? '',
            'teu' => $Instrumen->teu ?? '',
            'nomor' => $Instrumen->nomor ?? '',
            'bentuk' => $Instrumen->bentuk ?? '',
            'bentuk_singkat' => $Instrumen->bentuk_singkat ?? '',
            'tahun_meta' => $Instrumen->tahun_meta ?? '',
            'tempat_penetapan' => $Instrumen->tempat_penetapan ?? '',

            'tanggal_penetapan' => $Instrumen->tanggal_penetapan ? date('d F Y', strtotime($Instrumen->tanggal_penetapan)) : '',
            'tanggal_pengundangan' => $Instrumen->tanggal_pengundangan ? date('d F Y', strtotime($Instrumen->tanggal_pengundangan)) : '',
            'tanggal_berlaku' => $Instrumen->tanggal_berlaku ? date('d F Y', strtotime($Instrumen->tanggal_berlaku)) : '',

            'sumber' => $Instrumen->sumber ?? '',
            'subjek' => $Instrumen->subjek ?? '',
            'status' => $Instrumen->status ?? '',
            'bahasa' => $Instrumen->bahasa ?? '',
            'lokasi' => $Instrumen->lokasi ?? '',
            'bidang' => $Instrumen->bidang ?? '',

            'file_pdf' => $Instrumen->file_pdf ? asset('storage/' . trim($Instrumen->file_pdf)) : null,
            'mencabut' => $Instrumen->mencabut ? str_replace("\r", '', trim($Instrumen->mencabut)) : null,
        ]);
    }

    public function detailJson($id)
    {
        $Instrumen = Instrumen::find($id);
        if (!$Instrumen) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'judul' => $Instrumen->judul_meta,
            'tahun' => $Instrumen->tahun_meta,
            'kata_kunci' => $Instrumen->kata_kunci,
            'abstrak' => $Instrumen->abstrak,
            'catatan' => $Instrumen->catatan,
        ]);
    }

    public function destroy($id)
    {
        $Instrumen = Instrumen::findOrFail($id);

        if ($Instrumen->file_pdf && file_exists(public_path('storage/' . $Instrumen->file_pdf))) {
            unlink(public_path('storage/' . $Instrumen->file_pdf));
        }

        $Instrumen->delete();

        return redirect()->back()->with('success', 'Instrumen berhasil dihapus.');
    }

    public function edit($id)
    {
        $Instrumen = Instrumen::findOrFail($id);
        return view('InstrumenPengawasan.edit-instrumen', compact('Instrumen'));
    }

    public function update(Request $request, $id)
    {
        $Instrumen = Instrumen::findOrFail($id);

        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $Instrumen->jenis = $request->jenis;
        $Instrumen->judul = $request->judul;
        $Instrumen->tahun = $request->tahun;
        $Instrumen->kata_kunci = $request->kata_kunci;
        $Instrumen->abstrak = $request->abstrak;
        $Instrumen->catatan = $request->catatan;

        $Instrumen->tipe_dokumen = $request->tipe_dokumen;
        $Instrumen->judul_meta = $request->judul_meta;
        $Instrumen->teu = $request->teu;
        $Instrumen->nomor = $request->nomor;
        $Instrumen->bentuk = $request->bentuk;
        $Instrumen->bentuk_singkat = $request->bentuk_singkat;
        $Instrumen->tahun_meta = $request->tahun_meta;
        $Instrumen->tempat_penetapan = $request->tempat_penetapan;
        $Instrumen->tanggal_penetapan = $request->tanggal_penetapan;
        $Instrumen->tanggal_pengundangan = $request->tanggal_pengundangan;
        $Instrumen->tanggal_berlaku = $request->tanggal_berlaku;
        $Instrumen->sumber = $request->sumber;
        $Instrumen->subjek = $request->subjek;
        $Instrumen->status = $request->status;
        $Instrumen->bahasa = $request->bahasa;
        $Instrumen->lokasi = $request->lokasi;
        $Instrumen->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($Instrumen->file_pdf && Storage::disk('public')->exists($Instrumen->file_pdf)) {
                Storage::disk('public')->delete($Instrumen->file_pdf);
            }

            $path = $request->file('file_pdf')->store('Instrumen_pdfs', 'public');
            $Instrumen->file_pdf = $path;
        }

        $Instrumen->mencabut = $request->mencabut;

        $Instrumen->save();

        return redirect()->back()->with('success', 'Instrumen berhasil diperbarui.');
    }

    public function showByJenis($jenis)
    {
        $instrumens = Instrumen::where('jenis', $jenis)->get();

        $judul = match ($jenis) {
            'instrumen' => 'Instrumen Pengawasan',
            'audit' => 'Instrumen Audit',
            'reviu' => 'Instrumen Reviu',
            'monev' => 'Instrumen Monev',
            default => 'Instrumen Pengawasan',
        };

        return view('InstrumenPengawasan.index', compact('instrumens', 'judul'));
    }

    public function lihat($jenis)
    {
        $title = strtoupper($jenis) . " INSTRUMEN";

        $instrumens = Instrumen::where('jenis', $jenis)->get();

        return view('InstrumenPengawasan.lihat-instrumen', compact('title', 'instrumens', 'jenis'));
    }
}
