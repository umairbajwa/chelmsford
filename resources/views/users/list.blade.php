@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab" aria-controls="nav-new" aria-selected="true">Users</a>

                        @if (checkPermissions('permissions', 1))
                            <a class="nav-item nav-link" id="nav-roles-tab" data-toggle="tab" href="#nav-roles" role="tab" aria-controls="nav-roles" aria-selected="false">Roles & Permissions</a>
                        @endif
                    </div>
                </nav>
                <div class="tab-content mt-1" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
                        <div class="row my-2">
                            <div class="col">
                                <h2>Users</h2>
                            </div>

                            @if (checkPermissions('users', 2))
                                <div class="col-auto">
                                    <a href="{{ url('users/create') }}" class="btn btn-primary">Create</a>
                                </div>
                            @endif
                        </div>
                        @if (count($users) > 0)
                            <table class="table">
                                <thead>
                                    <th scope="col">Sr #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Status</th>
                                    @if (checkPermissions('users', 2))
                                        <th scope="col">Actions</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{!! $key + 1 !!}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->title }}</td>
                                            <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                                            <td>
                                                @if ($user->active)
                                                    <p class="label label-success">Active</p>
                                                @else
                                                    <p class="label label-danger">Deactive</p>
                                                @endif
                                            </td>
                                            @if (checkPermissions('users', 2))
                                                <td>
                                                    <a href="{{ url('users/' . $user->id) }}" class="btn btn-primary">Edit</a>
                                                    @if ($user->active)
                                                        <a href="{{ url('users/change-status/' . $user->id) }}" class="btn btn-danger">Deactivate</a>
                                                    @else
                                                        <a href="{{ url('users/change-status/' . $user->id) }}" class="btn btn-success">Activate</a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="alert alert-danger">No Users Found</p>
                        @endif
                    </div>

                    @if (checkPermissions('permissions', 1))
                        <div class="tab-pane fade " id="nav-roles" role="tabpanel" aria-labelledby="nav-roles">
                            <div class="row my-2">
                                <div class="col">
                                    <h2>Roles & Permissions</h2>
                                </div>
                                @if (checkPermissions('permissions', 2))
                                    <div class="col-auto">
                                        <a href="{{ url('roles/create') }}" class="btn btn-primary">Create</a>
                                    </div>
                                @endif
                            </div>
                            @if (count($roles) > 0)
                                <table class="table">
                                    <thead>
                                        <th>Sr #</th>
                                        <th>Title</th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Admin</th>

                                        @if (checkPermissions('permissions', 2))
                                            <th>Actions</th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{!! $key + 1 !!}</td>
                                                <td>{{ $role->title }}</td>
                                                <td>
                                                    @if ($role->permissions()->where('action', 1)->exists())
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-times text-danger"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($role->permissions()->where('action', 2)->exists())
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-times text-danger"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($role->permissions()->where('action', 3)->exists())
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-times text-danger"></i>
                                                    @endif
                                                </td>

                                                @if (checkPermissions('permissions', 2))
                                                    <td>
                                                        <a href="{{ url('roles/edit/' . $role->id) }}" class="btn btn-primary">Edit</a>
                                                        <a href="{{ url('roles/delete/' . $role->id) }}" class="btn btn-primary">Delete</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="alert alert-danger">No Roles Found</p>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endsection
