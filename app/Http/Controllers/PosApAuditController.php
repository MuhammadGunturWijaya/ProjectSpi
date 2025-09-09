<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosApAuditController extends Controller
{
    public function index()
    {
        return view('pos-ap-audit');
    }
}
