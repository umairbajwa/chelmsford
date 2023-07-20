<div class="webview">
    <table style="width: 100%;">
        <tr style="width: 100%; float: right; display: block;">
            <td style="width: 100%; float: left;">
                <h2 class="customer-name">{{ $quote->first .' '. $quote->last }}</h2>
            </td>
        </tr>
    </table>

    <table class="customer-detail-main-box " style="width: 100%;margin-bottom: 0;">
        <tr class="customer-detail-ctm">
            <td class="width-1">
                <p class="text-detail">{{ $quote->address_line_1 }}</p>
                <p class="text-detail">{{ $quote->address_line_2 }}</p>
                <p class="text-detail">{{ $quote->address_line_3 }}</p>
            </td>
            <td class="width-2">
                <p style="margin: 0;" class="text-con">Phone: <span>{{ $quote->phone_number }}</span> </p>
                <p style="margin: 0;" class="text-con">Email: <span>{{ $quote->email }}</span> </p>
            </td>
        </tr>
    </table>

    <table class="customer-detail-main-box" style="width: 100%;">
        <tr class="customer-detail-ctm">
            <td class="width-1">
                <p class="text-detail">{{ $quote->town }}</p>
                <p class="text-detail">{{ $quote->postcode }}</p>
            </td>
            <td class="width-2">
            </td>
        </tr>
    </table>
</div>

<div class="mobileview">
    <table style="width: 100%;">
        <tr style="width: 100%; float: right; display: block;">
            <td style="width: 100%; float: left;">
                <h2 class="customer-name">{{ $quote->first .' '. $quote->last }}</h2>
            </td>
        </tr>
    </table>

    <table class="customer-detail-main-box " style="width: 100%;margin-bottom: 0;">
        <tr class="customer-detail-ctm">
            <td class="width-1">
                <p class="text-detail">{{ $quote->address_line_1 }}</p>
                <p class="text-detail">{{ $quote->address_line_2 }}</p>
                <p class="text-detail">{{ $quote->address_line_3 }}</p>
            </td>
        </tr>
    </table>

    <table class="customer-detail-main-box" style="width: 100%;">
        <tr class="customer-detail-ctm">
            <td class="width-1">
                <p class="text-detail">{{ $quote->town }}</p>
                <p class="text-detail">{{ $quote->postcode }}</p>
            </td>
            <td class="width-2">
            </td>
        </tr>
    </table>
    <table class="customer-detail-main-box" style="width: 100%;">
        <tr class="customer-detail-ctm">
            <td class="">
                <p style="margin: 0;" class="text-con">Phone: <span>{{ $quote->phone_number }}</span> </p>
                <p style="margin: 0;" class="text-con">Email: <span>{{ $quote->email }}</span> </p>
            </td>
        </tr>
    </table>
</div>