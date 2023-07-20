@extends('layouts.app')

@section('content')

@php
    $productname = '';
    $productshortdescription = '';
    $productdescription = '';
    $hometype = [
        'semi' => 0,
        'detached' => 0,
        'terraced' => 0,
        'bungalow' => 0,
        'apartment' => 0
    ];
    $bedrooms = [
        'one' => 0,
        'two' => 0,
        'three' => 0,
        'four' => 0,
        'five' => 0
    ];
    $bathrooms = [
        'one' => 0,
        'two' => 0,
        'three' => 0,
        'four' => 0
    ];
    $radiators = [
        'zerotoeight' => 0,
        'eighttofifteen' => 0,
        'fifteenplus' => 0,
    ];
    $towel = [
        'none' => 0,
        'one' => 0,
        'two' => 0,
        'three' => 0,
        'four' => 0
    ];
    $underfloor = [
        'none' => 0,
        'ground' => 0,
        'first' => 0,
        'everywhere' => 0
    ];
    $price = '';
    $lower = 0;
    $upper = 0;
    $iscombi = 0;
    $isrange = 0;
    $valuepercentage = 0;
    $valuetype = 'Increase';
    $liter = '125';
    $materials = 0;
    $labour = 0;
@endphp

    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <h2>Create Products </h2>
                {!!Form::open(['method' => 'POST', 'action' => 'ProductsController@store', 'enctype'=>'multipart/form-data']) !!}
                    @include('products.form')
                    <div class="form-group">
                        {!!Form::submit('Save',['class'=> 'btn btn-primary'])!!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('foot')
@parent
<script>

    $(document).on('input', 'input[name=materials],input[name=labour]', function () {
        let materials = parseInt($('input[name=materials]').val()) ? parseInt($('input[name=materials]').val()) : 0;
        let labour = parseInt($('input[name=labour]').val()) ? parseInt($('input[name=labour]').val()) : 0;

        $('#total-price').val(materials + labour);
    });
</script>
@endsection
