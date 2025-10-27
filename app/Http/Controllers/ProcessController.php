<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::orderBy('step_number')->get();
        // arahkan ke file resources/views/prosesBisnisSPI.blade.php
        return view('prosesBisnisSPI', compact('processes'));
    }

    public function create()
    {
        return view('processes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Daftar icon Bootstrap
        $icons = [
            'bi bi-clipboard-check',
            'bi bi-search',
            'bi bi-file-earmark-text',
            'bi bi-arrow-repeat',
            'bi bi-graph-up-arrow',
            'bi bi-lightbulb',
            'bi bi-gear',
            'bi bi-check-circle',
            'bi bi-people',
        ];

        // Ambil step_number terakhir dan tambahkan 1
        $lastStep = Process::max('step_number');
        $nextStep = $lastStep ? $lastStep + 1 : 1;

        // Pilih icon secara acak
        $randomIcon = $icons[array_rand($icons)];

        Process::create([
            'step_number' => $nextStep,
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $randomIcon,
        ]);

        return redirect()->route('processes.index')->with('success', 'Langkah berhasil ditambahkan!');
    }

    public function edit(Process $process)
    {
        return view('processes.edit', compact('process'));
    }

    public function update(Request $request, Process $process)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        $process->update($request->all());
        return redirect()->route('processes.index')->with('success', 'Langkah berhasil diperbarui!');
    }



    public function destroy(Process $process)
    {
        $process->delete();
        return back()->with('success', 'Langkah berhasil dihapus');
    }
}
