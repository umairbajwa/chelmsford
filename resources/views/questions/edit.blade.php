@extends('layouts.app')

@section('content')

@php
    $option = unserialize($question->options);
    $optioncount = count($option);

    $questiontext = $question->question;
    $salestext = $question->selling_point;
@endphp

    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                {!!Form::open(['method' => 'PUT', 'action' => ['QuestionsController@update', $question->id], 'enctype'=>'multipart/form-data', 'id' => 'QuestionForm']) !!}
                    <h2>Edit Question</h2>
                    @include('questions.form')
                    <input type="hidden" name="next" value="0">
                    <div class="form-group mt-4">
                        {!!Form::submit('Save',['class'=> 'btn btn-primary'])!!}
                        {!!Form::submit('Save & Next',['class'=> 'btn btn-primary', 'id' => 'saveNext'])!!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
