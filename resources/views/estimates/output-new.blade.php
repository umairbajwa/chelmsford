@php
// dd($productTypes);
$default = isset($productTypes['default']) ? $productTypes['default'] : NULL;
$water = isset($productTypes['water']) ? $productTypes['water'] : NULL;
$recommended = isset($productTypes['recommend']) ? $productTypes['recommend'] : [];
// dd($subtotalTotal,$default->updated_price,$default->price,$water->updated_price,$water->price);
$totalPrice = $subtotalTotal+$default->updated_price;
$originalPrice = $subtotalTotal+$default->price;
$recomenTotalPrice = [];
if($recommended){
    foreach ($recommended as $key => $value) {
        $recommendOriginalPrice[] = $subtotalTotal+$value->price;
        $recomenTotalPrice[] = $subtotalTotal+$value->updated_price;
    }
}
if($water){
    $totalPrice += $water->updated_price;
    $originalPrice += $water->price;
    if(count($recomenTotalPrice) > 0){
        foreach ($recomenTotalPrice as $k => $price) {
            $recomenTotalPrice[$k] += $water->updated_price;
            $recommendOriginalPrice[$k] += $water->price;
        }
    }
}
$additionalClass = ($default->iscombi != 5 && $default->iscombi != 6) ? '' : 'additional-product';
@endphp

@extends('layouts.app',['nobar' => 1])

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
@endsection


@section('content')
@php
    $setting = App\AdminSetting::orderBy('created_at', 'DESC')->first();
