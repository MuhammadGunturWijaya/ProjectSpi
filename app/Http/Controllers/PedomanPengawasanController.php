<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class PedomanPengawasanController extends Controller
{
    // Halaman utama pedoman pengawasan
    public function index()
    {
        // Ambil maksimal 4 pedoman tiap jenis
        $pedomanAudit = Pedoman::where('jenis', 'audit')->take(4)->get();
        $pedomanReviu = Pedoman::where('jenis', 'reviu')->take(4)->get();
        $pedomanMonev = Pedoman::where('jenis', 'monev')->take(4)->get();

        return view('pedomanPengawasan', compact('pedomanAudit', 'pedomanReviu', 'pedomanMonev'));
    }

    // Halaman detail pedoman berdasarkan ID
    public function show($id)
    {
        $pedoman = Pedoman::findOrFail($id); // ambil data pedoman berdasarkan id
        return view('pedomanPengawasan.detail-pedoman', compact('pedoman'));
    }
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

}
