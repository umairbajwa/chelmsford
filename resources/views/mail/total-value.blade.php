
<div class="webview">
     <table style="width: 100%;margin-bottom: 10px;">
         <tr style="display: block;">
             <td style="float: left; text-align: left;">
                 <h4 style="margin:0px;">Heating Package</h4>
             </td>
             <td style="float: right; text-align:right;">
                 <p style="margin:0px;">£{{ number_format($product->updated_price+$totalForBoiler,0) }}</p>
             </td>
         </tr>
     </table>
     <table style="width: 100%;margin-bottom: 10px;">
        <tr style="display: block;">
            <td style="float: left; text-align: left;">
                <h4 style="margin:0px;">Emitters</h4>
            </td>
            <td style="float: right; text-align:right;">
                <p style="margin:0px;">£{{ number_format($subtotal-$totalForBoiler,2) }}</p>
            </td>
        </tr>
    </table>
     @if ($water)
         <table style="width: 100%;margin-bottom: 10px;">
             <tr style="display: block;">
                 <td style="float: left; text-align: left;">
                     <h4 style="margin:0px;">Water Cylinder</h4>
                 </td>
                 <td style="float: right; text-align:right;">
                     <p style="margin:0px;">£{{ number_format($water->updated_price,2) }}</p>
                 </td>
             </tr>
         </table>
     @endif
     @foreach ($addons as $addon)
         <table style="width: 100%;margin-bottom: 10px;">
             <tr style="display: block;">
                 <td style="float: left; text-align: left;">
                     <h4 style="margin:0px;">{{ $addon->product_name }}</h4>
                 </td>
                 <td style="float: right; text-align:right;">
                     <p style="margin:0px;">£{{ number_format($addon->updated_price,2) }}</p>
                 </td>
             </tr>
         </table>
     @endforeach
     <table style="width: 100%; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0 30px; margin-bottom: 20px;">
         <tr style="display: block;">
             <td style="float: left; text-align: left;">
                 <p style="font-size: 20px; font-weight: 700; color: #1A438F; margin: 0;">Total Payable</p>
                 <p style="font-size: 10px; font-weight: 400; color: #656565; margin: 0;">Finance shown is for illustration purposes only</p>
             </td>
             <td style="float: right; text-align:right;">
                 <h4 class="price-package " style="margin: 0;">£{{ number_format($totalvalue,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>
             </td>
         </tr>
     </table>
</div>

<div class="mobileview">
    <table style="width: 100%; margin-bottom: 10px;">
        <tr style="display: block;">
            <td style="float: left; text-align: left;">
                <h4 style="margin:0px;">Heating Package</h4>
            </td>
            <td style="float: right; text-align:right;">
                <p style="margin:0px;">£{{ number_format($product->updated_price+$totalForBoiler,0) }}</p>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-bottom: 10px;">
        <tr style="display: block;">
            <td style="float: left; text-align: left;">
                <h4 style="margin:0px;">Emitters</h4>
            </td>
            <td style="float: right; text-align:right;">
                <p style="margin:0px;">£{{ number_format($subtotal-$totalForBoiler,2) }}</p>
            </td>
        </tr>
    </table>
    @if ($water)
    <table style="width: 100%; margin-bottom: 10px;">
        <tr style="display: block;">
            <td style="float: left; text-align: left;">
                <h4 style="margin:0px;">Water Cylinder</h4>
            </td>
            <td style="float: right; text-align:right;">
                <p style="margin:0px;">£{{ number_format($water->updated_price,2) }}</p>
            </td>
        </tr>
    </table>
    @endif
    @foreach ($addons as $addon)
    <table style="width: 100%; margin-bottom: 10px;">
        <tr style="display: block;">
            <td style="float: left; text-align: left;">
                <h4 style="margin:0px;">{{ $addon->product_name }}</h4>
            </td>
            <td style="float: right; text-align:right;">
                <p style="margin:0px;">£{{ number_format($addon->updated_price,2) }}</p>
            </td>
        </tr>
    </table>
    @endforeach
     <table style="width: calc(100% - 20px); border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0 30px;margin:auto; margin-bottom: 20px;">
         <tr style="display: block;">
             <td style="float: left; text-align: left;">
                 <p style="font-size: 20px; font-weight: 700; color: #1A438F; margin: 0;">Total Payable</p>
                 <p style="font-size: 10px; font-weight: 400; color: #656565; margin: 0;">Finance shown is for illustration purposes only</p>
             </td>
             <td style="float: right; text-align:right;">
                 <h4 class="price-package " style="margin: 0;">£{{ number_format($totalvalue,2) }} <span class="ml-1"> (inc. VAT and labour)</span> </h4>
             </td>
         </tr>
     </table>
</div>
