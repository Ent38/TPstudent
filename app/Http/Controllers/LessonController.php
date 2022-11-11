<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Models\Book;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use jambasangsang\Flash\Facades\LaravelFlash;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        return view('josue.backend.lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        $lesson->image = uploadOrUpdateFile($request, $lesson->image, \constPath::LessonImage);
        $lesson->save();
        LaravelFlash::withSuccess('Lesson Created Successfully');

        return redirect()->route('lesson.show', [$request->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Gate::authorize('view_news');
        $book = Book::whereSlug($slug)->firstOrFail();
        $book->update(['is_read' => 'yes']);

        return view('josue.frontend.home.publication', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
