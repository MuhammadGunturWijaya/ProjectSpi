<?php

namespace App\Http\Controllers\posAp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosAP;

class posApController extends Controller
{
    public function show($id)
    {
        $posAp = PosAp::findOrFail($id);
        return view('PosApPengawasan.detail-posap', compact('posAp'));
    }

}
