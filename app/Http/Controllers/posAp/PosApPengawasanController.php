<?php

namespace App\Http\Controllers\posAp;

use App\Http\Controllers\Controller;
use App\Models\PosAP;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Controllers\posApController;
use Carbon\Carbon;

class PosApPengawasanController extends Controller
{
    // Halaman utama PosAp pengawasan
    public function index()
    {
        $title = "POS AP PENGAWASAN";
        $PosApAudit = PosAp::where('jenis', 'audit')->take(4)->get();
        $PosApReviu = PosAp::where('jenis', 'reviu')->take(4)->get();
        $PosApMonev = PosAp::where('jenis', 'monev')->take(4)->get();

         //Ambil top 6 pedoman paling populer (views terbanyak) dalam 14 hari terakhir 
        $popular = PosAp::where('created_at', '>=', Carbon::now()->subDays(14))->orderByDesc('views')->limit(8)->get();

        return view('PosApPengawasan.index', compact('title', 'PosApAudit', 'PosApReviu', 'PosApMonev', 'popular'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'jenis' => 'required|string',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000', // max 10MB
        ]);

        // Buat instance PosAp baru
        $PosAp = new \App\Models\PosAP();
        $PosAp->jenis = $request->jenis;
        $PosAp->judul = $request->judul;
        $PosAp->tahun = $request->tahun;
        $PosAp->kata_kunci = $request->kata_kunci;
        $PosAp->abstrak = $request->abstrak;
        $PosAp->catatan = $request->catatan;

        // Metadata
        $PosAp->tipe_dokumen = $request->tipe_dokumen;
        $PosAp->judul_meta = $request->judul_meta;
        $PosAp->teu = $request->teu;
        $PosAp->nomor = $request->nomor;
        $PosAp->bentuk = $request->bentuk;
        $PosAp->bentuk_singkat = $request->bentuk_singkat;
        $PosAp->tahun_meta = $request->tahun_meta;
        $PosAp->tempat_penetapan = $request->tempat_penetapan;
        $PosAp->tanggal_penetapan = $request->tanggal_penetapan;
        $PosAp->tanggal_pengundangan = $request->tanggal_pengundangan;
        $PosAp->tanggal_berlaku = $request->tanggal_berlaku;
        $PosAp->sumber = $request->sumber;
        $PosAp->subjek = $request->subjek;
        $PosAp->status = $request->status;
        $PosAp->bahasa = $request->bahasa;
        $PosAp->lokasi = $request->lokasi;
        $PosAp->bidang = $request->bidang;

        // Upload file PDF
        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PosAp_pdfs', 'public');
            $PosAp->file_pdf = $path;
        }

        $PosAp->mencabut = $request->mencabut;

        $PosAp->save();

