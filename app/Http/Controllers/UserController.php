<?php

namespace App\Http\Controllers;

use constPath;
use App\Models\Role;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Models\Student;
use Jambasangsang\Flash\Facades\LaravelFlash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('josue.backend.users.index', ['users' => User::role(['Admin'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('josue.backend.users.create', ['roles' => Role::where('name', '!=', 'User')->get('name', 'id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated() + ['password' => Hash::make($request->password)]);
        $user->assignRole($request->role);
        $user->image = uploadOrUpdateFile($request, $user->image, constPath::UserImage);
        $user->save();
        LaravelFlash::withSuccess('User Created Successfully');
        return match ($request->role) {

            'Admin' => redirect()->route('users.index'),
            'default' => redirect()->route('users.index'),
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Gate::authorize('view_users');
        $student = Student::all();
        return view('josue.backend.students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('josue.backend.users.edit', ['roles' => Role::where('name', '!=', 'User')->get('name', 'id'), 'user' => User::whereSlug($slug)->firstOrFail()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();
        $user->update(['name' => $request->name, 'email' => $request->email, 'username' => $request->username]);
        $user->assignRole($request->role);
        $user->image = uploadOrUpdateFile($request, $user->image, constPath::UserImage);
        $user->save();
        LaravelFlash::withSuccess('User Updated Successfully');
        return match ($request->role) {

            'Admin' => redirect()->route('users.index'),
            'default' => redirect()->route('users.index'),
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
