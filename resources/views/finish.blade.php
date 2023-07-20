<!DOCTYPE html>
<html lang="en" class="mt-front">

<head>
    <meta charset="utf-8">
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1725350837862103');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1725350837862103&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <title>Thank you</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Main Stylesheet File -->
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('new-assets/css/main.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">


</head>

<body class="">
    <!--Body Start-->
    <section class="log-in home-servey fuel-type thank-you">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto  thank-you-ctm">

                    <div class="login-box">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="thank-you-img">
                                        <img src="{{ url('new-assets/img/thnak-you-img.svg') }}" alt="img">
                                    </div>
                                    <h3 class="log-in-heading text-center">Thank you! </h3>
                                    @if (request('estimates'))
                                        <p class="stardard-text">Thank you for choosing Chelmsford Gas Services Online budget calculator. We have sent you your booking details via email. Look forward to seeing you. Thanks</p>
                                    @else
                                        <p class="stardard-text">Thanks you for choosing Chelmsford Gas Services. We have emailed you a URL for your return to the estimate at any time. Thanks</p>
                                    @endif

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 col-md-6-ctm">
                                    <div class="submit-btn text-center">
                                        <a href="{{ url('/') }}" id="submit-form" class="btn-submit-form" type="submit">Finish</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</body>

</html>
