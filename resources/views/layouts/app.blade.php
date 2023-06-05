<!DOCTYPE HTML>

<!--[if IE 8]>
<html class="ie8 no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <![endif]-->
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
            @if(Route::is('front_office.page.identification'))
                @yield('home')
            @elseif(Route::is('front_office.page.consultation'))
                @yield('consultation')
            @elseif(Route::is('front_office.page.pre_identification'))
                @yield('pre_identification_abonnes_mobile')
            @elseif(Route::is('front_office.page.reclamation_paiement'))
                @yield('reclamation_paiement')
            @endif
            @include('sections.footer')
            @include('sections.scripts')
        </div>
        <!-- end container -->
    </body>
</html>
