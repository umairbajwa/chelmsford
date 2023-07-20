<?php

namespace App\Http\Controllers;

use App\Mail\NewAdminAdd;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $user, $role;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
        $this->role = new Role();
    }

    public function index()
    {
        $users = $this->user->newQuery()->where('is_admin', false)->where('id', '!=', Auth::id())->get();
        $roles = $this->role->newQuery()->get();
        return view('users.list', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::pluck('title', 'id');
        return view('users.new', compact('roles'));
    }

    public function edit($id)
    {
        if (!$user = $this->user->newQuery()->where('id', $id)->first()) {
            return redirect('users')->with('error', 'Invalid user selected');
        }
        $roles = Role::pluck('title', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|min:6'
        ]);
        $user = $this->user->newInstance();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->account_id = 1;
        $user->role_id = $request->role_id;
        $user->active = !empty($request->active) ? 1 : 0;
        $user->password = Hash::make($request->password);
        $user->save();
        Mail::to($request->email)->send(
            new NewAdminAdd($user, 'save')
        );
        return redirect('users')->with('success', 'User added successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required'
        ]);
        $user = $this->user->newQuery()->where('id', $request->id)->first();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->active = !empty($request->active) ? 1 : 0;
        if ($request->password) {
            if (strlen($request->password) < 6) {
                return redirect()->back()->with('error', 'The password must be at least 6 characters.');
            }
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->password) {
            Mail::to($user->email)->send(
                new NewAdminAdd($user, 'update')
            );
        }
        return redirect('users')->with('success', 'User updated successfully');
    }

    public function changeStatus($id)
    {
        $user = $this->user->newQuery()->where('id', $id)->first();
        if ($user->active) {
            $user->active = false;
            $status = 'Deactivated';
        } else {
            $user->active = true;
            $status = 'Activated';
        }
        $user->save();
        return redirect()->back()->with('success', 'User ' . $status . ' successfully');
    }
}
