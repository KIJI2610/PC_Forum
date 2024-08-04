<?php

namespace App\Http\Controllers;

use App\Models\Section;

class HomeController extends Controller
{
    public function show()
    {
        $sections = Section::all();
        return view('home', compact('sections'));
    }
}
