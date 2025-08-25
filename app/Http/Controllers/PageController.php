<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function strukturOrganisasi()
    {
        return view('struktur-organisasi');
    }
    public function ProfileSpi()
    {
        return view('profile-spi');
    }


}
