<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class SearchPedomanController extends Controller
{
    public function index(Request $request)
    {
        $pedoman = Pedoman::query();

        // Ambil semua input
        $judul = $request->input('judul');
        $nomor = $request->input('nomor');
        $tahun = $request->input('tahun');
        $jenis = $request->input('jenis');
        $entitas = $request->input('entitas');
        $kata_kunci = $request->input('kata_kunci');

        // Filter jika ada input
        if ($judul) {
            $pedoman->where('judul', 'like', "%{$judul}%");
        }

        if ($nomor) {
            $pedoman->where('nomor', 'like', "%{$nomor}%");
        }

        if ($tahun) {
            $pedoman->where('tahun', $tahun);
        }

        if ($jenis) {
            $pedoman->where('jenis', 'like', "%{$jenis}%");
        }

        if ($entitas) {
            $pedoman->where('subjek', 'like', "%{$entitas}%");
        }

        if ($kata_kunci) {
            $pedoman->where('kata_kunci', 'like', "%{$kata_kunci}%");
        }

        $pedoman = $pedoman->paginate(10)->withQueryString();

        return view('search.searchPedomanPengawasan', [
            'pedoman' => $pedoman,
            'keyword' => $request->input('keyword', ''),
            'judul' => $judul,
            'nomor' => $nomor,
            'tahun' => $tahun,
            'jenis' => $jenis,
            'entitas' => $entitas,
            'kata_kunci' => $kata_kunci
        ]);
    }


}
