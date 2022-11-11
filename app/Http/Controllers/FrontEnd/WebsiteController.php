<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slider;

class WebsiteController extends Controller
{
    public function website()
    {
        // dd(News::inRandomOrder()->get()->take(4));

        return view(
            'welcome',
            [
                'random_news' => News::inRandomOrder()->get()->take(4),
                'featured_new' => News::inRandomOrder()->take(1)->get(),
                'sliders' => Slider::where('status', 'Enabled')->get(),
            ]
        );
    }
}
