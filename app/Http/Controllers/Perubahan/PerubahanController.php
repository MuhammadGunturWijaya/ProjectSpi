<?php

namespace App\Http\Controllers\Perubahan;

use App\Http\Controllers\Controller;
use App\Models\Perubahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerubahanController extends Controller
{
    public function index()
    {
        $title = "MANAJEMEN PERUBAHAN";
        $perubahans = Perubahan::all();

        return view('Perubahan.index', compact('title', 'perubahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $perubahan = new Perubahan();
        $perubahan->judul            = $request->judul;
        $perubahan->tahun            = $request->tahun;
        $perubahan->kata_kunci       = $request->kata_kunci;
        $perubahan->abstrak          = $request->abstrak;
        $perubahan->catatan          = $request->catatan;
        $perubahan->tipe_dokumen     = $request->tipe_dokumen;
        $perubahan->judul_meta       = $request->judul_meta;
        $perubahan->teu              = $request->teu;
        $perubahan->nomor            = $request->nomor;
        $perubahan->bentuk           = $request->bentuk;
        $perubahan->bentuk_singkat   = $request->bentuk_singkat;
        $perubahan->tahun_meta       = $request->tahun_meta;
        $perubahan->tempat_penetapan = $request->tempat_penetapan;
        $perubahan->tanggal_penetapan = $request->tanggal_penetapan;
        $perubahan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $perubahan->tanggal_berlaku  = $request->tanggal_berlaku;
        $perubahan->sumber           = $request->sumber;
        $perubahan->subjek           = $request->subjek;
        $perubahan->status           = $request->status;
        $perubahan->bahasa           = $request->bahasa;
        $perubahan->lokasi           = $request->lokasi;
        $perubahan->bidang           = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('Perubahan_pdfs', 'public');
            $perubahan->file_pdf = $path;
        }

        $perubahan->mencabut = $request->mencabut;
        $perubahan->save();

        return redirect()->back()->with('success', 'Data Perubahan berhasil disimpan.');
    }

    public function show($id)
    {
        $perubahan = Perubahan::findOrFail($id);
        return view('Perubahan.detail', compact('perubahan'));
    }

    public function edit($id)
    {
        $perubahan = Perubahan::findOrFail($id);
        return view('Perubahan.edit', compact('perubahan'));
    }

    public function update(Request $request, $id)
    {
        $perubahan = Perubahan::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|integer',
            'file_pdf'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $perubahan->judul            = $request->judul;
        $perubahan->tahun            = $request->tahun;
        $perubahan->kata_kunci       = $request->kata_kunci;
        $perubahan->abstrak          = $request->abstrak;
        $perubahan->catatan          = $request->catatan;
        $perubahan->tipe_dokumen     = $request->tipe_dokumen;
        $perubahan->judul_meta       = $request->judul_meta;
        $perubahan->teu              = $request->teu;
        $perubahan->nomor            = $request->nomor;
        $perubahan->bentuk           = $request->bentuk;
        $perubahan->bentuk_singkat   = $request->bentuk_singkat;
        $perubahan->tahun_meta       = $request->tahun_meta;
        $perubahan->tempat_penetapan = $request->tempat_penetapan;
        $perubahan->tanggal_penetapan = $request->tanggal_penetapan;
        $perubahan->tanggal_pengundangan = $request->tanggal_pengundangan;
        $perubahan->tanggal_berlaku  = $request->tanggal_berlaku;
        $perubahan->sumber           = $request->sumber;
        $perubahan->subjek           = $request->subjek;
        $perubahan->status           = $request->status;
        $perubahan->bahasa           = $request->bahasa;
        $perubahan->lokasi           = $request->lokasi;
        $perubahan->bidang           = $request->bidang;

        if ($request->hasFile('file_pdf')) {
            if ($perubahan->file_pdf && Storage::disk('public')->exists($perubahan->file_pdf)) {
                Storage::disk('public')->delete($perubahan->file_pdf);
            }
            $path = $request->file('file_pdf')->store('Perubahan_pdfs', 'public');
            $perubahan->file_pdf = $path;
        }

        $perubahan->mencabut = $request->mencabut;
        $perubahan->save();

        return redirect()->back()->with('success', 'Data Perubahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perubahan = Perubahan::findOrFail($id);

        if ($perubahan->file_pdf && Storage::disk('public')->exists($perubahan->file_pdf)) {
            Storage::disk('public')->delete($perubahan->file_pdf);
        }

        $perubahan->delete();

        return redirect()->back()->with('success', 'Data Perubahan berhasil dihapus.');
    }

    public function lihat()
    {
        $title = "DAFTAR PERUBAHAN";
        $perubahans = Perubahan::all();
        return view('Perubahan.lihat', compact('title', 'perubahans'));
    }

    public function showJson($id)
    {
        return response()->json(Perubahan::findOrFail($id));
    }
}
