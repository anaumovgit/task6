<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = false;
    const CREATED_AT = 'registered_at';
    const UPDATED_AT = 'auth_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_show',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_show',
    ];

    protected $attributes = [
        'status' => 'active',
        'role' => 'user'
    ];

    public function messages()
    {
        return $this->hasMany('App\Models\Message')->latest();
    }

}