        return redirect()->back()->with('success', 'PosAp berhasil disimpan.');
    }


    // // Halaman detail PosAp berdasarkan ID
    // public function show($id)
    // {
    //     // pastikan model benar: PosAP atau PosAp sesuai definisi model Anda
    //     $PosAp = PosAP::findOrFail($id);
    //     return view('PosApPengawasan.detail-posap', compact('PosAp'));
    // }

    public function show($id)
    {
        $PosAp = PosAP::findOrFail($id);
        $title = "Detail POS AP Pengawasan";
        // return view('PosApPengawasan.show', compact('PosAp', 'title'));

        // Tambah jumlah view setiap kali dibuka
        $PosAp->increment('views');
        return view('PosApPengawasan.detail-posap', compact('PosAp', 'title'));

    }




    // Ambil detail pedoman untuk modal / AJAX
    public function getDetail($id)
    {
        $PosAp = PosAp::findOrFail($id);

        return response()->json([
            'judul' => $PosAp->judul,
            'tahun' => $PosAp->tahun,
            'kata_kunci' => $PosAp->kata_kunci ?? '',
            'abstrak' => $PosAp->abstrak ?? '',
            'catatan' => $PosAp->catatan ?? '',

            // Metadata
            'tipe_dokumen' => $PosAp->tipe_dokumen ?? '',
            'judul_meta' => $PosAp->judul_meta ?? '',
            'teu' => $PosAp->teu ?? '',
            'nomor' => $PosAp->nomor ?? '',
            'bentuk' => $PosAp->bentuk ?? '',
            'bentuk_singkat' => $PosAp->bentuk_singkat ?? '',
            'tahun_meta' => $PosAp->tahun_meta ?? '',
            'tempat_penetapan' => $PosAp->tempat_penetapan ?? '',

            'tanggal_penetapan' => $PosAp->tanggal_penetapan ? date('d F Y', strtotime($PosAp->tanggal_penetapan)) : '',
            'tanggal_pengundangan' => $PosAp->tanggal_pengundangan ? date('d F Y', strtotime($PosAp->tanggal_pengundangan)) : '',
            'tanggal_berlaku' => $PosAp->tanggal_berlaku ? date('d F Y', strtotime($PosAp->tanggal_berlaku)) : '',

            'sumber' => $PosAp->sumber ?? '',
            'subjek' => $PosAp->subjek ?? '',
            'status' => $PosAp->status ?? '',
            'bahasa' => $PosAp->bahasa ?? '',
            'lokasi' => $PosAp->lokasi ?? '',
            'bidang' => $PosAp->bidang ?? '',

            // File & Status
            'file_pdf' => $PosAp->file_pdf ? asset('storage/' . trim($PosAp->file_pdf)) : null,
            'mencabut' => $PosAp->mencabut ? str_replace("\r", '', trim($PosAp->mencabut)) : null,
        ]);
    }

    // Detail versi ringkas (JSON)
    public function detailJson($id)
    {
        $PosAp = PosAp::find($id);
        if (!$PosAp) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'judul' => $PosAp->judul_meta,
            'tahun' => $PosAp->tahun_meta,
            'kata_kunci' => $PosAp->kata_kunci,
            'abstrak' => $PosAp->abstrak,
            'catatan' => $PosAp->catatan,
        ]);
    }

    // 🔹 Fungsi hapus PosAp
    public function destroy($id)
    {
        $PosAp = PosAp::findOrFail($id);

        // hapus file PDF dari storage kalau ada
        if ($PosAp->file_pdf && file_exists(public_path('storage/' . $PosAp->file_pdf))) {
            unlink(public_path('storage/' . $PosAp->file_pdf));
        }

        $PosAp->delete();

        return redirect()->back()->with('success', 'PosAp berhasil dihapus.');
    }

    public function edit($id)
    {
        $PosAp = PosAp::findOrFail($id);
        return view('PosApPengawasan.edit-PosAp', compact('PosAp'));
    }

    // Update PosAp
    public function update(Request $request, $id)
    {
        $PosAp = PosAp::findOrFail($id);

        // Validasi data
        $request->validate([
           
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000', // max 10 MB
        ]);

        // Update field dasar
        // $PosAp->jenis = $request->jenis;
        $PosAp->judul = $request->judul;
        $PosAp->tahun = $request->tahun;
        $PosAp->kata_kunci = $request->kata_kunci;
        $PosAp->abstrak = $request->abstrak;
        $PosAp->catatan = $request->catatan;

        // Metadata
        $PosAp->tipe_dokumen = $request->tipe_dokumen;
        $PosAp->judul_meta = $request->judul_meta;
        $PosAp->teu = $request->teu;
        $PosAp->nomor = $request->nomor;
        $PosAp->bentuk = $request->bentuk;
        $PosAp->bentuk_singkat = $request->bentuk_singkat;
        $PosAp->tahun_meta = $request->tahun_meta;
        $PosAp->tempat_penetapan = $request->tempat_penetapan;
        $PosAp->tanggal_penetapan = $request->tanggal_penetapan;
        $PosAp->tanggal_pengundangan = $request->tanggal_pengundangan;
        $PosAp->tanggal_berlaku = $request->tanggal_berlaku;
        $PosAp->sumber = $request->sumber;
        $PosAp->subjek = $request->subjek;
        $PosAp->status = $request->status;
        $PosAp->bahasa = $request->bahasa;
        $PosAp->lokasi = $request->lokasi;
        $PosAp->bidang = $request->bidang;

        // Update file PDF jika ada upload baru
        if ($request->hasFile('file_pdf')) {
            // hapus file lama kalau ada
            if ($PosAp->file_pdf && Storage::disk('public')->exists($PosAp->file_pdf)) {
                Storage::disk('public')->delete($PosAp->file_pdf);
            }

            $path = $request->file('file_pdf')->store('PosAp_pdfs', 'public');
            $PosAp->file_pdf = $path;   // simpan full path relatif: PosAp_pdfs/xxx.pdf
        }


        // Update status pencabutan
        $PosAp->mencabut = $request->mencabut;

        $PosAp->save();

        return redirect()->back()->with('success', 'PosAp berhasil diperbarui.');
    }
    public function showByJenis($jenis)
    {

        $posAps = PosAP::where('jenis', $jenis)->get();

        $judul = match ($jenis) {
            'pos-ap' => 'POS AP Pengawasan',
            'audit' => 'POS AP Audit',
            'reviu' => 'POS AP Reviu',
            'monev' => 'POS AP Monev',
            default => 'POS AP Pengawasan',
        };

        return view('PosApPengawasan.index', compact('posAps', 'judul'));
    }

    public function lihat($jenis)
    {
        $title = strtoupper($jenis) . " POS AP";

        // ambil semua data sesuai jenis
        $posAps = PosAp::where('jenis', $jenis)->get();

        return view('PosApPengawasan.lihat-posAp', compact('title', 'posAps', 'jenis'));
    }


    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $nomor = $request->input('nomor');
        $tahun = $request->input('tahun');
        $jenis = $request->input('jenis');
        $entitas = $request->input('entitas');
        $tag = $request->input('tag');

        $query = PosAP::query();

        if ($keyword) {
            $keywords = explode(' ', $keyword);
            foreach ($keywords as $word) {
                $query->where(function ($q) use ($word) {
                    $q->where('judul', 'like', "%{$word}%")
                        ->orWhere('abstrak', 'like', "%{$word}%")
                        ->orWhere('subjek', 'like', "%{$word}%"); // ganti 'tentang'
                });
            }
        }

        if ($nomor)
            $query->where('nomor', 'like', "%{$nomor}%");
        if ($tahun)
            $query->where('tahun', $tahun);
        if ($jenis)
            $query->where('jenis', 'like', "%{$jenis}%");
        if ($entitas)
            $query->where('entitas', 'like', "%{$entitas}%");
        if ($tag)
            $query->where('tag', 'like', "%{$tag}%");

        $posaps = $query->paginate(10)->appends($request->all());

        return view('PosApPengawasan.search', compact('posaps', 'keyword'));
    }


}




