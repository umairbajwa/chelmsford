<div class="mt-5">
    <div class="text-center my-4">
        <img class="coverage-check-img" src="{{ url('coverage/images/logo.svg') }}" alt="logo" />
        <ul id="progressbar">
            <li class="active"></li>
            <li class="active"></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="background: #151C3E;color: white">
        <div class="row my-5 container">
            <div class="col-md-12 my-3">
                <h1 class="main-heading-text text-center">Your cover plan includes</h1>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex flex-wrap justify-content-around flex-column">
                            <img class="w-75 mx-auto" src="{{ url('coverage/images/component-6.png') }}" alt="presentation" />
                            <div class="text-center d-flex justify-content-center align-items-start mt-4">
                                <h5>Starting at <br /><b class="gold-text">£24</b> Month</h5>
                                <img src="{{ url('coverage/images/component-1.svg') }}" alt="layer" class="mx-2" />
                                <h5>
                                    No Call Out Fee <br />
                                    <b class="gold-text">£0
                                        <br>
                                    </b>
                                    <a href="javascript:void(0)" class="text-decoration-none text-white" style="font-size: 60%" data-bs-toggle="modal" data-bs-target="#callOutFeeModal">what is this?</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="my-3 heading-text">Boiler Plan</h4>

                        <div>
                            <ul class="custom-list-image">
                                <li> Save up to 15% in fuel cost with our plan</li>
                                <li> Call before 10am for a same day repair</li>
                                <li> Boiler service as per the manufacturer instructions, average time approximately 1 hour</li>
                                <li> All repairs’ parts and labour</li>
                                <li> Priority response</li>
                                <li> Free boiler replacement if under 7 years old</li>
                                <li> Discounted boiler replacement if 7-10 years old</li>
                                <li> Water quality scale and sludge corrosion</li>
                                <li> All covered.</li>
                            </ul>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center">
                            <div class="mx-2">
                                <div class="d-flex align-self-center  align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/boiler.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200">Boilers</p>
                            </div>
                            <div class="mx-2">
                                <div class="d-flex align-self-center  align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/radiator.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200 mb-0">Radiators</p>
                                <p class="my-0 text-center font-200 mb-0">and</p>
                                <p class="text-center font-200">Valves</p>
                            </div>
                            <div class="mx-2">
                                <div class="d-flex align-self-center align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/pipework.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200 mb-0">Heating</p>
                                <p class="text-center font-200">Pipework</p>
                            </div>
                            <div class="mx-2">
                                <div class="d-flex align-self-center  align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/controls.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200">Controls</p>
                            </div>
                            <div class="mx-2">
                                <div class="d-flex align-self-center  align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/cylinder.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200 mb-0">Hot Water</p>
                                <p class="text-center font-200">Cylinder</p>
                            </div>
                            {{-- <div class="mx-2">
                                <div class="d-flex align-self-center  align-items-center justify-content-center boiler-image">
                                    <img src="{{ url('coverage/images/tank.png') }}" alt="boiler" />
                                </div>
                                <p class="mt-2 text-center font-200">Tank</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->

    {{-- <div class="text-center">
<h5 type="button" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#exampleModal">
More Information
</h5>
</div> --}}

    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content cover-plan-modal p-3">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="heading-text text-center">Maintenance Cover Plan</h2>
                    <p class="text-center mt-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                        irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum
                    </p>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                        irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="d-flex justify-content-center align-items-center text-white" style="background: #8E7017;">
        <div class="container text-center my-5" style="max-width: 1160px">
            <h1 class="heading-text mb-3">
                £99 inc VAT onboarding fee
            </h1>
            <a href="javascript:void(0)" class="text-decoration-none text-white" data-bs-toggle="modal" data-bs-target="#onboardingFeeModal">what is this?</a>
        </div>
    </div>

    <div class="container mt-5" style="max-width: 800px">
        <h1 class="heading-text text-center">Choose Plan</h1>

        <div class="container" style="max-width: 800px">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="choose-plan-box px-4 ">
                        <h6 class=" text-center mb-4">
                            Boiler and up to 20 radiators
                            <br>
                            <strong style="font-size: 32px"> £24</strong>
                            <br>
                            inc VAT per month
                        </h6>
                        <button class="get-started-btn w-100" type="button" data-bs-toggle="modal" data-bs-target="#plan1Modal">
                            Get Started
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="choose-plan-box px-4 ">
                        <h6 class=" text-center mb-4">
                            Two boilers and up to 30 radiators *
                            <br>
                            <strong style="font-size: 32px">£43</strong>
                            <br>
                            inc VAT per month
                        </h6>
                        <button class="get-started-btn w-100" type="button" data-bs-toggle="modal" data-bs-target="#plan2Modal">
                            Get Started
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3 class="text-center">*in a single dwelling</h3>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="plan1Modal" tabindex="-1" aria-labelledby="plan1ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content cover-plan-modal p-3">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Covered</h5>
                                <ul class="custom-list-image">
                                    <li><span>Bespoke service agreement that covers your whole heating system. For example:</span>
                                        <ul class="list-none">
                                            <li>Year 1 – Boiler service cleaning heat exchanger and new combustion seals</li>
                                            <li>Year 2 – Boiler and hot water cylinder service</li>
                                            <li>Year 3 – Boiler with hydraulic service and radiators service including thermostatic radiator valves maintenance.</li>
                                        </ul>
                                    </li>
                                    <li>Your own plan will be customised to your system’s requirements.</li>
                                    <li class="without-bullet">What else is covered?</li>
                                    <li>Boiler service as per the manufacturer’s instructions. Average time approximately 1 hour</li>
                                    <li>All repairs, parts and labour</li>
                                    <li>Priority response in most cases same day repair </li>
                                    <li>Free boiler replacement (if under 7 years old). </li>
                                    <li>Discounted boiler replacement (if 7-10 years old) .</li>
                                    <li>Because we look after your system water quality, we cover water quality scale and sludge corrosion issues (you probably won’t find another policy that will cover this).</li>
                                    <li>Boiler controls </li>
                                    <li>Hot water cylinder </li>
                                    <li>Radiators, pipework and valves</li>
                                    <li>Accidental cover </li>
                                    <li>Cold water feed and expansion tank. </li>
                                    <li>For full details of what’s included see our <a class="text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#termsCondition1">terms and conditions.</a> </li>
                                </ul>
                                <a href="javascript:void(0)" class="read-more-btn text-center text-decoration-none text-white">Read More</a>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Not Covered</h5>
                                <ul class="custom-list-image">
                                    <li>Water damage caused from any leaks </li>
                                    <li>Trace and access (leaking pipes under concrete floor but will already have covered with home insurance for trace and access) </li>
                                    <li>Evohome smart systems </li>
                                    <li>Honeywell smart fit (obsolete).</li>
                                    <li>Certain makes of boilers, Rayburn AGA, ferrior, Chaffoteaux Potterton Powermax, Britony, Elm Le Blanc Sime, Servowarm and; or any make or model of back boilers.</li>
                                    <li>Weekend cover and out of hours, we only cover for 8am -5pm Monday-Friday </li>
                                    <li>All plumbing related issues e.g. showers, WCs, bath, sinks, taps, water softeners, accumulators, booster mains</li>
                                    <li>Drains, waste pipes etc </li>
                                    <li>Potterton Powermax, Chaffoteaux, Ferolli, Sabre, Alpha and Elm Le Blanc. We do not service or repair: solid fuel boilers, oil boilers, electric boilers, back boilers, or dual purpose boilers</li>
                                </ul>
                                <a href="javascript:void(0)" class="read-more-btn text-center text-decoration-none text-white">Read More</a>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Monthly Payment</h5>
                                <h4 class="text-center">£24 inc. VAT</h4>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Upfront</h5>
                                <h4 class="text-center">£99 inc. VAT</h4>
                            </div>
                        </div>
                        <form class="plan-select-form d-flex justify-content-center align-items-center flex-column mt-3">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckChecked1" required>
                                    <label class="form-check-label text-white" for="flexCheckChecked1">
                                        By clicking here, I state that I have read and understood the <a class="text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#termsCondition1">terms and conditions.</a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked name="marketing" id="flexCheckChecked2">
                                    <label class="form-check-label text-white" for="flexCheckChecked2">
                                        Please send me energy saving tips, special offers and interesting local information by email. You can unsubscribe at any time.
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="99">
                            <button type="submit" class="get-started-btn continue-btn">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="plan2Modal" tabindex="-1" aria-labelledby="plan2ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content cover-plan-modal p-3">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Covered</h5>
                                <ul class="custom-list-image">
                                    <li><span>Bespoke service agreement that covers your whole heating system. For example:</span>
                                        <ul class="list-none">
                                            <li>Year 1 – Boiler service cleaning heat exchanger and new combustion seals</li>
                                            <li>Year 2 – Boiler and hot water cylinder service</li>
                                            <li>Year 3 – Boiler with hydraulic service and radiators service including thermostatic radiator valves maintenance.</li>
                                        </ul>
                                    </li>
                                    <li>Your own plan will be customised to your system’s requirements.</li>
                                    <li class="without-bullet">What else is covered?</li>
                                    <li>Boiler service as per the manufacturer’s instructions. Average time approximately 1 hour</li>
                                    <li>All repairs, parts and labour</li>
                                    <li>Priority response in most cases same day repair </li>
                                    <li>Free boiler replacement (if under 7 years old). </li>
                                    <li>Discounted boiler replacement (if 7-10 years old) (discounted labour only).</li>
                                    <li>Because we look after your system water quality, we cover water quality scale and sludge corrosion issues (you probably won’t find another policy that will cover this).</li>
                                    <li>Boiler controls </li>
                                    <li>Hot water cylinder </li>
                                    <li>Radiators, pipework and valves</li>
                                    <li>Accidental cover </li>
                                    <li>Cold water feed and expansion tank. </li>
                                    <li>For full details of what’s included see our <a class="text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#termsCondition2">terms and conditions.</a> </li>
                                </ul>
                                <a href="javascript:void(0)" class="read-more-btn text-center text-decoration-none text-white">Read More</a>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Not Covered</h5>
                                <ul class="custom-list-image">
                                    <li>Water damage caused from any leaks </li>
                                    <li>Trace and access (leaking pipes under concrete floor but will already have covered with home insurance for trace and access) </li>
                                    <li>Evohome smart systems </li>
                                    <li>Honeywell smart fit (obsolete).</li>
                                    <li>Certain makes of boilers, Rayburn AGA, ferrior, Chaffoteaux Potterton Powermax, Britony, Elm Le Blanc Sime, Servowarm and; or any make or model of back boilers.</li>
                                    <li>Weekend cover and out of hours, we only cover for 8am -5pm Monday-Friday </li>
                                    <li>All plumbing related issues e.g. showers, WCs, bath, sinks, taps, water softeners, accumulators, booster mains</li>
                                    <li>Drains, waste pipes etc </li>
                                    <li>Potterton Powermax, Chaffoteaux, Ferolli, Sabre, Alpha and Elm Le Blanc. We do not service or repair: solid fuel boilers, oil boilers, electric boilers, back boilers, or dual purpose boilers</li>
                                </ul>

                                <a href="javascript:void(0)" class="read-more-btn text-center text-decoration-none text-white">Read More</a>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Monthly Payment</h5>
                                <h4 class="text-center">£43 inc. Vat</h4>
                            </div>
                            <div class="col-md-5 modal-border p-3 mt-2 mx-2">
                                <h5 class="text-center">Upfront</h5>
                                <h4 class="text-center">£174 inc. Vat</h4>
                            </div>
                        </div>
                        <form class="plan-select-form d-flex justify-content-center align-items-center flex-column mt-3">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckChecked1" required>
                                    <label class="form-check-label text-white" for="flexCheckChecked1">
                                        By clicking here, I state that I have read and understood the <a class="text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#termsCondition2">terms and conditions.</a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked name="marketing" id="flexCheckChecked2">
                                    <label class="form-check-label text-white" for="flexCheckChecked2">
                                        Please send me energy saving tips, special offers and interesting local information by email. You can unsubscribe at any time
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="174">
                            <button type="submit" class="get-started-btn continue-btn">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="onboardingFeeModal" tabindex="-1" aria-labelledby="#onboardingFeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content p-3">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="custom-list-image">
                            <li>Unlike other boiler cover we like to get everything set up properly from the outset, we will complete a full boiler service including new burner seals and electrodes (service plans are tailored to your specific requirements) </li>
                            <li>Whole house heat loss survey</li>
                            <li>Boiler range rating </li>
                            <li>Hydronic radiator balancing using our bespoke balancing technique and the latest digital monitoring equipment, we have proven up to 15% energy saving using our technology. </li>
                            <li>Normally price without cover plan £385 inc VAT</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="callOutFeeModal" tabindex="-1" aria-labelledby="#callOutFeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="custom-list-image">
                            <li>We don’t charge a call out fee parts and labour are covered within your plan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-lg" id="termsCondition1" tabindex="-1" aria-labelledby="#termsCondition1Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content p-3 modal-dialog-scrollable">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#plan1Modal"></button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>
                                <strong>These terms</strong>
                                <ol>
                                    <li>
                                        <strong>What these terms cover.</strong> These are the terms and conditions on which we supply our Boiler Plan services to you (“service(s)”). These services provide you with an on-boarding service, an annual service and ongoing maintenance and repair in the event of a fault for your gas central heating boiler, radiators and valves, heating pipework, controls, hot water cylinder and tank as further detailed in our booklet. This also explains what is not covered and should be read in conjunction with these terms.
                                    </li>
                                    <li>
                                        <strong>Why you should read them.</strong> Please read these terms carefully before asking us to provide the services. These terms tell you who we are, how we will provide services to you, how you and we may change or end the contract, what to do if there is a problem and other important information. If you think that there is a mistake in these terms, please contact us to discuss.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Information about us and how to contact us</strong>
                                <ol>
                                    <li>
                                        <strong>Who we are.</strong> We are Chelmsford Gas Services Limited a company registered in England and Wales. Our company registration number is 07732487 and our registered office is at 227 Rutland Road Broomfield Chelmsford CM1 4BW. Our registered VAT number is 122 9800 28
                                    </li>
                                    <li>
                                        <strong>How to contact us.</strong> You can contact us by telephoning <a href="tel:01245251741">01245 251741</a> or by writing to us at <a href="mailto:info@chelmsfordgas.co.uk">info@chelmsfordgas.co.uk</a>.
                                    </li>
                                    <li>
                                        <strong>How we may contact you.</strong> If we have to contact you we will do so by telephone or by writing to you at the email address or postal address you provided to us in your order. You are responsible for keeping your contact details up to date and informing us of any change either to your personal details or your property address. <br> If you do not give us the correct information, we cannot provide the services to you.
                                    </li>
                                    <li>
                                        <strong>"Writing" includes emails.</strong> When we use the words "writing" or "written" in these terms, this includes email.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our contract with you</strong>
                                <ol>
                                    <li>
                                        <strong>How we will accept you for Boiler Plan.</strong> Our acceptance will take place when we tell you that we are able to provide you with the services, which we will also confirm in writing to you, at which point a contract will come into existence between you and us.
                                    </li>
                                    <li>
                                        <strong>If we cannot accept you for Boiler Plan.</strong> If we are unable to accept you for Boiler Plan, we will inform you of this. This might be because:
                                        <ul>
                                            <li>your boiler is not on our approved list, or </li>
                                            <li>replacement parts are not available for your boiler or heating system, or</li>
                                            <li>because we have identified an error in the price or description of the services, or</li>
                                            <li>you do not live in an area covered by our services, or</li>
                                            <li>your property is unfit or unsafe, or</li>
                                            <li>your property is not primarily for residential or domestic use. </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Your Boiler Plan number.</strong> We will assign a Boiler Plan number to you and tell you what it is when we accept your order. It will help us if you can tell us the Boiler Plan number whenever you contact us
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Your right to make changes.</strong>
                                <ol>
                                    <li>
                                        If you wish to make a change to the services, or to a boiler or appliance covered by the services or your address for delivery of the services, please contact us. We will let you know if the change is possible. If it is possible we will let you know about any changes to the price of the services, their timing or anything else which would be necessary as a result of your requested change and ask you to confirm whether you wish to go ahead with the change. If it is not possible to make the change, we reserve the right to cancel the contract
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our rights to make changes</strong>
                                <ol>
                                    <li>
                                        <strong>Minor changes to the services.</strong> We may change the services to reflect changes in relevant laws and regulatory requirements or to implement minor technical adjustments and improvements. These changes will not affect your use of the services.
                                    </li>
                                    <li>
                                        <strong>More significant changes to the services and these terms.</strong> In addition, we may make significant changes to these terms or the services, but if we do so we will notify you and you may then contact us to end the contract and receive a full refund before the changes take effect.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Providing the services</strong>
                                <ol>
                                    <li>
                                        <strong>What services will be provided</strong> If this is your first contract, you will receive an on- boarding service and the system health check as detailed in our booklet. Our engineer will also check that your boiler is on our approved list and the boiler, appliance or any central heating system does not have any inherent faults. If there are pre-existing faults, or the boiler is not approved then we will notify you of the steps required and cost in order to provide the services. You must notify us if your boiler is covered by an existing manufacturer’s warranty and, if required, confirm what insurance cover you hold. <br> Following a successful on boarding service, then approximately 12 months later you will receive an annual service at a time and date agreed with you in advance, for as long as you have a Boiler Plan contract. One of our engineers will attend your property to carry out the service in accordance with these terms.
                                    </li>
                                    <li>
                                        <strong>When we will provide the services.</strong> Your Boiler Plan will last for an initial 12 months and serviced between 31st March and 30th September
                                    </li>
                                    <li>
                                        We will contact you with a price for the next 12 months and if you choose to continue, then the contract will renew automatically. This process will repeat at the end of each 12 month period or until either you end the contract for the services as described in clause 7 or we end the contract by written notice to you as described in clause 8.
                                    </li>
                                    <li>
                                        <strong>We are not responsible for delays outside our control.</strong> If our performance of the services is affected by an event outside our control then we will contact you as soon as possible to let you know and we will take steps to minimise the effect of the delay. Provided we do this we will not be liable for delays caused by the event but if there is a risk of substantial delay you may contact us to end the contract and receive a refund for any services you have paid for but not received.
                                    </li>
                                    <li>
                                        <strong>If you do not allow us access to your property to provide services.</strong> If you do not allow us access to your property as arranged (and you do not have a good reason for this) or if you are a tenant and have not been permitted by the landlord to allow us access, we may charge you additional costs incurred by us as a result. If, despite our reasonable efforts, we are unable to contact you or re-arrange access to your property we may end the contract and clause 8 will apply.
                                    </li>
                                    <li>
                                        <strong>Working at your property.</strong> We will only provide services to you at your property if there is an adult present when our engineers are on site and that person is authorised to give instructions and receipt any paperwork required on your behalf. We might ask for a written authority. If there are any shared facilities, you must obtain consent for us to carry out the services.
                                    </li>
                                    <li>
                                        <strong>If you are a tenant,</strong> you must have the Landlord’s authority or approval for our engineers to access the property and to provide the services. Any relevant paperwork must be passed to that landlord by you. We will not contact that landlord direct unless they have a Boiler Plan with us.
                                    </li>
                                    <li>
                                        <strong>Hazardous or unsafe conditions.</strong> The services will only be provided if there is no health and safety risk to our engineers and we reserve the right to suspend services until any health and safety risk has been remedied to our reasonable satisfaction. If you verbally or physically abuse our engineers, they will stop work and leave the property.
                                    </li>
                                    <li>
                                        <strong>What will happen if you do not provide required information to us.</strong> We may need certain information from you so that we can provide the services to you, for example, your full contact details, if the property is tenanted and whether or not the boiler is covered by a manufacturer’s warranty. <br> We will contact you to ask for this information. If you do not, within a reasonable time of us asking for it, provide us with this information, or you provide us with incomplete or incorrect information, we may either end the contract (see clause 8.1) or make an additional charge of a reasonable sum to compensate us for any extra work that is required as a result. We will not be responsible for providing the services late or not providing any part of them if this is caused by you not giving us the information we need within a reasonable time of us asking for it.
                                    </li>
                                    <li>
                                        <strong>Reasons we may suspend the services.</strong> We may have to suspend the services to:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>deal with technical problems or make minor technical changes;</li>
                                            <li>update the services to reflect changes in relevant laws and regulatory requirements;</li>
                                            <li>make changes to the services as requested by you or notified by us to you (see clause 5).</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>We may also suspend the services if you do not pay.</strong> If you do not pay us for the services when you are supposed to (see clause 10.4) or you cancel the direct debit and you still do not make payment within 14 days of us reminding you that payment is due, we may suspend the services until you have paid us the outstanding amounts. We will contact you to tell you we are suspending the services. As well as suspending the services we can also charge you interest on your overdue payments (see clause 10.5).
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Your rights to end the contract</strong>
                                <ol>
                                    <li>
                                        <strong>You can always end the contract within 14 days of the order.</strong> You may contact us at any time within 14 days of the date of our acceptance of you to Boiler Plan to end the contract for the services (cooling off period), or at a later date but in some circumstances we may charge you certain sums for doing so, as described below. This is in accordance with your statutory rights of cancellation.
                                    </li>
                                    <li>
                                        <strong>What happens if you have good reason for ending the contract. </strong> If you are ending the contract for a reason set out at (a) to (e) below the contract will end immediately and we will refund you in full for any services which have not been provided or have not been properly provided. The relevant reasons are:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>we have told you about an upcoming substantial change to the services or these terms which you do not agree to (see clause 5.2);</li>
                                            <li>we have told you about an error in the price or description of the services you have ordered and you do not wish to proceed;</li>
                                            <li>there is a risk the services may be significantly delayed because of events outside our control;</li>
                                            <li>we suspend the services for technical reasons, or notify you are going to suspend them for technical reasons, in each case for a period of more than [28 Days]; or</li>
                                            <li>you have a legal right to end the contract because of something we have done wrong. </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>What happens if you end the contract without a good reason.</strong> Unless you have a right to end the contract immediately (see clause 7.2), the contract will not end until the end of each 12 month period of the contract. You can serve notice to end the contract before that date, but the notice will only take effect on an anniversary of the contract and no refunds will be given for early termination.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our rights to end the contract</strong>
                                <ol>
                                    <li>
                                        <strong>We may end the contract if you break it.</strong> We may end the contract at any time by writing to you if:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>you do not make any payment to us when it is due and you still do not make payment within 14 days of us reminding you that payment is due;</li>
                                            <li>you stop your direct debit payments to us, or</li>
                                            <li>you do not, within a reasonable time, give us access to your property to enable us to provide the services to you; or</li>
                                            <li>you have verbally or physically abused our engineers or staff, or</li>
                                            <li>there is a pre-existing fault discovered during the first service, or</li>
                                            <li>there is an unacceptable health and safety risk.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>You must compensate us if you break the contract.</strong> If we end the contract in the situations set out in clause 8.1 we will refund any money you have paid in advance for services we have not provided but we may deduct or charge you reasonable compensation for the net costs we will incur as a result of your breaking the contract.
                                    </li>
                                    <li>
                                        <strong>We may stop providing the services.</strong> We may write to you to let you know that we are going to stop providing the services. We will let you know at least [PERIOD] in advance of our stopping the services and will refund any sums you have paid in advance for services which will not be provided.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>If there is a problem with the services</strong>
                                <ol>
                                    <li>
                                        <strong>How to tell us about problems.</strong> If you have any questions or complaints about the services, please contact us.
                                    </li>
                                    <li>
                                        <strong>Summary of your legal rights.</strong> See the box below for a summary of your key legal rights in relation to the services. Nothing in these terms will affect your legal rights. <br>
                                        <p class="small"><strong>Summary of your key legal rights </strong><br>
                                            This is a summary of your key legal rights. These are subject to certain exceptions. For detailed information please visit the Citizens Advice website www.adviceguide.org.uk or call 03454 04 05 06.
                                            The Consumer Rights Act 2015 says:
                                        </p>
                                        <ul class="small">
                                            <li>you can ask us to repeat or fix a service if it's not carried out with reasonable care and skill, or get some money back if we can't fix it.</li>
                                            <li>if you haven't agreed a price beforehand, what you're asked to pay must be reasonable.</li>
                                            <li>if you haven't agreed a time beforehand, it must be carried out within a reasonable time.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Our guarantee in addition to your legal rights.</strong> We offer a 12 month guarantee on any parts fitted by our engineers from the date we complete the work which is in addition to your legal rights (as described in clause 9.2) and does not affect them. In the unlikely event there is any defect with part supplied we will use every effort to repair or fix the defect free of charge, without significant inconvenience to you, as soon as we reasonably can.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Price and payment</strong>
                                <ol>
                                    <li>
                                        <strong>Where to find the price for the services.</strong> The price of the services (which includes VAT) will be the price set out in our price list in force at the date of your order unless we have agreed another price in writing. The price might change if you add on extra products, such as an additional boiler or heating system but we will agree that price change with you. We take all reasonable care to ensure that the prices of services advised to you are correct. However please see clause 10.3 for what happens if we discover an error in the price of the services you order.
                                    </li>
                                    <li>
                                        <strong>We will pass on changes in the rate of VAT. </strong> If the rate of VAT changes between your order date and the date we provide the services, we will adjust the rate of VAT that you pay, unless you have already paid for the services in full before the change in the rate of VAT takes effect.
                                    </li>
                                    <li>
                                        <strong>What happens if we got the price wrong. </strong> It is always possible that, despite our best efforts, some of the services we sell may be incorrectly priced. We will normally check prices before accepting your order and will contact you for your instructions before we accept your order, if there is a mistake.
                                    </li>
                                    <li>
                                        <strong>When you must pay and how you must pay. </strong> You must pay for the services in advance by monthly direct debit. Payments by direct debit will renew every year unless the contract ends.
                                    </li>
                                    <li>
                                        <strong>We can charge interest if you pay late. </strong> . If you do not make any payment to us by the due date (see clause 10.4) we may charge interest to you on the overdue amount at the rate of 5% a year above the base lending rate of Nat West Bank plc from time to time. This interest shall accrue on a daily basis from the due date until the date of actual payment of the overdue amount, whether before or after judgment. You must pay us interest together with any overdue amount.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our responsibility for loss or damage suffered by you</strong>
                                <ol>
                                    <li>
                                        <strong>We are responsible to you for foreseeable loss and damage caused by us.</strong> If we fail to comply with these terms, we are responsible for loss or damage you suffer that is a foreseeable result of our breaking this contract or our failing to use reasonable care and skill, but we are not responsible for any loss or damage that is not foreseeable. Loss or damage is foreseeable if either it is obvious that it will happen or if, at the time the contract was made, both we and you knew it might happen, for example, if you discussed it with us during the service.
                                    </li>
                                    <li>
                                        <strong>We do not exclude or limit in any way our liability to you where it would be unlawful to do so.</strong> This includes liability for death or personal injury caused by our negligence or the negligence of our employees, agents or subcontractors; for fraud or fraudulent misrepresentation; for breach of your legal rights in relation to the services including the right to receive services which are as described and supplied with reasonable skill and care.
                                    </li>
                                    <li>
                                        <strong>When we are liable for damage to your property.</strong> If we are providing services in your property, we will make good any damage to your property caused by us while doing so. However, we are not responsible for the cost of repairing any pre-existing faults or damage to your property that we discover while providing the services or not caused by us. We are not responsible for any reinstatement works including but not limited to, decorating, tiles or replacing ductwork.
                                    </li>
                                    <li>
                                        <strong>We are not liable for business losses.</strong> We only supply the services for domestic and private use. If you use the services for any commercial, business or re-sale purpose we will have no liability to you for any loss of profit, loss of business, business interruption, or loss of business opportunity.
                                    </li>
                                    <li>
                                        <strong>We are not responsible for communications.</strong> We will have no liability for any loss or damage caused by interference with any software, Internet communications, wireless signals, transmission of data or Internet connection and we will not be responsible for repairing or replacing any software or hardware or communications equipment or connectivity through these media and equipment and their control of your boiler or heating system.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>How we may use your personal information</strong>
                                <ol>
                                    <li>
                                        <strong>How we will use your personal information.</strong> If we fail to comply with these terms, we are responsible for loss or damage you suffer that is a foreseeable result of our breaking this contract or our failing to use reasonable care and skill, but we are not responsible for any loss or damage that is not foreseeable. Loss or damage is foreseeable if either it is obvious that it will happen or if, at the time the contract was made, both we and you knew it might happen, for example, if you discussed it with us during the service.We will use the personal information you provide to us to:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>provide the services;</li>
                                            <li> process your payment for such services; and</li>
                                            <li> if you agreed to this during the order process, to inform you about similar products that we provide, but you may stop receiving these communications at any time by contacting us.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>We will only give your personal information to third parties where the law either requires or allows us to do so.</strong> Please refer to our Privacy Policy for details on how we use and retain your personal data. <a href="https://chelmsfordgasservices.co.uk/privacy-policy/" target="_blank">privacy policy</a>.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Other important terms</strong>
                                <ol>
                                    <li>
                                        <strong>We may transfer this agreement to someone else.</strong> We may transfer this agreement to someone else.
                                    </li>
                                    <li>
                                        <strong>Nobody else has any rights under this contract.</strong> This contract is between you and us. No other person shall have any rights to enforce any of its terms. Neither of us will need the consent of any person to end the contract or make any changes to these terms.
                                    </li>
                                    <li>
                                        <strong>If a court finds part of this contract illegal, the rest will continue in force.</strong> Each of the paragraphs of these terms operates separately. If any court or relevant authority decides that any of them are unlawful, the remaining paragraphs will remain in full force and effect.
                                    </li>
                                    <li>
                                        <strong>Even if we delay in enforcing this contract, we can still enforce it later.</strong> If we do not insist immediately that you do anything you are required to do under these terms, or if we delay in taking steps against you in respect of your breaking this contract, that will not mean that you do not have to do those things or prevent us taking steps against you at a later date. For example, if you miss a payment and we do not chase you but we continue to provide the services, we can still require you to make the payment at a later date.
                                    </li>
                                    <li>
                                        <strong>Which laws apply to this contract and where you may bring legal proceedings.</strong>These terms are governed by English law and you can bring legal proceedings in respect of the services in the English courts.
                                    </li>
                                    <li>
                                        <strong>Complaints.</strong> If you are dissatisfied with any part of our service, please contact us in the first instance by telephone on <a href="tel:01245251741">01245 251741</a> or writing to us at <a href="https://chelmsfordgas.co.uk/complaints" target="_blank">complaints</a> or Chelmsford Gas Services Customer Relations 227 Rutland Road Chelmsford Essex CM1 4BW. We will do our best to resolve your complaint as soon as possible but if we need more information or time to investigate, we will let you know. If you are not satisfied with our final response you can refer to alternative dispute resolution.
                                    </li>
                                    <li>
                                        <strong>Alternative dispute resolution.</strong> Alternative dispute resolution is a process where an independent body considers the facts of a dispute and seeks to resolve it, without you having to go to court. If you are not happy with how we have handled any complaint, you may want to contact the alternative dispute resolution provider we use. You can submit a complaint to Utilities ADR via their website at <a href="https://www.utilitiesadr.co.uk" target="_blank">https://www.utilitiesadr.co.uk</a>.
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#plan1Modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-lg" id="termsCondition2" tabindex="-1" aria-labelledby="#termsCondition2Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content p-3 modal-dialog-scrollable">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#plan2Modal"></button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>
                                <strong>These terms</strong>
                                <ol>
                                    <li>
                                        <strong>What these terms cover.</strong> These are the terms and conditions on which we supply our Boiler Plan services to you (“service(s)”). These services provide you with an on-boarding service, an annual service and ongoing maintenance and repair in the event of a fault for your gas central heating boiler, radiators and valves, heating pipework, controls, hot water cylinder and tank as further detailed in our booklet. This also explains what is not covered and should be read in conjunction with these terms.
                                    </li>
                                    <li>
                                        <strong>Why you should read them.</strong> Please read these terms carefully before asking us to provide the services. These terms tell you who we are, how we will provide services to you, how you and we may change or end the contract, what to do if there is a problem and other important information. If you think that there is a mistake in these terms, please contact us to discuss.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Information about us and how to contact us</strong>
                                <ol>
                                    <li>
                                        <strong>Who we are.</strong> We are Chelmsford Gas Services Limited a company registered in England and Wales. Our company registration number is 07732487 and our registered office is at 227 Rutland Road Broomfield Chelmsford CM1 4BW. Our registered VAT number is 122 9800 28
                                    </li>
                                    <li>
                                        <strong>How to contact us.</strong> You can contact us by telephoning <a href="tel:01245251741">01245 251741</a> or by writing to us at <a href="mailto:info@chelmsfordgas.co.uk">info@chelmsfordgas.co.uk</a>.
                                    </li>
                                    <li>
                                        <strong>How we may contact you.</strong> If we have to contact you we will do so by telephone or by writing to you at the email address or postal address you provided to us in your order. You are responsible for keeping your contact details up to date and informing us of any change either to your personal details or your property address. <br> If you do not give us the correct information, we cannot provide the services to you.
                                    </li>
                                    <li>
                                        <strong>"Writing" includes emails.</strong> When we use the words "writing" or "written" in these terms, this includes email.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our contract with you</strong>
                                <ol>
                                    <li>
                                        <strong>How we will accept you for Boiler Plan.</strong> Our acceptance will take place when we tell you that we are able to provide you with the services, which we will also confirm in writing to you, at which point a contract will come into existence between you and us.
                                    </li>
                                    <li>
                                        <strong>If we cannot accept you for Boiler Plan.</strong> If we are unable to accept you for Boiler Plan, we will inform you of this. This might be because:
                                        <ul>
                                            <li>your boiler is not on our approved list, or </li>
                                            <li>replacement parts are not available for your boiler or heating system, or</li>
                                            <li>because we have identified an error in the price or description of the services, or</li>
                                            <li>you do not live in an area covered by our services, or</li>
                                            <li>your property is unfit or unsafe, or</li>
                                            <li>your property is not primarily for residential or domestic use. </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Your Boiler Plan number.</strong> We will assign a Boiler Plan number to you and tell you what it is when we accept your order. It will help us if you can tell us the Boiler Plan number whenever you contact us
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Your right to make changes.</strong>
                                <ol>
                                    <li>
                                        If you wish to make a change to the services, or to a boiler or appliance covered by the services or your address for delivery of the services, please contact us. We will let you know if the change is possible. If it is possible we will let you know about any changes to the price of the services, their timing or anything else which would be necessary as a result of your requested change and ask you to confirm whether you wish to go ahead with the change. If it is not possible to make the change, we reserve the right to cancel the contract
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our rights to make changes</strong>
                                <ol>
                                    <li>
                                        <strong>Minor changes to the services.</strong> We may change the services to reflect changes in relevant laws and regulatory requirements or to implement minor technical adjustments and improvements. These changes will not affect your use of the services.
                                    </li>
                                    <li>
                                        <strong>More significant changes to the services and these terms.</strong> In addition, we may make significant changes to these terms or the services, but if we do so we will notify you and you may then contact us to end the contract and receive a full refund before the changes take effect.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Providing the services</strong>
                                <ol>
                                    <li>
                                        <strong>What services will be provided</strong> If this is your first contract, you will receive an on- boarding service and the system health check as detailed in our booklet. Our engineer will also check that your boiler is on our approved list and the boiler, appliance or any central heating system does not have any inherent faults. If there are pre-existing faults, or the boiler is not approved then we will notify you of the steps required and cost in order to provide the services. You must notify us if your boiler is covered by an existing manufacturer’s warranty and, if required, confirm what insurance cover you hold. <br> Following a successful on boarding service, then approximately 12 months later you will receive an annual service at a time and date agreed with you in advance, for as long as you have a Boiler Plan contract. One of our engineers will attend your property to carry out the service in accordance with these terms.
                                    </li>
                                    <li>
                                        <strong>When we will provide the services.</strong> Your Boiler Plan will last for an initial 12 months and serviced between 31st March and 30th September
                                    </li>
                                    <li>
                                        We will contact you with a price for the next 12 months and if you choose to continue, then the contract will renew automatically. This process will repeat at the end of each 12 month period or until either you end the contract for the services as described in clause 7 or we end the contract by written notice to you as described in clause 8.
                                    </li>
                                    <li>
                                        <strong>We are not responsible for delays outside our control.</strong> If our performance of the services is affected by an event outside our control then we will contact you as soon as possible to let you know and we will take steps to minimise the effect of the delay. Provided we do this we will not be liable for delays caused by the event but if there is a risk of substantial delay you may contact us to end the contract and receive a refund for any services you have paid for but not received.
                                    </li>
                                    <li>
                                        <strong>If you do not allow us access to your property to provide services.</strong> If you do not allow us access to your property as arranged (and you do not have a good reason for this) or if you are a tenant and have not been permitted by the landlord to allow us access, we may charge you additional costs incurred by us as a result. If, despite our reasonable efforts, we are unable to contact you or re-arrange access to your property we may end the contract and clause 8 will apply.
                                    </li>
                                    <li>
                                        <strong>Working at your property.</strong> We will only provide services to you at your property if there is an adult present when our engineers are on site and that person is authorised to give instructions and receipt any paperwork required on your behalf. We might ask for a written authority. If there are any shared facilities, you must obtain consent for us to carry out the services.
                                    </li>
                                    <li>
                                        <strong>If you are a tenant,</strong> you must have the Landlord’s authority or approval for our engineers to access the property and to provide the services. Any relevant paperwork must be passed to that landlord by you. We will not contact that landlord direct unless they have a Boiler Plan with us.
                                    </li>
                                    <li>
                                        <strong>Hazardous or unsafe conditions.</strong> The services will only be provided if there is no health and safety risk to our engineers and we reserve the right to suspend services until any health and safety risk has been remedied to our reasonable satisfaction. If you verbally or physically abuse our engineers, they will stop work and leave the property.
                                    </li>
                                    <li>
                                        <strong>What will happen if you do not provide required information to us.</strong> We may need certain information from you so that we can provide the services to you, for example, your full contact details, if the property is tenanted and whether or not the boiler is covered by a manufacturer’s warranty. <br> We will contact you to ask for this information. If you do not, within a reasonable time of us asking for it, provide us with this information, or you provide us with incomplete or incorrect information, we may either end the contract (see clause 8.1) or make an additional charge of a reasonable sum to compensate us for any extra work that is required as a result. We will not be responsible for providing the services late or not providing any part of them if this is caused by you not giving us the information we need within a reasonable time of us asking for it.
                                    </li>
                                    <li>
                                        <strong>Reasons we may suspend the services.</strong> We may have to suspend the services to:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>deal with technical problems or make minor technical changes;</li>
                                            <li>update the services to reflect changes in relevant laws and regulatory requirements;</li>
                                            <li>make changes to the services as requested by you or notified by us to you (see clause 5).</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>We may also suspend the services if you do not pay.</strong> If you do not pay us for the services when you are supposed to (see clause 10.4) or you cancel the direct debit and you still do not make payment within 14 days of us reminding you that payment is due, we may suspend the services until you have paid us the outstanding amounts. We will contact you to tell you we are suspending the services. As well as suspending the services we can also charge you interest on your overdue payments (see clause 10.5).
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Your rights to end the contract</strong>
                                <ol>
                                    <li>
                                        <strong>You can always end the contract within 14 days of the order.</strong> You may contact us at any time within 14 days of the date of our acceptance of you to Boiler Plan to end the contract for the services (cooling off period), or at a later date but in some circumstances we may charge you certain sums for doing so, as described below. This is in accordance with your statutory rights of cancellation.
                                    </li>
                                    <li>
                                        <strong>What happens if you have good reason for ending the contract. </strong> If you are ending the contract for a reason set out at (a) to (e) below the contract will end immediately and we will refund you in full for any services which have not been provided or have not been properly provided. The relevant reasons are:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>we have told you about an upcoming substantial change to the services or these terms which you do not agree to (see clause 5.2);</li>
                                            <li>we have told you about an error in the price or description of the services you have ordered and you do not wish to proceed;</li>
                                            <li>there is a risk the services may be significantly delayed because of events outside our control;</li>
                                            <li>we suspend the services for technical reasons, or notify you are going to suspend them for technical reasons, in each case for a period of more than [28 Days]; or</li>
                                            <li>you have a legal right to end the contract because of something we have done wrong. </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>What happens if you end the contract without a good reason.</strong> Unless you have a right to end the contract immediately (see clause 7.2), the contract will not end until the end of each 12 month period of the contract. You can serve notice to end the contract before that date, but the notice will only take effect on an anniversary of the contract and no refunds will be given for early termination.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our rights to end the contract</strong>
                                <ol>
                                    <li>
                                        <strong>We may end the contract if you break it.</strong> We may end the contract at any time by writing to you if:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>you do not make any payment to us when it is due and you still do not make payment within 14 days of us reminding you that payment is due;</li>
                                            <li>you stop your direct debit payments to us, or</li>
                                            <li>you do not, within a reasonable time, give us access to your property to enable us to provide the services to you; or</li>
                                            <li>you have verbally or physically abused our engineers or staff, or</li>
                                            <li>there is a pre-existing fault discovered during the first service, or</li>
                                            <li>there is an unacceptable health and safety risk.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>You must compensate us if you break the contract.</strong> If we end the contract in the situations set out in clause 8.1 we will refund any money you have paid in advance for services we have not provided but we may deduct or charge you reasonable compensation for the net costs we will incur as a result of your breaking the contract.
                                    </li>
                                    <li>
                                        <strong>We may stop providing the services.</strong> We may write to you to let you know that we are going to stop providing the services. We will let you know at least [PERIOD] in advance of our stopping the services and will refund any sums you have paid in advance for services which will not be provided.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>If there is a problem with the services</strong>
                                <ol>
                                    <li>
                                        <strong>How to tell us about problems.</strong> If you have any questions or complaints about the services, please contact us.
                                    </li>
                                    <li>
                                        <strong>Summary of your legal rights.</strong> See the box below for a summary of your key legal rights in relation to the services. Nothing in these terms will affect your legal rights. <br>
                                        <p class="small"><strong>Summary of your key legal rights </strong><br>
                                            This is a summary of your key legal rights. These are subject to certain exceptions. For detailed information please visit the Citizens Advice website www.adviceguide.org.uk or call 03454 04 05 06.
                                            The Consumer Rights Act 2015 says:
                                        </p>
                                        <ul class="small">
                                            <li>you can ask us to repeat or fix a service if it's not carried out with reasonable care and skill, or get some money back if we can't fix it.</li>
                                            <li>if you haven't agreed a price beforehand, what you're asked to pay must be reasonable.</li>
                                            <li>if you haven't agreed a time beforehand, it must be carried out within a reasonable time.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Our guarantee in addition to your legal rights.</strong> We offer a 12 month guarantee on any parts fitted by our engineers from the date we complete the work which is in addition to your legal rights (as described in clause 9.2) and does not affect them. In the unlikely event there is any defect with part supplied we will use every effort to repair or fix the defect free of charge, without significant inconvenience to you, as soon as we reasonably can.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Price and payment</strong>
                                <ol>
                                    <li>
                                        <strong>Where to find the price for the services.</strong> The price of the services (which includes VAT) will be the price set out in our price list in force at the date of your order unless we have agreed another price in writing. The price might change if you add on extra products, such as an additional boiler or heating system but we will agree that price change with you. We take all reasonable care to ensure that the prices of services advised to you are correct. However please see clause 10.3 for what happens if we discover an error in the price of the services you order.
                                    </li>
                                    <li>
                                        <strong>We will pass on changes in the rate of VAT. </strong> If the rate of VAT changes between your order date and the date we provide the services, we will adjust the rate of VAT that you pay, unless you have already paid for the services in full before the change in the rate of VAT takes effect.
                                    </li>
                                    <li>
                                        <strong>What happens if we got the price wrong. </strong> It is always possible that, despite our best efforts, some of the services we sell may be incorrectly priced. We will normally check prices before accepting your order and will contact you for your instructions before we accept your order, if there is a mistake.
                                    </li>
                                    <li>
                                        <strong>When you must pay and how you must pay. </strong> You must pay for the services in advance by monthly direct debit. Payments by direct debit will renew every year unless the contract ends.
                                    </li>
                                    <li>
                                        <strong>We can charge interest if you pay late. </strong> . If you do not make any payment to us by the due date (see clause 10.4) we may charge interest to you on the overdue amount at the rate of 5% a year above the base lending rate of Nat West Bank plc from time to time. This interest shall accrue on a daily basis from the due date until the date of actual payment of the overdue amount, whether before or after judgment. You must pay us interest together with any overdue amount.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>Our responsibility for loss or damage suffered by you</strong>
                                <ol>
                                    <li>
                                        <strong>We are responsible to you for foreseeable loss and damage caused by us.</strong> If we fail to comply with these terms, we are responsible for loss or damage you suffer that is a foreseeable result of our breaking this contract or our failing to use reasonable care and skill, but we are not responsible for any loss or damage that is not foreseeable. Loss or damage is foreseeable if either it is obvious that it will happen or if, at the time the contract was made, both we and you knew it might happen, for example, if you discussed it with us during the service.
                                    </li>
                                    <li>
                                        <strong>We do not exclude or limit in any way our liability to you where it would be unlawful to do so.</strong> This includes liability for death or personal injury caused by our negligence or the negligence of our employees, agents or subcontractors; for fraud or fraudulent misrepresentation; for breach of your legal rights in relation to the services including the right to receive services which are as described and supplied with reasonable skill and care.
                                    </li>
                                    <li>
                                        <strong>When we are liable for damage to your property.</strong> If we are providing services in your property, we will make good any damage to your property caused by us while doing so. However, we are not responsible for the cost of repairing any pre-existing faults or damage to your property that we discover while providing the services or not caused by us. We are not responsible for any reinstatement works including but not limited to, decorating, tiles or replacing ductwork.
                                    </li>
                                    <li>
                                        <strong>We are not liable for business losses.</strong> We only supply the services for domestic and private use. If you use the services for any commercial, business or re-sale purpose we will have no liability to you for any loss of profit, loss of business, business interruption, or loss of business opportunity.
                                    </li>
                                    <li>
                                        <strong>We are not responsible for communications.</strong> We will have no liability for any loss or damage caused by interference with any software, Internet communications, wireless signals, transmission of data or Internet connection and we will not be responsible for repairing or replacing any software or hardware or communications equipment or connectivity through these media and equipment and their control of your boiler or heating system.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <strong>How we may use your personal information</strong>
                                <ol>
                                    <li>
                                        <strong>How we will use your personal information.</strong> If we fail to comply with these terms, we are responsible for loss or damage you suffer that is a foreseeable result of our breaking this contract or our failing to use reasonable care and skill, but we are not responsible for any loss or damage that is not foreseeable. Loss or damage is foreseeable if either it is obvious that it will happen or if, at the time the contract was made, both we and you knew it might happen, for example, if you discussed it with us during the service.We will use the personal information you provide to us to:
                                        <ul style="list-style-type: lower-alpha">
                                            <li>provide the services;</li>
                                            <li> process your payment for such services; and</li>
                                            <li> if you agreed to this during the order process, to inform you about similar products that we provide, but you may stop receiving these communications at any time by contacting us.</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>We will only give your personal information to third parties where the law either requires or allows us to do so.</strong> Please refer to our Privacy Policy for details on how we use and retain your personal data. <a href="https://chelmsfordgasservices.co.uk/privacy-policy/" target="_blank">privacy policy</a>.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Other important terms</strong>
                                <ol>
                                    <li>
                                        <strong>We may transfer this agreement to someone else.</strong> We may transfer this agreement to someone else.
                                    </li>
                                    <li>
                                        <strong>Nobody else has any rights under this contract.</strong> This contract is between you and us. No other person shall have any rights to enforce any of its terms. Neither of us will need the consent of any person to end the contract or make any changes to these terms.
                                    </li>
                                    <li>
                                        <strong>If a court finds part of this contract illegal, the rest will continue in force.</strong> Each of the paragraphs of these terms operates separately. If any court or relevant authority decides that any of them are unlawful, the remaining paragraphs will remain in full force and effect.
                                    </li>
                                    <li>
                                        <strong>Even if we delay in enforcing this contract, we can still enforce it later.</strong> If we do not insist immediately that you do anything you are required to do under these terms, or if we delay in taking steps against you in respect of your breaking this contract, that will not mean that you do not have to do those things or prevent us taking steps against you at a later date. For example, if you miss a payment and we do not chase you but we continue to provide the services, we can still require you to make the payment at a later date.
                                    </li>
                                    <li>
                                        <strong>Which laws apply to this contract and where you may bring legal proceedings.</strong>These terms are governed by English law and you can bring legal proceedings in respect of the services in the English courts.
                                    </li>
                                    <li>
                                        <strong>Complaints.</strong> If you are dissatisfied with any part of our service, please contact us in the first instance by telephone on <a href="tel:01245251741">01245 251741</a> or writing to us at <a href="https://chelmsfordgas.co.uk/complaints" target="_blank">complaints</a> or Chelmsford Gas Services Customer Relations 227 Rutland Road Chelmsford Essex CM1 4BW. We will do our best to resolve your complaint as soon as possible but if we need more information or time to investigate, we will let you know. If you are not satisfied with our final response you can refer to alternative dispute resolution.
                                    </li>
                                    <li>
                                        <strong>Alternative dispute resolution.</strong> Alternative dispute resolution is a process where an independent body considers the facts of a dispute and seeks to resolve it, without you having to go to court. If you are not happy with how we have handled any complaint, you may want to contact the alternative dispute resolution provider we use. You can submit a complaint to Utilities ADR via their website at <a href="https://www.utilitiesadr.co.uk" target="_blank">https://www.utilitiesadr.co.uk</a>.
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#plan2Modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
