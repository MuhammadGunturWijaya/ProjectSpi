<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Artikel;
use App\Models\Profil;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;

        $beritas = Berita::where('judul', 'LIKE', "%$keyword%")->get();
        $artikels = Artikel::where('judul', 'LIKE', "%$keyword%")->get();
        $profils = Profil::where('judul', 'LIKE', "%$keyword%")->get();

        return view('landingpage', compact('beritas', 'artikels', 'profils'));
    }
}
