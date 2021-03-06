<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

    public function blogs(){
        return $this->hasMany('App\Blog');
    }

    public function isRole(){
        return $this->role;
    }
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    public function hasRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }
}
