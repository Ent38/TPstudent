<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $notificationNews = News::where(['status' => 'Enabled', 'is_read' => 'no'])->select('id', 'title', 'slug', 'created_at')->get();
        view()->share(['notificationNews' => $notificationNews]);
    }
}
