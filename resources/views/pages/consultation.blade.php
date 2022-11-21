@extends('layouts.app')

@section('title', 'Consultation statut identification')

@section('consultation')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Consulter le statut de l'identification</li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- begin page title -->

    <!-- begin content -->
    <section id="content" class="container clearfix">
        <!-- begin our company -->
        <section>
            <div class="column-last">
                <h2><i class="fa fa-search text-black mr10"></i> &nbsp; Consulter le statut de l'identification
                </h2>
                @if(session()->has('resultats_statut'))
                    @php($resultats_statut = session('resultats_statut')->all())
                    @if(is_array($resultats_statut) && !empty($resultats_statut))
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center><br/>
                            <!--<i class="fad fa-search" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>-->
                            <h4>Recherche effectuée !</h4>
                            <br/><div>
                                <p style="padding: 0em 0em 4em">
                                    Numéro de dossier : &nbsp; <b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N° {{ $resultats_statut[0]->numero_dossier }}</b><br/><br/>
                                    Numéros de téléphones identifiés : <br/>
                                    @foreach($resultats_statut as $resultat_statut)
                                        <i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; {{ $resultat_statut->libelle_operateur }} : <b style="font-size: 1rem">{{ $resultat_statut->numero_de_telephone }}</b> &nbsp; | &nbsp; Statut : &nbsp; <i class="fad fa-{{ $resultat_statut->icone }}" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b style="font-size: 1rem">{{ $resultat_statut->libelle_statut }}</b><br/>
                                    @endforeach
                                    <br/>
                                    Document justificatif : &nbsp; <b style="font-size: 1rem"><i class="fad fa-id-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; {{ $resultats_statut[0]->libelle_piece }}</b><br/>
                                    <br/><br/>
                                    L'ONECI vous remercie !
                                </p>
                            </div>
                            <a href="https://www.oneci.ci" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                        </center>
                    </div>
                    @else
                        <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                            <center><br/>
                                <!--<i class="fad fa-search" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>-->
                                <h4>Recherche effectuée !</h4>
                                <br/><div>
                                    <p style="padding: 0em 0em 4em">
                                        <i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>
                                        <p style="padding: 0em 0em 2em">
                                            Aucune identification effectuée pour ce numéro...<br/><br/>
                                            L'ONECI vous remercie !
                                        </p>
                                    </p>
                                </div>
                                <a href="https://www.oneci.ci" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                            </center>
                        </div>
                    @endif
                @else
                    <h5>Veuillez renseigner le formulaire ci-dessous afin de consulter le statut de votre identification<br/></h5>

                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('consulter_statut_identification') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="tsch-input" name="tsch" value="0"/>
                            <center>
                                <br/><br/>
                                <!-- Form Number -->
                                <div class="form-group" id="form-number-field">
                                    <label class="col-sm-2 control-label">
                                        Entrez le numéro du dossier reçu lors de votre identification<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" id="form-number-input" name="form-number" placeholder="__________" maxlength="11" style="width: 23.4em; text-align: center" required="required"/>
                                    </div>
                                    <br/>
                                </div>
                                <!-- No Form Number -->
                                <!--<div class="form-group" id="first-name-field" style="display: none">
                                    <label class="col-sm-2 control-label">
                                        Entrez votre nom<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" id="first-name-input" name="first-name" placeholder="Nom ou Nom de l'époux..." maxlength="25" style="width: 23.4em; text-align: center"/>
                                    </div>
                                    <br/>
                                </div>
                                <div class="form-group" id="last-name-field" style="display: none">
                                    <label class="col-sm-2 control-label">
                                        Entrez votre prénom<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" id="last-name-input" name="last-name" placeholder="Prénom(s)..." maxlength="70" style="width: 23.4em; text-align: center"/>
                                    </div>
                                    <br/>
                                </div>
                                <div class="form-group" id="birth-date-field" style="display: none">
                                    <label class="col-sm-2 control-label">
                                        Entrez votre date de naissance<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="date" id="birth-date-input" name="birth-date" placeholder="Date de Naissance..." maxlength="10" style="width: 23.4em; text-align: center"/>
                                    </div>
                                    <br/>
                                </div>-->
                                <div id="no-form-number" style="margin-bottom: 2.5em;"><i class="fa fa-sim-card"></i> &nbsp; <span id="no-form-number-text" style="font-size: 1.1em; font-weight: bold; text-decoration: underline; cursor: pointer; font-style: italic;">Vérifier plutôt avec mon numéro de téléphone</span></div>
                                <!-- Captcha and submit -->
                                <br/><br/>
                                <div class="form-group">
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <div class="col-sm-12">
                                        <button type="submit" value="Submit" class="button" style="width: 100%;padding: 1em;"><i class="fa fa-search "></i> &nbsp; Consulter le statut de l'identification</button>
                                    </div>
                                </div>
                                <br/>
                            </center>
                        </form>
                    </div>

                @endif
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div>
        </section>
    </section>
@endsection
