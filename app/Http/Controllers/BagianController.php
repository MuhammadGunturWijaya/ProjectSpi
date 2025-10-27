<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;


class BagianController extends Controller
{
    // Simpan bagian baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_bagian' => 'required|string|unique:bagians,nama_bagian',
        ]);

        $bagian = Bagian::create([
            'nama_bagian' => $request->nama_bagian
        ]);

        return response()->json([
            'success' => true,
            'data' => $bagian
        ]);
    }

    // Ambil list semua bagian
    public function list()
    {
        $bagians = Bagian::orderBy('nama_bagian')->get();
        return response()->json($bagians);
    }

    public function createEvaluasiMr()
    {
        $bagians = Bagian::all(); // ambil semua bagian/units
        return view('identifikasi.evaluasiMr_form', compact('bagians'));
    }

    public function editEvaluasiMr($id)
    {
        $risiko = IdentifikasiRisiko::findOrFail($id);
        $bagians = Bagian::all(); // ambil semua bagian/units
        return view('identifikasi.evaluasiMr_form', compact('risiko', 'bagians'));
    }

}
