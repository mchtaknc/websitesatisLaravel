<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/front/img/header/favicon.ico') }}">
    <title>Sitedeposu - Anasayfa</title>
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/icons/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/icons-t/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/bootstrap.offcanvas.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/responsive.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/flickity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/modal-video.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/technology-icon/flaticon.css') }}">
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
    @yield('front_css')
</head>
<body>
@yield('body')
<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/front/js/particles-code.js') }}"></script>
<script src="{{ asset('assets/front/js/typed.js') }}"></script>
<script src="{{ asset('assets/front/js/smoothscroll.js') }}"></script>
<script src="{{ asset('assets/front/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/front/js/parallax.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.offcanvas.min.js') }}"></script>
<script src="{{ asset('assets/front/js/flickity.pkgd.min.js') }}"></script>
{{-- <script src="{{ asset('assets/front/js/mailer.js') }}"></script> --}}
<script src="{{ asset('assets/front/js/jquery.touchSwipe.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/front/js/modal-video.min.js') }}"></script>
<script src="{{ asset('assets/front/js/particles.js') }}"></script>
<script src="{{ asset('assets/front/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/front/js/video-bg.js') }}"></script>
<script src="{{ asset('assets/front/js/sweetalert2.js') }}"></script>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/front/js/scripts.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@yield('front_js')
</body>
</html>
