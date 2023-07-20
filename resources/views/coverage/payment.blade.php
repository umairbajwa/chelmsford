@extends('layouts.coverage')

@section('content')
    <div class="container" style="max-width: 700px">
        <div class="mt-5">
            <div class="text-center">
                <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />
                <ul id="progressbar">
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                </ul>
                <h1 class="heading-text mt-4">Payment</h1>
            </div>

            <div class="card payment-section-card mt-5">
                <h4 class="text-dark text-center">Summary</h4>
                @if ($coverage->plan == 99)
                    <div class="d-flex justify-content-between">
                        <h5 class="me-2">Boiler and up to 20 Radiators</h5>
                        <h5 >£24/pcm inc. VAT</h5>
                    </div>
                @else
                    <div class="d-flex justify-content-between">
                        <h5 class="ms-1">Two boilers and up to 30 Radiators</h5>
                        <h5>£43/pcm inc. VAT</h5>
                    </div>
                @endif
                <div class="d-flex justify-content-between">
                    <h5>Upfront Payment</h5>
                    <h5>£{{ $coverage->plan }} inc. VAT</h5>
                </div>
            </div>
            <div class="my-2">
                <h6 class="text-center">You are agreeing to 12 monthly payments of £{{ $coverage->plan == 99 ? 24 : 43 }} per month</h6>
            </div>
            {{-- <div class="accordion mt-3" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <div class="d-flex">
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" />
                            </div>
                            <h5 class="text-dark mb-0">Paypal</h5>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Paypal</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <div class="d-flex">
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" />
                            </div>
                            <h5 class="text-dark mb-0">Credit / Debit</h5>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control payment-form-class" id="floatingInput" placeholder="Card Holder" />
                                <label for="floatingInput">Card Holder</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input maxlength="19" type="text" class="form-control payment-form-class cc-number-input" id="floatingInput" placeholder="Card Number" />
                                <label for="floatingInput">Card Number</label>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="form-floating mb-3">
                                        <input maxlength="5" type="text" class="form-control payment-form-class cc-expiry-input" id="floatingInput" placeholder="Expiry Date" />
                                        <label for="floatingInput">Expiry Date</label>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" maxlength="3" class="form-control payment-form-class cc-cvc-input" id="floatingInput" placeholder="CVC" />
                                        <label for="floatingInput">CVC</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <div class="d-flex">
                            <div class="form-check align-self-center">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" />
                            </div>
                            <h5 class="text-dark mb-0">Net Banking</h5>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Net Banking</div>
                </div>
            </div>
        </div> --}}

            <a href="{{ route('proceedPayment', ['id' => $coverage->id]) }}" class="get-started-btn w-100  payment-info-btn text-center text-white text-decoration-none d-block" type="button">
                Proceed To Payment
            </a>
        </div>
    </div>
    {{-- Card Number Masking --}}
    {{-- <script>
        let ccNumberInput = document.querySelector(".cc-number-input"),
            ccNumberPattern = /^\d{0,16}$/g,
            ccNumberSeparator = " ",
            ccNumberInputOldValue,
            ccNumberInputOldCursor,
            ccExpiryInput = document.querySelector(".cc-expiry-input"),
            ccExpiryPattern = /^\d{0,4}$/g,
            ccExpirySeparator = "/",
            ccExpiryInputOldValue,
            ccExpiryInputOldCursor,
            ccCVCInput = document.querySelector(".cc-cvc-input"),
            ccCVCPattern = /^\d{0,3}$/g,
            mask = (value, limit, separator) => {
                var output = [];
                for (let i = 0; i < value.length; i++) {
                    if (i !== 0 && i % limit === 0) {
                        output.push(separator);
                    }

                    output.push(value[i]);
                }

                return output.join("");
            },
            unmask = (value) => value.replace(/[^\d]/g, ""),
            checkSeparator = (position, interval) =>
            Math.floor(position / (interval + 1)),
            ccNumberInputKeyDownHandler = (e) => {
                let el = e.target;
                ccNumberInputOldValue = el.value;
                ccNumberInputOldCursor = el.selectionEnd;
            },
            ccNumberInputInputHandler = (e) => {
                let el = e.target,
                    newValue = unmask(el.value),
                    newCursorPosition;

                if (newValue.match(ccNumberPattern)) {
                    newValue = mask(newValue, 4, ccNumberSeparator);

                    newCursorPosition =
                        ccNumberInputOldCursor -
                        checkSeparator(ccNumberInputOldCursor, 4) +
                        checkSeparator(
                            ccNumberInputOldCursor +
                            (newValue.length - ccNumberInputOldValue.length),
                            4
                        ) +
                        (unmask(newValue).length - unmask(ccNumberInputOldValue).length);

                    el.value = newValue !== "" ? newValue : "";
                } else {
                    el.value = ccNumberInputOldValue;
                    newCursorPosition = ccNumberInputOldCursor;
                }

                el.setSelectionRange(newCursorPosition, newCursorPosition);

                highlightCC(el.value);
            },
            highlightCC = (ccValue) => {
                let ccCardType = "",
                    ccCardTypePatterns = {
                        amex: /^3/,
                        visa: /^4/,
                        mastercard: /^5/,
                        disc: /^6/,

                        genric: /(^1|^2|^7|^8|^9|^0)/,
                    };

                for (const cardType in ccCardTypePatterns) {
                    if (ccCardTypePatterns[cardType].test(ccValue)) {
                        ccCardType = cardType;
                        break;
                    }
                }

                let activeCC = document.querySelector(".cc-types__img--active"),
                    newActiveCC = document.querySelector(
                        `.cc-types__img--${ccCardType}`
                    );

                if (activeCC) activeCC.classList.remove("cc-types__img--active");
                if (newActiveCC) newActiveCC.classList.add("cc-types__img--active");
            },
            ccExpiryInputKeyDownHandler = (e) => {
                let el = e.target;
                ccExpiryInputOldValue = el.value;
                ccExpiryInputOldCursor = el.selectionEnd;
            },
            ccExpiryInputInputHandler = (e) => {
                let el = e.target,
                    newValue = el.value;

                newValue = unmask(newValue);
                if (newValue.match(ccExpiryPattern)) {
                    newValue = mask(newValue, 2, ccExpirySeparator);
                    el.value = newValue;
                } else {
                    el.value = ccExpiryInputOldValue;
                }
            };

        ccNumberInput.addEventListener("keydown", ccNumberInputKeyDownHandler);
        ccNumberInput.addEventListener("input", ccNumberInputInputHandler);

        ccExpiryInput.addEventListener("keydown", ccExpiryInputKeyDownHandler);
        ccExpiryInput.addEventListener("input", ccExpiryInputInputHandler);
    </script> --}}
@endsection
