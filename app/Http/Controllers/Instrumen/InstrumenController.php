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

    // Detail dalam format JSON
    public function getDetail($id)
    {
        $instrumen = Instrumen::findOrFail($id);

        return response()->json([
            'judul' => $instrumen->judul,
            'tahun' => $instrumen->tahun,
            'kata_kunci' => $instrumen->kata_kunci ?? '',
            'abstrak' => $instrumen->abstrak ?? '',
            'catatan' => $instrumen->catatan ?? '',
            'file_pdf' => $instrumen->file_pdf ? asset('storage/' . trim($instrumen->file_pdf)) : null,
        ]);
    }

    // Hapus data
    public function destroy($id)
    {
        $instrumen = Instrumen::findOrFail($id);

        if ($instrumen->file_pdf && Storage::disk('public')->exists($instrumen->file_pdf)) {
            Storage::disk('public')->delete($instrumen->file_pdf);
        }

        $instrumen->delete();

        return redirect()->back()->with('success', 'Instrumen berhasil dihapus.');
    }

    // Edit halaman
    public function edit($id)
    {
        $instrumen = Instrumen::findOrFail($id);
        return view('InstrumenPengawasan.edit-instrumen', compact('instrumen'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $instrumen = Instrumen::findOrFail($id);

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

        $instrumen->fill($validated);

        if ($request->hasFile('file_pdf')) {
            if ($instrumen->file_pdf && Storage::disk('public')->exists($instrumen->file_pdf)) {
                Storage::disk('public')->delete($instrumen->file_pdf);
            }

            $path = $request->file('file_pdf')->store('Instrumen_pdfs', 'public');
            $instrumen->file_pdf = $path;
        }

        $instrumen->save();

        return redirect()->back()->with('success', 'Instrumen berhasil diperbarui.');
    }

    // Halaman daftar semua instrumen
    public function lihat()
    {
        $title = "DAFTAR INSTRUMEN PENGAWASAN";
        $instrumens = Instrumen::all();
        return view('InstrumenPengawasan.lihat-instrumen', compact('title', 'instrumens'));
    }
}
