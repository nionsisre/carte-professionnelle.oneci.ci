<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Oneci | Admin</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    @yield('css')

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;background-color: #00635a;border-right: 1px solid #D9DEE4;">
                    <a href="index.html" class="site_title"><img src="{{URL::asset('/images/logo.png')}}" alt="..." class="img-circle logo_img"> <span>Oneci</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix" style="border: 0;background-color: #0f6674;border: 1px solid #D9DEE4;">
                    <center>
                        <div class="profile_pic">
                            <img src="{{URL::asset('/images/user.jpg')}}" alt="..." class="img-circle profile_img">
                        </div>
                    </center>
                    <div class="profile_info">
                        <a class="" href="{{ route('logout') }}" style="font-weight: bold; color: white;color: white;">
                            <center>
                                &nbspSe deconnecter<br/>
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
                                    (Administrateur)
                                @endif
                            </center>
                        </a>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a href="{{ route('admin_home') }}"><i class="fa fa-home"></i> Accueil </a></li>
                            <li><a><i class="fa fa-edit"></i> Traitement <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('abonnees.exportation') }}">&nbspExportation</a></li>
                                    <li><a href="{{ route('abonnees.importation') }}">&nbspImportation</a></li>
                                </ul>
                            </li>
{{--                            <li><a href="{{ route('admin_home') }}"><i class="fa fa-home"></i> Acceuil <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="index.html">Dashboard</a></li>--}}
{{--                                    <li><a href="index2.html">Dashboard2</a></li>--}}
{{--                                    <li><a href="index3.html">Dashboard3</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-edit"></i> Gestion <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="form.html">General Form</a></li>--}}
{{--                                    <li><a href="form_advanced.html">Advanced Components</a></li>--}}
{{--                                    <li><a href="form_validation.html">Form Validation</a></li>--}}
{{--                                    <li><a href="form_wizards.html">Form Wizard</a></li>--}}
{{--                                    <li><a href="form_upload.html">Form Upload</a></li>--}}
{{--                                    <li><a href="form_buttons.html">Form Buttons</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-edit"></i> Gestion <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="form.html">General Form</a></li>--}}
{{--                                    <li><a href="form_advanced.html">Advanced Components</a></li>--}}
{{--                                    <li><a href="form_validation.html">Form Validation</a></li>--}}
{{--                                    <li><a href="form_wizards.html">Form Wizard</a></li>--}}
{{--                                    <li><a href="form_upload.html">Form Upload</a></li>--}}
{{--                                    <li><a href="form_buttons.html">Form Buttons</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="general_elements.html">General Elements</a></li>--}}
{{--                                    <li><a href="media_gallery.html">Media Gallery</a></li>--}}
{{--                                    <li><a href="typography.html">Typography</a></li>--}}
{{--                                    <li><a href="icons.html">Icons</a></li>--}}
{{--                                    <li><a href="glyphicons.html">Glyphicons</a></li>--}}
{{--                                    <li><a href="widgets.html">Widgets</a></li>--}}
{{--                                    <li><a href="invoice.html">Invoice</a></li>--}}
{{--                                    <li><a href="inbox.html">Inbox</a></li>--}}
{{--                                    <li><a href="calendar.html">Calendar</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="tables.html">Tables</a></li>--}}
{{--                                    <li><a href="tables_dynamic.html">Table Dynamic</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="chartjs.html">Chart JS</a></li>--}}
{{--                                    <li><a href="chartjs2.html">Chart JS2</a></li>--}}
{{--                                    <li><a href="morisjs.html">Moris JS</a></li>--}}
{{--                                    <li><a href="echarts.html">ECharts</a></li>--}}
{{--                                    <li><a href="other_charts.html">Other Charts</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a><i class="fa fa-cog"></i>Gestion des users <span class="fa fa-chevron-down"></span></a>--}}
{{--                                <ul class="nav child_menu">--}}
{{--                                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>--}}
{{--                                    <li><a href="fixed_footer.html">Fixed Footer</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col">
            @yield('content')
        </div>
        <!-- /page content -->
        <footer>
            <div>
                <center>
                    <p>Copyright © 2022 - Office National de l'Etat Civil et de l'Identification (ONECI) - Tous droits reservés.</p>
                </center>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="../vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>
@yield('script')
<script type="text/javascript">

</script>
</body>
</html>
