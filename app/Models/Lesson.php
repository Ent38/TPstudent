<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Traits\RendersContent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Lesson extends Model
{
    use RendersContent, Slugable;


    protected  $fillable = ['title', 'content', 'status', 'image', 'slug'];

    

    public function content()
    {
        return $this->larabergContent();
    }

    public function messages()
    {
        return $this->morphMany('App\Models\Message', 'messageable')->with('user');
    }
}
