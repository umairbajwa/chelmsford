<div class="header webview">
    <table style="width: 100%;">
        <tr>
            <td>
                <p class="date-text" style="font-size: 16px; font-weight: 400; color: #19163D;">DATE: {{ date('jS F, Y') }} </p>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr class="nav-top-ctm">
            <td style="float: left;">
                <div class="logo" style="width: 176px; height: 124;">
                    <a href="#">
                        <img class="img-fluid" src="{{ url('new-assets/img/logo-admin.png') }}" alt="img">
                    </a>
                </div>
            </td>
            <td style="float: right;">
                @if(isset($type))
                <h1 style="margin-bottom: 10px;">Admin Access</h1>
                @else
                <h1 style="margin-bottom: 10px;">Heating Estimate</h1>
                @if (isset($inquiryNo))
                <h5 style="margin-top: 0;">INQUIRY # CGS-{{ $inquiryNo }}</h5>
                @endif
                @endif
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr class="nav-bar-ctm">
            <td>
                <div class="nav-item-ctm">
                    <a href="https://chelmsfordgasservices.co.uk/" target="_blank">
                        <span>
                            <img src="{{ url('new-assets/img/computer.png') }}" alt="img">
                        </span> chelmsfordgasservices.co.uk
                    </a>
                </div>
            </td>
            <td>
                <div class="nav-item-ctm">
                    <a href="tel:01245251741">
                        <span>
                            <img src="{{ url('new-assets/img/telephone.png') }}" alt="img">
                        </span> 01245 251 741
                    </a>
                </div>
            </td>
            <td>
                <div class="nav-item-ctm">
                    <a href="mailto:info@chelmsfordgas.co.uk">
                        <span style="vertical-align: middle;">
                            <img src="{{ url('new-assets/img/envelope.png') }}" alt="img">
                        </span> info@chelmsfordgas.co.uk
                    </a>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="header mobileview">
    <table style="width: 100%;">
        <tr>
            <td>
                <p class="date-text" style="font-size: 16px; font-weight: 400; color: #19163D;">DATE: {{ date('jS F, Y') }} </p>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr class="nav-top-ctm">
            <td style="float: left;">

                <div class="logo" style="width: 120px; height: 124;">
                    <a href="#">
                        <img class="img-fluid" src="{{ url('new-assets/img/logo-admin.png') }}" alt="img">
                    </a>
                </div>
            </td>
            <td style="float: right;">
                <h1>Heating Estimate</h1>
                @if (isset($inquiryNo))
                <h5 style="margin-top: 0;">INQUIRY # CGS-{{ $inquiryNo }}</h5>
                @endif
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr class="nav-bar-ctm">
            <td>
                <div class="nav-item-ctm">
                    <a href="https://chelmsfordgasservices.co.uk/" target="_blank">
                        <span>
                            <img src="{{ url('new-assets/img/computer.png') }}" alt="img">
                        </span> chelmsfordgasservices.co.uk
                    </a>
                </div>
            </td>
            <td>
                <div class="nav-item-ctm">
                    <a href="tel:01245251741">
                        <span>
                            <img src="{{ url('new-assets/img/telephone.png') }}" alt="img">
                        </span> 01245 251 741
                    </a>
                </div>
            </td>
            <td>
                <div class="nav-item-ctm">
                    <a href="mailto:info@chelmsfordgas.co.uk">
                        <span style="vertical-align: middle;">
                            <img src="{{ url('new-assets/img/envelope.png') }}" alt="img">
                        </span> info@chelmsfordgas.co.uk
                    </a>
                </div>
            </td>
        </tr>
    </table>

</div>
