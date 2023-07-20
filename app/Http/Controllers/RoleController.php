<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role, $permission, $rolePermission;
    public function __construct()
    {
        $this->middleware('auth');
        $this->role = new Role();
        $this->permission = new Permission();
        $this->rolePermission = new RolePermission();
    }

    public function index()
    {
        $roles = $this->role->newQuery()->with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permission->newQuery()->get();
        return view('roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $inputs = $request->all();
        $role = $this->role->newInstance();
        $role->title = $inputs['title'];
        $role->slug = strtolower(str_replace(' ', '_', $inputs['title']));
        $role->save();
        foreach ((!empty($inputs['action_read']) ? $inputs['action_read'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 1;
            $per->save();
        }
        foreach ((!empty($inputs['action_write']) ? $inputs['action_write'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 2;
            $per->save();
        }
        foreach ((!empty($inputs['action_admin']) ? $inputs['action_admin'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 3;
            $per->save();
        }
        return redirect()->to('/users')->with('success', 'Role added successfully');;
    }

    public function edit($id)
    {
        $role = $this->role->newQuery()->find($id);
        if ($role) {
            $permissions = $this->permission->newQuery()->get();
            return view('roles.edit', compact('role', 'permissions'));
        }
        return redirect()->back()->with('error', 'Role not found');
    }

    public function update(Request $request)
    {
        $inputs = $request->all();
        $role = $this->role->newQuery()->find($request->id);
        $role->title = $inputs['title'];
        $role->slug = strtolower(str_replace(' ', '_', $inputs['title']));
        $role->save();
        $this->rolePermission->newQuery()->where('role_id', $inputs['id'])->delete();
        foreach ((!empty($inputs['action_read']) ? $inputs['action_read'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 1;
            $per->save();
        }
        foreach ((!empty($inputs['action_write']) ? $inputs['action_write'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 2;
            $per->save();
        }
        foreach ((!empty($inputs['action_admin']) ? $inputs['action_admin'] : []) as $key => $permission) {
            $per = $this->rolePermission->newInstance();
            $per->role_id = $role->id;
            $per->permission_id = $permission;
            $per->action = 3;
            $per->save();
        }
        return redirect()->to('/users')->with('success', 'Role updated successfully');
    }
}
