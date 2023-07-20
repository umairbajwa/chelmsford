@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <h2>Create User</h2>
                {!! Form::open(['method' => 'POST', 'action' => 'UserController@store', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h5>Name</h5>
                            {!! Form::text('name', '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Full Name']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Email</h5>
                            {!! Form::email('email', '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Email Address']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Password</h5>
                            {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Password']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <h5>Status</h5>
                            {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <h5>Status</h5>
                            <label for="active">
                                {!! Form::checkbox('active', 'yes', true, ['id' => 'active']) !!} Active
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
