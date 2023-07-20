@extends('layouts.app',['nobar' => 1])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="logo"><img src="{{url('/')}}/storage/logo/{!!$account->logo!!}"/><a href="{{url('/')}}" class="link-overlay"></a></div>
            </div>
            <a href="{{url('/')}}" class="btn btn-primary start-over">Start Over</a>
            <div class="w-100"></div>
            <div class="col mt-3">
                <div class="quote-wrap p-3">
                    <h2 class="text-center">Your Estimate</h2>
                    <div class="row m-0 quote-body">
                        {!!$output!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



