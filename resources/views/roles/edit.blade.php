@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Create Role</h2>
                    </div>
                </div>
                <form action="{{ route('roles.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" name="title" id="role_name" class="form-control" value="{{ $role->title }}">
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="row">
                            <div class="col">{{ $permission->name }}</div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_read_{{ $permission->id }}">
                                        <input type="checkbox" name="action_read[]" id="permission_read_{{ $permission->id }}" value="{{ $permission->id }}" @if ($role->permissions()->where('action', 1)->where('permission_id', $permission->id)->exists()) checked @endif> Read
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_write_{{ $permission->id }}">
                                        <input type="checkbox" name="action_write[]" id="permission_write_{{ $permission->id }}" value="{{ $permission->id }}" @if ($role->permissions()->where('action', 2)->where('permission_id', $permission->id)->exists()) checked @endif> Write
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_admin_{{ $permission->id }}">
                                        <input type="checkbox" name="action_admin[]" id="permission_admin_{{ $permission->id }}" value="{{ $permission->id }}" @if ($role->permissions()->where('action', 3)->where('permission_id', $permission->id)->exists()) checked @endif> Admin
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
