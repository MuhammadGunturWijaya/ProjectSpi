<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    // Tampilkan timeline di halaman SPI
    // Halaman SPI publik (index)
    public function index()
    {
        $timelines = Timeline::orderBy('id', 'asc')->get();
        return view('sejarah', compact('timelines'));
    }


    // Form tambah
    public function create()
    {
        return view('admin.timeline.create');
    }

    // Simpan timeline baru
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Timeline::create($request->all());
        return redirect()->route('admin.timeline.index')->with('success', 'Fase baru berhasil ditambahkan!');
    }

    // Form edit
    public function edit(Timeline $timeline)
    {
        return view('admin.timeline.edit', compact('timeline'));
    }

    // Update timeline
    public function update(Request $request, Timeline $timeline)
    {
        $request->validate([
            'year' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $timeline->update($request->all());
        return redirect()->route('admin.timeline.index')->with('success', 'Fase berhasil diperbarui!');
    }

    // Hapus timeline
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return redirect()->route('admin.timeline.index')->with('success', 'Fase berhasil dihapus!');
    }
}
