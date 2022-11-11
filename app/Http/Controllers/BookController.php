<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Jambasangsang\Flash\Facades\LaravelFlash;

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
        $books=Book::with('category')->get();
        $id=Book::all()->pluck('id');
        Gate::authorize('view_books');
        $books = Book::get();

        return view('josue.backend.books.index', ['books' => $books],compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $books = Book::all()->pluck('name', 'id');
        $chapter = Book::all()->pluck('nfc', 'id');
        $categories=Category::all();

        return view('josue.backend.books.create', compact('books', 'chapter','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $books = Book::create($request->validated());
        $books->image = uploadOrUpdateFile($request, $books->image, \constPath::UserImage);
        $category_id=Category::all()->pluck('id');
        // Book::create([
        //     'name' => $request->input('name'),
        //     'nfc' => $request->input('nfc'),
        //     'category_id' => $request->input('category_id'),
        //  ]);
        $books->save();
        $status = 'A new book was added successfully.';

        return redirect()->route('books.index',compact('category_id'))->with([
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

        return view('josue.backend.books.show', ['book' => Book::with('books', 'books.book')->whereSlug($book)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $book=Book::whereSlug($slug)->firstOrFail();
        $categories=Category::all();

        return view('josue.backend.books.edit', ['book' => $book], compact('categories'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $slug)
    {
        //
        Gate::authorize('edit_book');
        $book=Book::whereSlug($slug)->firstOrFail();
        $book->update($request->validated());
        $book->image = uploadOrUpdateFile($request, $book->image, \constPath::BookImage);
        $book->save();
        $status='Book Updated Successfully';

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
        $books = Book::get();
        $book = Book::FindOrFail($id);
        $book->delete();

        $status = 'The book was deleted successfully.';

        return redirect()->route('books.index', ['books' => $books])->with([
            'status' => $status,
        ]);
    }
}
