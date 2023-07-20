@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <h2>Create User</h2>
                {!! Form::open(['method' => 'POST', 'action' => 'UserController@update', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="col">
                        <div class="form-group">
                            <h5>Name</h5>
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Full Name']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Email</h5>
                            {!! Form::email('email', $user->email, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Email Address', 'disabled' => true]) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Password</h5>
                            {!! Form::password('password', ['class' => 'form-control', 'required' => false, 'placeholder' => 'Leave Empty if same']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Role</h5>
                            {!! Form::select('role_id', $roles, $user->role_id, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <h5>Status</h5>
                            <label for="active">
                                {!! Form::checkbox('active', 'yes', $user->active == 1, ['id' => 'active']) !!} Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
