<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $camps = Camp::with(['camp_benefits'])->limit(2)->get();

        // dd($camps);

        return view('pages.index', compact('camps'));
    }
}
