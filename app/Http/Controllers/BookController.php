<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use constPath;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('view_books');

        $books = Book::all()->sortByDesc("created_at");
        $categories = Category::all();

        return view('josue.backend.books.index', compact('books','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        //
        $categories = Category::all();

        return view('josue.backend.books.create', compact('book', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {

        $book = Book::create(
        ['name' =>$request['required'],
        'category_id' => $request['required|integer'],
        'nfc' => $request['required'],
        'status' => $request['required'],
        'image' => $request['nullable|image'],]);

        $book->image = uploadOrUpdateFile($request, $book->image, constPath::BookImage);

        $book->save();
        $status = 'A new book was added successfully.';

        return redirect()->route('books.index')->with([
            'status' => $status, ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        Gate::authorize('view_book');
        $book->load('category');

        return view('josue.backend.books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('josue.backend.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request,Book $book)
    {
        //
        Gate::authorize('edit_book');

        $book->update($request->all());
        $book->image = uploadOrUpdateFile($request, $book->image, constPath::BookImage);
        $book->save();
        $status = 'Book Updated Successfully';

        return redirect()->route('books.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('books')->where('id', $id)->delete();

        $status = 'The book was deleted successfully.';

        return redirect()->route('books.index')->with([
            'status' => $status,
        ]);
    }
}
