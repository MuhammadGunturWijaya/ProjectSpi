<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class SearchPedomanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', '');

        $pedoman = Pedoman::query();

        if ($keyword) {
            $pedoman->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('kata_kunci', 'like', "%{$keyword}%")
                    ->orWhere('jenis', 'like', "%{$keyword}%")
                    ->orWhere('abstrak', 'like', "%{$keyword}%");
            });

        }

        $pedoman = $pedoman->paginate(10)->withQueryString();

        return view('search.searchPedomanPengawasan', compact('pedoman', 'keyword'));
    }

}
