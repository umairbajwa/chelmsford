@extends('layouts.app')

@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            @if (checkPermissions('estimates', 1))
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Estimates</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="{{ url('estimates') }}" class="card-link">View All</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="w-100 my-3"></div>
            @include('inc.internalNav')

        </div>
    </div>
@endsection
