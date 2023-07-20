$(function () {
    var standardRadiator;
    var designerRadiator;
    $(document).on('ajaxStart', function () {
        $('#loading-image').removeClass('hide');
    }).on('ajaxStop', function () {
        $('#loading-image').addClass('hide');
    });
    $('#addNewOption').on('click', function (e) {
        var count = $('#addNewOption').attr('data-count');
        jQuery.ajax({
            url: '/getnewoptions/' + count,
            method: 'GET',
            success: function (result) {
                count++;
                $('#question-options').append(result);
                $('#addNewOption').attr('data-count', count);
            }
        });
    });

    $('#app').on('click', '.removeoption-button', function (e) {
        var row = $(this).attr('data-row');
        $('#row-' + row).remove();
    });
    $('.nextButton').on('click', function (e) {
        if (e.target.className == 'zoom' || e.target.className == 'fas fa-eye text-white') {
            $($(this).data('id')).find('#image-output').find('img').attr('src', $(this).data('image'));
            return true;
        }
        var goto = $(this).attr('data-goto');
        var parent = $(this).attr('data-parent');
        if (goto == 7 || goto == 8 || goto == 20 || goto == 21) {
            standardRadiator = $('#option-6-0').is(':checked');
            designerRadiator = $('#option-6-1').is(':checked');
            columnRadiator = $('#option-6-2').is(':checked');
            towelRadiator = $('#option-6-3').is(':checked');
            if (standardRadiator) {
                goto = 7;
            } else {
                if (designerRadiator) {
                    goto = 8;
                } else {
                    if (columnRadiator) {
                        goto = 20;
                    } else {
                        if (towelRadiator) {
                            goto = 21;
                        }
                    }
                }
            }
        }
        if (goto == 9) {
            if ($('#question-7').is(':visible')) {
                if (designerRadiator) {
                    goto = 8;
                } else {
                    if (columnRadiator) {
                        goto = 20;
                    } else {
                        if (towelRadiator) {
                            goto = 21;
                        }
                    }
                }
            }
            if ($('#question-8').is(':visible')) {
                if (columnRadiator) {
                    goto = 20;
                } else {
                    if (towelRadiator) {
                        goto = 21;
                    }
                }
            }
            if ($('#question-20').is(':visible')) {
                if (towelRadiator) {
                    goto = 21;
                }
            }
        }

        if (goto == 19 && $('#question-18').find('input[type=radio]:checked').val() == parseInt($('#question-17').find('input[type=radio]:checked').val()) + 1) {
            $('#question-' + goto).addClass('hide');
            goto = '1000';
            parent = 18;
        }
        $('#question-' + parent).addClass('hide');
        $('#question-' + goto).removeClass('hide');


        $('#question-' + goto + ' .backButton').attr('data-goto', parent);
        var height = $('#question-' + goto).outerHeight();
        $('#estimate-form').css('height', height);
        if (goto == 1000) {
            $('.email-section').addClass('opacity-0');
        } else {
            $('.email-section').removeClass('opacity-0');
        }
    });

    $('.backButton').on('click', function () {
        $(this).closest('.question-row').find('input[type="text"],input[type="number"]').val('');
        $(this).closest('.question-row').find('input[type="checkbox"],input[type="radio"]').prop('checked', false);
        var goto = $(this).attr('data-goto');
        var parent = $(this).attr('data-parent');
        $('#question-' + parent).addClass('hide');
        $('#question-' + goto).removeClass('hide');
        $(this).siblings('.nextButton').addClass('opacity-0');
        var height = $('#question-' + goto).outerHeight();
        $('#estimate-form').css('height', height);
    });

    $(document).on('click', '.calculator-next-step', function () {
        $(this).closest('.step-1').addClass('hide');
        let totalRooms = $(this).closest('.step-1').find('input').val();
        html = '';
        for (let index = 1; index <= totalRooms; index++) {
            html += `<div class="row mb-2">
                            <div class="col-md-5 d-flex align-items-center">
                                <h4>Room ${index}</h4>
                            </div>
                            <div class="col-md-7">
                                <div class="row square-feet-inputs-row">
                                    <div class="col d-flex align-items-center">
                                       <input type="number" class="form-control required form-contact p-1 length-input" placeholder="0 m" value="0">
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <input type="number" class="form-control required form-contact p-1 width-input" placeholder="0 m" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>`;

        }
        $(this).closest('.step-1').siblings('.step-2').find('.rooms-row').html(html);
        $(this).closest('.step-1').siblings('.step-2').removeClass('hide');
    });

    $(document).on('input', '#rooms-qty', function () {
        if ($(this).val() > 0) {
            $('.calculator-next-step').removeClass('opacity-0');
        } else $('.calculator-next-step').addClass('opacity-0');
    });

    $(document).on('input', '.length-input, .width-input', function () {
        let total = 0;
        $('.square-feet-inputs-row').each(function () {
            length = $(this).find('.length-input').val() ? $(this).find('.length-input').val() : 0;
            width = $(this).find('.width-input').val() ? $(this).find('.width-input').val() : 0;
            total += (parseFloat(length) * parseFloat(width));
        });
        $('#total-sq-ft').html(total.toFixed(2));
    });

    $('.option-wrap').on('click', function (e) {
        console.log(e);
        if (e.target.classList.contains('qty-add') || e.target.classList.contains('qty-subtract') || e.target.classList.contains('fa-minus') || e.target.classList.contains('fa-plus')) {
            return true;
        }
        if ($(this).closest('.radio-ctm').data('question') == 9) {
            setTimeout(() => {
                $('#question-9').find('input[type=number]').trigger('focus')
            }, 100);
            return;
        }
        $(this).closest('.row').find('.nextButton').attr('data-goto', $(this).data('goto'));
        $(this).closest('.row').find('.nextButton').removeClass('opacity-0');
    });

    $('.question-wrap input[type="text"]').on('click', function () {
        var radio = $(this).attr('data-radio');
        $('#' + radio).prop('checked', true);
    });
    $('.question-wrap input[type="number"]').on('click', function () {
        var radio = $(this).attr('data-radio');
        if ($(this).val() == 0) {
            $('#' + radio).prop('checked', false);
        } else {
            $('#' + radio).prop('checked', true);
        }
    });
    var selectedCheckbox;
    $(document).on('click', '.floor-modal', function () {
        selectedCheckbox = $(this).siblings('label.option-wrap');
        selectedCheckbox.click();
        // $(this).siblings('input').prop('checked', true);
        $('#floor-modal').find('.step-1').removeClass('hide');
        $('#floor-modal').find('.step-2').addClass('hide');
        $('#floor-modal').find('.input-floor-type').val($(this).data('question'));
        // console.log($('#floor-modal').find('.input-floor-type').val());
        $('#floor-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '.calculate-area', function () {
        let selected = $('#floor-modal').find('.input-floor-type').val();
        let squareMtr = $('#total-sq-ft').html();
        // console.log(selected, squareMtr);
        selectedCheckbox.find('input.form-control').val(squareMtr);
        $('#floor-modal').modal('hide');
        selectedCheckbox = null;
    });
    $('label.textOption').on('click', function () {
        // console.log($(this).find('input').val());
        if ($(this).find('input').val() == '') {
            $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
        }
    });

    $('label.quantityOption').on('click', function (e) {
        if (e.target.classList.contains('qty-add') || e.target.classList.contains('qty-subtract') || e.target.classList.contains('fa-minus') || e.target.classList.contains('fa-plus')) {
            return true;
        }
        if ($(e.target).is('input[type="number"]')) {
            e.preventDefault();
            return;
        }
        var checkbox = $(this).attr('for');
        if ($('#' + checkbox).is(':checked') && !$('#' + checkbox).is('input[type="radio"]')) {
            $(this).find('.quantity-input').val(0);
        } else {
            $(this).find('.quantity-input').val(1);
        }
        // console.log($('#' + checkbox).is(':checked') && !$('#' + checkbox).is('input[type="radio"]'));
        var t = $(this);
        var checked = false;
        setTimeout(() => {
            if (!$('#' + checkbox).is('input[type="radio"]')) {

                $(this).closest('.question-row').find('input[type="checkbox"]:checked').each(function () {
                    if ($(this).find('input[type="number"]').val() <= 0) {
                        $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
                    } else {
                        $(this).closest('.question-row').find('.arrow-w .nextButton').removeClass('opacity-0');
                        checked = true;
                    }
                });
                if (checked) {
                    $(this).closest('.question-row').find('.arrow-w .nextButton').removeClass('opacity-0');
                } else {
                    $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
                }
            }
        }, 50);
    });





    $('#SeeMyEstimate').on('click', function (e) {

        $('#InformationFirst').removeClass("InputError");
        $('#InformationLast').removeClass("InputError");
        $('#InformationEmail').removeClass("InputError");
        $('#InformationAddress1').removeClass("InputError");
        $('#InformationPostcode').removeClass("InputError");
        $('#InformationPhoneNumber').removeClass("InputError");
        $('#InformationError').addClass("hide");

        var error = 0;
        if ($('#InformationFirst').val() == "") {
            error++;
            $('#InformationFirst').addClass("InputError");
        }
        if ($('#InformationLast').val() == "") {
            error++;
            $('#InformationLast').addClass("InputError");
        }
        if ($('#InformationEmail').val() == "") {
            error++;
            $('#InformationEmail').addClass("InputError");
        }
        if ($('#InformationAddress1').val() == "") {
            error++;
            $('#InformationAddress1').addClass("InputError");
        }
        if ($('#InformationPostcode').val() == "") {
            error++;
            $('#InformationPostcode').addClass("InputError");
        }
        if ($('#InformationPhoneNumber').val() == "") {
            error++;
            $('#InformationPhoneNumber').addClass("InputError");
        }
        var email = $('#InformationEmail').val();
        if (email.includes("@") == 0) {
            error++;
            $('#InformationEmail').addClass("InputError");
            $('#InformationError').removeClass("hide");
            $('#InformationError').html("It doesn't look like you entered a valid email address.");
        }
        var number = $('#InformationPhoneNumber').val();
        if (number.length != 11) {
            error++;
            $('#InformationPhoneNumber').addClass("InputError");
            $('#InformationError').removeClass("hide");
            $('#InformationError').html("Please enter a valid phone number of 11 digits.");
        }

        if (error == 0) {
            e.preventDefault();
            $('#estimate-form').submit();
        }

    });
    $(document).on('click', '.zoom', function () {
        // console.log(($(this).data('id'), $(this).data('image')));
        $($(this).data('target')).find('#image-output>img').attr('src', $(this).data('image'));
    })
    $('.backButton, .nextButton, .start-over').on('click', function (e) {
        if (e.target.className == 'zoom' || e.target.className == 'fas fa-eye text-white') {
            return true;
        }
        $('.progress-bar').css('width', $(this).data('progress_bar') + '%');
        if ($(this).data('goto') == 1000) {
            $('.progress-bar').css('width', '100%');
        }
    });

    $(document).on('input', 'input.quantity-input', function () {
        if ($(this).closest('.question-row').attr('id') == 'question-9') {
            // console.log($(this).closest('.question-row').attr('id'));
            return;
        }
        // console.log($(this).closest('.question-row').attr('id'));
        if ($(this).val() > 0 && $(this).closest('.radio-ctm').find('input[type=checkbox]').is(':checked')) {
            $(this).closest('.question-row').find('.arrow-w .nextButton').removeClass('opacity-0');
        } else $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
        if ($(this).closest('.radio-ctm').find('input[type=radio]').is(':checked')) {
            if ($(this).closest('.radio-ctm').find('input[type=number]').val() <= 0) {
                $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
            } else $(this).closest('.question-row').find('.arrow-w .nextButton').removeClass('opacity-0');
        }
    });

    $(document).on('input', 'input.text-input', function () {
        if ($(this).val().length > 0 && $(this).closest('.radio-ctm').find('input[type=radio]').is(':checked')) {
            $(this).closest('.question-row').find('.arrow-w .nextButton').removeClass('opacity-0');
        } else $(this).closest('.question-row').find('.arrow-w .nextButton').addClass('opacity-0');
    });

    $(document).on('click', '.start-over', function () {
        $('.question-row').addClass('hide');
        $('#question-' + $(this).data('goto')).removeClass('hide');
    })

    $(document).on('click', '.start-button', function () {
        $('.log-in.home-servey').removeClass('hide');
        $('.banner-zxm').addClass('hide');
        $('#question-' + $(this).data('goto')).removeClass('hide');
    })

    $(document).on('submit', '#survey-postcode', function (e) {
        e.preventDefault();
        if (/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})$/.test($(this).find('#post-code').val()) == false) {
            $(this).find('.post-code-check-error-invalid').removeClass('d-none');
            return;
        } else $(this).find('.post-code-check-error-invalid').addClass('d-none');
        $.ajax({
            url: $('#survey-postcode').attr('action'),
            method: 'POST',
            data: $('#survey-postcode').serialize(),
            success: function (res) {
                if (res.success && res.type == 'session') {
                    $('.log-in.home-servey').addClass('hide').siblings('.fuel-type').removeClass('hide');
                    $('#survey-postcode').find('.postcode-form-next-btn').trigger('click');
                } else if (res.success && res.type == 'email') {
                    $('#submit-form').val('Request Sent').prop('disabled', true);
                    $('#submit-form').closest('.row').find('.text-success').removeClass('hide');

                } else {
                    $('#survey-postcode').find('.post-code-email-row').removeClass('hide');
                    $('#survey-postcode').find('.post-code-email-row').find('input[type=email]').prop('required', true);
                    $('#submit-form').val('Send Request').prop('disabled', false);
                    $('.thank-you-img,.error-header').removeClass('hide');
                    $('#startOverButton').removeClass('hide');
                    $('.normal').addClass('hide');
                }
            }
        })
    })

    $('#calculate-finance').on('click', function () {
        var total = parseInt($('#finance-calculator #finance-estimate-total').val());
        var deposit = parseInt($('#finance-calculator #finance-deposit').val());
        // console.log(deposit, total)
        if (isNaN(deposit)) {
            deposit = 0;
            $('#finance-calculator #finance-deposit').val(0);
        }
        var remaining = total - deposit;
        $('#finance-calculator #remaining-to-finance').val(remaining);
        var years = parseInt($('#finance-calculator #finance-years').val());
        var months = years * 12;
        var rate = 0.099;

        var interest = Math.pow((1 + rate / 1), 1 / 12) - 1;
        var value1 = interest * Math.pow((1 + interest), months);
        var value2 = Math.pow((1 + interest), months) - 1;
        var pmt = Math.round(remaining * (value1 / value2) * 100) / 100;

        var totalrepaymentvalue = Math.round((pmt * months) * 100) / 100;
        var totalpayable = totalrepaymentvalue + deposit;
        var payableinterest = Math.round((totalpayable - total) * 100) / 100;
        // console.log(pmt);

        $('#finance-calculator #finance-monthly-repayments').val(pmt);
        $('#finance-calculator #finance-total-repayment-value').html("Total Payable: £" + totalpayable);
        $('#amount-on-finance').val(Math.round(remaining));
        $('#total-interest').val(payableinterest);
        $('#calculate-finance').html("Recalculate");
        $('#finance-total-repayment-value').removeClass("hide");
        $('#repayments-wrap').removeClass("hide");
        /*for(var i = 0; i < TotalMonths; i++){
            var calc = runningtotal * rate;
            runningtotal -= calc;
            // console.log(calc + " - " + runningtotal);
        }*/
    });

    $('#extraModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var price = button.data('price'); // Extract info from data-* attributes
        var product = button.data('productid'); // Extract info from data-* attributes
        var subtotal = $('#finance-subtotal-total').val();
        // console.log(product);
        var total = parseInt(price) + parseInt(subtotal);

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.quoted-product-wrap').css('display', 'none');
        modal.find('.product-' + product).css('display', 'block');
        modal.find('.additional-product').css('display', 'block');
        modal.find('#finacne-estimate-total').html("Estimated Total: £" + total);
        modal.find('#finance-estimate-total').val(total);
    });

    $(document).on('input', '#finance-deposit', function () {
        // console.log($(this).val());
        if (parseInt($(this).val()) > parseInt($('#finance-subtotal-total').val())) {
            $('#calculate-finance').prop('disabled', true);
        } else $('#calculate-finance').prop('disabled', false);
    })

    $('#finance-extraModal').on('show.bs.modal', function (event) {
        $('#repayments-wrap').addClass("hide");
        $('#finance-total-repayment-value').addClass("hide");
        var button = $(event.relatedTarget) // Button that triggered the modal
        var price = button.data('price'); // Extract info from data-* attributes
        var product = button.data('productid'); // Extract info from data-* attributes
        var subtotal = $('#finance-subtotal-total').val();
        var extras = $('#withExtras').val();
        // console.log(price);
        // console.log(subtotal);
        // console.log(extras);
        var total = parseInt(subtotal);

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.quoted-product-wrap').css('display', 'none');
        modal.find('.product-' + product).css('display', 'block');
        modal.find('.additional-product').css('display', 'block');
        modal.find('#finacne-estimate-total').html("Estimated Total: £" + total);
        modal.find('#finance-estimate-total').val(total);
    });
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var image = button.data('image'); // Extract info from data-* attributes


        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#image-output').html('<img src="' + image + '"/>');
    });

    // $('#app .interestedButton').on('click', function () {
    //     var productid = $(this).attr('data-id');
    //     var productname = $(this).attr('data-name');
    //     $('#productchosen').val(productid);
    // });
    $('.upload-button').on('click', function (e) {
        e.preventDefault();
        $('input[type=file]').click();
    });
    $('.pdf-input').on('change', function (e) {
        $("#formSubmit").click();
    });
    $('#saveNext').on('click', function (e) {
        e.preventDefault();
        $('input[name=next]').val(1);
        $('#QuestionForm').submit();
    });
    $('#saveNextProduct').on('click', function (e) {
        e.preventDefault();
        $('input[name=next]').val(1);
        $('#ProductForm').submit();
    });
    $('input[name=combi]').on('click', function () {
        if ($(this).val() == '5') {
            $('.liter-option').removeClass('hide');
        } else {
            $('.liter-option').addClass('hide');
        }
    });


    $(window).on('beforeunload', function () {
        $('#loading-image').removeClass('hide');
    })

    $(document).ready(function () {
        $('#loading-image-1').fadeOut();
    })
});
var controller = new IdealPostcodes.Autocomplete.Controller({
    api_key: "ak_kt0bw1iyZ0G9Wlyek7itgZw8Xh7gQ",
    inputField: "#InformationAddress1",
    outputFields: {
        line_1: "#InformationAddress1",
        line_2: "#InformationAddress2",
        county: "#AddressTown",
        post_town: "#InformationAddress3",
        postcode: "#InformationPostcode"
    }
});
