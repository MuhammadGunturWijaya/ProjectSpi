<?php

namespace App\Http\Controllers\MR;

use App\Http\Controllers\Controller;
use App\Models\PedomanMR;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PedomanMRController extends Controller
{
    public function index()
    {
        $title = "PEDOMAN MR";
        // gunakan nama jamak yang sama dengan Blade
        $pedomanmrs = PedomanMR::all();

        return view('pedomanmr.index', compact('title', 'pedomanmrs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $pedomanmr = new PedomanMR();
        $pedomanmr->judul = $request->judul;
        $pedomanmr->tahun = $request->tahun;
        $pedomanmr->kata_kunci = $request->kata_kunci;
        $pedomanmr->abstrak = $request->abstrak;
        $pedomanmr->catatan = $request->catatan;
        $pedomanmr->tipe_dokumen = $request->tipe_dokumen;
        $pedomanmr->judul_meta = $request->judul_meta;
        $pedomanmr->teu = $request->teu;
        $pedomanmr->nomor = $request->nomor;
        $pedomanmr->bentuk = $request->bentuk;
        $pedomanmr->bentuk_singkat = $request->bentuk_singkat;
        $pedomanmr->tahun_meta = $request->tahun_meta;
        $pedomanmr->tempat_penetapan = $request->tempat_penetapan;
        $pedomanmr->tanggal_penetapan = $request->tanggal_penetapan;
        $pedomanmr->tanggal_pengundangan = $request->tanggal_pengundangan;
        $pedomanmr->tanggal_berlaku = $request->tanggal_berlaku;
        $pedomanmr->sumber = $request->sumber;
        $pedomanmr->subjek = $request->subjek;
        $pedomanmr->status = $request->status;
        $pedomanmr->bahasa = $request->bahasa;
        $pedomanmr->lokasi = $request->lokasi;
        $pedomanmr->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('PedomanMR_pdfs', 'public');
            $pedomanmr->file_pdf = $path;
        }

        $pedomanmr->mencabut = $request->mencabut;
        $pedomanmr->save();

        return redirect()->back()->with('success', 'Pedoman MR berhasil disimpan.');
    }

    public function show($id)
    {
        $pedomanmr = PedomanMR::findOrFail($id);
        return view('pedomanmr.detail', compact('pedomanmr'));
    }

    public function detail($id)
    {
        $pedomanmr = PedomanMR::findOrFail($id);
        return response()->json($pedomanmr);
    }


    public function edit($id)
    {
        $pedomanmr = PedomanMR::findOrFail($id);
        return view('pedomanmr.edit', compact('pedomanmr'));
    }

    public function update(Request $request, $id)
    {
        $pedomanmr = PedomanMR::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
        ]);

        $pedomanmr->judul = $request->judul;
        $pedomanmr->tahun = $request->tahun;
        $pedomanmr->kata_kunci = $request->kata_kunci;
        $pedomanmr->abstrak = $request->abstrak;
        $pedomanmr->catatan = $request->catatan;
        $pedomanmr->tipe_dokumen = $request->tipe_dokumen;
        $pedomanmr->judul_meta = $request->judul_meta;
        $pedomanmr->teu = $request->teu;
        $pedomanmr->nomor = $request->nomor;
        $pedomanmr->bentuk = $request->bentuk;
        $pedomanmr->bentuk_singkat = $request->bentuk_singkat;
        $pedomanmr->tahun_meta = $request->tahun_meta;
        $pedomanmr->tempat_penetapan = $request->tempat_penetapan;
        $pedomanmr->tanggal_penetapan = $request->tanggal_penetapan;
        $pedomanmr->tanggal_pengundangan = $request->tanggal_pengundangan;
        $pedomanmr->tanggal_berlaku = $request->tanggal_berlaku;
        $pedomanmr->sumber = $request->sumber;
        $pedomanmr->subjek = $request->subjek;
        $pedomanmr->status = $request->status;
        $pedomanmr->bahasa = $request->bahasa;
        $pedomanmr->lokasi = $request->lokasi;
        $pedomanmr->bidang = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($pedomanmr->file_pdf && Storage::disk('public')->exists($pedomanmr->file_pdf)) {
                Storage::disk('public')->delete($pedomanmr->file_pdf);
            }
            $path = $request->file('file_pdf')->store('PedomanMR_pdfs', 'public');
            $pedomanmr->file_pdf = $path;
        }

        $pedomanmr->mencabut = $request->mencabut;
        $pedomanmr->save();

        return redirect()->back()->with('success', 'Pedoman MR berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pedomanmr = PedomanMR::findOrFail($id);

        if ($pedomanmr->file_pdf && Storage::disk('public')->exists($pedomanmr->file_pdf)) {
            Storage::disk('public')->delete($pedomanmr->file_pdf);
        }

        $pedomanmr->delete();

        return redirect()->back()->with('success', 'Pedoman MR berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PEDOMAN MR";
        $pedomanmrs = PedomanMR::all();
        return view('pedomanmr.lihat', compact('title', 'pedomanmrs'));
    }

    public function showJson($id)
    {
        return response()->json(PedomanMR::findOrFail($id));
    }
}
