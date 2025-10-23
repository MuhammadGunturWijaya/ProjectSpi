<?php

namespace App\Http\Controllers\Instrumen;

use App\Http\Controllers\Controller;
use App\Models\Instrumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstrumenController extends Controller

{
    // Halaman utama Instrumen Pengawasan
    public function index()
    {
        $title = "INSTRUMEN PENGAWASAN";
        $instrumens = Instrumen::all();

        $popular = Instrumen::where('created_at', '>=', Carbon::now()->subDays(14))
            ->orderByDesc('views')
            ->limit(8)
            ->get();

        return view('InstrumenPengawasan.index', compact('title', 'instrumens', 'popular'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'kata_kunci' => 'nullable|string',
            'abstrak' => 'nullable|string',
            'catatan' => 'nullable|string',
            'tipe_dokumen' => 'nullable|string',
            'judul_meta' => 'nullable|string',
            'teu' => 'nullable|string',
            'nomor' => 'nullable|string',
            'bentuk' => 'nullable|string',
            'bentuk_singkat' => 'nullable|string',
            'tahun_meta' => 'nullable|string',
            'tempat_penetapan' => 'nullable|string',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',
            'tanggal_berlaku' => 'nullable|date',
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'status' => 'nullable|string',
            'bahasa' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'bidang' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:40000',
            'mencabut' => 'nullable|string',
        ]);

        $instrumen = new Instrumen($validated);

        // Simpan file PDF jika ada
        if ($request->hasFile('file_pdf')) {
            $path = $request->file('file_pdf')->store('Instrumen_pdfs', 'public');
            $instrumen->file_pdf = $path;
        }

        $instrumen->views = 0; // inisialisasi awal jumlah views
        $instrumen->save();

        return redirect()->back()->with('success', 'Instrumen berhasil ditambahkan.');
    }

    // Halaman detail instrumen
    public function show($id)
    {
        $instrumen = Instrumen::findOrFail($id);
        $instrumen->increment('views');

        return view('InstrumenPengawasan.detail-instrumen', compact('instrumen'));
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
