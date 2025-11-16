<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    // Method untuk user biasa
    public function index()
    {
        $aspirasis = Aspirasi::orderBy('created_at', 'desc')->paginate(10);
        return view('aspirasi.index', compact('aspirasis'));
    }

    // Method untuk admin melihat semua aspirasi
    public function adminIndex(Request $request)
    {
        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = Aspirasi::query();

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhere('asal_pelapor', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%");
            });
        }

        $aspirasis = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistik
        $stats = [
            'total' => Aspirasi::count(),
            'agama' => Aspirasi::where('kategori', 'agama')->count(),
            'kesehatan' => Aspirasi::where('kategori', 'kesehatan')->count(),
            'keuangan' => Aspirasi::where('kategori', 'keuangan')->count(),
            'pendidikan' => Aspirasi::where('kategori', 'pendidikan')->count(),
            'infrastruktur' => Aspirasi::where('kategori', 'infrastruktur')->count(),
            'akademik' => Aspirasi::where('kategori', 'akademik')->count(),
            'kemahasiswaan' => Aspirasi::where('kategori', 'kemahasiswaan')->count(),
            'sarana_prasarana' => Aspirasi::where('kategori', 'sarana_prasarana')->count(),
            'layanan_administrasi' => Aspirasi::where('kategori', 'layanan_administrasi')->count(),
            'kerja_sama' => Aspirasi::where('kategori', 'kerja_sama')->count(),
            'kepegawaian' => Aspirasi::where('kategori', 'kepegawaian')->count(),
            'perencanaan_dan_kegiatan' => Aspirasi::where('kategori', 'perencanaan_dan_kegiatan')->count(),
            'tata_kelola' => Aspirasi::where('kategori', 'tata_kelola')->count(),
            'unit_bisnis_dan_teaching_factory' => Aspirasi::where('kategori', 'unit_bisnis_dan_teaching_factory')->count(),
            'lingkungan' => Aspirasi::where('kategori', 'lingkungan')->count(),
            'sistem_informasi_dan_komunikasi' => Aspirasi::where('kategori', 'sistem_informasi_dan_komunikasi')->count(),
            'lainnya' => Aspirasi::where('kategori', 'lainnya')->count(),
        ];


        return view('aspirasi.admin', compact('aspirasis', 'stats'));
    }

    public function create()
    {
        return view('aspirasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'asal_pelapor' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|in:agama,kesehatan,keuangan,pendidikan,infrastruktur,akademik,kemahasiswaan,sarana_prasarana,layanan_administrasi,kerja_sama,kepegawaian,perencanaan_dan_kegiatan,tata_kelola,unit_bisnis_dan_teaching_factory,lingkungan,sistem_informasi_dan_komunikasi,lainnya',
            'kategori_lainnya' => 'required_if:kategori,lainnya|nullable|string|max:255',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ], [
            'judul.required' => 'Judul aspirasi wajib diisi',
            'keterangan.required' => 'Keterangan detail wajib diisi',
            'asal_pelapor.required' => 'Asal pelapor wajib diisi',
            'instansi.required' => 'Instansi wajib diisi',
            'tanggal.required' => 'Tanggal laporan wajib diisi',
            'kategori.required' => 'Kategori laporan wajib dipilih',
            'kategori_lainnya.required_if' => 'Kategori lainnya wajib diisi jika memilih "Lainnya"',
            'lampiran.mimes' => 'File harus berformat PDF, DOC, DOCX, JPG, JPEG, atau PNG',
            'lampiran.max' => 'Ukuran file maksimal 5MB',
        ]);

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $validated['lampiran'] = $file->storeAs('lampiran', $filename, 'public');
        }

        Aspirasi::create($validated);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim! Terima kasih atas partisipasi Anda.');
    }

    public function show(Aspirasi $aspirasi)
    {
        return view('aspirasi.show', compact('aspirasi'));
    }

    public function adminShow(Aspirasi $aspirasi)
    {
        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('aspirasi.admin-show', compact('aspirasi'));
    }

    public function destroy(Aspirasi $aspirasi)
    {
        if ($aspirasi->lampiran) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }

        $aspirasi->delete();

        // Redirect ke admin index jika user adalah admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('aspirasi.admin')->with('success', 'Aspirasi berhasil dihapus');
        }

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }
}