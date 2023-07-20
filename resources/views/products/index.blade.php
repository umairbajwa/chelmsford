@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Products</h2>
                    </div>
                    @if (checkPermissions('products', 2))
                        <div class="col-auto">
                            <a href="{{ url('products/create') }}" class="btn btn-primary">Create</a>
                        </div>
                    @endif
                </div>
                @if (checkPermissions('products', 2))
                    {!! Form::open(['method' => 'POST', 'action' => 'ProductsController@globalPrice']) !!}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h5>Price Percentage</h5>
                                {!! Form::text('global_value_percentage', $globalPriceValue, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <h5>Percentage Type</h5>
                                {!! Form::select('global_value_type', ['Increase' => 'Increase', 'Decrease' => 'Decrease'], $globalValueType, ['class' => 'form-control', 'id' => 'global_value_type']) !!}
                            </div>
                        </div>
                        <div class="col global-value-expiry @if ($globalValueType && $globalValueType == 'Increase') d-none @endif">
                            <div class="form-group">
                                <h5>Expiry</h5>
                                {!! Form::date('global_value_expiry', $globalValueExpiry, ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <h5></h5>
                                {!! Form::submit('Save', ['class' => 'btn btn-primary mt-4']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
                {!! Form::open(['method' => 'POST', 'action' => 'ProductsController@globalPDF', 'enctype' => 'multipart/form-data']) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h5>Generic PDF</h5>
                            <input type="file" name="global_pdf" class="pdf-input" style="display:none;" accept="application/pdf">
                            <button style="display: none" id="formSubmit"></button>

                            @if ($globalPDF)
                                <a href="{{ url('storage/products/' . $globalPDF) }}" class="btn btn-primary" target="_blank">View</a>

                                @if (checkPermissions('products', 2))
                                    <button class="btn btn-primary upload-button"> Change</button>
                                    <a href="{{ url('/product/global/pdf/delete') }}" class="btn btn-danger"> Remove</a>
                                @endif
                            @else
                                @if (checkPermissions('products', 2))
                                    <button class="btn btn-primary upload-button"> Upload </button>
                                @endif
                            @endif


                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                @if (checkPermissions('products', 2))
                    {!! Form::open(['method' => 'POST', 'action' => 'ProductsController@wkUpdate']) !!}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <h5>KW displayed</h5>
                                <select name="kw" id="" class="form-control">
                                    <option value="1" @if ($setting->kw) selected @endif>On</option>
                                    <option value="0" @if (!$setting->kw) selected @endif>Off</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <h5></h5>
                                {!! Form::submit('Update', ['class' => 'btn btn-primary mt-4']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
                @if (count($products) > 0)
                    <table class="table">
                        <thead>
                            <th scope="col">Sr #</th>
                            <th scope="col">Product</th>
                            <th scope="col">Type</th>
                            <th scope="col">Range</th>
                            <th scope="col">Original Price</th>
                            <th scope="col">Updated Price</th>

                            @if (checkPermissions('products', 2))
                                <th scope="col">Actions</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $p)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>{!! $p->product_name !!}</td>
                                    <td>{!! $p->product_type !!}</td>
                                    <td>{!! $p->range == 1 ? 100 : ($p->range == 2 ? 200 : '') !!}</td>
                                    <td>£{!! number_format($p->price) !!}</td>
                                    <td>£{!! number_format($p->updated_price) !!}</td>
                                    @if (checkPermissions('products', 2))
                                        <td>
                                            <a class="btn btn-primary float-left ml-1" href="{{ url('products/' . $p->id) }}/edit">Edit</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">No Products Found</p>
                @endif

            </div>
        </div>
    </div>
@endsection
@section('foot')
    @parent
    <script>
        $(document).on('change', '#global_value_type', function() {
            if ($(this).val() == 'Decrease') {
                $('.global-value-expiry').removeClass('d-none');
            } else {
                $('.global-value-expiry').addClass('d-none');;
            }
        })
    </script>
@endsection
