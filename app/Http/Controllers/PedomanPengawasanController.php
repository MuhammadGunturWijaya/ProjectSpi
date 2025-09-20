<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;
use Illuminate\Support\Facades\Storage;

class PedomanPengawasanController extends Controller
{
    // Halaman utama pedoman pengawasan
    public function index()
    {
        $title = "PEDOMAN PENGAWASAN";
        $pedomanAudit = Pedoman::where('jenis', 'audit')->take(4)->get();
        $pedomanReviu = Pedoman::where('jenis', 'reviu')->take(4)->get();
        $pedomanMonev = Pedoman::where('jenis', 'monev')->take(4)->get();

        return view('pedomanpengawasan.index', compact('title', 'pedomanAudit', 'pedomanReviu', 'pedomanMonev'));
    }

    // Halaman detail pedoman berdasarkan ID
    public function show($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        return view('pedomanPengawasan.detail-pedoman', compact('pedoman'));
    }

    // Ambil detail pedoman untuk modal / AJAX
    public function getDetail($id)
    {
        $pedoman = Pedoman::findOrFail($id);

        return response()->json([
            'judul' => $pedoman->judul,
            'tahun' => $pedoman->tahun,
            'kata_kunci' => $pedoman->kata_kunci ?? '',
            'abstrak' => $pedoman->abstrak ?? '',
            'catatan' => $pedoman->catatan ?? '',

            // Metadata
            'tipe_dokumen' => $pedoman->tipe_dokumen ?? '',
            'judul_meta' => $pedoman->judul_meta ?? '',
            'teu' => $pedoman->teu ?? '',
            'nomor' => $pedoman->nomor ?? '',
            'bentuk' => $pedoman->bentuk ?? '',
            'bentuk_singkat' => $pedoman->bentuk_singkat ?? '',
            'tahun_meta' => $pedoman->tahun_meta ?? '',
            'tempat_penetapan' => $pedoman->tempat_penetapan ?? '',

            'tanggal_penetapan' => $pedoman->tanggal_penetapan ? date('d F Y', strtotime($pedoman->tanggal_penetapan)) : '',
            'tanggal_pengundangan' => $pedoman->tanggal_pengundangan ? date('d F Y', strtotime($pedoman->tanggal_pengundangan)) : '',
            'tanggal_berlaku' => $pedoman->tanggal_berlaku ? date('d F Y', strtotime($pedoman->tanggal_berlaku)) : '',

            'sumber' => $pedoman->sumber ?? '',
            'subjek' => $pedoman->subjek ?? '',
            'status' => $pedoman->status ?? '',
            'bahasa' => $pedoman->bahasa ?? '',
            'lokasi' => $pedoman->lokasi ?? '',
            'bidang' => $pedoman->bidang ?? '',

            // File & Status
            'file_pdf' => $pedoman->file_pdf ? asset('storage/' . trim($pedoman->file_pdf)) : null,
            'mencabut' => $pedoman->mencabut ? str_replace("\r", '', trim($pedoman->mencabut)) : null,
        ]);
    }

    // Detail versi ringkas (JSON)
    public function detailJson($id)
    {
        $pedoman = Pedoman::find($id);
        if (!$pedoman) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'judul' => $pedoman->judul_meta,
            'tahun' => $pedoman->tahun_meta,
            'kata_kunci' => $pedoman->kata_kunci,
            'abstrak' => $pedoman->abstrak,
            'catatan' => $pedoman->catatan,
        ]);
    }

    // 🔹 Fungsi hapus pedoman
    public function destroy($id)
    {
        $pedoman = Pedoman::findOrFail($id);

        // hapus file PDF dari storage kalau ada
        if ($pedoman->file_pdf && file_exists(public_path('storage/' . $pedoman->file_pdf))) {
            unlink(public_path('storage/' . $pedoman->file_pdf));
        }

        $pedoman->delete();

        return redirect()->back()->with('success', 'Pedoman berhasil dihapus.');
    }

    public function edit($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        return view('pedomanPengawasan.edit-pedoman', compact('pedoman'));
    }

    // Update pedoman
    public function update(Request $request, $id)
    {
        $pedoman = Pedoman::findOrFail($id);

        // Validasi data
        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:10240', // max 10 MB
        ]);

        // Update field dasar
        $pedoman->jenis = $request->jenis;
        $pedoman->judul = $request->judul;
        $pedoman->tahun = $request->tahun;
        $pedoman->kata_kunci = $request->kata_kunci;
        $pedoman->abstrak = $request->abstrak;
        $pedoman->catatan = $request->catatan;

        // Metadata
        $pedoman->tipe_dokumen = $request->tipe_dokumen;
        $pedoman->judul_meta = $request->judul_meta;
        $pedoman->teu = $request->teu;
        $pedoman->nomor = $request->nomor;
        $pedoman->bentuk = $request->bentuk;
        $pedoman->bentuk_singkat = $request->bentuk_singkat;
        $pedoman->tahun_meta = $request->tahun_meta;
        $pedoman->tempat_penetapan = $request->tempat_penetapan;
        $pedoman->tanggal_penetapan = $request->tanggal_penetapan;
        $pedoman->tanggal_pengundangan = $request->tanggal_pengundangan;
        $pedoman->tanggal_berlaku = $request->tanggal_berlaku;
        $pedoman->sumber = $request->sumber;
        $pedoman->subjek = $request->subjek;
        $pedoman->status = $request->status;
        $pedoman->bahasa = $request->bahasa;
        $pedoman->lokasi = $request->lokasi;
        $pedoman->bidang = $request->bidang;

        // Update file PDF jika ada upload baru
        if ($request->hasFile('file_pdf')) {
            // hapus file lama kalau ada
            if ($pedoman->file_pdf && Storage::disk('public')->exists($pedoman->file_pdf)) {
                Storage::disk('public')->delete($pedoman->file_pdf);
            }

            $path = $request->file('file_pdf')->store('pedoman_pdfs', 'public');
            $pedoman->file_pdf = $path;   // simpan full path relatif: pedoman_pdfs/xxx.pdf
        }


        // Update status pencabutan
        $pedoman->mencabut = $request->mencabut;

        $pedoman->save();

        return redirect()->back()->with('success', 'Pedoman berhasil diperbarui.');
    }
    public function showByJenis($jenis)
    {
        $pedoman = Pedoman::where('jenis', $jenis)->get();

        $judul = match ($jenis) {
            'pos-ap' => 'POS AP Pengawasan',
            'audit' => 'Pedoman Audit',
            'reviu' => 'Pedoman Reviu',
            'monev' => 'Pedoman Monev',
            default => 'Pedoman Pengawasan',
        };

        return view('pedomanPengawasan', compact('pedoman', 'judul'));
    }


}
