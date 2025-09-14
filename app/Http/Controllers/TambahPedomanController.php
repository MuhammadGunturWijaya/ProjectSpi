<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;
use Exception;

class TambahPedomanController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Materi Pokok
                'judul' => 'required|string|max:255',
                'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
                'kata_kunci' => 'nullable|string|max:255',
                'abstrak' => 'nullable|string',
                'catatan' => 'nullable|string',

                // Metadata
                'tipe_dokumen' => 'nullable|string|max:255',
                'judul_meta' => 'nullable|string|max:255',
                'teu' => 'nullable|string|max:255',
                'nomor' => 'nullable|string|max:100',
                'bentuk' => 'nullable|string|max:100',
                'bentuk_singkat' => 'nullable|string|max:100',
                'tahun_meta' => 'nullable|integer',
                'tempat_penetapan' => 'nullable|string|max:255',
                'tanggal_penetapan' => 'nullable|date',
                'tanggal_pengundangan' => 'nullable|date',
                'tanggal_berlaku' => 'nullable|date',
                'sumber' => 'nullable|string|max:255',
                'subjek' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
                'bahasa' => 'nullable|string|max:100',
                'lokasi' => 'nullable|string|max:255',
                'bidang' => 'nullable|string|max:255',

                // File & Status
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'mencabut' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('file_pdf')) {
                $validated['file_pdf'] = $request->file('file_pdf')
                    ->store('pedoman_pdfs', 'public');
            }

            Pedoman::create($validated);

            return redirect()->back()->with('success', 'Pedoman berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}
