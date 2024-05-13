@extends('layouts.app')

@section('title', 'Menu d\'Identification Abonné Mobile')

@section('content')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li>Certificat Conformité &rsaquo; </li>
                    <li>Menu</li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- begin page title -->

    <!-- begin content -->
    <section id="content" class="container clearfix">
        <section>
            <div class="column-last">
                <h2><i class="fa fa-file-certificate text-black mr10"></i> &nbsp; Menu d'obtention du certificat de conformité</h2><br/><br/><br/><br/>
                <!-- begin services -->
                <section class="container">
                    <div class="one-half" style="width: 48%;">
                        <div class="iconbox icon-top atcl" align="center">
                            <a href="{{ route('certificat.index') }}" style="box-shadow:0 0 3px rgba(60,72,88,0.15) !important;">
                                <div class="iconbox-icon"><i class="fad fa-file-certificate fa-4x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.5em; margin-top: 0.5em"></i></div>
                                <h2 class="iconbox-title">Obtenir mon certificat de conformité</h2>
                                <div class="arrow-box-hover"></div>
                            </a>
                        </div>
                    </div>
                    <div class="one-half" style="width: 48%;">
                        <div class="iconbox icon-top atcl" align="center">
                            <a href="{{ route('certificat.consultation') }}" style="box-shadow:0 0 3px rgba(60,72,88,0.15) !important;">
                                <div class="iconbox-icon"><i class="fad fa-search fa-4x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.5em; margin-top: 0.5em"></i></div>
                                <h2 class="iconbox-title">Consulter mon certificat de conformité</h2>
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
