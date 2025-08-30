<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengurusController extends Controller
{
    // Form edit pengurus
    public function edit($id)
    {
        // misalnya ambil data pengurus dari database
        // kalau datanya statis (cuma gambar di public/images), cukup kirim id
        return view('admin.editPengurus', compact('id'));
    }

    // Proses update pengurus
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = 'pengurus_'.$id.'.jpg'; // contoh: pengurus_1.jpg
            $file->move(public_path('images'), $fileName);
        }

        // kalau pakai DB: update nama & jabatan ke tabel pengurus
        // misalnya Pengurus::where('id',$id)->update([...]);

        return redirect()->back()->with('success', 'Data pengurus berhasil diperbarui.');
    }
}
