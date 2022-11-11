<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugable;

class Category extends Model
{
    use HasFactory, Slugable;
    protected $fillable = ['name','slug','image'];



}
