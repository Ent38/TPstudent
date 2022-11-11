<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\News;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // dd(auth()->user()->Books()->withCount('Book', 'student')->with('Book:id,name,slug,image')->get());
        return view(
            'home',
            [
                'numberOfAdmins' => User::Admin()->count(),

                'books' => Book::get(),

                'numberOfStudents' => User::Student()->count(),
                'numberOfActiveStudents' => User::Student()->where('status', 'Enabled')->count(),
                'numberOfInactiveStudents' => User::Student()->where('status', 'Disabled')->count(),

                'news' => News::where('status', 'Enabled')->get(['id', 'title', 'created_at']),

            ]
        );
    }
}
