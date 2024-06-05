@extends('admin.layouts.app')

@section('page-title-tab')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i>&nbsp; Accueil</h2>
    </div>
@endsection

@section('vendor-scripts')
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/raphael-2.1.0.min.js') }}"></script>
    <!--<script src="{{ URL::asset('back-office/assets/js/dashboard.js') }}"></script>-->
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

            var enter_first = 0;
            $("#withNumCNI").click(function () {
                if (enter_first !== 0) {
                    enter_first = 0;
                    /* change required inputs */
                    $("input[name='numero-cni']").attr("required", "required");
                    $("input[name='number_recepisse']").removeAttr("required");
                    $("input[name='nom']").removeAttr("required");
                    $("input[name='prenom']").removeAttr("required");
                    $("input[name='date-naissance']").removeAttr("required");
                    $("input[name='lieu-naissance']").removeAttr("required");
                    $("input[name='number']").attr("required", "required");
                    $("input[name='first_name']").removeAttr("required");
                    $("input[name='last_name']").removeAttr("required");
                    $("input[name='birth_date']").removeAttr("required");
                    $("input[name='birth_place']").removeAttr("required");
                    /* toggle */
                    $("#second-group").hide();
                    $("#first-group").fadeIn('100');
                }
            });
            $("#withoutNumCNI").click(function () {
                if (enter_first === 0) {
                    enter_first++;
                    /* change required inputs */
                    $("input[name='numero-cni']").removeAttr("required");
                    $("input[name='number_recepisse']").attr("required", "required");
                    $("input[name='nom']").attr("required", "required");
                    $("input[name='prenom']").attr("required", "required");
                    $("input[name='date-naissance']").attr("required", "required");
                    $("input[name='lieu-naissance']").attr("required", "required");
                    $("input[name='number']").removeAttr("required");
                    $("input[name='first_name']").attr("required", "required");
                    $("input[name='last_name']").attr("required", "required");
                    $("input[name='birth_date']").attr("required", "required");
                    $("input[name='birth_place']").attr("required", "required");
                    /* toggle */
                    $("#first-group").hide();
                    $("#second-group").fadeIn('10');
                }
            });
        });
        function popupwindow(url, title, w, h) {
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            $("#coupon-generated-btn").removeAttr("disabled");
            $("#coupon-generate-btn").attr("disabled","disabled");
            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        }
        function popupPrintWindowVIP(form, url, title, w, h) {
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            $(form).submit();
            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        }
        /*
         *  window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
         */


        function popupPrintWindow(url, title, w, h) {
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        }
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

    <span id="dft-lnk" style="display: none">{{ url()->current() }}</span> <!-- Tips to help App.js finding Current Default Website URL -->
    <span id="tab-srch" style="display: none">{{ url()->current() }}</span> <!-- Tips to help App.js finding Current Default Website URL -->
    <script src="{{ URL::asset('back-office/assets/js/countrySelectCEDEAO.js') }}" type='text/javascript'></script>
    <script>
        jQuery("#country-input").countrySelect({
            defaultCountry: 'ci',
            preferredCountries: ['ci','fr', 'us', 'cn', 'ru', 'ca', 'gb', 'de']
        });
    </script>
    <script language="javascript">
        var tabsLst = "";
    </script>
    <script language="JavaScript">
        function showPopup(url, title, w, h) {
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-dark panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-hand-receiving"></i>
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Nombre total de demandes</small>
                                <h1>{{ $nombre_demandes }}</h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Aujourd'hui</small>
                                <h4>{{ $nombre_demandes_daily }}</h4>
                            </div>

                            <div class="col-xs-6">
                                <small class="stat-label">Ce mois-ci</small>
                                <h4>{{ $nombre_demandes_monthly }}</h4>
                            </div>
                        </div><!-- row -->

                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Demandes validées</small>
                                <h1>{{ $nombre_demandes_validees }}</h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Aujourd'hui</small>
                                <h4>{{ $nombre_demandes_validees_daily }}</h4>
                            </div>

                            <div class="col-xs-6">
                                <small class="stat-label">Ce mois-ci</small>
                                <h4>{{ $nombre_demandes_validees_monthly }}</h4>
                            </div>
                        </div><!-- row -->
                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-danger panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-times"></i>
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Demandes refusées</small>
                                <h1>{{ $nombre_demandes_refusees }}</h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Aujourd'hui</small>
                                <h4>{{ $nombre_demandes_refusees_daily }}</h4>
                            </div>

                            <div class="col-xs-6">
                                <small class="stat-label">Ce mois-ci</small>
                                <h4>{{ $nombre_demandes_refusees_monthly }}</h4>
                            </div>
                        </div><!-- row -->

                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-primary panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-file-certificate"></i>
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Taux de demandes traitées</small>
                                <h1>{{ intval($taux_demandes_traitees) }}%</h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Aujourd'hui</small>
                                <h4>{{ intval($taux_demandes_traitees_daily) }}%</h4>
                            </div>

                            <div class="col-xs-6">
                                <small class="stat-label">Ce mois-ci</small>
                                <h4>{{ intval($taux_demandes_traitees_monthly) }}%</h4>
                            </div>
                        </div><!-- row -->

                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->


    </div><hr style="border-top: 1px solid #212121" />
    <div class="row">
        <!-- Ostat Plus Web -->
        <div class=" col-sm d-flex" style="text-align: center;margin-left: 15%;margin-right: 15%;margin-top: 3%">
            <a href="{{ route('admin.certificat') }}" style="text-decoration: none;">
                <div class="col-lg-3 d-flex align-items-stretch" style="object-fit: cover;">
                    <div class="hover-highlight-19 panel panel-warning panel-alt widget-today" onmousemove="highlightHover('set','19')" onmouseleave="highlightHover('unset', '19')">
                        <div class=" panel-heading text-center" style="background-color: #ffffff; height: 12.4em; border-radius: 6px">
                            <i class="fad fa-tasks" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; font-size: 4.5em;"></i>
                            <h5 class="today" style="width: 115%;margin-left: -7%;height: 4em;padding-top: 4.5em;font-size:90%;font-weight: bold;margin-top: -2.6em;font-family: 'RobotoRegular', Helvetica, sans-serif !important;">Traiter les demandes de certificat de conformité</h5>
                        </div>
                    </div><!-- panel -->
                </div>
            </a>
        </div>
    </div><!-- row -->
@endsection
