@extends('layouts.app')

@section('content')

@php
$criteria = unserialize($product->criteria);
$productname = $product->product_name;
$productshortdescription = $product->shortdescription;
$productdescription = $product->product_description;
$price = $product->materials + $product->labour;
$lower = $product->lower_bracket;
$upper = $product->upper_bracket;
$iscombi = $product->iscombi;
$isrange = $product->range;
$valuepercentage = $product->value_percentage;
$valuetype = $product->value_type;
$liter = $product->liter;
$materials = $product->materials;
$labour = $product->labour;
@endphp

<div class="container">
    <div class="row justify-content-center">
        @include('inc.internalNav')
        <div class="col">
            <h2>Edit Product </h2>
            {!!Form::open(['method' => 'PUT', 'action' => ['ProductsController@update',$product->id], 'enctype'=>'multipart/form-data', 'id' => 'ProductForm']) !!}
            @include('products.form')
            <input type="hidden" name="next" value="0">
            <div class="form-group">
                {!!Form::submit('Update',['class'=> 'btn btn-primary'])!!}
                {!!Form::submit('Update & Next',['class'=> 'btn btn-primary', 'id' => 'saveNextProduct'])!!}
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
