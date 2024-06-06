<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="patrickangel.ndri@gmail.com">
    <!--<link rel="shortcut icon" href="images/favicon.png" type="image/png">-->

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

    <title>{{ env('APP_NAME')." ".auth()->user()->user_role_label }}</title>

    <!--<link href="{{ URL::asset('back-office/assets/css/style.default.css') }}" rel="stylesheet">-->

    <link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/jquery.tagsinput.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/colorpicker.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/style.css') }}" />
    <link href="{{ URL::asset('back-office/assets/css/jquery.gritter.css') }}" rel="stylesheet">
    <!--<link href="{{ URL::asset('back-office/assets/css/style.default.css') }}" rel="stylesheet">-->
    <link href="{{ URL::asset('back-office/assets/css/style.1.0.1.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('back-office/assets/css/countrySelectCEDEAO.css') }}" rel='stylesheet' type='text/css'>
    <style>
        .body-texture {background-image: url('{{ URL::asset('back-office/assets/images/background-patterns/boxed/wild_oliva.png') }}');}
        .utxt {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE10+/Edge */
            user-select: none; /* Standard */
            -webkit-touch-callout: none;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('back-office/assets/js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/respond.min.js') }}"></script>
    <![endif]-->
    @yield('page-styles')
</head>

<body class="stickyheader body-texture">
<!-- Preloader -->
@hasSection('preloader')
    @yield('preloader')
@else
    <div id="preloader">
        <div id="status"><i class="fa fa-fingerprint fa-spin"></i></div>
    </div>
@endif

    <section>
        <div class="leftpanel sticky-leftpanel">
            <div class="logopanel">
                <h1><span><a href="{{ route('admin.home') }}">@hasSection('logo') @yield('logo') @else <img src="{{ URL::asset('back-office/assets/images/oneci_logo.svg') }}" style="width: 2.5em; padding: 0.2em 0.2em" alt="" /> @endif</a></span></h1>
            </div><!-- logopanel -->
            @include('admin.panels.sidebar')
        </div><!-- leftpanel -->
        <!--
        background-size: 11em
        -->
        <div class="mainpanel" @hasSection('background') @yield('background') @else style="background-image: url('{{ URL::asset("back-office/assets/images/background-patterns/boxed/hexa-vertical.png") }}');" @endif>
            @include('admin.panels.navbar')
            @yield('page-title-tab')
            <div class="contentpanel">
                @yield('content')
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </section>


    <script src="{{ URL::asset('back-office/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery-ui-1.10.3.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/toggles.min.js') }}"></script>
    {{--<script src="{{ URL::asset('back-office/assets/js/retina.min.js') }}"></script>--}}
    <script src="{{ URL::asset('back-office/assets/js/jquery.cookies.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.autogrow-textarea.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.mask.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.mousewheel.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/select2_search.min.js') }}" type='text/javascript'></script>
    <script src="{{ URL::asset('back-office/assets/js/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/colorpicker.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/jquery.gritter.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/custom.js') }}"></script>
    <script>
        /* highlight on hover */
        function highlightHover(type, classId) {
            if(type == "set"){
                $(".hover-highlight-"+classId).attr("style", "background-color: rgb(2,158,158, 0.1);transform: scale(1.05);box-shadow: 0 5px 13px rgb(60 72 88 / 20%) !important;transition: all 0.3s ease;");
                $(".hover-highlight-"+classId).children(0).attr("style", "background-color: #4c9a506b; height: 12.4em; border-radius: 6px;"); /* #ffffff33 backdrop-filter: blur(0.5px);*/
            } else if(type == "unset") {
                $(".hover-highlight-"+classId).attr("style", "background-color: rgba(153,153,153, 0.02);box-shadow: 0 0 3px rgb(60 72 88 / 15%) !important;transition: all 0.3s ease;");
                $(".hover-highlight-"+classId).children(0).attr("style", "background-color: #ffffff; height: 12.4em; border-radius: 6px");
            }
        }
        jQuery(document).ready(function () {
            "use strict";
            /* Tags Input */
            jQuery('#tags').tagsInput({width: 'auto'});
            /* Select2 */
            jQuery('.good-select').select2({
                minimumResultsForSearch: 3,
                formatNoMatches: () => "Aucun résultat trouvé"
            });
            jQuery('.good-select').removeClass('form-control');
            /* Textarea Autogrow */
            jQuery('#autoResizeTA').autogrow();
            /* Color Picker */
            if (jQuery('#colorpicker').length > 0) {
                jQuery('#colorSelector').ColorPicker({
                    onShow: function (colpkr) {
                        jQuery(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        jQuery(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                        jQuery('#colorpicker').val('#' + hex);
                    }
                });
            }
            /* Color Picker Flat Mode */
            jQuery('#colorpickerholder').ColorPicker({
                flat: true,
                onChange: function (hsb, hex, rgb) {
                    jQuery('#colorpicker3').val('#' + hex);
                }
            });
            /* Date Picker */
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker-inline').datepicker();
            jQuery('#datepicker-multiple').datepicker({
                numberOfMonths: 3,
                showButtonPanel: true
            });
            /* Spinner */
            var spinner = jQuery('#spinner').spinner();
            spinner.spinner('value', 0);
            /* Input Masks */
            jQuery("#date-naissance").mask("99/99/9999");
            jQuery("#birth-date").mask("99/99/9999");
            /*jQuery("#numero-recepisse").mask("99999999999");*/
            /*jQuery("#numero-cni").mask("C 9999 9999 99");
            jQuery(".numero-cni").mask("C 9999 9999 99");*/
            jQuery(".masked-phone-number").mask("99 99 99 99 99");
            jQuery("#ssn").mask("999-99-9999");
            /* Time Picker */
            jQuery('#timepicker').timepicker({defaultTIme: false});
            jQuery('#timepicker2').timepicker({showMeridian: false});
            jQuery('#timepicker3').timepicker({minuteStep: 15});
        });
        function triggerViewChange(selectInputId) {
            var argAmountSelectedValue = $(selectInputId).val();
            for(let i=1;i<=6;i++) {
                if(i > argAmountSelectedValue) {
                    $("#arg"+i).attr("style","display : none");
                } else {
                    $("#arg"+i).attr("style","");
                }
            }
        }
        $('.inputfile').each(function () {
            var $input = $(this),
                $label = $input.next('label'),
                labelVal = $label.html();

            $input.on('change', function (e)
            {
                var fileName = '';

                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                else if (e.target.value)
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    $label.find('span').html(fileName);
                else
                    $label.html(labelVal);
            });

            /* Firefox bug fix */
            $input
                .on('focus', function () {
                    $input.addClass('has-focus');
                })
                .on('blur', function () {
                    $input.removeClass('has-focus');
                });
        });
    </script>
    @yield('vendor-scripts')
    @yield('page-scripts')
</body>
</html>
