<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * Get all of the comments for the Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getActions($id): HasMany
    {
        return $this->hasMany(RolePermission::class, 'permission_id')->where('role_id', $id)->pluck('action')->toArray();
    }
}
