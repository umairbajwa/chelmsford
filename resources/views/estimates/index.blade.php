@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('inc.internalNav')
        <div class="col">
            <h2>Estimates</h2>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="true">New</a>
                    <a class="nav-item nav-link" id="nav-survey-tab" data-toggle="tab" href="#nav-survey" role="tab" aria-controls="nav-survey" aria-selected="false">Survey Requested</a>
                    <a class="nav-item nav-link" id="nav-followedup-tab" data-toggle="tab" href="#nav-followedup" role="tab" aria-controls="nav-followedup" aria-selected="false">Followed Up</a>
                    <a class="nav-item nav-link" id="nav-won-tab" data-toggle="tab" href="#nav-won" role="tab" aria-controls="nav-won" aria-selected="false">Won</a>
                    <a class="nav-item nav-link" id="nav-lost-tab" data-toggle="tab" href="#nav-lost" role="tab" aria-controls="nav-lost" aria-selected="false">Lost</a>
                </div>
            </nav>
            <div class="tab-content mt-1" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
                    @if(count($estimates0) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-auto">Sr #</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Quoted Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimates0 as $e)
                            <tr>
                                <td>{!!$e->id!!}</td>
                                <td>{!!$e->first.' '.$e->last!!}</td>
                                <td>{!!$e->email!!}</td>
                                <td>{!!$e->phone_number!!}</td>
                                <td>£{!!$e->total_quoted_price!!}</td>
                                <td>
                                    <a class="btn btn-primary float-left ml-1" href="{{url('estimate/output/admin/' . $e->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No Estimates Found</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-survey" role="tabpanel" aria-labelledby="nav-survey-tab">
                    @if(count($estimates1) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-auto">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Quoted Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimates1 as $e)
                            <tr>
                                <td>{!!$e->id!!}</td>
                                <td>{!!$e->first.' '.$e->last!!}</td>
                                <td>{!!$e->email!!}</td>
                                <td>{!!$e->phone_number!!}</td>
                                <td>£{!!$e->total_quoted_price!!}</td>
                                <td>
                                    <a class="btn btn-primary float-left ml-1" href="{{url('estimate/output/admin/' . $e->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No Estimates Found</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-followedup" role="tabpanel" aria-labelledby="nav-followedup-tab">
                    @if(count($estimates2) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-auto">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Quoted Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimates2 as $e)
                            <tr>
                                <td>{!!$e->id!!}</td>
                                <td>{!!$e->first.' '.$e->last!!}</td>
                                <td>{!!$e->email!!}</td>
                                <td>{!!$e->phone_number!!}</td>
                                <td>£{!!$e->total_quoted_price!!}</td>
                                <td>
                                    <a class="btn btn-primary float-left ml-1" href="{{url('estimate/output/admin/' . $e->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No Estimates Found</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-won" role="tabpanel" aria-labelledby="nav-won-tab">
                    @if(count($estimates3) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-auto">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Quoted Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimates3 as $e)
                            <tr>
                                <td>{!!$e->id!!}</td>
                                <td>{!!$e->first.' '.$e->last!!}</td>
                                <td>{!!$e->email!!}</td>
                                <td>{!!$e->phone_number!!}</td>
                                <td>£{!!$e->total_quoted_price!!}</td>
                                <td>
                                    <a class="btn btn-primary float-left ml-1" href="{{url('estimate/output/admin/' . $e->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No Estimates Found</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-lost" role="tabpanel" aria-labelledby="nav-lost-tab">
                    @if(count($estimates4) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-auto">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Quoted Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estimates4 as $e)
                            <tr>
                                <td>{!!$e->id!!}</td>
                                <td>{!!$e->first.' '.$e->last!!}</td>
                                <td>{!!$e->email!!}</td>
                                <td>{!!$e->phone_number!!}</td>
                                <td>£{!!$e->total_quoted_price!!}</td>
                                <td>
                                    <a class="btn btn-primary float-left ml-1" href="{{url('estimate/output/admin/' . $e->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No Estimates Found</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
