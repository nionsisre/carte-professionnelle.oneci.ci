@extends('layouts.app')

@section('title', 'Consultation statut identification')

@section('scripts')
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.toggle-form-number-and-msisdn')
    @if(session()->has('client'))
        @include('sections.scripts.payment-processing')
    @endif
@endsection

@section('content')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li>Fiche de Pré-enrôlement DJ &rsaquo; </li>
                    <li><a href="{{ route('certificat.menu') }}">Menu</a> &rsaquo; </li>
                    <li>Consultation</li>
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
                <h2><i class="fa fa-search text-black mr10"></i> &nbsp; Consulter le statut de votre demande de certificat de conformité
                </h2>
                @if(session()->has('client'))
                    @php($client = session()->get('client'))
                    @if(!empty($client))
                    <div id="modalBox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center><br/>
                            <section>
                                <div class="one-half">
                                    <div class="arrowbox arrowbox-first">
                                        <h2 class="arrowbox-title"><i class="fa fa-search"></i> &nbsp; Consultation
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Consultez régulièrement le statut de votre demande</p>
                                    </div>
                                </div>

                                <div class="one-half" style="width: 47%">
                                    <div class="arrowbox">
                                        <h2 class="arrowbox-title"><i class="fa fa-file-certificate"></i> &nbsp; Obtention du certificat
                                            <span class="arrowbox-title-arrow-back"></span>
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Récupérez votre certificat de conformité dans lieu de retrait si disponible</p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </section><br/>
                            <h4><i class="fa fa-file-certificate fa-3x text-black"></i><br/><br/>Demande de certificat de conformité</h4>
                            <br/><div>
                                <p style="padding: 0em 0em 2em">
                                    Numéro de validation : &nbsp; <br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N° {{ $client->numero_dossier }}</b><br/><br/>
                                    Document justificatif : &nbsp; <br/>
                                        @if(!empty($client->cni))
                                        <b style="font-size: 1rem"><i class="fad fa-id-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; Carte Nationale d'Identité</b><br/>
                                        @endif
                                        @if(!empty($client->decision_judiciaire))
                                        <b style="font-size: 1rem"><i class="fad fa-balance-scale" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; Décision Judiciaire</b><br/>
                                        @endif
                                    <table class="gen-table" style="margin-top: 0; vertical-align: middle;">
                                        @if(session()->has('success'))
                                            <center>
                                                <div class="notification-box notification-box-success">
                                                    <div class="modal-header">
                                                        <h6 style="color: #1b5e20"><i class="fa fa-check-circle mr10"></i> &nbsp; {{ session()->get('success')['message'] }}</h6>
                                                    </div>
                                                </div>
                                            </center>
                                        @endif
                                        @if(session()->has('error') && session()->get('error'))
                                            <center>
                                                <div class="notification-box notification-box-error">
                                                    <div class="modal-header">
                                                        <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ session()->get('error_message') }}</h6>
                                                    </div>
                                                </div>
                                            </center>
                                        @endif
                                        @if($errors->any())
                                            <center>
                                                <div class="notification-box notification-box-error">
                                                    <div class="modal-header">
                                                        <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ $errors->first() }}</h6>
                                                    </div>
                                                </div>
                                            </center>
                                        @endif
                                        <thead>
                                        <tr style="font-size: 0.75em;">
                                            <th scope="col">Statut de la demande</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @if($client->statut==1)
                                                        <i class="fad fa-money-check" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Paiement non effectué</b>
                                                    @elseif($client->statut==2)
                                                        <i class="fad fa-hourglass-half" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Document justificatif en attente d'approbation</b>
                                                    @elseif($client->statut==3)
                                                        <i class="fad fa-check" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Demande approuvée par l'ONECI</b>
                                                    @elseif($client->statut==4)
                                                        <i class="fad fa-times-circle" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Demande refusée</b>
                                                    @elseif($client->statut==5)
                                                        <i class="fad fa-file-certificate" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Certificat de conformité disponible</b>
                                                    @elseif($client->statut==6)
                                                        <i class="fad fa-hand-receiving" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>Certificat de conformité retiré</b>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    @if(session()->get('client')->statut==1)
                                                        <div id="payment-button-container">
                                                            <div id="payment-link-loader" style="display: none"><center><i class="fa fa-spinner fa-spin"></i></center></div>
                                                            <a href="javascript:void(0)" class="button" style="margin: 0" onclick="gpl(true)" id="payment-link-btn"><i class="fa fa-money-check text-white"></i> &nbsp; Procéder au paiement</a>
                                                        </div>
                                                    @elseif(session()->get('client')->statut==2)
                                                        <i class="fa fa-spinner fa-spin"></i> &nbsp; Authentification du document justificatif par l'ONECI
                                                    @elseif(session()->get('client')->statut==3)
                                                        <i class="fa fa-spinner fa-spin"></i> &nbsp; Le certificat de conformité est en attente de signature par le Directeur Général
                                                    @elseif(session()->get('client')->statut==4)
                                                        @if(!empty(session()->get('client')->observation))
                                                            <i class="fa fa-exclamation-triangle"></i> &nbsp; Votre demande de certificat de conformité a été rejetée pour le motif suivant : {{ session()->get('client')->observation }}
                                                        @else
                                                            <i class="fa fa-exclamation-triangle"></i> &nbsp; Votre demande de certificat de conformité a été rejetée par l'ONECI.
                                                        @endif
                                                    @elseif(session()->get('client')->statut==5)
                                                        @if(session()->has('lieu_livraison') && !empty(session()->get('lieu_livraison')))
                                                            <i class="fa fa-check"></i> &nbsp; Le certificat de conformité est signé et disponible dans votre lieu de retrait suivant : {{ session()->get('lieu_livraison') }}
                                                        @else
                                                            <i class="fa fa-check"></i> &nbsp; Le certificat de conformité est signé et disponible dans votre lieu de retrait.
                                                        @endif
                                                    @elseif(session()->get('client')->statut==6)
                                                        <i class="fa fa-check-double"></i> &nbsp; Le retrait de votre certificat de conformité a bien été effectué avec succès, l'ONECI vous remercie.
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    L'ONECI vous remercie !
                                    <br/><br/>
                                </p>
                            </div>
                            <a href="{{ route('certificat.menu') }}" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                        </center>
                    </div>
                    @else
                        <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                            <center><br/>
                                <!--<i class="fad fa-search" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>-->
                                <h4>Recherche effectuée !</h4>
                                <br/><div>
                                    <p style="padding: 0em 0em 4em">
                                        <i class="fad fa-file-certificate" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>
                                        <p style="padding: 0em 0em 2em">
                                            Aucune demande de certificat de conformité n'a été effectuée pour ce numéro...<br/><br/>
                                            L'ONECI vous remercie !
                                        </p>
                                    </p>
                                </div>
                                <a href="{{ route('certificat.menu') }}" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                            </center>
                        </div>
                    @endif
                @else
                    <h5>Veuillez renseigner le formulaire ci-dessous afin de consulter le statut de votre demande de certificat de conformité<br/></h5>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        @if(session()->has('error') && session()->get('error'))
                            <center>
                                <div class="notification-box notification-box-error">
                                    <div class="modal-header">
                                        <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ session()->get('error_message') }}</h6>
                                    </div>
                                </div>
                            </center>
                        @endif
                        @if($errors->any())
                            <center>
                                <div class="notification-box notification-box-error">
                                    <div class="modal-header">
                                        <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ $errors->first() }}</h6>
                                    </div>
                                </div>
                            </center>
                        @endif
                        <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('certificat.consultation.submit') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="tsch-input" name="tsch" value="0"/>
                            <center>
                                <br/>
                                <!-- With Document Number -->
                                <div class="form-group" id="form-number-field">
                                    <label class="col-sm-2 control-label">
                                        Entrez le numéro de validation reçu après remplissage du formulaire de demande du certificat de conformité<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" id="form-number-input" name="form-number" placeholder="__________" maxlength="10" minlength="10" style="width: 23.4em; text-align: center" value="{{ old('form-number') }}" autocomplete="off" required="required"/>
                                    </div>
                                    <br/>
                                </div>
                                <!-- Captcha and submit -->
                                <br/><br/>
                                <div class="form-group">
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <div class="col-sm-12">
                                        <button type="submit" value="Submit" class="button" style="width: 100%;padding: 1em;"><i class="fa fa-search "></i> &nbsp; Consulter le statut de la demande</button>
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
