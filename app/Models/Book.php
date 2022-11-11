<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'image',
        'name',
        'nfc',
        'slug', ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
