<div class="webview">
    <table class="main-package-box" style="width: 100%;">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $product->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $product->product_name }}</h3>
                    <p class="package-text">{{ $product->shortdescription }}</p>
                    {!! $subTotalRows !!}
                </div>
            </td>
            <td class="package-price">

                <h4 class="price-package"> £{{ number_format($product->updated_price+$totalForBoiler,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>

            </td>
            <td></td>
        </tr>
    </table>
    @if($water)
    <table class="main-package-box" style="width: 100%;">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $water->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $water->product_name }}</h3>
                    <p class="package-text">{{ $water->shortdescription }}</p>
                </div>
            </td>
            <td class="package-price">

                <h4 class="price-package"> £{{ number_format($water->updated_price,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>

            </td>
            <td></td>
        </tr>
    </table>
    @endif
    @foreach ($addons as $addon)
    <table class="main-package-box" style="width: 100%;">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $addon->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $addon->product_name }}</h3>
                    <p class="package-text">{{ $addon->shortdescription }}</p>
                </div>
            </td>
            <td class="package-price">

                <h4 class="price-package"> £{{ number_format($addon->updated_price,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>

            </td>
            <td></td>
        </tr>
    </table>
    @endforeach
</div>

<div class="mobileview">
    <table class="main-package-box">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $product->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $product->product_name }}</h3>
                    <p class="package-text">{{ $product->shortdescription }}</p>
                    {!! $subTotalRows !!}
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="price-package">Amount</h4>
                    <h4 class="price-package">£{{ number_format($product->updated_price+$totalForBoiler,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>
                </div>
            </td>
        </tr>
    </table>
    @if($water)
    <table class="main-package-box">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $water->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $water->product_name }}</h3>
                    <p class="package-text">{{ $water->shortdescription }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="price-package">Amount</h4>
                    <h4 class="price-package">£{{ number_format($water->updated_price,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>
                </div>
            </td>
        </tr>
    </table>
    @endif
    @foreach ($addons as $addon)
    <table class="main-package-box">
        <tr class=" package-line">
            <td class="package-img-text">
                <div class="img-box-package">
                    <img src="{{ url('/storage/products/'. $addon->image) }}" class="img-fluid" alt="img">
                </div>
                <div class="package-content">
                    <h3 class="heading">{{ $addon->product_name }}</h3>
                    <p class="package-text">{{ $addon->shortdescription }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="price-package">Amount</h4>
                    <h4 class="price-package">£{{ number_format($addon->updated_price,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>
                </div>
            </td>
        </tr>
    </table>
    @endforeach
</div>
