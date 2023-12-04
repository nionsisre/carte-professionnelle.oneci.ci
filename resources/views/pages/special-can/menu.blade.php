@extends('layouts.app')

@section('title', 'Menu d\'Identification Abonné Mobile')

@section('content')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Abonnés Mobiles &rsaquo; </li>
                    <li>Menu Identification Spécial CAN 2023</li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- begin page title -->

    <!-- begin content -->
    <section id="content" class="container clearfix">
        <section>
            <div class="column-last">
                <h2><i class="fa fa-trophy-alt text-black mr10"></i> &nbsp; Menu d'identification Spécial CAN 2023</h2><br/><br/><br/><br/>
                <!-- begin services -->
                <section class="container">
                    <div style="width: 48%;">
                        <div class="iconbox icon-top atcl" align="center">
                            <a href="{{ route('front_office.special_can.consultation') }}" style="box-shadow:0 0 3px rgba(60,72,88,0.15) !important;">
                                <div class="iconbox-icon"><i class="fad fa-trophy-alt fa-4x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.5em; margin-top: 0.5em"></i></div>
                                <h2 class="iconbox-title"><i class="fa fa-sim-card text-black mr10"></i> &nbsp; Identifier mon numéro de télephone</h2>
                                <div class="arrow-box-hover"></div>
                            </a>
                        </div>
                    </div>


                    <div class="clear"></div>
                </section><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <!-- end services -->
            </div>
        </section>
    </section>
@endsection
