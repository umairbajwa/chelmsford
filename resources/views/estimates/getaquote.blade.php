@extends('layouts.app', ['nobar' => 1])

@section('head')
    {{-- @parent --}}
    {{-- New Assets --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('new-assets/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('new-assets/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('new-assets/slick/slick-theme.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="{{ asset('css/ideal-postcodes-autocomplete.css') }}" rel="stylesheet">
    <style>
        .idpc_ul {
            text-align: left !important;
        }

        #radiators-count {
            position: fixed;
            top: 200px;
            right: 100px;
            height: auto;
            z-index: 10;
            /* display: none; */
        }

        @media (max-width:767px) {
            #radiators-count {
                right: 10px
            }

            .radio-ctm {
                margin-right: 2rem;
            }
        }
    </style>

    {!! RecaptchaV3::initJs() !!}
@endsection
@section('content')
    {!! $questions !!}

    <div id="radiators-count" class=" d-none">

    </div>

    <div class="modal fade" id="sessionEmailModal" tabindex="-1" role="dialog" aria-labelledby="sessionEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 14px;">
                <section class="home-servey">
                    <div class="login-box">
                        <form action="" id="email-modal-form">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h3 class="log-in-heading text-center">Save Session</h3>
                                    <p class="stardard-text">An email will be sent so you can start from where you left.</p>
                                    <div class="form-group m-b-25">
                                        <label class="required" for="Email"> </label>
                                        <input type="email" class="form-control required form-contact email-input email-input-modal" id="Email" placeholder="Email" name="email">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 col-md-6-ctm">
                                    <div class="submit-btn text-center">
                                        <button id="submit-form" class="btn-submit-form" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="floor-modal" tabindex="-1" role="dialog" aria-labelledby="floor-modal" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 25px;">
                <section class="home-servey">
                    <div class="login-box">
                        <input type="hidden" value="" class="input-floor-type">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 10px;background-color: white;border-radius: 50%;z-index: 9999999;font-size: 20px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="text-center mb-4">Area Calculator</h2>
                        <div class="rooms-calculator-section p-2">
                            <div class="step-1">
                                <div class="row  mb-4">
                                    <div class="col-md-5 d-flex align-items-center">
                                        <h5 id="floor-type" style="text-transform:uppercase;font-weight:bolder">Total Rooms</h5>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="rooms-qty" id="rooms-qty" class="form-control required form-contact email-input email-input-modal p-2">
                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="mt-2">Enter the total number of rooms where you would like Under Floor Heating.</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end align-items-end">
                                        <button class="mt-2 btn custom-button calculator-next-step opacity-0">Next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="step-2 hide">
                                <div class="row mb-2">
                                    <div class="col-md-5 d-flex align-items-center ">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <h4>Length (m)</h4>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <h4>Width (m)</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12 rooms-row">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col d-flex justify-content-center align-items-center">
                                                <h3>Total Heating Area</h3>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-center">
                                                <h3><span id="total-sq-ft">0</span> sq. m</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-end align-items-end">
                                        <button class="mt-4 btn custom-button calculate-area">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    @parent
    <script>
        var totalRadiators = 0;
        $(document).on('click', '.nextButton', function() {
            if ($(this).closest('.question-row').length > 0) {
                let questionId = $(this).closest('.question-row').attr('id').split('-')[1];
                if (questionId == 6) {
                    if ($('#radiators-count>h4').length != $(this).closest('.question-row').find('input[type=checkbox]:checked').length) {
                        let html = '';
                        $(this).closest('.question-row').find('input[type=checkbox]:checked').each(function() {

                            html += `<h4 class="radiator-${$(this).siblings('.option-wrap').data('goto')}">${$(this).siblings('label.option-wrap').find('.text-input').text()}: <span>0</span></h4>`;
                        })
                        $('#radiators-count').html(html)
                        totalRadiators = 0;
                    }
                }

                if (questionId == 6 || questionId == 7 || questionId == 8 || questionId == 20 || questionId == 21) {

                    $('#radiators-count').removeClass('d-none');
                    let radiatorCount = 0;
                    $(this).closest('.question-row').find('input:checked').each(function() {
                        radiatorCount += parseInt($(this).siblings('.quantityOption').find('.quantity-input').val());
                    });
                    console.log('Radiator cound', radiatorCount);
                    console.log(totalRadiators);
                    totalRadiators += (isNaN(radiatorCount) ? 0 : radiatorCount);
                    $('#radiators-count').find(`.radiator-${questionId}>span`).html(radiatorCount);
                } else $('#radiators-count').addClass('d-none');
            }
        });
        $(document).on('change', '#question-9 input[type=checkbox]', function() {
            setTimeout(() => {
                $('#question-9').find('.nextButton').addClass('opacity-0');
            }, 50);
        })
        $(document).on('keyup focusin focus change click', '#question-9 input[type=number]', function(e) {
            console.log('event Type', e.type)
            let value = 0;
            $('#question-9').find('input[type=checkbox]:checked').each(function() {
                let quantity = parseInt($(this).siblings('.option-wrap').find('.quantity-input').val());
                console.log(quantity)
                value += (isNaN(quantity) ? 0 : quantity);
            });
            console.log('Values', value, totalRadiators)
            if (value == totalRadiators) {
                $('#question-9').find('.nextButton').removeClass('opacity-0');
            } else $('#question-9').find('.nextButton').addClass('opacity-0');
        })
        $(document).on('click', '.backButton', function() {

            if ($(this).closest('.question-row').length > 0) {
                let questionId = $(this).data('goto');
                if (questionId == 7 || questionId == 8 || questionId == 9 || questionId == 20 || questionId == 21) {
                    $('#radiators-count').removeClass('d-none');
                } else $('#radiators-count').addClass('d-none');
            }

        });


        var email = "{{ $sessionEmail }}";
        $(document).on('input', '.email-input', function() {
            email = $(this).val();
            $('#email-form').find('.submitted-btn').prop('disabled', false).html('Update');
        });

        $(document).ready(function() {
            updateEmailInForm();
        })

        function updateEmailInForm() {
            $('#InformationEmail').val(email);
        }
        $(document).on('submit', '#email-form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('save-form-session') }}",
                method: 'POST',
                data: {
                    email: email,
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    $('#email-form').find('.submitted-btn').prop('disabled', true).html('Updated');
                    updateEmailInForm();
                },
                error: function() {
                    window.location.reload();
                }
            });
        });
        var buttonCounter = 1;
        $(document).on('click', '.nextButton', function() {

            if (buttonCounter >= 5 && $(this).data('goto') != 1000) {
                $('.btn-save').removeClass('opacity-0');
            }
            buttonCounter++;
            console.log(buttonCounter)
        })

        $(document).on('click', '.start-over', function() {
            buttonCounter = 3
            console.log(buttonCounter)
            $('.btn-save').addClass('opacity-0');
            $('.question-row').addClass('hide');
            $('.email-section').removeClass('opacity-0');
        });

        $(document).on('click', '.backButton', function() {
            buttonCounter -= 2;
            if (buttonCounter <= 7) {
                $('.btn-save').addClass('opacity-0');
            } else {
                $('.btn-save').removeClass('opacity-0');
            }
            $('.email-section').removeClass('opacity-0');
        });

        $(document).on("click", '.btn-save', function() {
            if (email != '') {
                $('#sessionEmailModal').find('.email-input-modal').addClass('hide');
            } else {
                $('#sessionEmailModal').find('.email-input-modal').removeClass('hide');
            }
            $('#sessionEmailModal').modal()
        })

        $(document).on('submit', '#email-modal-form', function(e) {
            e.preventDefault();
            updateEmailInForm();
            saveFormSession();
        })

        function saveFormSession() {
            let formData = $('#estimate-form').serializeArray();
            formData.push({
                name: 'email',
                value: email
            });

            $.ajax({
                url: "{{ url('save-form-session') }}",
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function() {
                    $('#email-modal-form').modal('hide');
                    window.location = "{{ url('thank-you') }}";
                }
            });
        }

        $(document).on('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.clientHeight - 10) {
                $('.scroll-bottom').addClass('hide');
            } else {
                $('.scroll-bottom').removeClass('hide');
            }
        })
        $(document).on('click', '.scroll-bottom', function() {
            $('html,body').animate({
                scrollTop: '+=200px'
            });
        })

        $(document).on('click', '.qty-add', function() {
            let input = $(this).siblings('.quantity-input');
            input.val(parseInt(input.val()) + 1);
            $('#question-9').find('input[type=number]').trigger('focus')
        })

        $(document).on('click', '.qty-subtract', function() {
            let input = $(this).siblings('.quantity-input');
            if (input.val() == 1) {
                return;
            }
            input.val(parseInt(input.val()) - 1);
            $('#question-9').find('input[type=number]').trigger('focus')
        })
    </script>
@endsection
