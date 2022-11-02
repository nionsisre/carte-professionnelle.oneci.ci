<!DOCTYPE HTML>

<!--[if IE 8]>
<html class="ie8 no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        @include('sections.head')
    </head>
    <body>
        <?php $routes[1] = "nos-services"; $routes[2] = "retrait-par-procuration"; ?>
        <div id="fb-root"></div>
        <div class="main-wrapper" style="margin: -5px 0;">
            @include('sections.header')
        </div>
        <!-- begin container -->
        <div id="wrap">
            <div class="spacer">&nbsp;</div>
            <div class="spacer">&nbsp;</div>
            @if (Route::has('accueil'))
                @yield("home")
            @endif
            @include("sections.footer")
            @include("sections.scripts")
        </div>
        <!-- end container -->
    </body>
</html>
