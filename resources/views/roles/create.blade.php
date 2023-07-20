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
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" name="title" id="role_name" class="form-control">
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="row">
                            <div class="col">{{ $permission->name }}</div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_read_{{ $permission->id }}">
                                        <input type="checkbox" name="action_read[]" id="permission_read_{{ $permission->id }}" value="{{ $permission->id }}"> Read
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_write_{{ $permission->id }}">
                                        <input type="checkbox" name="action_write[]" id="permission_write_{{ $permission->id }}" value="{{ $permission->id }}"> Write
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="permission_admin_{{ $permission->id }}">
                                        <input type="checkbox" name="action_admin[]" id="permission_admin_{{ $permission->id }}" value="{{ $permission->id }}"> Admin
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
