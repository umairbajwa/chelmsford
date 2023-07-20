@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Coverages</h2>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary float-right" href="{{ route('coverages.new') }}">Create</a>
                    </div>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-active-tab" data-toggle="tab" href="#nav-active" role="tab" aria-controls="nav-new" aria-selected="true">Active</a>
                        <a class="nav-item nav-link" id="nav-archive-tab" data-toggle="tab" href="#nav-archive" role="tab" aria-controls="nav-archive" aria-selected="false">Archives</a>
                    </div>
                </nav>
                <div class="tab-content mt-1" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-new-tab">
                        @if (count($coverages) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-auto">Sr #</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coverages as $e)
                                        <tr>
                                            <td>{{ $e->id }}</td>
                                            <td>{{ $e->name }} {{ $e->surname }}</td>
                                            <td>{{ $e->email }}</td>
                                            <td>{{ $e->phone_number }}</td>
                                            <td>£{{ $e->plan }}</td>
                                            <td>{{ $e->status }}</td>
                                            <td>
                                                <a class="btn btn-primary float-left ml-1" href="{{ url('coverages/' . $e->id) }}">View</a>
                                                @if (checkPermissions('coverages', 2))
                                                    <a class="btn btn-danger float-left ml-1" href="{{ url('coverages/archive/' . $e->id) }}">Archive</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="alert alert-danger">No Coverages Found</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-archive" role="tabpanel" aria-labelledby="nav-archive-tab">
                        @if (count($coverageArchives) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-auto">Sr #</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coverageArchives as $e)
                                        <tr>
                                            <td>{{ $e->id }}</td>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->email }}</td>
                                            <td>{{ $e->phone_number }}</td>
                                            <td>£{{ $e->plan }}</td>
                                            <td>{{ $e->status }}</td>
                                            <td>
                                                <a class="btn btn-primary float-left ml-1" href="{{ url('coverages/' . $e->id) }}">View</a>
                                                @if (checkPermissions('coverages', 2))
                                                    <a class="btn btn-secondary float-left ml-1" href="{{ url('coverages/archive/' . $e->id) }}">Restore</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="alert alert-danger">No Coverages Found</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
