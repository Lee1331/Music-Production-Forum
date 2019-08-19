<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //allows for notifications
    use Notifiable;

    //prevent remember me option for admins - added security
    protected $rememberTokenName = false;

    /**
     * Set the guard type - app/config/auth.php
     *
     * @var array
     */
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName(){
        return 'name';
    }

    //Relationships
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
