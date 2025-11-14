<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Survey;
use App\Helpers\IkmHelper;

class LandingPageController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->take(3)->get();
        $surveys = Survey::all();
        $totalRespondents = $surveys->count();

        // ✅ Gunakan helper yang sama
        $ikmData = IkmHelper::calculateIkm($surveys);
        
        $ikm = $ikmData['ikm'];
        $ikmCategory = $ikmData['category'];

        return view('LandingPages', compact('beritas', 'ikm', 'ikmCategory', 'totalRespondents'));
    }
}