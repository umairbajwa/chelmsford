@extends('layouts.coverage')

@section('content')
    <div class="container" style="max-width: 1200px">
        <div class="mt-5">
            <div class="text-center">
                <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />
            </div>
            <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                <h1 class="fw-bold">Thank You</h1>
                <p>Your payment has been processed. You will receive an email with the details. </p>
                <p>Your direct debit of {{ session()->get('coverage')->plan == 99 ? '£24' : '£34' }} will start from {{ \Carbon\Carbon::now()->addMonth()->format('05-m-Y') }}</p>
                <p>If you have any questions please contact us at <a href="mailto:support@chelmsfordgas.co.uk">support@chelmsfordgas.co.uk</a></p>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <div class="thank-you-div-class">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="material-icons" style="font-size: 60px">check</i>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
