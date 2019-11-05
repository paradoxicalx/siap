<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $guarded = [
         'id', 'api_token', 'last_login', 'email_verified_at', 'remember_token', 'created_at', 'updated_at', 'role',
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = [
         'password', 'remember_token', 'api_token', 'deleted_at', 'email_verified_at'
     ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
     protected $casts = [
         'email_verified_at' => 'datetime',
         'last_login' => 'datetime',
         'created_at' => 'datetime',
         'updated_at' => 'datetime',
         'status'   => 'boolean'
     ];
}
