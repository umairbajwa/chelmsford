@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="w-100"></div>
            <div class="col mt-3">
                <div class="quote-wrap p-3">
                    <div class="row m-0 quote-body mt-2 py-4">
                        <div class="col pl-0">
                            <h2 class="text-left">Viewing Estimate - {!! $quote->id !!}</h2>
                        </div>

                        @if (checkPermissions('estimates', 2))
                            <div class="col pr-0">
                                {!! Form::open(['method' => 'POST', 'action' => 'QuotesController@UpdateStatus', 'enctype' => 'multipart/form-data']) !!}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Status</span>
                                    </div>
                                    {!! Form::hidden('quoteid', $quote->id) !!}
                                    {!! Form::select('updateStatus', [0 => 'New!', 1 => 'Survey Requested', 2 => 'Followed Up', 3 => 'Won', 4 => 'Lost'], $quote->followed_up, ['class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        @endif
                        <div class="w-100"></div>
                        <div class="col pl-0">
                            <strong>Name: </strong>{!! $quote->first . ' ' . $quote->last !!}<br>
                            <strong>Email: </strong>{!! $quote->email !!}<br>
                            <strong>Contact Number: </strong>{!! $quote->phone_number !!}<br>
                            <strong>Address: </strong><br>{!! $quote->address_line_1 !!}<br>{!! $quote->address_line_2 !!} {!! $quote->address_line_3 !!}<br>{!! $quote->town !!}<br>{!! $quote->postcode !!}
                        </div>
                        <div class="col pr-0">
                            <div class="row">
                                {!! $qRows !!}
                            </div>
                        </div>
                        <div class="w-100 my-2"></div>
                        {!! $output !!}
                        <div class="w-100 my-2"></div>
                        <div class="col">
                            <h3>Total Quoted Price</h3>
                        </div>
                        <div class="col text-right">
                            <h3><b>£{{ unserialize($quote->final_details) ? unserialize($quote->final_details)['totalvalue'] : $quote->total_quoted_price }}</b></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
