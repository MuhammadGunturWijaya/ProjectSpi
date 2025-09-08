<?php

namespace App\Http\Controllers;

use App\Models\Sdm;
use Illuminate\Http\Request;

class SdmController extends Controller
{
    public function index()
    {
        $sdm = Sdm::all();
        return view('Sumber-Daya-Manusia', compact('sdm'));
    }

    public function create()
    {
        return view('sdm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'biodata' => 'required|string|max:255',
            'tanggal_lahir' => 'required|string|max:255',
            'pengalaman' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $fotoName);
        }

        Sdm::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'bidang' => $request->bidang,
            'biodata' => $request->biodata,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pengalaman' => $request->pengalaman,
            'foto' => $fotoName,
        ]);

        return redirect()->route('sdm.index')->with('success', 'SDM berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $sdm = Sdm::findOrFail($id);
        return view('sdm.edit', compact('sdm'));
    }

    public function update(Request $request, $id)
    {
        try {
            $sdm = Sdm::findOrFail($id);

            $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'bidang' => 'required|string|max:255',
                'biodata' => 'required|string',
                'pengalaman' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // update data
            $sdm->nama = $request->nama;
            $sdm->jabatan = $request->jabatan;
            $sdm->bidang = $request->bidang;
            $sdm->biodata = $request->biodata;
            $sdm->pengalaman = $request->pengalaman;
            $sdm->tanggal_lahir = $request->tanggal_lahir;

            // update foto
            if ($request->hasFile('foto')) {
                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('images'), $fotoName);
                $sdm->foto = $fotoName;
            }

            $sdm->save();

            return redirect()->route('sdm.edit', $id)->with('success', 'Data SDM berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('sdm.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


}
