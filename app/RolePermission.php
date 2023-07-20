<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    /**
     * Get the permission that owns the RolePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissions(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
