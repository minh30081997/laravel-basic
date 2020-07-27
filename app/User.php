<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';

    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsToMany('App\Role', 'roles_users', 'user_id', 'role_id');
    }


    // Check if user has access to $permissions
    public function hasAccess(array $permissions) 
    {
        foreach ($this->role as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            } 
        }
        return false;
    }

    public function inRole(string $roleSlug) 
    {
        return $this->role()->where('slug', $roleSlug)->count() == 1;
    }



    // Accessor
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    // Mutator 
    // public function setPasswordAttribute($value) 
    // {
    //     $this-> attributes['password'] = bcrypt($value);
    // }
}
