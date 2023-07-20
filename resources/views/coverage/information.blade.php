<div class="mt-5">
    <div class="text-center">
        <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />
        <ul id="progressbar">
            <li class="active"></li>
            <li class="active"></li>
            <li class="active"></li>
            <li></li>
        </ul>
        <h1 class="heading-text mt-5">Your Information</h1>
        <p class="text-center pointer-none">
            Your information in the box below and we’ll confirm
        </p>
    </div>
    <form class="mt-5" id="information-form" action="" method="POST">
        <input type="hidden" name="plan" value="{{ session()->get('plan') }}">
        @csrf
        <div class="form-floating">
            <select class="form-control info-field-1" id="floatingInput1" name="title" placeholder="Title" required>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
                <option value="Dr.">Dr.</option>
            </select>
            <label for="floatingInput1">TItle</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control info-field-2" id="floatingInput1" name="name" placeholder="First name" required />
            <label for="floatingInput1">First name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control info-field-2" id="floatingInput1" name="surname" placeholder="Surname" required />
            <label for="floatingInput1">Surname</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control info-field-2" id="floatingInput6" name="email" placeholder="Email Address" value="{{ session()->get('email') }}" required />
            <label for="floatingInput6">Email Address <span class="text-danger" id="invalid-email"></span></label>
        </div>
        <div class="form-floating">
            <input class="form-control info-field-2" oninput="" id="InformationAddress1" aria-label="Floating label select example" name="address_1" class="address" autocomplete="off" required />
            <label for="InformationAddress1">Address</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control d-none info-field-2" id="InformationAddress2" aria-label="Floating label select example" name="address_2" class="address" autocomplete="off" />
            <label for="InformationAddress2">Addres Line 2</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control d-none info-field-2" id="InformationAddress3" name="town" placeholder="Town" required />
            <label for="InformationAddress3">Town</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control d-none info-field-2" id="InformationPostcode" name="post_code" placeholder="Post Code" required />
            <label for="InformationPostcode">Post Code</label>
        </div>
        <div class="form-floating">
            <input class="form-control d-none info-field-2" id="AddressTown" aria-label="Floating label select example" name="county" class="address" autocomplete="off" required />
            <label for="AddressTown">County</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control info-field-2" id="floatingInput4" name="phone_number" placeholder="Phone Number" required />
            <label for="floatingInput4">Phone Number (Mobile number preferred) </label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control info-field-3" id="floatingInput5" name="referred_by" placeholder="Referred By" readonly />
            <label for="floatingInput5">Referral for amazon vouchers </label>
        </div>

        <button class="get-started-btn w-100 mt-4" id="form-submit-btn" type="submit">Next</button>
    </form>
</div>
<div class="modal fade " id="referral-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-body">
                <p class="text-center mt-3">
                    If you have been recommended by a friend please provide their name and as a thank you we will send them and you some Amazon vouchers
                </p>
                <input type="text" class="form-control" id="referral-input" autofocus autocomplete="off">
            </div>

            <div class="d-flex justify-content-evenly align-items-center">
                <button type="button" class="get-started-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="get-started-btn referral-done">Refer</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('coverage/js/ideal-postcodes-autocomplete.min.js') }}" defer></script>

<script src="{{ asset('coverage/js/custom.js') }}" defer></script>

<script>
    var emailValid = false;
    var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    $('#floatingInput6').on('input', function() {
        if (validEmail.test($(this).val())) {
            $.ajax({
                url: "{{ route('checkEmail') }}",
                method: "post",
                data: {
                    email: $('#floatingInput6').val()
                },
                success: function(res) {
                    if (res.success) {
                        $('#information-form').attr('action', res.url)
                        $('#invalid-email').html('');
                        $('#form-submit-btn').prop('disabled', false);
                        emailValid = true;
                    } else {
                        $('#information-form').attr('action', "")
                        $('#invalid-email').html(res.message);
                        $('#form-submit-btn').prop('disabled', true);
                        emailValid = false;
                    }
                }
            })
        }
    });
    $('#information-form').on('submit', function(e) {
        if (!emailValid) {
            e.preventDefault()
        }
    })

    $(function() {
        $("#floatingInput4").inputmask({
            "mask": "99999 999999"
        });
    });
    var myModal = new bootstrap.Modal(document.getElementById('referral-modal'), {
        keyboard: false,
        focus: true
    })

    $(document).on('focus', '#floatingInput5', function() {
        myModal.toggle();
        // setTimeout(() => {
        //     $(document).find('#referral-input').focus();
        // }, 200);
    });

    $(document).on('click', '.referral-done', function() {
        $('#floatingInput5').val($('#referral-input').val());
        myModal.toggle();
    })
</script>
