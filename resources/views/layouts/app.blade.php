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
            {{-- Identification --}}
            @if(Route::is('front_office.page.identification'))
                @yield('home')
            @elseif(Route::is('front_office.page.consultation'))
                @yield('consultation')
            @elseif(Route::is('front_office.page.reclamation_paiement'))
                @yield('reclamation_paiement')
            {{-- Pré-Identification --}}
            @elseif(Route::is('front_office.pre_identification.menu'))
                @yield('menu_pre_identification')
            @elseif(Route::is('front_office.pre_identification.page'))
                @yield('pre_identification_abonnes_mobile')
            @endif
            {{-- Footer --}}
            @include('sections.footer')
            {{-- Scripts --}}
            @include('sections.scripts')
        </div>
        <!-- end container -->
    </body>
</html>
