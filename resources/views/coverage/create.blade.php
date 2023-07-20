@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <form action="{{ route('coverages.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Dr.">Dr.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" name="surname" id="surname" value="{{ old('surname') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="referred_by">Referred By</label>
                                <input type="text" class="form-control" name="referred_by" id="referred_by" value="{{ old('referred_by') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="plan">Plan</label>
                                <select name="plan" id="plan" class="form-control">
                                    <option value="99">1 Boiler upto 20 Radiators (£24)</option>
                                    <option value="174">2 Boilers upto 30 Radiators (£43)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InformationAddress1">Address 1</label>
                                        <input type="text" class="form-control" name="address_1" id="InformationAddress1" value="{{ old('address_1') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="InformationAddress2">Address 2</label>
                                        <input type="text" class="form-control" name="address_2" id="InformationAddress2" value="{{ old('address_2') }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="InformationAddress3">Town</label>
                                        <input type="text" class="form-control" name="town" id="InformationAddress3" value="{{ old('town') }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="AddressTown">Country</label>
                                        <input type="text" class="form-control" name="country" id="AddressTown" value="{{ old('country') }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="InformationPostcode">Post Code</label>
                                        <input type="text" class="form-control" name="post_code" id="InformationPostcode" value="{{ old('post_code') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="Create" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    @parent
    <script>
        $(function() {
            $("#phone_number").inputmask({
                "mask": "99999 999999"
            });
        });
    </script>
@endsection
