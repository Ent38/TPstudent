<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'image',
        'title',
        'content',
        'date',
        'status',
        'created_by_id',
        'is_read',

    ];

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected $casts = [
        'date' => 'datetime',
    ];

    public function image()
    {
        if (Schema::hasColumn($this->getTable(), 'image')) {
            return asset(! empty($this->image) ? '/josue/assets/'.$this->getTable().'/images/'.$this->image : \constPath::DefaultImage);
        }
    }
}
