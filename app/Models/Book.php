<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

class Book extends Model
{
    use HasFactory;
    protected $appends = ['avatar'];

    protected $fillable = [
        'image',
        'name',
        'nfc',
        'category_id',
         ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class, 'category_id' ,'id');
    }

    public function user():HasMany{

        return $this->hasMany(User::class);
    }

    public function image()
    {
        if (Schema::hasColumn($this->getTable(), 'image')) {
            return asset(! empty($this->image) ? '/josue/assets/'.$this->getTable().'/images/'.$this->image : \constPath::DefaultImage);
        }
    }
}
