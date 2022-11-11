<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class FrontEndEventController extends Controller
{
    public function index()
    {
        return view('josue.frontend.events.index');
    }

    public function single($slug)
    {
        return view('josue.frontend.events.single');
    }
}
