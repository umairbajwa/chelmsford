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
    <!-- Style CSS -->
    @include('mail.head')

</head>


<body class="">
    <div class="top-bar">
        @include('mail.header')
        <div class="content">
            @include('mail.section-heading',['sectionName' => 'Property Details'])

            @include('mail.questions',['questionsData' => $questionsData])

            <h5>Click <a href="{{ $url }}" target="_blank">here</a> to continue your Quote</h5>
            <br>
            <br>
        </div>
        @include('mail.footer')
    </div>
</body>

</html>
