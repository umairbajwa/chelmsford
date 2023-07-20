<!DOCTYPE html>
<html lang="en" class="mt-front">

<head>
    <meta charset="utf-8">
    <title>Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Main Stylesheet File -->
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    @include('mail.head')

</head>


<body class="">
    <div class="top-bar">
        @include('mail.header')

        <div class="content">
            <table style="width: 100%;">
                <tr style="width: 100%; float: right; display: block;">
                    <td style="width: 100%; float: left;">
                        <p>Hi,</p>
                        <p>Someone tried to reach out from this postcode and waiting for your response.</p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr style="width: 100%; float: right; display: block;">
                    <td style="width: 100%; float: left;">
                        <p>Email: <a href="mailto:{{request('email')}}">{{request('email')}}</a></p>
                        <p>Post Code: {{request('post_code')}}</p>
                    </td>
                </tr>
            </table>
        </div>
        @include('mail.footer')
    </div>
</body>

</html>
