@extends('layouts.app')

@section('title', 'Consultation statut identification')

@section('scripts')
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.toggle-form-number-and-msisdn')
    @if(session()->has('customer'))
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
                    <li><a href="{{ route('pre-identification.menu') }}">Menu</a> &rsaquo; </li>
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
                <h2><i class="fa fa-search text-black mr10"></i> &nbsp; Consulter le statut de votre demande de fiche de Pré-enrôlement
                </h2>
                @if(session()->has('customer'))
                    @php($customer = session()->get('customer'))
                    @if(!empty($customer))
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
                                        <h2 class="arrowbox-title"><i class="fa fa-file-certificate"></i> &nbsp; Téléchargement de la fiche
                                            <span class="arrowbox-title-arrow-back"></span>
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Téléchargez votre fiche de pré-enrôlement</p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </section><br/>
                            <h4><i class="fa fa-file-certificate fa-3x text-black"></i><br/><br/>Demande de fiche de pré-enrôlement</h4>
                            <br/><div>
                                <p style="padding: 0em 0em 2em">
                                    Numéro de validation : &nbsp; <br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N° {{ $customer->numero_dossier }}</b><br/><br/>
                                    Titre d'identité : &nbsp; <br/><b style="font-size: 1rem"><i class="fad fa-id-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; {{ $customer->customersTypePiece->libelle_piece }}</b><br/>
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
                                                    <i class="fad fa-{{ $customer->customersStatut->icone }}" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ $customer->customersStatut->libelle_statut }}</b>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    @if($customer->customersStatut->id == 1)
                                                        <div id="payment-button-container">
                                                            <div id="payment-link-loader" style="display: none"><center><i class="fa fa-spinner fa-spin"></i></center></div>
                                                            <a href="javascript:void(0)" class="button" style="margin: 0" onclick="gpl(true)" id="payment-link-btn"><i class="fa fa-money-check text-white"></i> &nbsp; Procéder au paiement</a>
                                                        </div>
                                                    @elseif($customer->customersStatut->id == 2)
                                                        <i class="fa fa-spinner fa-spin"></i> &nbsp; Authentification du document justificatif fourni par l'ONECI
                                                    @elseif($customer->customersStatut->id == 3)
                                                        @if(!empty($customer->observation))
                                                            <i class="fa fa-exclamation-triangle"></i> &nbsp; Votre demande de pré-identification a été rejetée pour le motif suivant : {{ session()->get('customer')->observation }}
                                                        @else
                                                            <i class="fa fa-exclamation-triangle"></i> &nbsp; Votre demande de pré-identification a été rejetée par l'ONECI.
                                                        @endif
                                                    @elseif($customer->customersStatut->id==4)
                                                        @if(session()->has('lieu_livraison') && !empty(session()->get('lieu_livraison')))
                                                            <i class="fa fa-check"></i> &nbsp; La fiche de Pré-enrôlement est signé et disponible dans votre lieu de retrait suivant : {{ session()->get('lieu_livraison') }}
                                                        @else
                                                            <i class="fa fa-check"></i> &nbsp; La fiche de Pré-enrôlement est signé et disponible dans votre lieu de retrait.
                                                        @endif
                                                    @elseif(session()->get('customer')->customersStatut->id==5)
                                                        <i class="fa fa-check-double"></i> &nbsp; Le retrait de votre fiche de Pré-enrôlement a bien été effectué avec succès, l'ONECI vous remercie.
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
                            <a href="{{ route('pre-identification.menu') }}" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
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
                                            Aucune demande de fiche de Pré-enrôlement n'a été effectuée pour ce numéro...<br/><br/>
                                            L'ONECI vous remercie !
                                        </p>
                                    </p>
                                </div>
                                <a href="{{ route('pre-identification.menu') }}" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                            </center>
                        </div>
                    @endif
                @else
                    <h5>Veuillez renseigner le formulaire ci-dessous afin de consulter le statut de votre demande de fiche de Pré-enrôlement<br/></h5>
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
                        <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('pre-identification.consultation.submit') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="tsch-input" name="tsch" value="0"/>
                            <center>
                                <br/>
                                <!-- With Document Number -->
                                <div class="form-group" id="form-number-field">
                                    <label class="col-sm-2 control-label">
                                        Entrez le numéro de validation reçu après remplissage du formulaire de demande de fiche de Pré-enrôlement<span style="color: #d9534f">*</span> :
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
