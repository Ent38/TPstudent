<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Gate;


class NewsController extends Controller
{
    public function index()
    {
        Gate::authorize('view_news');

        return view(
            'josue.backend.news.index',
            [
                'newses' => News::get(),
            ]
        );
    }

    public function create()
    {
        Gate::authorize('add_news');

        return view('josue.backend.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        Gate::authorize('add_news');

        $news = News::create($request->validated());
        $news->image = uploadOrUpdateFile($request, $news->image, \constPath::NewsImage);
        $news->save();
        $status = 'News Created Successfully';

        return redirect()->route('newses.index')->with([
            'status' => $status, ]);
    }

    public function show($slug)
    {
        Gate::authorize('view_news');
        $news = News::whereSlug($slug)->firstOrFail();
        $news->update(['is_read' => 'yes']);

        return view('josue.backend.news.show', ['news' => $news]);
    }

    public function edit($slug)
    {
        Gate::authorize('edit_news');

        $news = News::whereSlug($slug)->firstOrFail();

        return view('josue.backend.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, $slug)
    {
        $news = News::whereSlug($slug)->firstOrFail();

        $news->update($request->validated());
        $news->image = uploadOrUpdateFile($request, $news->image, \constPath::NewsImage);
        $news->save();
        $status='News Updated Successfully';

        return redirect()->route('newses.index')->with([
            'status' => $status, ]);
    }

    public function destroy($id)
    {
        Gate::authorize('delete_news');

        $newses = News::all();
        $news = News::FindOrFail($id);
        $news->delete();
        $status = 'The news was deleted successfully.';

        return redirect()->route('newses.index', ['newses' => $newses])->with([
            'status' => $status,
        ]);
    }

    public function single($slug)
    {
        $news = News::whereSlug($slug)->firstOrFail();
        $news->update(['is_read' => 'yes']);

        return view('josue.frontend.news.single', ['news' => $news]);
    }
}
