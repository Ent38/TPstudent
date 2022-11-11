<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('josue.frontend.about.aboutUs');
    }
}
