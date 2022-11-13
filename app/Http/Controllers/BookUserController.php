<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookUserRequest;
use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class BookUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('view_bookuser');
        $categories = Category::all()->sortByDesc("created_at");
        $books = Book::where('category_id', request('category_id'))->latest()->get();

        return view('josue.frontend.bookuser.index', compact( 'books','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $books = Book::all()->sortByDesc("created_at");
        $users = User::all()->sortByDesc("created_at");
        $bookUsers = BookUser::get();
        $chapter = Book::all()->pluck('nfc');

        return view('josue.frontend.bookuser.create', compact('books', 'chapter', 'bookUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookUserRequest $request)
    {
        //
        Gate::authorize('add_bookuser');

        $user = Auth::user()->id;
        $bookUsers = BookUser::create([
            'user_id' => $request['user_id'],
            'chap_num' => $request['chap_num'],
            'book_id' => $request['book_id'],
        ]);
        // or $request->user()
        $bookUsers->save();
        $status = 'chapter number was added successfully.';
        return redirect()->route('bookuser.index')->with([
            'status' => $status, ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        Gate::authorize('view_bookuser');
        $categories = Category::all()->sortByDesc("created_at");
        $books = Book::where('category_id', request('category_id'))->latest()->get();
        $bookUser=BookUser::all();
        $nfc = Book::orderBy('id' , 'desc')->first()->nfc;

        return redirect()->route('josue.frontend.bookuser.show',compact('books','nfc','bookUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function edit(BookUser $bookUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookUser $bookUser)
    {
        //
        Gate::authorize('update_bookuser');
        $user = Auth::user()->id;
        $bookUser = BookUser::create([
            'user_id' => $request['user_id'],
            'chap_num' => $request['chap_num'],
            'book_id' => $request['book_id'],
        ]);

        $bookUser->save();

        $status = 'chapter Updated Successfully';

        return redirect()->route('bookuser.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookUser $bookUser)
    {
        //
    }
}
