<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class SearchPedomanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));

        $query = Pedoman::query();

        if ($keyword) {
            // Filter keyword di judul, abstrak, catatan, kata_kunci
            $query->where(function($q) use ($keyword){
                $q->where('judul','like',"%{$keyword}%")
                  ->orWhere('abstrak','like',"%{$keyword}%")
                  ->orWhere('catatan','like',"%{$keyword}%")
                  ->orWhere('kata_kunci','like',"%{$keyword}%")
                  ->orWhere('tahun','like',"%{$keyword}%");
            });

            // Prioritaskan judul yang mengandung keyword
            $query->orderByRaw("CASE WHEN judul LIKE ? THEN 0 ELSE 1 END", ["%{$keyword}%"])
                  ->orderByDesc('created_at');
        } else {
            $query->whereRaw('1 = 0'); // kembalikan kosong jika keyword kosong
        }

        $pedoman = $query->paginate(10)->withQueryString();

        return view('search.searchPedomanPengawasan', [
            'pedoman' => $pedoman,
            'keyword' => $keyword,
        ]);
    }
}
