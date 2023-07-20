@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Settings</h2>

                <hr>
                {!!Form::open(['method' => 'POST', 'action' => 'SettingsController@update', 'enctype'=>'multipart/form-data']) !!}
                    <h3>Your Details</h3>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!!Form::label('name', 'Name')!!}
                                {!!Form::text('name',auth::user()->name,['class' => 'form-control'])!!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!!Form::label('email', 'E-Mail Address')!!}
                                {!!Form::text('email',auth::user()->email,['class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::submit('Save',['class'=> 'btn btn-primary'])!!}
                    </div>
                {!! Form::close() !!}
                
                <hr>
                <h3>Update your Password</h3>
                <form class="form-horizontal" method="POST" action="/settings/changepassword">
                    {{ csrf_field() }}
                    

                    <div class="row form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">

                        <div class="col">
                            <input id="current-password" type="password" class="form-control" name="current-password" required placeholder="Current Password">

                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">

                        <div class="col">
                            <input id="new-password" type="password" class="form-control" name="new-password" required  placeholder="New Password">

                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required  placeholder="Confirm New Password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection