<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('josue.frontend.contact.contactUs');
    }
}
