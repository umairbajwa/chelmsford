@extends('layouts.email')

@section('subject')
    Your New Boiler Estimate
@endsection

@section('content')

@php 
    $priceoutput = '£'.$totalvalue;
@endphp
    <p>
        Hi {!!$first!!},<br><br>
        Thank you for requesting a home survey with Chelmsford Gas Services.<br>
        The product you have requested from the online estimate calculator is: <strong>{!!$productchosen!!}</strong><br>
        @if($boostamain == 1)
            You have requested a boost-a-main to be considered in the home survey<br>
        @endif
        @if($accumulator == 1)
            You have requested an accumulator to be considered in the home survey<br>
        @endif
        And it has been estimated the new boiler installation will cost {!!$priceoutput!!}<br><br>
        A member of the Chelmsford Gas team will be in touch shortly to arrange a good time and day to visit your property.<br>
        Please also see attached our standard terms and conditions for your safe keeping.
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="button" bgcolor="#1265a8">
                            <a class="link" href="https://cgs.wi24dev.co.uk/estimate/output/{!!$estimateId!!}" target="_blank" style="color:#ffffff">
                                View my estimate            
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </p>
@endsection
