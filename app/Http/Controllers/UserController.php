<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use constPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $status = 'A new user was added successfully.';

        return match ($request->role) {
            'Admin' => redirect()->route('users.index')->with([
                'status' => $status, ]),
            'default' => redirect()->route('users.index')->with([
                'status' => $status, ]),
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

        return view('josue.backend.students.show', ['student' => User::with('books', 'books.book')->whereSlug($slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $roles = Role::where('name', '!=', 'User')->get('name', 'id');
        $user = User::whereSlug($slug)->firstOrFail();

        return view('josue.backend.users.edit', compact('roles', 'user', 'slug'));
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
        $status = 'User Updated Successfully';

        return match ($request->role) {
            'Admin' => redirect()->route('users.index')->with([
                'status' => $status, ]),
            'default' => redirect()->route('users.index')->with([
                'status' => $status, ]),
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
        DB::table('users')->where('id', $id)->delete();

        $status = 'The user was deleted successfully.';

        return redirect()->route('users.index')->with([
            'status' => $status,
        ]);
    }
}
