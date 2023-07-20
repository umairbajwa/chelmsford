@extends('layouts.coverage')
@section('head')
    @parent

    <link href="{{ asset('coverage/css/ideal-postcodes-autocomplete.css') }}" rel="stylesheet">

    <style>
        .boiler-image {
            height: 54px;
            width: 54px;
            border: 1px solid #8e7017;
            border-radius: 10px;
            background: white;
        }

        .boiler-image>img {
            height: 40px;
            width: 40px;
        }

        .modal-border {
            border: 1px solid transparent;
            border-radius: 20px;
            background: #151c3e;
            color: white;
        }

        .cover-plan-modal {
            border-radius: 20px !important;
            background: #8e7017;
        }

        .form-floating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem .75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out;
        }

        .floating-label {
            opacity: .65;
            transform: scale(.85) translateY(-.5rem) translateX(.15rem);
        }

        .form-floating .form-control,
        .form-floating .form-control-plaintext {
            padding: 1rem .75rem;
        }

        .form-floating .form-control-plaintext:focus,
        .form-floating .form-control-plaintext:not(:placeholder-shown),
        .form-floating .form-control:focus,
        .form-floating .form-control:not(:placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: .625rem;
        }

        .form-floating .form-control,
        .form-floating .form-control-plaintext,
        .form-floating .form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .modal .custom-list-image>li:nth-child(1n+5) {
            display: none;
        }

        .modal .custom-list-image.show-all>li:nth-child(1n+5) {
            display: block;
        }

        .modal .custom-list-image.show-all+.read-more-btn {
            display: none;
        }
    </style>
    {!! RecaptchaV3::initJs() !!}
