@extends('admin/main')

@yield('css')
@section('content')

{{--    <div class="row" style="display: inline-block;" >--}}
{{--        <div class="tile_count">--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-user"></i> Total Users</span>--}}
{{--                <div class="count">2500</div>--}}
{{--                <span class="count_bottom"><i class="green">4% </i> From last Week</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>--}}
{{--                <div class="count">123.50</div>--}}
{{--                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-user"></i> Total Males</span>--}}
{{--                <div class="count green">2,500</div>--}}
{{--                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-user"></i> Total Females</span>--}}
{{--                <div class="count">4,567</div>--}}
{{--                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>--}}
{{--                <div class="count">2,315</div>--}}
{{--                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-sm-4  tile_stats_count">--}}
{{--                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>--}}
{{--                <div class="count">7,325</div>--}}
{{--                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-sm-12 ">--}}
{{--            <div class="dashboard_graph">--}}

{{--                <div class="row x_title">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <h3>Network Activities <small>Graph title sub-title</small></h3>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
{{--                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
{{--                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-9 col-sm-9 ">--}}
{{--                    <div id="chart_plot_01" class="demo-placeholder"></div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-sm-3  bg-white">--}}
{{--                    <div class="x_title">--}}
{{--                        <h2>Top Campaign Performance</h2>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-12 col-sm-12 ">--}}
{{--                        <div>--}}
{{--                            <p>Facebook Campaign</p>--}}
{{--                            <div class="">--}}
{{--                                <div class="progress progress_sm" style="width: 76%;">--}}
{{--                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>Twitter Campaign</p>--}}
{{--                            <div class="">--}}
{{--                                <div class="progress progress_sm" style="width: 76%;">--}}
{{--                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 col-sm-12 ">--}}
{{--                        <div>--}}
{{--                            <p>Conventional Media</p>--}}
{{--                            <div class="">--}}
{{--                                <div class="progress progress_sm" style="width: 76%;">--}}
{{--                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>Bill boards</p>--}}
{{--                            <div class="">--}}
{{--                                <div class="progress progress_sm" style="width: 76%;">--}}
{{--                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div><br/>--}}
{{--    <div class="row">--}}


{{--        <div class="col-md-4 col-sm-4 ">--}}
{{--            <div class="x_panel tile fixed_height_320">--}}
{{--                <div class="x_title">--}}
{{--                    <h2>App Versions</h2>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <h4>App Usage across versions</h4>--}}
{{--                    <div class="widget_summary">--}}
{{--                        <div class="w_left w_25">--}}
{{--                            <span>0.1.5.2</span>--}}
{{--                        </div>--}}
{{--                        <div class="w_center w_55">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">--}}
{{--                                    <span class="sr-only">60% Complete</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w_right w_20">--}}
{{--                            <span>123k</span>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}

{{--                    <div class="widget_summary">--}}
{{--                        <div class="w_left w_25">--}}
{{--                            <span>0.1.5.3</span>--}}
{{--                        </div>--}}
{{--                        <div class="w_center w_55">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">--}}
{{--                                    <span class="sr-only">60% Complete</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w_right w_20">--}}
{{--                            <span>53k</span>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}
{{--                    <div class="widget_summary">--}}
{{--                        <div class="w_left w_25">--}}
{{--                            <span>0.1.5.4</span>--}}
{{--                        </div>--}}
{{--                        <div class="w_center w_55">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">--}}
{{--                                    <span class="sr-only">60% Complete</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w_right w_20">--}}
{{--                            <span>23k</span>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}
{{--                    <div class="widget_summary">--}}
{{--                        <div class="w_left w_25">--}}
{{--                            <span>0.1.5.5</span>--}}
{{--                        </div>--}}
{{--                        <div class="w_center w_55">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">--}}
{{--                                    <span class="sr-only">60% Complete</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w_right w_20">--}}
{{--                            <span>3k</span>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}
{{--                    <div class="widget_summary">--}}
{{--                        <div class="w_left w_25">--}}
{{--                            <span>0.1.5.6</span>--}}
{{--                        </div>--}}
{{--                        <div class="w_center w_55">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">--}}
{{--                                    <span class="sr-only">60% Complete</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w_right w_20">--}}
{{--                            <span>1k</span>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-md-4 col-sm-4 ">--}}
{{--            <div class="x_panel tile fixed_height_320 overflow_hidden">--}}
{{--                <div class="x_title">--}}
{{--                    <h2>Device Usage</h2>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <table class="" style="width:100%">--}}
{{--                        <tr>--}}
{{--                            <th style="width:37%;">--}}
{{--                                <p>Top 5</p>--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                <div class="col-lg-7 col-md-7 col-sm-7 ">--}}
{{--                                    <p class="">Device</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-5 col-md-5 col-sm-5 ">--}}
{{--                                    <p class="">Progress</p>--}}
{{--                                </div>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <table class="tile_info">--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <p><i class="fa fa-square blue"></i>IOS </p>--}}
{{--                                        </td>--}}
{{--                                        <td>30%</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <p><i class="fa fa-square green"></i>Android </p>--}}
{{--                                        </td>--}}
{{--                                        <td>10%</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <p><i class="fa fa-square purple"></i>Blackberry </p>--}}
{{--                                        </td>--}}
{{--                                        <td>20%</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <p><i class="fa fa-square aero"></i>Symbian </p>--}}
{{--                                        </td>--}}
{{--                                        <td>15%</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <p><i class="fa fa-square red"></i>Others </p>--}}
{{--                                        </td>--}}
{{--                                        <td>30%</td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="col-md-4 col-sm-4 ">--}}
{{--            <div class="x_panel tile fixed_height_320">--}}
{{--                <div class="x_title">--}}
{{--                    <h2>Quick Settings</h2>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <div class="dashboard-widget-content">--}}
{{--                        <ul class="quick-list">--}}
{{--                            <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>--}}
{{--                            </li>--}}
{{--                            <li><i class="fa fa-bars"></i><a href="#">Subscription</a>--}}
{{--                            </li>--}}
{{--                            <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>--}}
{{--                            <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>--}}
{{--                            </li>--}}
{{--                            <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>--}}
{{--                            <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>--}}
{{--                            </li>--}}
{{--                            <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}

{{--                        <div class="sidebar-widget">--}}
{{--                            <h4>Profile Completion</h4>--}}
{{--                            <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>--}}
{{--                            <div class="goal-wrapper">--}}
{{--                                <span id="gauge-text" class="gauge-value pull-left">0</span>--}}
{{--                                <span class="gauge-value pull-left">%</span>--}}
{{--                                <span id="goal-text" class="goal-value pull-right">100%</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"></h3>
    </div>
    <div class="panel-body">
        <div class="row" style="margin-bottom: 15px;">

            <div class="col-3" style="margin-bottom: 15px; background-color:#FF8C00;margin-left: 5px;border-radius: 5px;">
                <div class="col-md-12" style="font-size: 18px;  padding-top: 15px ; font-weight: bold;font-family: Arial, Helvetica, sans-serif;">
                    <span class="fa fa-mobile"></span>&nbsp;&nbsp;Orange CI
                </div>
                <hr>
                <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ $OrangeEnattente }}</span> </div>
                <div class="col-md-12" style="font-style: italic">Validés : &nbsp;<span style="font-weight: bold">{{ count($OrangeValide) }}</span></div>
                <div class="col-md-12" style="font-style: italic ; padding-bottom: 10px">Rejeté : &nbsp;<span style="font-weight: bold">{{ count($OrangeReject) }}</span></div>
                <hr>
                <div class="col-md-12" style="font-size: 18px; font-style: italic; padding-bottom: 15px ; font-family: Arial, Helvetica, sans-serif;">
                    Total :{{ $sommeOrange }}
                </div>

            </div>

            <div class="col-3" style="margin-bottom: 15px; background-color:#ffc107;margin-left: 5px;border-radius: 5px;">
                <div class="col-md-12" style="font-size: 18px; padding-top: 15px ; font-weight: bold;font-family: Arial, Helvetica, sans-serif;">
                    <span class="fa fa-mobile"></span>&nbsp;&nbsp;MTN CI
                </div>
                <hr>
                <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ $MtnEnattente }}</span> </div>
                <div class="col-md-12" style="font-style: italic">Validés : &nbsp;<span style="font-weight: bold">{{ count($MtnValide) }}</span></div>
                <div class="col-md-12" style="font-style: italic ; padding-bottom: 10px">Rejeté: &nbsp;<span style="font-weight: bold">{{ count($MtnReject) }}</span></div>
                <hr>
                <div class="col-md-12" style="font-size: 18px; font-style: italic; padding-bottom: 15px ; font-family: Arial, Helvetica, sans-serif;">
                    Total :{{ $sommeMtn }}
                </div>
            </div>

            <div class="col-3" style="margin-bottom: 15px;color: #fff;
                background-color: #28a745; border-color: #28a745; margin-left: 5px;border-radius: 5px;">
                <div class="col-md-12" style="font-size: 18px; padding-top: 15px ; font-weight: bold;font-family: Arial, Helvetica, sans-serif;">
                    <span class="fa fa-mobile"></span>&nbsp;&nbsp;Moov Africa
                </div>
                <hr>
                <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ $MoovEnattente }}</span> </div>
                <div class="col-md-12" style="font-style: italic">Validés : &nbsp;<span style="font-weight: bold">{{ count($MoovValide) }}</span></div>
                <div class="col-md-12" style="font-style: italic ; padding-bottom: 10px">Rejeté: &nbsp;<span style="font-weight: bold">{{ count($MoovReject) }}</span></div>
                <hr>
                <div class="col-md-12" style="font-size: 18px; font-style: italic; padding-bottom: 15px ; font-family: Arial, Helvetica, sans-serif;">
                    Total :{{ $sommeMoov }}
                </div>
            </div>

            <div class="col-2" style="width: 350px; margin-bottom: 15px;color: #fff;background-color: #17a2b8;
                border-color: #17a2b8;margin-left: 5px;border-radius: 5px;">
                <div class="col-md-12" style="font-size: 18px; padding-top: 15px ; font-weight: bold;font-family: Arial, Helvetica, sans-serif;">
                    <span class="fa fa-address-book"></span>&nbsp;&nbsp;Total Abonnés
                </div>
                <hr style="color: #fff;">
                <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ $sommeEncours }}</span> </div>
                <div class="col-md-12" style="font-style: italic">Validés : &nbsp;<span style="font-weight: bold">{{ $sommeValide }}</span></div>
                <div class="col-md-12" style="font-style: italic ; padding-bottom: 10px">Rejeté : &nbsp;<span style="font-weight: bold">{{ $sommeRejet }}</span></div>
                <hr>
                <div class="col-md-12" style="font-size: 18px; font-weight: bold;font-family: Arial, Helvetica, sans-serif;">
                    <span class="fa fa-address-book"></span>&nbsp;&nbsp;Total : {{ $somme }}
                </div>
            </div>

        </div>
        <!-- L'élément "#mon-chart" où placer le chart -->
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6" id="mon-chart" style="height: 350px;"></div>
            <div class="col-md-6" id="nom-bar" style="height: 350px; "></div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <!-- Importation de l'API AJAX Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        alert("ok");
        google.charts.load('current', {'packages':['corechart']});
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Operateurs', 'Abonnees'],
                @foreach ($operateurs as $operateur) // On parcourt les operateurs
                ["{{ $operateur->libelle_operateur }}", {{ $operateur->abonnesnumeros->count() }} ], // Proportion des abonnees de l'operateur
                @endforeach
            ]);

            var options = {
                title: 'Proportion des abonnées inscrits par Operateurs', // Le titre
                is3D: true // En 3D
            };

            // On crée le chart en indiquant l'élément où le placer "#mon-chart"
            var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));

            // On déssine le chart avec les données et les options
            chart.draw(data, options);

            var data = google.visualization.arrayToDataTable([
                ['Operateurs', 'Abonnees'],
                @foreach ($operateurs as $operateur) // On parcourt les catégories
                ['{{ $operateur->libelle_operateur  }}', {{ $operateur->abonnesnumeros->count() }} ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Performance des abonnées - Operateurs',
                    subtitle: 'abonnées pour chaque Operateurs',
                },
                bars: 'vertical' // Direction "verticale" pour les bars
            };

            var chart = new google.charts.Bar(document.getElementById('nom-bar'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

    </script>
@endsection
