@extends('layouts.app')

@section('content')

@php
    $optioncount = 1;
    $questiontext = '';
    $salestext = '';
    $optionIcon = '';
@endphp

    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <h2>Create Question</h2>
                {!!Form::open(['method' => 'POST', 'action' => 'QuestionsController@store', 'enctype'=>'multipart/form-data']) !!}
                    @include('questions.form')
                    <div class="form-group mt-4">
                        {!!Form::submit('Save',['class'=> 'btn btn-primary'])!!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection