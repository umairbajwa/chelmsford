@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <h2>Update Postcode</h2>
                {!! Form::open(['method' => 'PUT', 'action' => ['PostCodesController@update', $postCode->id], 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <h5>Postcode</h5>
                            {!! Form::text('name', $postCode->name, ['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <h5>Quotes</h5>
                            {!! Form::checkbox('quotes', '1', $postCode->quotes, ['id' => 'quotes']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <h5>Boiler</h5>
                            {!! Form::checkbox('boiler', '1', $postCode->boiler, ['id' => 'quotes']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