@endsection
@section('content')
    {{-- Step 1 => Coverage Area Check --}}
    <div class="container step" id="step-1" style="max-width: 500px">
        <div class="mt-5" id="steps-1">
            <div class="text-center">
                <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />

                <ul id="progressbar">
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="container" id="post-code-container" style="max-width: 430px">

            <div class="text-center">
                <h1 class="heading-text mt-3">Please enter your postcode</h1>
                <p class="text-center pointer-none">
                    Enter your postcode to check if we cover your area
                </p>
            </div>
            <form id="check-coverage-area-form" method="POST">
                <div class="form-floating">
                    <input type="code" class="form-control" name="post_code" id="floatingInput1" placeholder="Enter Code" required>
                    <label for="floatingInput1">Post Code</label>
                </div>
                <input type="text" class="form-control d-none" name="address" placeholder="Enter Address" />
                <span class="text text-danger post-code-check-error-invalid small d-none">Please enter a valid post code address</span>
                <span class="text text-danger post-code-check-error small d-none">We’re sorry, it seems we don’t cover your area</span>
                <div class="col-md-6">
                    {!! RecaptchaV3::field('register') !!}
                </div>
                <button class="generic-submit-btn w-100 mt-3" type="submit">
                    Find Address to Get Started
                </button>
            </form>
        </div>
        <div class="container d-none mt-5" id="email-container" style="max-width: 430px">

            <div class="text-center">
                <h1 class="heading-text mt-3">Please enter your postcode and email</h1>
                <p class="text-center pointer-none">
                    We’re sorry, it seems we don’t cover your area. Please send us your email because we might still be able to help.
                </p>
            </div>
            <form id="email-postcode-form" method="POST">
                <div class="form-floating">
                    <input type="code" class="form-control" name="post_code" id="floatingInput2" placeholder="Enter Code" required />
                    <label for="floatingInput2">Post Code</label>
                </div>
                <span class="text text-danger post-code-check-error-invalid small d-none">Please enter a valid post code address</span>
                <div class="form-floating mt-3">
                    <input type="email" class="form-control" name="email" id="floatingInput3" placeholder="Email Address" required />
                    <label for="floatingInput3">Email Address</label>
                </div>
                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        {!! RecaptchaV3::field('register') !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="generic-submit-btn" type="button" style="width: 45%">
                        Start Over
                    </button>
                    <button class="generic-submit-btn" type="submit" style="width: 45%">
                        Submit
                    </button>
                </div>
                <span class="text text-success d-none">Thank you for submitting. Someone will get back to you shortly.</span>
            </form>
        </div>
    </div>

    {{-- Step 2 => Coverage Plan --}}
    <div class="step mb-5 d-none" id="step-2">

    </div>

    {{-- Step 3 => Your Information --}}
    <div class="container step d-none" style="max-width: 500px" id="step-3">

    </div>

    {{-- Step 4 => Payment --}}
    <div class="container step d-none" style="max-width: 500px" id="step-4">

    </div>

    {{-- Step 4 => Thank You --}}
    <div class="container step d-none" style="max-width: 500px" id="step-5">

    </div>
@endsection

@section('foot')
    @parent
    <script>
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        $(document).on('focus', '#InformationAddress1', function() {
            $(this).closest('.form-floating').find('label').addClass('floating-label');
        });
        $(document).on('input', '#InformationAddress1', function() {
            if (!$(this).val().length) {
                $(this).closest('.form-floating').find('label').removeClass('floating-label');
            } else {
                $(document).find("input.d-none.info-field-2").removeClass('d-none');
            }
        });
        // Step 1 => Postal Code Check
        $(document).on('submit', '#check-coverage-area-form', function(e) {
            e.preventDefault();
            if (/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})$/.test($('#floatingInput1').val()) == false) {
                $(this).find('.post-code-check-error-invalid').removeClass('d-none');
                return false;
            } else $(this).find('.post-code-check-error-invalid').addClass('d-none')
            $.ajax({
                url: "{{ route('postCodeCheck') }}",
                method: "POST",
                data: $('#check-coverage-area-form').serialize(),
                headers: headers,
                success: function(res) {
                    if (res.message) {
                        $('.post-code-check-error-invalid').removeClass('d-none');
                        location.reload();
                    }
                    if (res.success) {
                        hideShowStep(2, res.html);
                        $('.post-code-check-error').addClass('d-none');
                    } else {
                        $('#email-postcode-form').find('input[name="post_code"]').val($('#check-coverage-area-form').find('input[name="post_code"]').val())
                        $('#post-code-container').addClass('d-none');
                        $('#steps-1').addClass('d-none');
                        $('#email-container').removeClass('d-none');
                    }
                }
            })
        });

        $(document).on('submit', '#email-postcode-form', function(e) {
            e.preventDefault();
            if (/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})$/.test($('#floatingInput2').val()) == false) {
                $(this).find('.post-code-check-error-invalid').removeClass('d-none');
                return false;
            } else $(this).find('.post-code-check-error-invalid').addClass('d-none')
            $.ajax({
                url: "{{ route('postCodeCheck') }}",
                method: "POST",
                data: $('#email-postcode-form').serialize(),
                headers: headers,
                success: function(res) {
                    if (res.error) {
                        window.location.reload();
                    }
                    if (res.success) {
                        $('.text-success').removeClass('d-none');
                        $('#email-postcode-form').find('button[type="submit"]').prop('disabled', true);
                    }
                }
            })
        });

        $(document).on('click', '.generic-submit-btn[type="button"]', function() {
            $('input').val('');
            window.location.reload();
        });

        $(document).on('submit', '.plan-select-form', function(e) {
            e.preventDefault();
            let form = $(this)
            $.ajax({
                url: "{{ route('selectPlan') }}",
                method: "POST",
                data: form.serialize(),
                headers: headers,
                success: function(res) {
                    $('.modal').modal('hide');
                    if (res.success) {
                        hideShowStep(3, res.html);
                    }
                }
            })
        });
        // $(document).on('submit', '#information-form', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: "{{ route('information') }}",
        //         method: "POST",
        //         data: $('#information-form').serialize(),
        //         headers: headers,
        //         success: function(res) {
        //             if (res.success) {
        //                 hideShowStep(4, res.html);
        //             }
        //         }
        //     })
        // });


        function hideShowStep(step, html) {
            $('.step').addClass('d-none');
            $(`#step-${step}`).removeClass('d-none');
            $(`#step-${step}`).html(html);
        }

        $(document).on('click', '.read-more-btn', function() {
            $(this).closest('.modal-body').find('.custom-list-image').addClass('show-all');
        });
    </script>
@endsection
