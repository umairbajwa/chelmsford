<!DOCTYPE html>
<html lang="en" class="mt-front">

<head>
    <meta charset="utf-8">
    <title>Admin Access</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Main Stylesheet File -->
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Style CSS -->
    @include('mail.head')

</head>


<body class="">
    <div class="top-bar">
        @include('mail.header')

        <div class="content">
            <table style="width: 100%;">
                <tr style="width: 100%; float: right; display: block;">
                    <td style="width: 100%; float: left;">
                        @if($type == 'save')
                        <p>Hi {{ $user->name }},</p>
                        <p>You have been given admin access to Chemlsford Portal.</p>
                        <p>Use below credentials to <a href="{{ url('home') }}">Login</a></p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Password:</strong> {{ request('password') }}</p>
                        @else
                        <p>Hi {{ $user->name }},</p>
                        <p>Your credentials for Chemlsford Portal has been updated</p>
                        <p>Use below credentials to <a href="{{ url('home') }}">Login</a></p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Password:</strong> {{ request('password') }}</p>
                        @endif
                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr style="width: 100%; float: right; display: block;">
                    <td style="width: 100%; float: left;">
                        <p>Thank you</p>
                        <p>Team Chelmsfordgas</p>
                    </td>
                </tr>
            </table>
        </div>
        @include('mail.footer')
    </div>
</body>

</html>
