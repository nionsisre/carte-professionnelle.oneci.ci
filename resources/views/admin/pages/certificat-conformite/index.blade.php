@extends('layouts.app')

@section('page-styles')
    <style>
        @keyframes play120 {
            0% {
                background-position: 0px 0px;
            }
            100% {
                background-position: -12000px 0px;
            }
        }
        .shapeshifter {
            animation-duration: 2000ms;
            animation-iteration-count: infinite;
            animation-timing-function: steps(120);
            width: 100px;
            height: 169px;
            background-repeat: no-repeat;
        }
        .shapeshifter.play {
            animation-name: play120;
        }
        .animated-logo {
            display: inline-block;
            width: 7.8em;
        }
        .centered-content {
            margin-top: 27vh;
            text-align: center;
        }
    </style>
@endsection

@section('page-title-tab')
    <div class="pageheader">
        <h2><img src="{{ URL::asset('back-office/assets/images/ostatplus_icon.svg') }}" alt="" style="width: 1.5em; padding: 0.2em 0.2em 0.4em 0.2em"/> &nbsp; OStat+ Web</h2>
    </div>
@endsection

@section('preloader')
    @if(!empty($context))
        <div></div>
    @else
        <div id="preloader" style="background: linear-gradient(0deg, rgba(245,124,0,1) 0%, rgba(250,187,122,1) 33%, rgba(255,255,255,1) 75%);">
            {{-- <div class="shapeshifter-mini play-mini animated-logo" style="background-image: url('{{ URL::asset('admin/assets/images/ostatplus_preloader.svg') }}')"></div> --}}
            <div class="centered-content">
                <div class="shapeshifter play animated-logo" style="background-image: url('{{ URL::asset('admin/assets/images/ostatplus_preloader.svg') }}')"></div>
            </div>
        </div>
    @endif
@endsection

@section('background')
    {!! 'style="background: linear-gradient(0deg, rgba(245,124,0,1) 23%, rgba(250,187,122,1) 73%, rgba(255,255,255,1) 95%);"' !!}
    {{--{!! 'style="background: linear-gradient(0deg, rgba(245,124,0,1) 0%, rgba(250,187,122,1) 33%, rgba(255,255,255,1) 75%);"' !!}--}}
@endsection

@section('vendor-scripts')
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.symbol.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.crosshair.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.categories.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/raphael-2.1.0.min.js') }}"></script>

    <script src="{{ URL::asset('admin/assets/js/vendors/lottie-interactivity.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/vendors/lottie-player.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/app.js') }}"></script>
    {{--
    <script src="/node_modules/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
    --}}
    {{--
    const player = document.getElementById("ostatplus-animation");
    player.addEventListener("ready", () => {
        const lottieInteractivity = window.lottieInteractivity;
        lottieInteractivity.create({ player: '#ostatplus-animation', mode: 'play', actions: [{visibility: [0,1], frames: [54]}] });
    });
    --}}
@endsection

