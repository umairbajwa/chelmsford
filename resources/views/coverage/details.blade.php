@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                @if (checkPermissions('coverages', 2))
                    <form action="{{ route('coverageUpdate') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <h2>Coverages</h2>
                            </div>
                            <div class="col-4">
                                <input type="hidden" name="id" value="{{ $coverage->id }}">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" {{ $coverage->archive ? '' : 'selected' }}>Active</option>
                                        <option value="archive" {{ $coverage->archive ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <input type="submit" value="Update" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </form>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <h5>Name</h5>
                        <p>{{ $coverage->name }} {{ $coverage->surname }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Email</h5>
                        <p>{{ $coverage->email }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Phone Number</h5>
                        <p>{{ $coverage->phone_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Referred By</h5>
                        <p>{{ $coverage->referred_by }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Plan</h5>
                        @if ($coverage->plan == 99)
                            <p>1 Boiler upto 20 Radiators (£24)</p>
                        @else
                            <p>2 Boilers upto 30 Radiators (£43)</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h5>Address</h5>
                        <p>{{ $coverage->address_1 }} {{ $coverage->address_2 }}, {{ $coverage->town }}, {{ $coverage->county }}, {{ $coverage->post_code }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Upfront Payment</h5>
                        <p>{{ date('d M, Y', strtotime($coverage->created_at)) }} (£{{ $coverage->plan }})</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Mailchimp Status</h5>
                        <p>{{ $coverage->marketing ? 'Subscribe' : 'Unsubscribed' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Mailchimp Contact Id</h5>
                        <p>{{ $coverage->mailchimp_contact_id }}</p>
                    </div>
                </div>
                <h2>Subscription Details</h2>
                @if ($subscription)
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Status</h5>
                            <p>{{ $subscription->status }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Starting Date</h5>
                            <p>{{ $subscription->start_date }}</p>
                        </div>
                        <div class="col-md-12">
                            <h5>Upcoming Payments</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col-auto">Sr #</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscription->upcoming_payments as $key => $e)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('d M, Y', strtotime($e->charge_date)) }}</td>
                                            <td>£{{ $e->amount / 100 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <h5>No active subscription</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
