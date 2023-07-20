<!DOCTYPE html>
<html lang="en" class="mt-front">

<head>
    <meta charset="utf-8">
    <title>New Quote</title>
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
        @include('mail.header',['inquiryNo' => $quote->inquiry_no])
        <div class="content">
            @include('mail.section-heading', ['sectionName' => 'CUSTOMER DETAILS'])

            @include('mail.customer-details', ['quote' => $quote])

            @include('mail.section-heading', ['sectionName' => 'PROPERTY DETAILS'])

            @include('mail.questions', ['questionsData' => $questionsData])

            @include('mail.section-heading', ['sectionName' => 'PACKAGE SELECTED'])

            @include('mail.products', ['addons' => $addons, 'product' => $product, 'subTotalRows' => $subTotalRows, 'water' => $water,'subtotal' => $subtotal])
            @include('mail.total-value', ['totalvalue' => $totalvalue])
        </div>
        @include('mail.footer')
    </div>
</body>

</html>
