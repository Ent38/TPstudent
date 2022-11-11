<?php

namespace App\Models;

use App\Traits\Slugable;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property string $name
 * @property string media_token
 * @property string email
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles, HasFactory, Slugable;

    protected $appends = ['avatar'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'status', 'image', 'code', 'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(BookUser::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getAvatarAttribute()
    {
        return Gravatar::get($this->attributes['email']);
    }

    public function assignRoles()
    {
        foreach ($this->getRoleNames() as $role) {
            return $role;
        }
    }

    public function scopeStudent()
    {
        return User::Role('User');
    }

    public function scopeAdmin()
    {
        return User::Role('Admin');
    }
}
