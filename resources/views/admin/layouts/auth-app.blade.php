<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- All size Favicons -->
    <!-- OLD ONE <link href="{{ URL::asset('back-office/assets/images/favicons/favicon.ico') }}" type="image/x-icon" rel="shortcut icon"> -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ URL::asset('back-office/assets/images/favicons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ URL::asset('back-office/assets/images/favicons/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ URL::asset('back-office/assets/images/favicons/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ URL::asset('back-office/assets/images/favicons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ URL::asset('back-office/assets/images/favicons/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ URL::asset('back-office/assets/images/favicons/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

    <title>ONECI | Back Office Certificat Conformité</title>

    <!--<link href="{{ URL::asset('back-office/assets/css/style.default.css') }}" rel="stylesheet">-->
    <link href="{{ URL::asset('back-office/assets/css/style.1.0.0.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('back-office/assets/js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<!--
    background-color : rgb(255 255 255 / 15%);
    background-image : url("https://www.visualatin.agency/wp-content/uploads/2015/01/blurred-background-10-2000x12501.jpg");

    background-image: url('.{{ URL::asset('back-office/assets/images/login.jpeg') }}');background-position: center;background-size: 100%;background-repeat: no-repeat
-->
<body class="signin boxed" style="background-image: url('{{ URL::asset('back-office/assets/images/background-patterns/boxed/hexa-vertical.png') }}');">


@yield('content')


<script src="{{ URL::asset('back-office/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/jquery.cookies.js') }}"></script>

<script src="{{ URL::asset('back-office/assets/js/toggles.min.js') }}"></script>
<script src="{{ URL::asset('back-office/assets/js/retina.min.js') }}"></script>

<script src="{{ URL::asset('back-office/assets/js/custom.js') }}"></script>
<script>
    jQuery(document).ready(function(){
        setTimeout(function () {
            $("#error-msg").attr("style", "display: none");
        }, 4000);
    });
</script>

</body>
</html>
