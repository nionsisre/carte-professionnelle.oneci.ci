<!DOCTYPE HTML>

<!--[if IE 8]>
<html class="ie8 no-js" lang="fr"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--<![endif]-->
    <head>
        @include('sections.head')
        <title>ONECI | @yield("title") </title>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="main-wrapper" style="margin: -5px 0;">
            @include('sections.header')
        </div>
        <!-- begin container -->
        <div id="wrap">
            <div class="spacer">&nbsp;</div>
            <div class="spacer">&nbsp;</div>
            @if (Route::is('accueil'))
                @yield('home')
            @elseif (Route::is('consultation_statut_identification'))
                @yield('consultation')
            @endif
            @include('sections.footer')
            @include('sections.scripts')
        </div>
        <!-- end container -->
    </body>
</html>
