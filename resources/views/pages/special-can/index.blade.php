@extends('layouts.app')

@section('title', 'Consultation statut identification')

@section('scripts')
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.toggle-form-number-and-msisdn')
    @if(session()->has('abonne_numeros'))
        @include('sections.scripts.otp-verification')
        @include('sections.scripts.payment-processing')
    @endif
@endsection

@section('content')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Identification spécial CAN 2023</li>
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
                <h2><i class="fa fa-trophy-alt text-black mr10"></i> &nbsp; Identification Spécial CAN 2023</h2>
                @if(isset($abonne_numeros))
                    @if(is_array($abonne_numeros) && !empty($abonne_numeros))
                    <div id="modalBox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center><br/>
                            <section>
                                <div class="one-half">
                                    <div class="arrowbox arrowbox-first">
                                        <h2 class="arrowbox-title"><i class="fa fa-search"></i> &nbsp; Identification du numéro
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Renseignez votre numéro de téléphone ivoirien et identifiez-le</p>
                                    </div>
                                </div>

                                <div class="one-half" style="width: 47%">
                                    <div class="arrowbox">
                                        <h2 class="arrowbox-title"><i class="fa fa-file-certificate"></i> &nbsp; Obtention du certificat
                                            <span class="arrowbox-title-arrow-back"></span>
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Téléchargez et imprimez votre certificat d'identification ONECI</p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </section><br/>
                            <!--<i class="fad fa-search" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>-->
                            <h4><i class="fa fa-user fa-3x text-black"></i><br/><br/>Abonné Mobile</h4>
                            <br/><div>
                                <p style="padding: 0em 0em 2em">
                                    Nom Complet : &nbsp; <br/><b style="font-size: 1rem">{{ $abonne_numeros[0]->prenoms.' '.$abonne_numeros[0]->nom }}</b><br/><br/>
                                    Numéro de validation : &nbsp; <br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N° {{ $abonne_numeros[0]->numero_dossier }}</b><br/><br/>
                                    Document justificatif : &nbsp; <br/><b style="font-size: 1rem"><i class="fad fa-id-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; {{ $abonne_numeros[0]->libelle_piece }}</b><br/><b style="font-size: 1rem">{{ "(N° ".$abonne_numeros[0]->numero_document.")" }}</b>
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
                                            <th scope="col">Numéro de téléphone à identifier</th>
                                            <th scope="col">Opérateur téléphonique</th>
                                            <th scope="col">Statut de l'identification</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <form id="ctptch-frm-id-0" class="content-form" method="post" action="{{ route('front_office.form.soumettre_identification_special_can') }}">
                                                <tr>
                                                    <td style="vertical-align: middle;">
                                                        <i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp;
                                                        <b>
                                                            <input type="text" class="form-control msisdn"
                                                                   id="msisdn-input-1" name="msisdn"
                                                                   placeholder="__ __ __ __ __" maxlength="14"
                                                                   style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                                   required="required" autocomplete="off" />
                                                        </b>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp;
                                                        <select class="form-control good-select"
                                                                id="telco-input-1" name="telco[]"
                                                                required="required" readonly="readonly"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Opérateur téléphonique</option>
                                                            @foreach($abonnes_operateurs as $abonnes_operateur)
                                                                <option value="{{ $abonnes_operateur->id }}">{{ $abonnes_operateur->libelle_operateur }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: middle;"><i class="fad fa-{{ $abonne_numeros[0]->icone }}" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ $abonne_numeros[0]->libelle_statut }}</b></td>
                                                    <td style="vertical-align: middle;">
                                                        @if($abonne_numeros[0]->code_statut==='NNV')
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="cli" value="{{ url()->current() }}">
                                                            <input type="hidden" name="fn" value="{{ $abonne_numeros[0]->numero_dossier }}">
                                                            <input type="hidden" name="idx" value="0">
                                                            <div class="column-last">
                                                                <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn-0" style="margin-bottom: 0">
                                                                    <i class="fa fa-check text-white"></i> &nbsp; Identifier ce numéro de téléphone
                                                                </button>
                                                            </div>
                                                        @elseif($abonne_numeros[0]->code_statut==='DAA')
                                                            <i class="fa fa-spinner fa-spin"></i> &nbsp; Authentification du document justificatif par l'ONECI
                                                        @elseif($abonne_numeros[0]->code_statut==='NUI')
                                                            {{-- Si le numéro est identifié, que le paiement est effectué et que la date de validité du paiement n'excède pas 1 an --}}
                                                            @if($abonne_numeros[0]->cinetpay_data_status==='ACCEPTED' && !empty($abonne_numeros[0]->cinetpay_data_payment_date) &&
                                                                date('Y-m-d', time()) <= date('Y-m-d', strtotime('+1 year', strtotime($abonne_numeros[0]->cinetpay_data_payment_date))))
                                                                {{-- Si le jour du paiement n'est pas encore passé l'otp est inactif --}}
                                                                <a href="{{ route('front_office.download.certificat_identification.pdf').'?n='.$abonne_numeros[0]->certificate_download_link }}" class="button" style="margin-bottom: 0"><i class="fa fa-download text-white"></i> &nbsp; Télécharger le certificat d'identification ONECI</a>
                                                            @else
                                                                <div id="certificate-get-payment-link-container" style="display: block;">
                                                                    <span id="certificate-get-payment-link-loader-{{ $i }}" style="display: none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                                                    <a id="certificate-get-payment-link-{{ $i }}" href="javascript:void(0);" class="button blue certificate-get-payment-link" style="margin-bottom: 0"><i class="fa fa-file-certificate text-white"></i> &nbsp; Obtenir un certificat pour ce numéro de téléphone</a>
                                                                </div>
                                                            @endif
                                                        @elseif($abonne_numeros[0]->code_statut==='IDR')
                                                            <i class="fa fa-times-circle"></i> &nbsp; Document refusé par l'ONECI<br/><b>Motif : {{ (!empty($abonne_numeros[0]->observation)) ? $abonne_numeros[0]->observation : "..." }}</b>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                    <br/><br/>
                                    L'ONECI vous remercie !
                                    <br/>
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
                    <h5>Veuillez renseigner votre numéro NNI afin de procéder à l'Identification Spécial CAN<br/></h5>
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
                        <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('front_office.form.consulter_nni_special_can') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="tsch-input" name="tsch" value="0"/>
                            <center>
                                <br/>
                                <!-- With Document Number -->
                                <div class="form-group" id="nni-field">
                                    <label class="col-sm-2 control-label">
                                        Numéro NNI<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nni" placeholder="___________" class="nni" maxlength="11" minlength="11" style="width: 23.4em; text-align: center" value="{{ old('nni') }}" autocomplete="off" required="required"/>
                                    </div>
                                    <br/>
                                </div>
                                <!-- Captcha and submit -->
                                <br/><br/>
                                <div class="form-group">
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <div class="col-sm-12">
                                        <button type="submit" value="Submit" class="button" style="width: 100%;padding: 1em;"><i class="fa fa-sim-card "></i> &nbsp; Procéder à l'identification</button>
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
