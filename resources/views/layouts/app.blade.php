<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title')</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('/assets/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/ladda/ladda.min.css" rel="stylesheet') }}" />
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ asset('/assets/css/sleek.css') }}" />



    <!-- FAVICON -->
    <link href="{{ asset('/assets/img/favicon.png') }}" rel="shortcut icon" />

    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Toaster Alert -->
{{--    <script src="{{ asset('/assets/plugins/nprogress/nprogress.js') }}"></script>--}}
{{--    <link href="{{ asset('/assets/toaster/light-theme.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('/assets/toaster/dark-theme.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('/assets/toaster/colored-theme.min.css') }}" rel="stylesheet">--}}
{{--    <script type="text/javascript" src="{{ asset('/assets/toaster/growl-notification.min.js') }}" />--}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
<script>
    NProgress.configure({ showSpinner: false });
    NProgress.start();
</script>

<div class="mobile-sticky-body-overlay"></div>

<div class="wrapper">

    <!--
====================================
——— LEFT SIDEBAR WITH FOOTER
=====================================
-->

    @include('layouts.sidebar')

    <div class="page-wrapper">
        <!-- Header -->

        @include('layouts.header')


        <div class="content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@yield('script')

@include('alert_script')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/charts/Chart.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('/assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/assets/plugins/jekyll-search.min.js') }}"></script>
<script src="{{ asset('/assets/js/sleek.js') }}"></script>
<script src="{{ asset('/assets/js/chart.js') }}"></script>
<script src="{{ asset('/assets/js/date-range.js') }}"></script>
<script src="{{ asset('/assets/js/map.js') }}"></script>
<script src="{{ asset('/assets/js/custom.js') }}"></script>
</body>
</html>
