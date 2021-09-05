<?php

namespace App\Models;

use App\Traits\Rules;
use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids, Rules;

    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author');
    }

    /**
     * Role name
     *
     * @var string[]
     */
    public static $roleNames = [
        self::ADMIN_ROLE => 'Admin',
        self::USER_ROLE => 'User',
    ];

    /**
     * Get role_name attribute
     *
     * @return string|null
     */
    public function getRoleNameAttribute()
    {
        if (!isset($this->role)) {
            return null;
        }

        return self::$roleNames[$this->role];
    }

    /**
     * Rules
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|min:5|max:50|unique:\App\Models\User,email',
            'password' => 'required|min:6|max:50|confirmed',
            'role' => 'required|in:' . implode(',', array_keys(User::$roleNames)),
        ];
    }
}
