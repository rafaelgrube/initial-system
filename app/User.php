<?php

namespace App;

use App\Company;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'password', 'username'
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

    /**
     * Only accept a valid password and 
     * hash a password before saving
     */
    public function setPasswordAttribute($password)
    {
        if ($password !== null & $password !== "") {
            if (Hash::needsRehash($password)) {
                $this->attributes['password'] = Hash::make($password);
            }
        }
    }

    /**
     * Relationships
     */

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
