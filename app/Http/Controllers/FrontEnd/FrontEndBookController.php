<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Book;

class FrontEndBookController extends Controller
{
    public function index()
    {
        return view('josue.frontend.book.post', ['books' => Book::FrontEndBook()->where('status', 'Enabled')->paginate(6)]);
    }

    public function single(Book $book)
    {
        // dd($slug);
        // $Book = Book::whereSlug($slug)->first();
        // dd($Book);

        return view('josue.frontend.Books.single', [
            'related_Books' => Book::FrontEndBook()->where('id', '!=', $book->id)->inRandomOrder()->take(2)->get(),
            'book' => $book->load('students:id'),
            'Books_you_may_like' => Book::FrontEndBook()->where('id', '!=', $book->id)->inRandomOrder()->take(3)->get(),
        ]);
    }
}
