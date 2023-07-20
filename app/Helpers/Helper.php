<?php

use App\Role;
use Illuminate\Support\Facades\Auth;

function checkPermissions($module, $permission)
{
    return Role::where('id', auth()->user()->role_id)->whereHas('permissions', function ($q) use ($module, $permission) {
        $q->where('module', $module)->where('action', $permission);
    })->exists();
}
