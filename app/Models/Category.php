<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['avatar'];

    protected $fillable = ['name', 'image'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        if (Schema::hasColumn($this->getTable(), 'image')) {
            return asset(! empty($this->image) ? '/josue/assets/'.$this->getTable().'/images/'.$this->image : \constPath::DefaultImage);
        }
    }
}
