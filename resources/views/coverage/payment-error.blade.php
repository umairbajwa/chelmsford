@extends('layouts.coverage')

@section('content')
    <div class="container" style="max-width: 1200px">
        <div class="mt-5">
            <div class="text-center">
                <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />
            </div>
            <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                <h1 class="fw-bold">Thank You</h1>
                <p>There was an error while processing you payment.</p>
                <p>Please get in touch with the following details at <a href="mailto:support@chlemsfordgas.co.uk">support@chlemsfordgas.co.uk</a></p>
            </div>
        </div>
    </div>
@endsection
