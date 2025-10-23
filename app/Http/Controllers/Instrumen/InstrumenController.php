<?php

namespace App\Http\Controllers\Instrumen;

use App\Http\Controllers\Controller;
use App\Models\Instrumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InstrumenController extends Controller
{
    public function index()
    {
        $title = "INSTRUMEN PENGAWASAN";
        $InstrumenAudit = Instrumen::take(4)->get(); // hapus filter 'jenis'
        return view('InstrumenPengawasan.index', compact('title', 'InstrumenAudit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $Instrumen = new Instrumen();
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


    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $nomor = $request->input('nomor');
        $tahun = $request->input('tahun');
        $entitas = $request->input('entitas');
        $tag = $request->input('tag');

        $query = Instrumen::query();

        if ($keyword) {
            $keywords = explode(' ', $keyword);
            foreach ($keywords as $word) {
                $query->where(function ($q) use ($word) {
                    $q->where('judul', 'like', "%{$word}%")
                        ->orWhere('abstrak', 'like', "%{$word}%");
                });
            }
        }

        if ($nomor)
            $query->where('nomor', 'like', "%{$nomor}%");
        if ($tahun)
            $query->where('tahun', $tahun);
        if ($entitas)
            $query->where('entitas', 'like', "%{$entitas}%");
        if ($tag)
            $query->where('tag', 'like', "%{$tag}%");

        $instrumens = $query->paginate(10)->appends($request->all());

        return view('InstrumenPengawasan.search', compact('instrumens', 'keyword'));
    }

    // Method lain seperti show, edit, update, destroy tetap sama, tapi hapus pengaturan $Instrumen->jenis
}
