<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,
        SoftDeletes,
        HasApiTokens,
        HasFactory,
        Notifiable;
    /*
    * Permissions
    */

    const USER_ACCESS = 'user_access';
    const USER_CREATE = 'user_create';
    const USER_EDIT = 'user_edit';
    const USER_DELETE = 'user_delete';
    const USER_VIEW = 'user_view';

    const ROLE_ACCESS = 'role_access';
    const ROLE_CREATE = 'role_create';
    const ROLE_EDIT = 'role_edit';
    const ROLE_DELETE = 'role_delete';
    const ROLE_VIEW = 'role_view';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
