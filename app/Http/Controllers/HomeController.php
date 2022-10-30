<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // dd(auth()->user()->courses()->withCount('course', 'student')->with('course:id,name,slug,image')->get());
        return view(
            'home',
            [
                'numberOfAdmins' => User::Admin()->count(),

                'numberOfStudents' => User::Student()->count(),
                'numberOfActiveStudents' => User::Student()->where('status', 'Enabled')->count(),
                'numberOfInactiveStudents' => User::Student()->where('status', 'Disabled')->count(),

                'news' => News::where('status', 'Enabled')->get(['id', 'title', 'created_at']),


            ]
        );
    }
}
