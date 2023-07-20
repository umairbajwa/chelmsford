<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body bgcolor="#1265a8">
    <table width="600" border="0" cellpadding="0" align="center" cellspacing="0" bordercolor="#ffffff">
        <tr>
            <td height="434">
            <table width="600" height="432" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            <td height="109" bgcolor="#ffffff"><table width="150" align="center" cellpadding="10" cellspacing="20">
                <tr>
                    <td bgcolor="#ffffff">
                        <img src="https://cgs.wi24dev.co.uk/storage/logo/cgs.jpg" width="300" />
                    </td>
                </tr>
            </table></td>
            </tr>
            <tr>
            <td height="34" bgcolor="#1265a8" color="#ffffff"><div align="center" style="color: #fff; font-size: 22px;">@yield('subject')</div></td>
            </tr>
            <tr>
            <td bgcolor="#ffffff" color="#1265a8"><table width="100%" cellpadding="20">
                <tr>
                    <td> 
                        @yield('content')
                    </td>
                </tr>
            </td>
            </tr>
            <tr>
            <td height="124" bgcolor="#1265a8"><table width="100%" cellpadding="20">
                <tr>
                    <td height="86" color="#ffffff"> 
                        <span class="style2" style="color: #ffffff; font-size: 12px;">
                            If you have recieved this in error then please email us at 
                            <a href="mailto:info@chelmsfordgasservices.co.uk" style="color:#ffffff;">info@chelmsfordgasservices.co.uk</a>
                        </span>
                    </td>
                </tr>
            </td>
        </tr>
    </table>
</body>
</html>
