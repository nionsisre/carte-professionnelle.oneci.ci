@extends('admin/layout')

<style>
    body { padding-top:20px;
        background:#eee;
    }
    .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>
@yield('css')
@section('content')

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
                    <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ count($MtnEnattente) }}</span> </div>
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
                    <div class="col-md-12" style="font-style: italic">En cours : &nbsp;<span style="font-weight: bold">{{ count($MoovEnattente) }}</span> </div>
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
            google.charts.load('current', {'packages':['corechart']});
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                console.log(JSON.parse(''));
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
                        ['{{ $operateur->libelle_operateur  }}', {{ $operateur->abonnesnumeros->count() }} ]
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

