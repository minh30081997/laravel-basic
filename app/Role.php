<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function user()
    {
        return $this->belongsToMany('App\User', 'roles_users', 'role_id', 'user_id');
    }

    public function hasAccess(array $permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            } 
        }
        
        return false;
    }

    public function hasPermission(string $permission)
    {
        return $this->permissions[$permission] ? true : false;
    }


}
