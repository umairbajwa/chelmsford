<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
    fbq('init', '1236282487278426');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1236282487278426&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ url('coverage/css/style.css') }}" />
<style>
    .custom-list-image {
        list-style: none
    }

    .custom-list-image>li::before,
    .custom-list-image-2>li::before {
        background-image: url("{{ url('coverage/images/component-1.svg') }}");
        content: '';
        display: inline-block;
        height: 7px;
        width: 25px;
        background-size: contain;
        background-repeat: no-repeat;
        margin-left: -35px;
        margin-right: 5px;
    }

    .modal .custom-list-image>li::before,
    .modal .custom-list-image-2>li::before {
        background-image: url("{{ url('coverage/images/component-1.svg') }}");
        content: '';
        display: inline-block;
        height: 7px;
        width: 30px;
        background-size: contain;
        background-repeat: no-repeat;
        margin-left: -35px;
        margin-right: 5px;
    }

    .custom-list-image>li.without-bullet::before,
    .custom-list-image-2>li.without-bullet::before {
        background-image: none;
    }

    .custom-list-image.white>li::before {
        background-image: url("{{ url('coverage/images/component-1-white.svg') }}");
    }

    .main-heading-text {
        font-size: 40px
    }

    .heading-text {
        font-size: 26px;
        font-weight: normal;
        line-height: 35px;
    }


    #progressbar {
        margin: auto;
        margin-bottom: 30px;
        overflow: hidden;
        counter-reset: step;
        margin-top: 30px;
        padding: 0px;
        max-width: 500px;
    }

    #progressbar li {
        list-style-type: none;
        color: #679b9b;
        text-transform: uppercase;
        font-size: 9px;
        width: 25%;
        float: left;
        position: relative;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 40px;
        line-height: 40px;
        display: block;
        font-size: 10px;
        color: black;
        border-radius: 3px;
        margin: 0 auto 5px auto;
        background: white;
        border: 1px solid #ccc;
        border-radius: 50%;
    }

    #progressbar li:after {
        content: "";
        width: 100%;
        height: 2px;
        background: #8E7017;
        position: absolute;
        left: -50%;
        top: 20px;
        z-index: -1;
    }

    #progressbar li:first-child:after {
        content: none;
    }

    #progressbar li.active {
        color: #8E7017;
    }

    #progressbar li:after {
        background: #ccc;
    }

    #progressbar li.active:after {
        background: #8E7017;
    }

    #progressbar li.active:before {
        background: #8E7017;
        color: white;
    }
</style>
