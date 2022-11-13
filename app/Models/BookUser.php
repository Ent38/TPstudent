<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookUser extends Model
{
    use HasFactory, Slugable;

    protected $fillable = [
        'chap_num',
        'users_id',
        'books_id' ];

        public function book()
        {
          $this->belongsTo(Book::class, 'book_id' ,'id');
        }

        public function user()
        {
          $this->belongsTo(User::class, 'user_id' ,'id');
        }
}