@section('page-scripts')
    @include('panels.scripts.form-tools')
    <script>
        {{-- Initializations --}}
        jQuery('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'
        });
        var ostatPlusData = {!! json_encode($ostatplus_data) !!};
        var serviceNames = {!! json_encode($service_names) !!};
        var services = {!! json_encode($services) !!};
        var typesPerServices = {!! json_encode($types_per_services) !!};
        var departmentData = {!! json_encode($department_list) !!};
        var centreData = {!! json_encode($centre_list) !!};
        {{-- Process --}}
        jQuery('input[name="date_type"]').click(function () {
            if(jQuery('#ostatplus-date').is(':checked')) {
                jQuery('#ostatplus-date-container').show();
                jQuery('#ostatplus-interval-container').hide();
                if(jQuery('#code-centre-select').val() !== "0") {
                    jQuery('#ostatplus-ostatplus-add-edit-container').show();
                    jQuery('.date-button-label').each(function () {
                        jQuery(this).text(jQuery('input[name="report_date"]').val());
                    });
                    jQuery('.local-button-label').each(function () {
                        jQuery(this).text(jQuery('#code-centre-select').select2('data').text);
                    });
                } else {
                    jQuery('#ostatplus-ostatplus-add-edit-container').hide();
                }
            } else if(jQuery('#ostatplus-interval').is(':checked')) {
                jQuery('#ostatplus-date-container').hide();
                jQuery('#ostatplus-interval-container').show();
                jQuery('#ostatplus-ostatplus-add-edit-container').hide();
            }
        });
        jQuery('#code-region-select').change(function () {
            var selected_code_region = this.value;

            // Récupérer le select2 du département et effacer
            var departmentSelect = jQuery('#code-department-select');
            departmentSelect.empty();
            // Filtrer et ajouter les départements basés sur la région sélectionnée
            var option = new Option("Tous les départements de la liste", "0");
            departmentSelect.append(option);
            jQuery.each(departmentData, function (index, department) {
                if (selected_code_region != "0") {
                    if (department.code_zone + department.code_region === selected_code_region) {
                        option = new Option(department.department_label, department.code_zone + department.code_region + department.code_departement);
                        departmentSelect.append(option);
                    }
                } else {
                    option = new Option(department.department_label, department.code_zone + department.code_region + department.code_departement);
                    departmentSelect.append(option);
                }
            });
            // Mettre à jour le select2 après avoir ajouté les départements
            departmentSelect.select2();

            // Récupérer le select2 du centre et effacer
            var centreSelect = jQuery('#code-centre-select');
            centreSelect.empty();
            // Filtrer et ajouter les centre basés sur la région sélectionnée
            option = new Option("Tous les locaux de la liste", "0");
            centreSelect.append(option);
            jQuery.each(centreData, function (index, centre) {
                if (selected_code_region != "0") {
                    if (centre.code_zone + centre.code_region === selected_code_region) {
                        var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                        centreSelect.append(option);
                    }
                } else {
                    var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                    centreSelect.append(option);
                }
            });
            // Mettre à jour le select2 après avoir ajouté les centres
            centreSelect.select2();
        });
        jQuery('#code-department-select').change(function () {
            var selected_code_region = jQuery('#code-region-select').val();
            var selected_code_department = this.value;
            // Récupérer le select2 du centre et effacer
            var centreSelect = jQuery('#code-centre-select');
            centreSelect.empty();
            // Filtrer et ajouter les centre basés sur la région sélectionnée
            option = new Option("Tous les locaux de la liste", "0");
            centreSelect.append(option);
            jQuery.each(centreData, function (index, centre) {
                if (selected_code_department != "0") {
                    if (centre.code_zone + centre.code_region + centre.code_departement === selected_code_department) {
                        var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                        centreSelect.append(option);
                    }
                } else if(selected_code_region != "0") {
                    if (centre.code_zone + centre.code_region === selected_code_region) {
                        var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                        centreSelect.append(option);
                    }
                } else {
                    var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                    centreSelect.append(option);
                }
            });
            // Mettre à jour le select2 après avoir ajouté les centres
            centreSelect.select2();
        });
        jQuery('#type-local-select').change(function () {
            var selected_code_region = jQuery('#code-region-select').val();
            var selected_code_department = jQuery('#code-department-select').val();
            var selected_type_local = this.value;

            // Récupérer le select2 du centre et effacer
            var centreSelect = jQuery('#code-centre-select');
            centreSelect.empty();
            // Filtrer et ajouter les centre basés sur la région sélectionnée
            option = new Option("Tous les locaux de la liste", "0");
            centreSelect.append(option);
            jQuery.each(centreData, function (index, centre) {
                if(selected_type_local === "0") {
                    if (selected_code_department != "0") {
                        if (centre.code_zone + centre.code_region + centre.code_departement === selected_code_department) {
                            var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                            centreSelect.append(option);
                        }
                    } else if(selected_code_region != "0") {
                        if (centre.code_zone + centre.code_region === selected_code_region) {
                            var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                            centreSelect.append(option);
                        }
                    } else {
                        var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                        centreSelect.append(option);
                    }
                } else if(selected_type_local === "1") {
                    if ((centre.location_label + ", " + centre.area_label + ", " + centre.department_label).includes("AGENCE")) {
                        if (selected_code_department != "0") {
                            if (centre.code_zone + centre.code_region + centre.code_departement === selected_code_department) {
                                var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                                centreSelect.append(option);
                            }
                        } else if(selected_code_region != "0") {
                            if (centre.code_zone + centre.code_region === selected_code_region) {
                                var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                                centreSelect.append(option);
                            }
                        } else {
                            var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                            centreSelect.append(option);
                        }
                    }
                } else if(selected_type_local === "2") {
                    if (!((centre.location_label + ", " + centre.area_label + ", " + centre.department_label).includes("AGENCE"))) {
                        if (selected_code_department != "0") {
                            if (centre.code_zone + centre.code_region + centre.code_departement === selected_code_department) {
                                var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                                centreSelect.append(option);
                            }
                        } else if(selected_code_region != "0") {
                            if (centre.code_zone + centre.code_region === selected_code_region) {
                                var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                                centreSelect.append(option);
                            }
                        } else {
                            var option = new Option(centre.location_label + ", " + centre.area_label + ", " + centre.department_label, centre.code_unique_centre);
                            centreSelect.append(option);
                        }
                    }
                }
            });
            // Mettre à jour le select2 après avoir ajouté les centres
            centreSelect.select2();
        });
        jQuery('#code-centre-select').change(function () {
            if(jQuery('#code-centre-select').val() !== "0" && jQuery('#ostatplus-date').is(':checked')) {
                jQuery('#ostatplus-ostatplus-add-edit-container').show();
                jQuery('.date-button-label').each(function () {
                    jQuery(this).text(jQuery('input[name="report_date"]').val());
                });
                jQuery('.local-button-label').each(function () {
                    jQuery(this).text(jQuery('#code-centre-select').select2('data').text);
                });
            } else {
                jQuery('#ostatplus-ostatplus-add-edit-container').hide();
            }
        });
        jQuery('input[name="report_date"]').change(function () {
            jQuery('.date-button-label').each(function () {
                jQuery(this).text(jQuery('input[name="report_date"]').val());
            });
            jQuery('.local-button-label').each(function () {
                jQuery(this).text(jQuery('#code-centre-select').select2('data').text);
            });
        });
        @if(isset($type_local))
        jQuery(document).ready(function () {
            jQuery('#code-region-select').val("{{ $code_region }}").trigger('change');
            jQuery('#code-department-select').val("{{ $code_department }}").trigger('change');
            jQuery('#type-local-select').val("{{ $type_local }}").trigger('change');
            jQuery('#code-centre-select').val("{{ $code_unique_centre }}").trigger('change');
            jQuery('.local-button-label').each(function () {
                jQuery(this).text(jQuery('#code-centre-select').select2('data').text);
            });
            jQuery('#service-select').change(function () {
                var selectedService = this.value;
                var typeServiceContainer = jQuery('#ostatplus-type-service-container');
                var container = "";
                typeServiceContainer.empty();
                jQuery.each(typesPerServices, function (index, typesPerService) {
                    if(typesPerService.service_id === parseInt(selectedService)) {
                        container +=
                            '<div class="form-group">\n\
                                <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 control-label"><b>'+typesPerService.type_service_label+'</b> : </label>\n\
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">\n\
                                    <input type="number" name="type_service[]" id="type-service-input-'+index+'" required maxlength="100" class="form-control" placeholder="'+ typesPerService.type_service_label +'" />\n\
                                </div>\n\
                            </div>';
                    }
                });
                typeServiceContainer.html(container);
            });
            if(jQuery('#ostatplus-date').is(':checked')) {
                jQuery('#ostatplus-date').click();
            } else if(jQuery('#ostatplus-interval').is(':checked')) {
                jQuery('#ostatplus-interval').click();
            }
        });
        @endif
        function getReportFormSubmit(form) {
            $('#ostatplus-data-container').hide();
            $('#ostatplus-loader-container').show();
            $('#ostatplus-image').hide();
            $('#ostatplus-loader-text-container').html('<b>Chargement en cours...</b><br/>Veuillez patienter');
            $('#ostatplus-animation').show().attr('loop', 'true').attr('autoplay', 'true').get(0).play();
            $(form).submit();
        }
        function sendReportFormSubmit(form) {
        }
        @if(!empty($ostatplus_data['data']->reports))
            function pieChartSetter(containerId, containerLegendId, data, serviceName) {
                /* Parsing and displaying received response object */
                try {
                    let piedata = []; /* Pie Data Object */
                    if(data['data'].reports.length !== 0) {
                        for (let index in data['data'].reports) {
                            if (serviceName === data['data'].reports[index]["service_name"]) {
                                piedata.push({
                                    label: data['data'].reports[index]["type_service_name"],
                                    data: [[1, data['data'].reports[index]["value"]]]//,
                                    //color: '#424242'
                                });
                            }
                        }
                    } else {
                        $(containerId).html("<center style='padding-top: 11em'>Aucune donnée à afficher</center>");
                    }
                    /* Pie Chart Settings */
                    jQuery.plot(containerId, piedata, {
                        series: {
                            pie: {
                                show: true,
                                radius: 0.9,
                                label: {
                                    show: true,
                                    //radius: 1 / 3,
                                    formatter: labelFormatter,
                                    threshold: 0.03,
                                    background: {
                                        opacity: 0.8
                                    }
                                }
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true
                        },
                        legend: {
                            show: true,
                            position : "se",
                            container: containerLegendId,
                            labelBoxBorderColor: "none"
                        }
                    });
                    function labelFormatter(label, series) {
                        {{--return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + (Math.round(series.percent * 100) / 100) + "%</div>";--}}
                        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + (Math.round(series.percent * 100) / 100) + "%</div>";
                    }
                } catch (exception) {}
            }
            for (let index in serviceNames) {
                pieChartSetter("#ostatplus-report-"+index, "#ostatplus-legend-"+index, ostatPlusData, serviceNames[index]);
            }
        @endif
    </script>
@endsection

{{--
@section('logo')
    <img src="{{ URL::asset('admin/assets/images/ostatplus_icon.svg') }}" alt="" style="width: 2.5em; padding: 0.2em 0.2em"/>
@endsection
--}}

@section('content')

    <div class="row mb10">
        <form id="get-report-form" class="form-horizontal" action="{{ route('ostatplus.reports.get') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="context" value="get-reports"/>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if($show_region_and_department)
                        <div style="margin-bottom: 1em">
                            <div class="form-group">
                                <label class="control-label hidden-xs hidden-sm col-md-4 col-lg-4">Région : </label>
                                <select id="code-region-select" class="form-control good-select col-xs-12 col-sm-12 col-md-8 col-lg-8" name="code_region" required>
                                    <option value="0" @if($code_region == "0") {{ 'selected="selected"' }} @endif>Toutes les régions de la liste</option>
                                    @foreach($region_list as $region)
                                        <option value="{{ $region->code_zone.$region->code_region }}" @if($code_region == $region->code_zone.$region->code_region) {{ 'selected="selected"' }} @endif>{{ $region->region_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="margin-bottom: 1em">
                            <div class="form-group">
                                <label class="control-label hidden-xs hidden-sm col-md-4 col-lg-4">Département : </label>
                                <select id="code-department-select" class="form-control good-select col-xs-12 col-sm-12 col-md-8 col-lg-8" name="code_department" required>
                                    <option value="0" @if($code_department == "0") {{ 'selected="selected"' }} @endif>Tous les départements de la liste</option>
                                    @foreach($department_list as $department)
                                        <option value="{{ $department->code_zone.$department->code_region.$department->code_departement }}" @if($code_department == $department->code_zone.$department->code_region.$department->code_departement) {{ 'selected="selected"' }} @endif>{{ $department->department_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="margin-bottom: 1em">
                            <div class="form-group">
                                <label class="control-label hidden-xs hidden-sm col-md-4 col-lg-4">Type de local : </label>
                                <select id="type-local-select" class="form-control good-select col-xs-12 col-sm-12 col-md-8 col-lg-8" name="type_local" required>
                                    <option value="0" @if($type_local == "0") {{ 'selected="selected"' }} @endif>Tous les types de locaux</option>
                                    <option value="1" @if($type_local == "1") {{ 'selected="selected"' }} @endif>Agences uniquement</option>
                                    <option value="2" @if($type_local == "2") {{ 'selected="selected"' }} @endif>Centres uniquement</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div>
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1"><i class="fa fa-store-alt"></i></label>
                                <select id="code-centre-select" class="form-control good-select col-xs-11 col-sm-11 col-md-11 col-lg-11" name="code_unique_centre" required>
                                    <option value="0" @if($code_unique_centre == "0") {{ 'selected="selected"' }} @endif>Tous les locaux de la liste</option>
                                    @foreach($centre_list as $centre)
                                        <option value="{{ $centre->code_unique_centre }}" @if($code_unique_centre == $centre->code_unique_centre) {{ 'selected="selected"' }} @endif>
                                            {{ $centre->location_label . ", " . $centre->area_label . ", " . $centre->department_label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div><!-- panel-body -->
                </div><!-- panel-default -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="margin-bottom: 1em">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="rdio rdio-default col-xs-6 col-sm-6 col-md-12 col-lg-12">
                                    <input type="radio" name="date_type" id="ostatplus-date" value="date" @if((isset($date_type) && !empty($date_type) && $date_type == "date") || !isset($date_type)) {{ "checked" }} @endif>
                                    <label for="ostatplus-date">Date</label>
                                </div>
                                <div class="rdio rdio-default col-xs-6 col-sm-6 col-md-12 col-lg-12">
                                    <input type="radio" name="date_type" id="ostatplus-interval" value="interval" @if(isset($date_type) && !empty($date_type) && $date_type == "interval") {{ "checked" }} @endif>
                                    <label for="ostatplus-interval">Intervalle</label>
                                </div>
                            </div>
                            <div id="ostatplus-date-container">
                                <div class="input-group col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <input type="text" class="form-control datepicker" name="report_date" placeholder="Date de début"
                                           id="ostatplus-datepicker-date" value="@if(isset($report_date) && !empty($report_date)) {{ $report_date }} @else {{ date('d/m/Y') }} @endif" autocomplete="off">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div id="ostatplus-interval-container" style="display: none">
                                <div class="input-group col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <input type="text" class="form-control datepicker" name="report_start_date" placeholder="Date de début"
                                           id="ostatplus-datepicker-begin" value="@if(isset($report_start_date) && !empty($report_start_date)) {{ $report_start_date }} @else {{ date('d/m/Y') }} @endif" autocomplete="off">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                                <div class="input-group col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <input type="text" class="form-control datepicker" name="report_end_date" placeholder="Date de fin"
                                           id="ostatplus-datepicker-end" value="@if(isset($report_end_date) && !empty($report_end_date)) {{ $report_end_date }} @else {{ date('d/m/Y') }} @endif" autocomplete="off">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- panel-body -->
                    <div class="panel-footer text-center col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color: #fcfcfc">
                        <button class="btn btn-success col-xs-12 col-sm-12 col-md-12 col-lg-12" id="ostatplus-refresh-button" onclick="cancelFormSubmit('#get-report-form', getReportFormSubmit)"><i class="fa fa-sync mr20"></i>Actualiser</button>
                    </div><!-- panel-footer -->
                </div><!-- panel-default -->
            </div><!-- col-md-8 -->
        </form>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt10" id="ostatplus-ostatplus-add-edit-container" style="display: none">
            <div class="panel panel-default">
                <div class="panel-body">
                    <button class="btn btn-success col-xs-12 col-sm-12 col-md-12 col-lg-12" id="ostatplus-add-edit-button" onclick="cancelFormSubmit('#send-report-form', sendReportFormSubmit)"  data-placement="bottom" data-toggle="modal" data-target="#add-or-edit-report-modal"><i class="fa fa-edit mr20"></i>Ajouter ou mettre à jour les données <br/>du <span class="date-button-label">@if(!isset($date_type)) {{ date('d/m/Y') }} @elseif(isset($date_type) && !empty($date_type) && $date_type == "date") {{ $report_date }} @endif</span></button>
                </div><!-- panel-body -->
            </div><!-- panel-default -->
        </div><!-- col-md-8 -->

    </div><!-- row -->

    <div class="modal fade" id="add-or-edit-report-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form id="send-report-form" action="{{ route('ostatplus.reports.submit') }}" method="POST">
            <div class="modal-content">
                <div class="panel panel-success panel-alt">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-edit mr10"></i>Ajouter / Modifier rapport</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 control-label"><b>Centre ou Agence</b> : </label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <b style="display: block;margin-top: 0.3em;padding-left: 1em"><span class="local-button-label">XXXX</span></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 control-label"><b>Date</b> : </label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <b style="display: block;margin-top: 0.3em;padding-left: 1em"><span class="date-button-label">XXXX</span></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 control-label"><b>Service : </b></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <select class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-12 good-select" id="service-select" name="ostatplus_service" required>
                                    @if(sizeof($services) != 0)
                                        @foreach($services as $index => $service)
                                            <option value="{{ $service->id }}">{{ $service->label }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div id="ostatplus-type-service-container">
                            @foreach($types_per_services as $index => $types_per_service)
                                @if($types_per_service->service_id == $services[0]->id)
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 control-label"><b>{{ $types_per_service->type_service_label }}</b> : </label>
                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                        <input type="number" name="type_service[]" id="type-service-input-{{ $index }}" required maxlength="100" class="form-control" placeholder="{{ $types_per_service->type_service_label }}" />
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <button class="btn btn-success btn-block" id="ostatplus-refresh-button" onclick="cancelFormSubmit('#get-report-form', getReportFormSubmit)"><i class="fa fa-check mr20"></i>Valider</button>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <button class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-times mr20"></i>Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    @if(!empty($ostatplus_data['data']->reports))
        <div id="ostatplus-data-container">
            <div class="row mb10" style="color: black">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt10">
                    <h4><i class="fa fa-calendar-day mr10"></i> &nbsp; Données du @if(!isset($date_type)) {{ date('d/m/Y') }} @elseif(isset($date_type) && !empty($date_type) && $date_type == "date") {{ $report_date }} @elseif(isset($date_type) && !empty($date_type) && $date_type == "interval") {{ $report_start_date }} au {{ $report_end_date }} @endif</h4>
                </div>
            </div>
            <div class="row">
                @foreach($service_names as $index => $service_name)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt10">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div>
                                    @foreach($ostatplus_data['data']->reports as $report)
                                        @if($service_name == $report["service_name"])
                                            @if(!empty($report["icon"]))
                                                <img class="mr10" src="{{ $report["icon"] }}" alt="icon" style="width: 3.5em; padding: 0.2em 0.2em 0.4em 0.2em; margin-bottom: 0.8em"/>{{ $service_name }}<hr/>
                                            @else
                                                <i class="fa fa-chart-bar mr10" style="font-size: 2em; padding: 0.2em 0.2em 0.4em 0.2em"></i>{{ $service_name }}<hr/>
                                            @endif
                                            @break
                                        @endif
                                    @endforeach
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                            @foreach($ostatplus_data['data']->reports as $idx => $report)
                                                @if($service_name == $report["service_name"])
                                                    {{ $report["type_service_name"] }} : <b>@if(!empty($ostatplus_data['data']->reports_stock) && ($report["type_service_id"] == 9 || $report["type_service_id"] == 11 || $report["type_service_id"] == 15 || $report["type_service_id"] == 16 || $report["type_service_id"] == 17) ) {{ $ostatplus_data['data']->reports_stock[$idx]["value"] }} @else {{ $report["value"] }} @endif</b><br/>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                            <div id="ostatplus-report-{{ $index }}" class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style=" height: 300px"></div>
                                            <div id="ostatplus-legend-{{ $index }}" class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="height: 300px"></div>
                                        </div>
                                    </div>
                                    @if((!isset($date_type) || isset($date_type) && !empty($date_type) && $date_type == "date") && $code_unique_centre !== "0")
                                        @foreach($ostatplus_data['data']->reports as $report)
                                            @if($service_name == $report["service_name"])
                                                    <div>&nbsp;</div>
                                                    <em class="visible-xs-block visible-sm-block visible-md-block visible-lg-block text-right">{{ $report["reason"] }}</em>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel-default -->
                    </div>
                @endforeach
            </div>
        </div>
        <div id="ostatplus-loader-container" class="row" style="display: none">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="text-center" style="margin-top: 4em">
                    <div class="text-center" style="display: flex;justify-content: center;align-items: center;">
                        <div id="ostatplus-image" style="width: 200px; height: 200px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1000 1000" width="1000" height="1000" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;"><defs><clipPath id="__lottie_element_2"><rect width="1000" height="1000" x="0" y="0"></rect></clipPath></defs><g clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,449.260009765625,199.75)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,207.9199981689453,18.917999267578125)"><path fill="rgb(205,201,201)" fill-opacity="1" d=" M61.14099884033203,18.66699981689453 C61.14099884033203,-1.9529999494552612 79.73400115966797,-18.66699981689453 102.66899871826172,-18.66699981689453 C125.60600280761719,-18.66699981689453 144.2010040283203,-1.9529999494552612 144.2010040283203,18.66699981689453 C144.2010040283203,18.66699981689453 -144.1999969482422,18.66699981689453 -144.1999969482422,18.66699981689453 C-144.1999969482422,18.66699981689453 -144.1999969482422,-18.66699981689453 -144.1999969482422,-18.66699981689453 C-144.1999969482422,-18.66699981689453 102.66899871826172,-18.66699981689453 102.66899871826172,-18.66699981689453"></path></g></g><g transform="matrix(1,0,0,1,449.260009765625,199.75)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,155.4199981689453,189.16400146484375)"><path fill="rgb(231,227,228)" fill-opacity="1" d=" M12.277000427246094,188.91400146484375 C12.277000427246094,188.91400146484375 -155.1699981689453,188.91400146484375 -155.1699981689453,188.91400146484375 C-155.1699981689453,188.91400146484375 -155.1699981689453,-151.57899475097656 -155.1699981689453,-151.57899475097656 C-155.1699981689453,-151.57899475097656 -155.1699981689453,-147.58099365234375 -155.1699981689453,-147.58099365234375 C-155.1699981689453,-168.1999969482422 -136.57699584960938,-188.91400146484375 -113.63999938964844,-188.91400146484375 C-113.63999938964844,-188.91400146484375 155.1699981689453,-188.91400146484375 155.1699981689453,-188.91400146484375 C132.23399353027344,-188.91400146484375 113.63999938964844,-172.19900512695312 113.63999938964844,-151.57899475097656 C113.63999938964844,-151.57899475097656 113.63999938964844,151.57899475097656 113.63999938964844,151.57899475097656 C113.63999938964844,172.197998046875 95.0479965209961,188.91400146484375 72.11100006103516,188.91400146484375 C72.11100006103516,188.91400146484375 12.277000427246094,188.91400146484375 12.277000427246094,188.91400146484375z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,241.48699951171875,189.69200134277344)"><path fill="rgb(240,240,240)" fill-opacity="1" d=" M153.87399291992188,-189.44200134277344 C130.93699645996094,-189.44200134277344 112.34500122070312,-172.7270050048828 112.34500122070312,-152.10699462890625 C112.34500122070312,-152.10699462890625 110.93900299072266,152.10699462890625 110.93900299072266,152.10699462890625 C110.93900299072266,172.7259979248047 92.34600067138672,189.44200134277344 69.41000366210938,189.44200134277344 C69.41000366210938,189.44200134277344 -153.87399291992188,189.44200134277344 -153.87399291992188,189.44200134277344 C-153.87399291992188,189.44200134277344 -153.87399291992188,-158.92100524902344 -153.87399291992188,-158.92100524902344 C-153.87399291992188,-158.92100524902344 -152.75399780273438,-181.8820037841797 -124.75299835205078,-189.16299438476562 C-124.75299835205078,-189.16299438476562 153.87399291992188,-189.44200134277344 153.87399291992188,-189.44200134277344z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,155.59100341796875,360.4670104980469)"><path fill="rgb(204,201,200)" fill-opacity="1" d=" M155.34100341796875,18.66699981689453 C132.40499877929688,18.66699981689453 113.81199645996094,1.9520000219345093 113.81199645996094,-18.66699981689453 C113.81199645996094,-18.66699981689453 -155.34100341796875,-18.66699981689453 -155.34100341796875,-18.66699981689453 C-155.34100341796875,-18.66699981689453 -151.42100524902344,14.777000427246094 -118.94000244140625,18.66699981689453 C-118.94000244140625,18.66699981689453 155.34100341796875,18.66699981689453 155.34100341796875,18.66699981689453z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,416.1260070800781,78.60600280761719)"><path fill="rgb(205,202,200)" fill-opacity="1" d=" M62.29399871826172,78.35600280761719 C39.358001708984375,78.35600280761719 20.764999389648438,61.63999938964844 20.764999389648438,41.020999908447266 C20.764999389648438,41.020999908447266 20.764999389648438,-41.020999908447266 20.764999389648438,-41.020999908447266 C20.764999389648438,-61.64099884033203 2.1710000038146973,-78.35600280761719 -20.764999389648438,-78.35600280761719 C-43.70100021362305,-78.35600280761719 -62.29399871826172,-61.64099884033203 -62.29399871826172,-41.020999908447266 C-62.29399871826172,-41.020999908447266 -62.29399871826172,41.020999908447266 -62.29399871826172,41.020999908447266 C-62.29399871826172,41.020999908447266 -62.29399871826172,78.35600280761719 -62.29399871826172,78.35600280761719 C-62.29399871826172,78.35600280761719 62.29399871826172,78.35600280761719 62.29399871826172,78.35600280761719z"></path></g></g><g transform="matrix(1,0,0,1,309.3580017089844,465.57598876953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,108.52200317382812,4.730000019073486)"><path fill="rgb(58,67,78)" fill-opacity="1" d=" M108.27200317382812,4.480000019073486 C108.27200317382812,4.480000019073486 -108.27200317382812,4.480000019073486 -108.27200317382812,4.480000019073486 C-108.27200317382812,4.480000019073486 -108.27200317382812,-4.480000019073486 -108.27200317382812,-4.480000019073486 C-108.27200317382812,-4.480000019073486 108.27200317382812,-4.480000019073486 108.27200317382812,-4.480000019073486 C108.27200317382812,-4.480000019073486 108.27200317382812,4.480000019073486 108.27200317382812,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,309.3580017089844,483.5)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,54.3849983215332,3.4170000553131104)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M54.1349983215332,3.1670000553131104 C54.1349983215332,3.1670000553131104 -54.1349983215332,3.1670000553131104 -54.1349983215332,3.1670000553131104 C-54.1349983215332,3.1670000553131104 -54.1349983215332,-3.1670000553131104 -54.1349983215332,-3.1670000553131104 C-54.1349983215332,-3.1670000553131104 54.1349983215332,-3.1670000553131104 54.1349983215332,-3.1670000553131104 C54.1349983215332,-3.1670000553131104 54.1349983215332,3.1670000553131104 54.1349983215332,3.1670000553131104z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,698.625)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,714.3060302734375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,729.9869995117188)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,374.10498046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.41300201416016,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.16300201416016,4.480000019073486 C104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 C-104.16300201416016,4.480000019073486 -104.16300201416016,-4.480000019073486 -104.16300201416016,-4.480000019073486 C-104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 C104.16300201416016,-4.480000019073486 104.16300201416016,4.480000019073486 104.16300201416016,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,392.5849914550781)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.41300201416016,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.16300201416016,4.480000019073486 C104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 C-104.16300201416016,4.480000019073486 -104.16300201416016,-4.480000019073486 -104.16300201416016,-4.480000019073486 C-104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 C104.16300201416016,-4.480000019073486 104.16300201416016,4.480000019073486 104.16300201416016,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,38.99399948120117,15.930000305175781)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M34.26599884033203,11.201000213623047 C34.26599884033203,11.201000213623047 -34.26599884033203,11.201000213623047 -34.26599884033203,11.201000213623047 C-34.26599884033203,11.201000213623047 -34.26599884033203,-11.201000213623047 -34.26599884033203,-11.201000213623047 C-34.26599884033203,-11.201000213623047 34.26599884033203,-11.201000213623047 34.26599884033203,-11.201000213623047 C34.26599884033203,-11.201000213623047 34.26599884033203,11.201000213623047 34.26599884033203,11.201000213623047z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,38.994998931884766,15.930999755859375)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M38.744998931884766,15.680999755859375 C38.744998931884766,15.680999755859375 -38.744998931884766,15.680999755859375 -38.744998931884766,15.680999755859375 C-38.744998931884766,15.680999755859375 -38.744998931884766,-15.680999755859375 -38.744998931884766,-15.680999755859375 C-38.744998931884766,-15.680999755859375 38.744998931884766,-15.680999755859375 38.744998931884766,-15.680999755859375 C38.744998931884766,-15.680999755859375 38.744998931884766,15.680999755859375 38.744998931884766,15.680999755859375z M-29.78499984741211,6.7210001945495605 C-29.78499984741211,6.7210001945495605 29.783000946044922,6.7210001945495605 29.783000946044922,6.7210001945495605 C29.783000946044922,6.7210001945495605 29.783000946044922,-6.71999979019165 29.783000946044922,-6.71999979019165 C29.783000946044922,-6.71999979019165 -29.78499984741211,-6.71999979019165 -29.78499984741211,-6.71999979019165 C-29.78499984741211,-6.71999979019165 -29.78499984741211,6.7210001945495605 -29.78499984741211,6.7210001945495605z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,54.85100173950195,34.691001892089844)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M-7,-7.560999870300293 C-7,-7.560999870300293 7,-7.560999870300293 7,-7.560999870300293 C7,-7.560999870300293 7,7.560999870300293 7,7.560999870300293 C7,7.560999870300293 -7,-7.560999870300293 -7,-7.560999870300293z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,329.302001953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.690999984741211,13.6899995803833)"><path fill="rgb(49,60,73)" fill-opacity="1" d=" M13.440999984741211,-13.4399995803833 C13.440999984741211,-13.4399995803833 -13.440999984741211,-13.4399995803833 -13.440999984741211,-13.4399995803833 C-13.440999984741211,-13.4399995803833 -13.440999984741211,13.4399995803833 -13.440999984741211,13.4399995803833 C-13.440999984741211,13.4399995803833 13.440999984741211,13.4399995803833 13.440999984741211,13.4399995803833 C13.440999984741211,13.4399995803833 13.440999984741211,-13.4399995803833 13.440999984741211,-13.4399995803833z"></path></g></g><g transform="matrix(1,0,0,1,527.10400390625,293.46002197265625)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,31.611000061035156)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-31.361000061035156 C13.4399995803833,-31.361000061035156 -13.4399995803833,-31.361000061035156 -13.4399995803833,-31.361000061035156 C-13.4399995803833,-31.361000061035156 -13.4399995803833,31.361000061035156 -13.4399995803833,31.361000061035156 C-13.4399995803833,31.361000061035156 13.4399995803833,31.361000061035156 13.4399995803833,31.361000061035156 C13.4399995803833,31.361000061035156 13.4399995803833,-31.361000061035156 13.4399995803833,-31.361000061035156z"></path></g></g><g transform="matrix(1,0,0,1,571.3460083007812,314.1809997558594)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,21.25)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-21 C13.4399995803833,-21 -13.4399995803833,-21 -13.4399995803833,-21 C-13.4399995803833,-21 -13.4399995803833,21 -13.4399995803833,21 C-13.4399995803833,21 13.4399995803833,21 13.4399995803833,21 C13.4399995803833,21 13.4399995803833,-21 13.4399995803833,-21z"></path></g></g><g transform="matrix(1,0,0,1,659.2680053710938,281.1400146484375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,37.770999908447266)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-37.520999908447266 C13.4399995803833,-37.520999908447266 -13.4399995803833,-37.520999908447266 -13.4399995803833,-37.520999908447266 C-13.4399995803833,-37.520999908447266 -13.4399995803833,37.520999908447266 -13.4399995803833,37.520999908447266 C-13.4399995803833,37.520999908447266 13.4399995803833,37.520999908447266 13.4399995803833,37.520999908447266 C13.4399995803833,37.520999908447266 13.4399995803833,-37.520999908447266 13.4399995803833,-37.520999908447266z"></path></g></g><g transform="matrix(1,0,0,1,614.2479858398438,239.697998046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,58.492000579833984)"><path fill="rgb(248,122,84)" fill-opacity="1" d=" M13.4399995803833,-58.242000579833984 C13.4399995803833,-58.242000579833984 -13.4399995803833,-58.242000579833984 -13.4399995803833,-58.242000579833984 C-13.4399995803833,-58.242000579833984 -13.4399995803833,58.242000579833984 -13.4399995803833,58.242000579833984 C-13.4399995803833,58.242000579833984 13.4399995803833,58.242000579833984 13.4399995803833,58.242000579833984 C13.4399995803833,58.242000579833984 13.4399995803833,-58.242000579833984 13.4399995803833,-58.242000579833984z"></path></g></g><g transform="matrix(1,0,0,1,382.0579833984375,521.3880004882812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,36.090999603271484,36.09199905395508)"><path fill="rgb(246,129,92)" fill-opacity="1" d=" M35.84199905395508,35.84199905395508 C35.84199905395508,-3.747999906539917 3.747999906539917,-35.84199905395508 -35.84199905395508,-35.84199905395508 C-35.84199905395508,-35.84199905395508 -35.84199905395508,35.84199905395508 -35.84199905395508,35.84199905395508 C-35.84199905395508,35.84199905395508 35.84199905395508,35.84199905395508 35.84199905395508,35.84199905395508z"></path></g></g><g transform="matrix(1,0,0,1,354.6619873046875,521.3889770507812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.947999954223633,36.09199905395508)"><path fill="rgb(250,215,115)" fill-opacity="1" d=" M13.697999954223633,-35.84199905395508 C3.986999988555908,-35.84199905395508 -5.251999855041504,-33.8650016784668 -13.697999954223633,-30.365999221801758 C-13.697999954223633,-30.365999221801758 13.697999954223633,35.84199905395508 13.697999954223633,35.84199905395508 C13.697999954223633,35.84199905395508 13.697999954223633,-35.84199905395508 13.697999954223633,-35.84199905395508z"></path></g></g><g transform="matrix(1,0,0,1,310.375,526.864013671875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,61.81399917602539,69.19499969482422)"><path fill="rgb(47,61,73)" fill-opacity="1" d=" M-17.277000427246094,-68.94599914550781 C-43.26300048828125,-58.18000030517578 -61.56399917602539,-32.61800003051758 -61.56399917602539,-2.73799991607666 C-61.56399917602539,36.85200119018555 -29.47100067138672,68.94599914550781 10.119000434875488,68.94599914550781 C30.341999053955078,68.94599914550781 48.53200149536133,60.50199890136719 61.56399917602539,47.03200149536133 C61.56399917602539,47.03200149536133 10.119000434875488,-2.73799991607666 10.119000434875488,-2.73799991607666 C10.119000434875488,-2.73799991607666 -17.277000427246094,-68.94599914550781 -17.277000427246094,-68.94599914550781z"></path></g></g><g transform="matrix(1,0,0,1,382.0579833984375,593.072021484375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,36.090999603271484,25.135000228881836)"><path fill="rgb(253,255,255)" fill-opacity="1" d=" M-35.840999603271484,-24.885000228881836 C-35.840999603271484,-24.885000228881836 15.602999687194824,24.885000228881836 15.602999687194824,24.885000228881836 C28.083999633789062,11.984999656677246 35.840999603271484,-5.519000053405762 35.840999603271484,-24.885000228881836 C35.840999603271484,-24.885000228881836 -35.840999603271484,-24.885000228881836 -35.840999603271484,-24.885000228881836z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,646.8350219726562)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.722999572753906)"><path fill="rgb(250,215,115)" fill-opacity="1" d=" M9.472999572753906,9.472999572753906 C9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 C-9.472999572753906,9.472999572753906 -9.472999572753906,-9.472999572753906 -9.472999572753906,-9.472999572753906 C-9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 C9.472999572753906,-9.472999572753906 9.472999572753906,9.472999572753906 9.472999572753906,9.472999572753906z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,605.02001953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.723999977111816)"><path fill="rgb(47,61,73)" fill-opacity="1" d=" M9.472999572753906,9.473999977111816 C9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 C-9.472999572753906,9.473999977111816 -9.472999572753906,-9.473999977111816 -9.472999572753906,-9.473999977111816 C-9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 C9.472999572753906,-9.473999977111816 9.472999572753906,9.473999977111816 9.472999572753906,9.473999977111816z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,521.3889770507812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.723999977111816)"><path fill="rgb(246,129,92)" fill-opacity="1" d=" M9.472999572753906,9.473999977111816 C9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 C-9.472999572753906,9.473999977111816 -9.472999572753906,-9.473999977111816 -9.472999572753906,-9.473999977111816 C-9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 C9.472999572753906,-9.473999977111816 9.472999572753906,9.473999977111816 9.472999572753906,9.473999977111816z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,563.2050170898438)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.722999572753906)"><path fill="rgb(253,255,255)" fill-opacity="1" d=" M9.472999572753906,9.472999572753906 C9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 C-9.472999572753906,9.472999572753906 -9.472999572753906,-9.472999572753906 -9.472999572753906,-9.472999572753906 C-9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 C9.472999572753906,-9.472999572753906 9.472999572753906,9.472999572753906 9.472999572753906,9.472999572753906z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,526.3809814453125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.73199987411499 C0.25,4.73199987411499 27.1299991607666,4.73199987411499 27.1299991607666,4.73199987411499 C27.1299991607666,4.73199987411499 0.25,4.73199987411499 0.25,4.73199987411499z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,568.197998046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.729000091552734 C0.25,4.729000091552734 27.1299991607666,4.729000091552734 27.1299991607666,4.729000091552734 C27.1299991607666,4.729000091552734 0.25,4.729000091552734 0.25,4.729000091552734z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,610.010986328125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.73199987411499 C0.25,4.73199987411499 27.1299991607666,4.73199987411499 27.1299991607666,4.73199987411499 C27.1299991607666,4.73199987411499 0.25,4.73199987411499 0.25,4.73199987411499z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,651.8289794921875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.729000091552734 C0.25,4.729000091552734 27.1299991607666,4.729000091552734 27.1299991607666,4.729000091552734 C27.1299991607666,4.729000091552734 0.25,4.729000091552734 0.25,4.729000091552734z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g></g></svg></div>
                        <lottie-player id="ostatplus-animation" src="{{ URL::asset('admin/assets/images/ostatplus_animation.json') }}" background="transparent"  speed="1"  style="width: 200px; height: 200px; display: none;"></lottie-player>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="ostatplus-loader-text-container" class="text-center" style="color: black">
                    <b>Chargement en cours...</b><br/>
                    Veuillez patienter
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="text-center" style="margin-top: 4em">
                    <div class="text-center" style="display: flex;justify-content: center;align-items: center;">
                        <div id="ostatplus-image" style="width: 200px; height: 200px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1000 1000" width="1000" height="1000" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;"><defs><clipPath id="__lottie_element_2"><rect width="1000" height="1000" x="0" y="0"></rect></clipPath></defs><g clip-path="url(#__lottie_element_2)"><g transform="matrix(1,0,0,1,449.260009765625,199.75)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,207.9199981689453,18.917999267578125)"><path fill="rgb(205,201,201)" fill-opacity="1" d=" M61.14099884033203,18.66699981689453 C61.14099884033203,-1.9529999494552612 79.73400115966797,-18.66699981689453 102.66899871826172,-18.66699981689453 C125.60600280761719,-18.66699981689453 144.2010040283203,-1.9529999494552612 144.2010040283203,18.66699981689453 C144.2010040283203,18.66699981689453 -144.1999969482422,18.66699981689453 -144.1999969482422,18.66699981689453 C-144.1999969482422,18.66699981689453 -144.1999969482422,-18.66699981689453 -144.1999969482422,-18.66699981689453 C-144.1999969482422,-18.66699981689453 102.66899871826172,-18.66699981689453 102.66899871826172,-18.66699981689453"></path></g></g><g transform="matrix(1,0,0,1,449.260009765625,199.75)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,155.4199981689453,189.16400146484375)"><path fill="rgb(231,227,228)" fill-opacity="1" d=" M12.277000427246094,188.91400146484375 C12.277000427246094,188.91400146484375 -155.1699981689453,188.91400146484375 -155.1699981689453,188.91400146484375 C-155.1699981689453,188.91400146484375 -155.1699981689453,-151.57899475097656 -155.1699981689453,-151.57899475097656 C-155.1699981689453,-151.57899475097656 -155.1699981689453,-147.58099365234375 -155.1699981689453,-147.58099365234375 C-155.1699981689453,-168.1999969482422 -136.57699584960938,-188.91400146484375 -113.63999938964844,-188.91400146484375 C-113.63999938964844,-188.91400146484375 155.1699981689453,-188.91400146484375 155.1699981689453,-188.91400146484375 C132.23399353027344,-188.91400146484375 113.63999938964844,-172.19900512695312 113.63999938964844,-151.57899475097656 C113.63999938964844,-151.57899475097656 113.63999938964844,151.57899475097656 113.63999938964844,151.57899475097656 C113.63999938964844,172.197998046875 95.0479965209961,188.91400146484375 72.11100006103516,188.91400146484375 C72.11100006103516,188.91400146484375 12.277000427246094,188.91400146484375 12.277000427246094,188.91400146484375z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,241.48699951171875,189.69200134277344)"><path fill="rgb(240,240,240)" fill-opacity="1" d=" M153.87399291992188,-189.44200134277344 C130.93699645996094,-189.44200134277344 112.34500122070312,-172.7270050048828 112.34500122070312,-152.10699462890625 C112.34500122070312,-152.10699462890625 110.93900299072266,152.10699462890625 110.93900299072266,152.10699462890625 C110.93900299072266,172.7259979248047 92.34600067138672,189.44200134277344 69.41000366210938,189.44200134277344 C69.41000366210938,189.44200134277344 -153.87399291992188,189.44200134277344 -153.87399291992188,189.44200134277344 C-153.87399291992188,189.44200134277344 -153.87399291992188,-158.92100524902344 -153.87399291992188,-158.92100524902344 C-153.87399291992188,-158.92100524902344 -152.75399780273438,-181.8820037841797 -124.75299835205078,-189.16299438476562 C-124.75299835205078,-189.16299438476562 153.87399291992188,-189.44200134277344 153.87399291992188,-189.44200134277344z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,155.59100341796875,360.4670104980469)"><path fill="rgb(204,201,200)" fill-opacity="1" d=" M155.34100341796875,18.66699981689453 C132.40499877929688,18.66699981689453 113.81199645996094,1.9520000219345093 113.81199645996094,-18.66699981689453 C113.81199645996094,-18.66699981689453 -155.34100341796875,-18.66699981689453 -155.34100341796875,-18.66699981689453 C-155.34100341796875,-18.66699981689453 -151.42100524902344,14.777000427246094 -118.94000244140625,18.66699981689453 C-118.94000244140625,18.66699981689453 155.34100341796875,18.66699981689453 155.34100341796875,18.66699981689453z"></path></g></g><g transform="matrix(1,0,0,1,198.37100219726562,420.8659973144531)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,416.1260070800781,78.60600280761719)"><path fill="rgb(205,202,200)" fill-opacity="1" d=" M62.29399871826172,78.35600280761719 C39.358001708984375,78.35600280761719 20.764999389648438,61.63999938964844 20.764999389648438,41.020999908447266 C20.764999389648438,41.020999908447266 20.764999389648438,-41.020999908447266 20.764999389648438,-41.020999908447266 C20.764999389648438,-61.64099884033203 2.1710000038146973,-78.35600280761719 -20.764999389648438,-78.35600280761719 C-43.70100021362305,-78.35600280761719 -62.29399871826172,-61.64099884033203 -62.29399871826172,-41.020999908447266 C-62.29399871826172,-41.020999908447266 -62.29399871826172,41.020999908447266 -62.29399871826172,41.020999908447266 C-62.29399871826172,41.020999908447266 -62.29399871826172,78.35600280761719 -62.29399871826172,78.35600280761719 C-62.29399871826172,78.35600280761719 62.29399871826172,78.35600280761719 62.29399871826172,78.35600280761719z"></path></g></g><g transform="matrix(1,0,0,1,309.3580017089844,465.57598876953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,108.52200317382812,4.730000019073486)"><path fill="rgb(58,67,78)" fill-opacity="1" d=" M108.27200317382812,4.480000019073486 C108.27200317382812,4.480000019073486 -108.27200317382812,4.480000019073486 -108.27200317382812,4.480000019073486 C-108.27200317382812,4.480000019073486 -108.27200317382812,-4.480000019073486 -108.27200317382812,-4.480000019073486 C-108.27200317382812,-4.480000019073486 108.27200317382812,-4.480000019073486 108.27200317382812,-4.480000019073486 C108.27200317382812,-4.480000019073486 108.27200317382812,4.480000019073486 108.27200317382812,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,309.3580017089844,483.5)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,54.3849983215332,3.4170000553131104)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M54.1349983215332,3.1670000553131104 C54.1349983215332,3.1670000553131104 -54.1349983215332,3.1670000553131104 -54.1349983215332,3.1670000553131104 C-54.1349983215332,3.1670000553131104 -54.1349983215332,-3.1670000553131104 -54.1349983215332,-3.1670000553131104 C-54.1349983215332,-3.1670000553131104 54.1349983215332,-3.1670000553131104 54.1349983215332,-3.1670000553131104 C54.1349983215332,-3.1670000553131104 54.1349983215332,3.1670000553131104 54.1349983215332,3.1670000553131104z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,698.625)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,714.3060302734375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,309.35699462890625,729.9869995117188)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.5510025024414,4.6479997634887695)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.3010025024414,4.3979997634887695 C104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 -104.3010025024414,4.3979997634887695 C-104.3010025024414,4.3979997634887695 -104.3010025024414,-4.3979997634887695 -104.3010025024414,-4.3979997634887695 C-104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 104.3010025024414,-4.3979997634887695 C104.3010025024414,-4.3979997634887695 104.3010025024414,4.3979997634887695 104.3010025024414,4.3979997634887695z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,374.10498046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.41300201416016,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.16300201416016,4.480000019073486 C104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 C-104.16300201416016,4.480000019073486 -104.16300201416016,-4.480000019073486 -104.16300201416016,-4.480000019073486 C-104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 C104.16300201416016,-4.480000019073486 104.16300201416016,4.480000019073486 104.16300201416016,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,392.5849914550781)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,104.41300201416016,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M104.16300201416016,4.480000019073486 C104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 -104.16300201416016,4.480000019073486 C-104.16300201416016,4.480000019073486 -104.16300201416016,-4.480000019073486 -104.16300201416016,-4.480000019073486 C-104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 104.16300201416016,-4.480000019073486 C104.16300201416016,-4.480000019073486 104.16300201416016,4.480000019073486 104.16300201416016,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,38.99399948120117,15.930000305175781)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M34.26599884033203,11.201000213623047 C34.26599884033203,11.201000213623047 -34.26599884033203,11.201000213623047 -34.26599884033203,11.201000213623047 C-34.26599884033203,11.201000213623047 -34.26599884033203,-11.201000213623047 -34.26599884033203,-11.201000213623047 C-34.26599884033203,-11.201000213623047 34.26599884033203,-11.201000213623047 34.26599884033203,-11.201000213623047 C34.26599884033203,-11.201000213623047 34.26599884033203,11.201000213623047 34.26599884033203,11.201000213623047z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,38.994998931884766,15.930999755859375)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M38.744998931884766,15.680999755859375 C38.744998931884766,15.680999755859375 -38.744998931884766,15.680999755859375 -38.744998931884766,15.680999755859375 C-38.744998931884766,15.680999755859375 -38.744998931884766,-15.680999755859375 -38.744998931884766,-15.680999755859375 C-38.744998931884766,-15.680999755859375 38.744998931884766,-15.680999755859375 38.744998931884766,-15.680999755859375 C38.744998931884766,-15.680999755859375 38.744998931884766,15.680999755859375 38.744998931884766,15.680999755859375z M-29.78499984741211,6.7210001945495605 C-29.78499984741211,6.7210001945495605 29.783000946044922,6.7210001945495605 29.783000946044922,6.7210001945495605 C29.783000946044922,6.7210001945495605 29.783000946044922,-6.71999979019165 29.783000946044922,-6.71999979019165 C29.783000946044922,-6.71999979019165 -29.78499984741211,-6.71999979019165 -29.78499984741211,-6.71999979019165 C-29.78499984741211,-6.71999979019165 -29.78499984741211,6.7210001945495605 -29.78499984741211,6.7210001945495605z"></path></g></g><g transform="matrix(1,0,0,1,478.9429931640625,239.13800048828125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,54.85100173950195,34.691001892089844)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M-7,-7.560999870300293 C-7,-7.560999870300293 7,-7.560999870300293 7,-7.560999870300293 C7,-7.560999870300293 7,7.560999870300293 7,7.560999870300293 C7,7.560999870300293 -7,-7.560999870300293 -7,-7.560999870300293z"></path></g></g><g transform="matrix(1,0,0,1,480.6210021972656,329.302001953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.690999984741211,13.6899995803833)"><path fill="rgb(49,60,73)" fill-opacity="1" d=" M13.440999984741211,-13.4399995803833 C13.440999984741211,-13.4399995803833 -13.440999984741211,-13.4399995803833 -13.440999984741211,-13.4399995803833 C-13.440999984741211,-13.4399995803833 -13.440999984741211,13.4399995803833 -13.440999984741211,13.4399995803833 C-13.440999984741211,13.4399995803833 13.440999984741211,13.4399995803833 13.440999984741211,13.4399995803833 C13.440999984741211,13.4399995803833 13.440999984741211,-13.4399995803833 13.440999984741211,-13.4399995803833z"></path></g></g><g transform="matrix(1,0,0,1,527.10400390625,293.46002197265625)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,31.611000061035156)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-31.361000061035156 C13.4399995803833,-31.361000061035156 -13.4399995803833,-31.361000061035156 -13.4399995803833,-31.361000061035156 C-13.4399995803833,-31.361000061035156 -13.4399995803833,31.361000061035156 -13.4399995803833,31.361000061035156 C-13.4399995803833,31.361000061035156 13.4399995803833,31.361000061035156 13.4399995803833,31.361000061035156 C13.4399995803833,31.361000061035156 13.4399995803833,-31.361000061035156 13.4399995803833,-31.361000061035156z"></path></g></g><g transform="matrix(1,0,0,1,571.3460083007812,314.1809997558594)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,21.25)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-21 C13.4399995803833,-21 -13.4399995803833,-21 -13.4399995803833,-21 C-13.4399995803833,-21 -13.4399995803833,21 -13.4399995803833,21 C-13.4399995803833,21 13.4399995803833,21 13.4399995803833,21 C13.4399995803833,21 13.4399995803833,-21 13.4399995803833,-21z"></path></g></g><g transform="matrix(1,0,0,1,659.2680053710938,281.1400146484375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,37.770999908447266)"><path fill="rgb(201,202,199)" fill-opacity="1" d=" M13.4399995803833,-37.520999908447266 C13.4399995803833,-37.520999908447266 -13.4399995803833,-37.520999908447266 -13.4399995803833,-37.520999908447266 C-13.4399995803833,-37.520999908447266 -13.4399995803833,37.520999908447266 -13.4399995803833,37.520999908447266 C-13.4399995803833,37.520999908447266 13.4399995803833,37.520999908447266 13.4399995803833,37.520999908447266 C13.4399995803833,37.520999908447266 13.4399995803833,-37.520999908447266 13.4399995803833,-37.520999908447266z"></path></g></g><g transform="matrix(1,0,0,1,614.2479858398438,239.697998046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.6899995803833,58.492000579833984)"><path fill="rgb(248,122,84)" fill-opacity="1" d=" M13.4399995803833,-58.242000579833984 C13.4399995803833,-58.242000579833984 -13.4399995803833,-58.242000579833984 -13.4399995803833,-58.242000579833984 C-13.4399995803833,-58.242000579833984 -13.4399995803833,58.242000579833984 -13.4399995803833,58.242000579833984 C-13.4399995803833,58.242000579833984 13.4399995803833,58.242000579833984 13.4399995803833,58.242000579833984 C13.4399995803833,58.242000579833984 13.4399995803833,-58.242000579833984 13.4399995803833,-58.242000579833984z"></path></g></g><g transform="matrix(1,0,0,1,382.0579833984375,521.3880004882812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,36.090999603271484,36.09199905395508)"><path fill="rgb(246,129,92)" fill-opacity="1" d=" M35.84199905395508,35.84199905395508 C35.84199905395508,-3.747999906539917 3.747999906539917,-35.84199905395508 -35.84199905395508,-35.84199905395508 C-35.84199905395508,-35.84199905395508 -35.84199905395508,35.84199905395508 -35.84199905395508,35.84199905395508 C-35.84199905395508,35.84199905395508 35.84199905395508,35.84199905395508 35.84199905395508,35.84199905395508z"></path></g></g><g transform="matrix(1,0,0,1,354.6619873046875,521.3889770507812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,13.947999954223633,36.09199905395508)"><path fill="rgb(250,215,115)" fill-opacity="1" d=" M13.697999954223633,-35.84199905395508 C3.986999988555908,-35.84199905395508 -5.251999855041504,-33.8650016784668 -13.697999954223633,-30.365999221801758 C-13.697999954223633,-30.365999221801758 13.697999954223633,35.84199905395508 13.697999954223633,35.84199905395508 C13.697999954223633,35.84199905395508 13.697999954223633,-35.84199905395508 13.697999954223633,-35.84199905395508z"></path></g></g><g transform="matrix(1,0,0,1,310.375,526.864013671875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,61.81399917602539,69.19499969482422)"><path fill="rgb(47,61,73)" fill-opacity="1" d=" M-17.277000427246094,-68.94599914550781 C-43.26300048828125,-58.18000030517578 -61.56399917602539,-32.61800003051758 -61.56399917602539,-2.73799991607666 C-61.56399917602539,36.85200119018555 -29.47100067138672,68.94599914550781 10.119000434875488,68.94599914550781 C30.341999053955078,68.94599914550781 48.53200149536133,60.50199890136719 61.56399917602539,47.03200149536133 C61.56399917602539,47.03200149536133 10.119000434875488,-2.73799991607666 10.119000434875488,-2.73799991607666 C10.119000434875488,-2.73799991607666 -17.277000427246094,-68.94599914550781 -17.277000427246094,-68.94599914550781z"></path></g></g><g transform="matrix(1,0,0,1,382.0579833984375,593.072021484375)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,36.090999603271484,25.135000228881836)"><path fill="rgb(253,255,255)" fill-opacity="1" d=" M-35.840999603271484,-24.885000228881836 C-35.840999603271484,-24.885000228881836 15.602999687194824,24.885000228881836 15.602999687194824,24.885000228881836 C28.083999633789062,11.984999656677246 35.840999603271484,-5.519000053405762 35.840999603271484,-24.885000228881836 C35.840999603271484,-24.885000228881836 -35.840999603271484,-24.885000228881836 -35.840999603271484,-24.885000228881836z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,646.8350219726562)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.722999572753906)"><path fill="rgb(250,215,115)" fill-opacity="1" d=" M9.472999572753906,9.472999572753906 C9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 C-9.472999572753906,9.472999572753906 -9.472999572753906,-9.472999572753906 -9.472999572753906,-9.472999572753906 C-9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 C9.472999572753906,-9.472999572753906 9.472999572753906,9.472999572753906 9.472999572753906,9.472999572753906z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,605.02001953125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.723999977111816)"><path fill="rgb(47,61,73)" fill-opacity="1" d=" M9.472999572753906,9.473999977111816 C9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 C-9.472999572753906,9.473999977111816 -9.472999572753906,-9.473999977111816 -9.472999572753906,-9.473999977111816 C-9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 C9.472999572753906,-9.473999977111816 9.472999572753906,9.473999977111816 9.472999572753906,9.473999977111816z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,521.3889770507812)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.723999977111816)"><path fill="rgb(246,129,92)" fill-opacity="1" d=" M9.472999572753906,9.473999977111816 C9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 -9.472999572753906,9.473999977111816 C-9.472999572753906,9.473999977111816 -9.472999572753906,-9.473999977111816 -9.472999572753906,-9.473999977111816 C-9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 9.472999572753906,-9.473999977111816 C9.472999572753906,-9.473999977111816 9.472999572753906,9.473999977111816 9.472999572753906,9.473999977111816z"></path></g></g><g transform="matrix(1,0,0,1,466.8089904785156,563.2050170898438)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,9.722999572753906,9.722999572753906)"><path fill="rgb(253,255,255)" fill-opacity="1" d=" M9.472999572753906,9.472999572753906 C9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 -9.472999572753906,9.472999572753906 C-9.472999572753906,9.472999572753906 -9.472999572753906,-9.472999572753906 -9.472999572753906,-9.472999572753906 C-9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 9.472999572753906,-9.472999572753906 C9.472999572753906,-9.472999572753906 9.472999572753906,9.472999572753906 9.472999572753906,9.472999572753906z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,526.3809814453125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.73199987411499 C0.25,4.73199987411499 27.1299991607666,4.73199987411499 27.1299991607666,4.73199987411499 C27.1299991607666,4.73199987411499 0.25,4.73199987411499 0.25,4.73199987411499z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,568.197998046875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.729000091552734 C0.25,4.729000091552734 27.1299991607666,4.729000091552734 27.1299991607666,4.729000091552734 C27.1299991607666,4.729000091552734 0.25,4.729000091552734 0.25,4.729000091552734z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,610.010986328125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.73199987411499 C0.25,4.73199987411499 27.1299991607666,4.73199987411499 27.1299991607666,4.73199987411499 C27.1299991607666,4.73199987411499 0.25,4.73199987411499 0.25,4.73199987411499z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g><g transform="matrix(1,0,0,1,495.9289855957031,651.8289794921875)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,0,0)"><path fill="rgb(214,213,212)" fill-opacity="1" d=" M0.25,4.729000091552734 C0.25,4.729000091552734 27.1299991607666,4.729000091552734 27.1299991607666,4.729000091552734 C27.1299991607666,4.729000091552734 0.25,4.729000091552734 0.25,4.729000091552734z"></path></g><g opacity="1" transform="matrix(1,0,0,1,13.692000389099121,4.730000019073486)"><path fill="rgb(206,204,202)" fill-opacity="1" d=" M13.440999984741211,4.480000019073486 C13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 -13.440999984741211,4.480000019073486 C-13.440999984741211,4.480000019073486 -13.440999984741211,-4.480000019073486 -13.440999984741211,-4.480000019073486 C-13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 13.440999984741211,-4.480000019073486 C13.440999984741211,-4.480000019073486 13.440999984741211,4.480000019073486 13.440999984741211,4.480000019073486z"></path></g></g></g></svg></div>
                        <lottie-player id="ostatplus-animation" src="{{ URL::asset('admin/assets/images/ostatplus_animation.json') }}" background="transparent"  speed="1"  style="width: 200px; height: 200px; display: none;"></lottie-player>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="ostatplus-loader-text-container" class="text-center" style="color: black">
                    <b>Aucune donnée chargée à cette date</b><br/>
                    Veuillez selectionnez vos options et appuyer sur le bouton actualiser
                </div>
            </div>
        </div>
    @endif
@endsection