@endphp
<!--Body Start-->
<section class="fuel-type your-estimate">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="col-md-12 text-center mb-2">
                    <a href="{{ url('/') }}" class="custom-button d-inline-block">Start Over</a>
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="heading-prime">Your Estimate @if($setting->kw) (KW {{ $kw }}) @endif</h2>
                <p class="text-des mb-3">By selecting a package, you are not committing to a price, we just need to know what your preferred selection would be.</p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12 recomended-option">
                <div class="label-recomended">
                    <p class="recommend-label-text" id="recommened-text"> Recommened</p>
                </div>
                <div class="estimate-box">
                    <div class="box-line product-{{ $default->id }} {{ $additionalClass }}">
                        <div class="left-img-box position-relative">
                            <img class="img-fluid default-image" src="{{ url('/storage/products/'. $default->image) }}" alt="img">
                            <i class="fas fa-eye text-white zoom-image"></i>
                        </div>
                        <div class="right-content-box">
                            <h4 class="heading"><span class="default-name">{{ $default->product_name }}</span> <span class="single-product-price default-product-price">£{{ number_format($default->updated_price + $totalForBoiler, 2) }}</span></h4>
                            <p class="text-c line-light default-description" data-description="{{ substr(nl2br($default->shortdescription), 0, 301) }}">
                                {!! substr(nl2br($default->shortdescription), 0, 301) !!}
                                <a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="{{  $default->id }}" data-price="{{  $default->updated_price + $totalForBoiler }}">More Info</a>
                            </p>
                            {!! $subTotalRows !!}
                        </div>
                        <div class="hide" id="default-details" data-tagtext="Recommened" data-productid="{{ $default->id }}" data-shortdescription="{{ substr(nl2br($default->shortdescription), 0, 100) }}" data-name="{{ $default->product_name }}" data-originalprice="{{ $originalPrice }}" data-totalprice="{{ $totalPrice }}" data-image="{{ url('/storage/products/'. $default->image) }}" data-singleprice="{{ $default->updated_price + $totalForBoiler }}"></div>
                        <input type="hidden" class="originalprice default-total-price" value="{{ $totalPrice }}"><input type="hidden" id="withExtras" value="0">
                    </div>
                    @if ($water)
                    <div class="box-line">
                        <div class="left-img-box position-relative bg-white border border-grey">
                            <img class="img-fluid" src="{{ url('/storage/products/'. $water->image) }}" alt="img">
                            <i class="fas fa-eye text-white zoom-image"></i>
                        </div>
                        <div class="right-content-box">
                            <h4 class="heading">{{ $water->product_name }} <span class="single-product-price">£{{ number_format($water->updated_price,2) }}</span></h4>
                            <p class="text-c line-light">
                                {{ substr(nl2br($water->shortdescription), 0, 301) }}
                                <a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="{{ $water->id }}" data-price="{{ $water->updated_price }}">More Info</a>
                            </p>
                        </div>
                    </div>
                    @endif
                    <div class="estimate-detail">
                        <h3 class="price"><span class="default-original-price @if($originalPrice <= $totalPrice) hide  @endif" style="font-size: 14px;text-decoration: line-through;margin-right:15px">£{{ number_format($originalPrice,2) }}</span> <span class="default-discounted-price">£{{ number_format($totalPrice, 2) }}</span> <span class="ml-1"> (inc. VAT and labour)</span> </h3>
                        <div class="right-btn-estimate">
                            <button type="button" class="btn-estimate-book proceed-btn">Proceed</button>
                            <a href="javascript:void(0)" id="seefinanceButton" data-toggle="modal" data-target="#finance-extraModal" data-productid="{{ $default->id }}" data-price="{{ $default->updated_price + $totalForBoiler }}">See Finance Options</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 box-position">
                @if ($recommended)
                @foreach ($recommended as $index => $recom)
                <div class="label-other-options">
                    <p class="other-option-text" id="other-text{{$recom->id}}"> Other Option</p>
                </div>
                <div class="recomended-box">
                    <div class="box-line">
                    <div class="left-img-box position-relative">
                        <img class="img-fluid other-option-image" src="{{ url('/storage/products/'. $recom->image) }}" alt="img-fluid">
                        <i class="fas fa-eye text-white zoom-image"></i>
                    </div>
                    <div class="right-content-box ">
                        <h4 class="reco-heading"><span class="other-option-name">{{ $recom->product_name }}</span><span class="single-product-price">£{{ number_format($recom->updated_price + $totalForBoiler, 2) }}</span></h4>
                        <p class="text-c line-light other-option-description">
                            {!! substr(nl2br($recom->shortdescription), 0, 100) !!}
                            <a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="{{ $recom->id }}" data-price="{{ $recom->updated_price + $totalForBoiler }}">More Info</a>
                        </p>
                        {!! $subTotalRows !!}
                    </div>
                    </div>
                    <div class="estimate-detail">
                        <h3 class="price"> <span class="other-option-original-price @if($recommendOriginalPrice <= $recomenTotalPrice) hide @endif" style="font-size: 14px;text-decoration: line-through;margin-right:15px">£{{ number_format($recommendOriginalPrice[$index], 2) }}</span> <span class="other-option-discounted-price">£{{ number_format($recomenTotalPrice[$index], 2)  }}</span> <span class="ml-1"> (inc. VAT and labour)</span> </h3>
                        <div class="right-btn-estimate">
                            <button type="button" class="select-recommended btn-estimate-book"  data-tagtext="Other Option" data-productid="{{ $recom->id }}" data-shortdescription="{{ substr(nl2br($recom->shortdescription), 0, 100) }}" data-name="{{ $recom->product_name }}" data-originalprice="{{ $recommendOriginalPrice[$index] }}" data-totalprice="{{ $recomenTotalPrice[$index] }}" data-image="{{ url('/storage/products/'. $recom->image) }}" data-singleprice="{{ $recom->updated_price + $totalForBoiler }}">Select</button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="row hide">
            <div class="col-md-2">
                <div class="col-md-12 text-center mb-2">
                    <a href="{{ url('/') }}" class="custom-button d-inline-block">Start Over</a>
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="heading-prime">Book Home Survey</h2>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12 book-home-servey-main recommended final-products product-{{ $default->id }}">
                <div class="estimate-box">
                    <div class="box-line justify-content-between">
                        <div class="main-left-handed-box">
                            <div class="left-img-box">
                                <img class="img-fluid" src="{{ url('/storage/products/'. $default->image) }}" alt="img">
                            </div>
                            <div class="right-content-box float-right">
                                <h4 class="heading">{{ $default->product_name }}</h4>
                                {!! $subTotalRows !!}
                            </div>
                        </div>
                        <div class="estimate-detail">
                            <h3 class="price outputprice" data-price="{{ $totalPrice }}">£{{ number_format($totalPrice, 2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h3>
                        </div>
                    </div>
                </div>
            </div>
            @if ($recommended)
            @foreach ($recommended as $index => $recom)
                <div class="col-md-12 book-home-servey-main other-options final-products hide product-{{ $recom->id }}">
                    <div class="estimate-box">
                        <div class="box-line justify-content-between">
                            <div class="main-left-handed-box">
                                <div class="left-img-box">
                                    <img class="img-fluid" src="{{ url('/storage/products/'. $recom->image) }}" alt="img">
                                </div>
                                <div class="right-content-box float-right">
                                    <h4 class="heading">{{ $recom->product_name }}</h4>
                                    {!! $subTotalRows !!}
                                </div>
                            </div>
                            <div class="estimate-detail">
                                <h3 class="price outputprice" data-price="{{ $recomenTotalPrice[$index] }}">£{{ number_format($recomenTotalPrice[$index],2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
            <div class="col-md-12">
                <div class="row">
                    @if ($displayBoost)
                    @foreach ($productsBoost as $boost)
                    <div class="col-md-4">
                        <div class="accumulator-box">
                            @if ($loop->first)
                            <div class="option-label">Optional Extras</div>
                            @endif
                            <div class="box-line-a">
                                <div class="left-img-box-a">
                                    <img class="img-fluid" src="{{ url('/storage/products/'.$boost->image) }}" alt="img">
                                </div>
                                <div class="right-content-box">
                                    <h4 class="heading">{{ $boost->product_name }} <span class="float-right" style="font-size: 16px;">£{{ number_format($boost->updated_price,2) }}</span> </h4>
                                    <p class="text-c ">
                                        {{ $boost->shortdescription }}
                                        <a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="{{ $boost->id }}" data-price="{{ $boost->updated_price }}">More Info</a>
                                    </p>

                                </div>
                            </div>
                            <div class="plus-btn" style="user-select: auto;">
                                <button class="btn-plus" style="user-select: auto;" data-id="addons-{{ $boost->id }}">
                                    <img class="" src="{{ url('new-assets/img/plus.svg') }}" alt="img" style="user-select: auto;">
                                    <img class="checked" src="{{ url('new-assets/img/check.svg') }}" alt="img" style="user-select: auto;">
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-12 estimate-detail justify-content-center">
                <div class="right-btn-estimate mr-1">
                    <button type="button" class="btn-estimate-book back-book-survey">Back</button>
                </div>
                <div class="right-btn-estimate ml-1">
                    <button type="button" data-id="{{ $default->id }}" data-name="{{ $default->product_name }}" data-toggle="modal" data-target="#bookModal" class="btn-estimate-book interestedButton">Book Home Survey</button>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal modal-estimate fade" id="finance-extraModal" tabindex="-1" role="dialog" aria-labelledby="finance-extraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>

            </div>

            <!-- Modal body -->
            <div class="modal-body second-modal-body" id="finance-calculator">
                <input type="hidden" name="finance-subtotal-total" id="finance-subtotal-total" value="{{ $totalPrice }}" class="form-control">
                <input type="hidden" name="finance-estimate-total" id="finance-estimate-total" value="0" class="form-control">
                <input type="hidden" name="remaining-to-finance" id="remaining-to-finance" value="0" class="form-control">
                <h4 class="mdal-heading-ctm">Finance Calculator</h4>
                <div class="modal-form">
                    <div class="row d-flex align-items-center justify-content-between mb-ctm-12">
                        <div class="col-md-5 col-sm-12 pr-0">
                            <p class="label-text mr-0 mb-0">
                                <label class="mb-0" for="usr">Total Value</label>
                            </p>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <div class="radio-input estimate-detail justify-content-center">
                                <h3 class="price outputprice">£{{ number_format($totalPrice, 2) }} </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-between mb-ctm-12">
                        <div class="col-md-5 col-sm-12 pr-0">
                            <p class="label-text mr-0 mb-0">
                                <label class="mb-0" for="usr">Deposit</label>
                            </p>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <div class="radio-input">

                                <div class="qtv">
                                    £
                                </div>
                                <input type="text" name="finance-deposit" id="finance-deposit" value="0" class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="row input-style phone-dropdown mb-ctm-12">
                        <div class="col-md-5 col-sm-12 pr-0">
                            <p class="label-text mr-0 mb-0">
                                <label>Years of Finance <span class="text-danger"></span></label>
                            </p>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <div class="radio-input dropdown drop-bottom">
                                <div class="qtv">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <select name="finance-years" id="finance-years" class="form-control">
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10 Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="repayments-wrap" class="hide">
                        <div class="row d-flex bg-color-ctm align-items-center justify-content-between mb-ctm-12">
                            <div class="col-md-5 col-sm-12 pr-0">
                                <p class="label-text mr-0 mb-0">
                                    <label class="mb-0" for="usr">Amount on Finance</label>
                                </p>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="radio-input">

                                    <div class="qtv">
                                        £
                                    </div>
                                    <input type="text" name="amount-on-finance" id="amount-on-finance" value="0" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex bg-color-ctm align-items-center justify-content-between mb-ctm-12">
                            <div class="col-md-5 col-sm-12 pr-0">
                                <p class="label-text mr-0 mb-0">
                                    <label class="mb-0" for="usr">Monthly Repayments</label>
                                </p>
                            </div>
                            <div class="col-md-7 col-sm-12">

                                <div class="radio-input">

                                    <div class="qtv">
                                        £
                                    </div>
                                    <input type="text" name="finance-monthly-repayments" id="finance-monthly-repayments" value="0" class="form-control" disabled>
                                    <div class="month-position">/month</div>

                                </div>
                            </div>
                        </div>
                        <div class="row d-flex bg-color-ctm align-items-center justify-content-between mb-ctm-12">
                            <div class="col-md-5 col-sm-12 pr-0">
                                <p class="label-text mr-0 mb-0">
                                    <label class="mb-0" for="usr">Total Interest</label>
                                </p>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="radio-input">

                                    <div class="qtv">
                                        £
                                    </div>
                                    <input type="text" name="total-interest" id="total-interest" value="0" class="form-control" disabled>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total-payable d-flex align-items-center justify-content-between hide">
                        <h3 class="total-h">Total Payable</h3>
                        <p class="total-price" id="finance-total-repayment-value">£10778.79</p>
                    </div>
                    <div class="modal-btn-footer">
                        <button type="button" class="btn-main" id="calculate-finance">Calculate</button>
                    </div>
                    <div class="detailtext-p">
                        <p class="para-detail-p">Finance from 3-10 years at 9.9% APR No deposit needed </p>
                        <p class="para-detail-p">Example: £4560 over 5 years, total payable £5744.00, £96/month </p>
                        <p class="para-detail-p">Total loan amount 4560.00 repayable by 60 monthly repayments of 95.73.</p>
                        <p class="para-detail-p">Total charge from credit = £1183.97. Total amount repayable = £5743.97. Representative APR 9.9% APR.</p>
                        <p class="para-detail-p">Subject to status.</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">

                </div> -->

        </div>
    </div>
</div>

<div class="modal modal-estimate fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="extraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="estimate-box">
                    <div class="box-line flex-column">
                        <input type="hidden" name="finance-subtotal-total" id="finance-subtotal-total" value="{{ $totalPrice }}" class="form-control">
                        <input type="hidden" name="finance-estimate-total" id="finance-estimate-total" value="" class="form-control">
                        <input type="hidden" name="remaining-to-finance" id="remaining-to-finance" value="" class="form-control">
                        <div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-{{ $default->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-1">{{ $default->product_name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 14px;font-weight: 400">{!! nl2br($default->product_description) !!}</p>
                                </div>
                            </div>
                        </div>
                        @if($water)
                        <div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-{{ $water->id }} ">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-1">{{ $water->product_name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 14px;font-weight: 400">{!! nl2br($water->product_description) !!}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($recommended)
                        @foreach ($recommended as $index => $recom)
                        <div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-{{ $recom->id }} ">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-1">{{ $recom->product_name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 14px;font-weight: 400">{!! nl2br($recom->product_description) !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @foreach ($productsBoost as $boost)
                        <div class="quoted-product-wrap text-left modal-product-wrap p-3 my-1 col product-{{ $boost->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-1">{{ $boost->product_name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 14px;font-weight: 400">{!! nl2br($boost->product_description) !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal modal-estimate fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>

            </div>

            <!-- Modal body -->
            <div class="modal-body second-modal-body">
                <div class="login-box">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h3 class="log-in-heading text-center">Book your home survey</h3>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-6-ctm">
                            <div class="submit-btn text-center flex-column">
                                <p style="font-size: 14px;font-weight:normal">
                                    Book your free consultation, we are the experts so we don't expect you to know everything about heating systems and how to choose the right product for best home comfort and efficiency. <br> Before we can go any further let us provide you with a free consultation, we can then provide you with a fixed price quotation. <br> To organise a day and time for a home visit. just click the booking button below, during the home visit an assessment of your property will be made to ensure that this chosen product is actually suitable for your property.
                                    <br>
                                    During the home visit we will ensure the best product is chosen to best suit your requirements based on home Comfort and efficiency.
                                </p>
                                <form method="POST" action="{{ url('submitbooking') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="productchosen" id="productchosen" value="{{ $default->id }}">
                                    @if($water)
                                    <input type="hidden" name="water" id="water" value="{{ $water->id }}">
                                    @endif
                                    @if ($displayBoost)
                                        @foreach ($productsBoost as $boost)
                                        <input type="checkbox" class="hide optionalExtras addons" name="addons[]" id="addons-{{ $boost->id }}" value="{{ $boost->id }}" data-price="{{ $boost->updated_price }}">
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="totalvalue" id="totalvalue" value="{{ round($totalPrice) }}">
                                    <input type="hidden" name="subtotal" id="subtotal" value="{{ round($subtotalTotal) }}">
                                    <input type="hidden" name="quoteid" id="" value="{{ $quote->id }}">
                                    <button id="submit-form" class="btn-submit-form" type="submit">Send Booking Request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal  modal-estimate fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <img src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection


@section('foot')
@parent

<script>
    $(document).on('click', '.btn-plus', function () {
        if ($(this).hasClass('checked')) {
            $('#' + $(this).data('id')).prop('checked', false);
        } else {
            $('#' + $(this).data('id')).prop('checked', true);
        }
        $('#' + $(this).data('id')).val();
        $(this).toggleClass('checked');
        updateTotalPrice();
    });
    $(document).on('click', '.proceed-btn', function () {
        $(this).closest('.row').addClass('hide');
        $(this).closest('.row').siblings('.row').removeClass('hide');
    });

    function updateTotalPrice() {
        var value = 0;
        $('.optionalExtras.addons').each(function () {
            console.log($(this).is(':checked'));
            if ($(this).is(':checked')) {

                value += parseFloat($(this).data('price'));
            }
        });
        var original = parseFloat($('.originalprice').val());
        console.log(original,value);
        $('#totalvalue').val(original+value);
        console.log($('#totalvalue').val());
        $('.final-products').each(function(){
            let price = parseFloat($(this).find('.outputprice').data('price')) + value;
            $(this).find('.outputprice').html('£' + price.toLocaleString() + ' <span class="ml-1"> (inc. VAT and labour)</span>');
        })
        $('#finance-calculator .outputprice').html('£' + (original+value) + ' <span class="ml-1"> (inc. VAT and labour)</span>');
    }


    $(document).on('click','.select-recommended', function(){
        // recomended values
        let productID = $(this).data('productid');
        let totalPrice = $(this).data('totalprice')
        let image = $(this).data('image');
        let description = $(this).data('shortdescription');
        let originalPrice = $(this).data('originalprice');
        let name = $(this).data('name');
        let productPrice = $(this).data('singleprice');
        let moreInfoLink = `<a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="${productID}" data-price="${totalPrice}">More Info</a>`;
        let tagText = $(this).data('tagtext');

        // default values
        let otherproductID = $('#default-details').data('productid');
        let othertotalPrice = $('#default-details').data('totalprice')
        let otherimage = $('#default-details').data('image');
        let otherdescription = $('#default-details').data('shortdescription')
        let otheroriginalPrice = $('#default-details').data('originalprice')
        let othername = $('#default-details').data('name');
        let otherproductprice = $('#default-details').data('singleprice');
        let otherTagText = $('#default-details').data('tagtext');
        let othermoreInfoLink = `<a class="modal-info" data-toggle="modal" data-target="#extraModal" data-productid="${otherproductID}" data-price="${othertotalPrice}">More Info</a>`;

        // Other html and data settings
        $(this).data('tagtext', otherTagText).data('productid',otherproductID).data('totalprice',othertotalPrice).data('image',otherimage).data('shortdescription',otherdescription).data('originalprice',otheroriginalPrice).data('name',othername).data('singleprice',otherproductprice);
        $(this).closest('.recomended-box').find('.other-option-image').attr('src',otherimage);
        $(this).closest('.recomended-box').find('.other-option-name').html(othername);
        $(this).closest('.recomended-box').find('.other-option-description').html(otherdescription+othermoreInfoLink);
        $(this).closest('.recomended-box').find('.other-option-discounted-price').html('£'+othertotalPrice.toLocaleString());
        $(this).closest('.recomended-box').find('.other-option-original-price').html(otheroriginalPrice.toLocaleString());
        $(this).closest('.recomended-box').find('h4 .single-product-price').html('£'+otherproductprice.toLocaleString());

        $('#other-text' + productID).html(otherTagText);
        $('#other-text' + productID).attr('id', 'other-text' + otherproductID);

        // default Html settings
        $('#seefinanceButton').data('productid',productID).data('price',totalPrice)
        $('.default-image').attr('src',image);
        $('.default-name').html(name);
        $('.default-description').html(description+moreInfoLink);
        $('.default-total-price').val(totalPrice);
        $('.default-discounted-price').html('£'+totalPrice.toLocaleString());
        $('.default-original-price').html(originalPrice.toLocaleString());

        $('#recommened-text').html(tagText);
        $('.default-product-price').html('£'+productPrice.toLocaleString());
        $('#finance-subtotal-total').val(totalPrice);
        $('#productchosen').val(productID);
        $('#totalvalue').val(totalPrice);
        $('#finance-calculator').find('.price.outputprice').html('£'+totalPrice.toLocaleString());


        // Default data value setting
        $('#default-details').data('tagtext', tagText).data('productid',productID).data('totalprice',totalPrice).data('image',image).data('shortdescription',description).data('originalprice',originalPrice.toLocaleString()).data('name',name).data('singleprice',productPrice);

        $('.final-products').addClass('hide');
        $('.final-products.product-'+productID).removeClass('hide');
    });

    $(document).on('click','.back-book-survey', function(){
       $(this).closest('.row').addClass('hide');
       $(this).closest('.row').siblings('.row').removeClass('hide');
    });

    $(document).on('click','.zoom-image',function(){
        if($(this).siblings('img').attr('src') == "{{ url('/') }}/storage/products"){
            return false;
        }
        $('#imageModal').find('img').attr('src',$(this).siblings('img').attr('src'));
        $('#imageModal').modal();
    });
</script>
@endsection
