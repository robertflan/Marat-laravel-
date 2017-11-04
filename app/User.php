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
        'name', 'email', 'password', 'gender', 'last_name', 'activation_code', 'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }


    // get users by roles
    public function scopeHasRoles($query, array $roles = [])
    {
        return $query->whereHas('roles', function($query) use ($roles){
            $query->whereIn('slug', $roles);
        });
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'manager_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['gender'] . ' ' . $this->attributes['name'] . ' ' . $this->attributes['last_name'];
    }
}
