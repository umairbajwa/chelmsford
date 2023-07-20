@extends('layouts.email')

@section('subject')
    New Appointment Request
@endsection

@section('content')

@php 
    $priceoutput = '£'.number_format($price);
@endphp
    <p>
        <!--Hi {!!$name!!},<br><br>
        Thank you for getting an instant estimate online.<br>
        Given the information you provided us we estimate your new boiler would cost: <strong>{!!$priceoutput!!}</strong><br><br>
        You can view your estimate again at anytime by clicking the button below.
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
        </tr>-->
        A new appintment request for {!!$name!!}<br><br>
        Estimate Total: {!!$priceoutput!!}  
        <br><br>
        <a class="link" href="https://cgs.wi24dev.co.uk/estimate/output/admin/{!!$estimateId!!}" target="_blank" style="color:#ffffff">
            View my estimate            
        </a>
    </p>
@endsection
