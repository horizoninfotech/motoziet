<html lang="@yield('lang', 'en')" dir="@yield('dir', 'ltr')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSS Files -->
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    
    @if (app()->getLocale() === 'ar' || app()->getLocale() === 'ur')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet">
    <link href="{{ URL::asset('public/css/font-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/plugins.css') }}" rel="stylesheet"> 
    <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet"> 
    <link href="{{ URL::asset('public/css/responsive.css') }}" rel="stylesheet"> 

    @yield('css')
</head>
<body>

    @include('partials.header')
    <div class="container-fluid p-0">
        @yield('content')
    </div>
    @include('partials.footer')

    <!-- JS Files -->
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js"></script>
    <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}"></script>

    <script src="{{ URL::asset('public/js/plugin.js') }}"></script>
    <script src="{{ URL::asset('public/js/main.js') }}"></script>
 

    @yield('js')
</body>
</html>
