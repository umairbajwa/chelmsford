@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Roles</h2>
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
        </div>
    </div>
@endsection
