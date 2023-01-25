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
                @if(session()->has('abonne_numeros'))
                    @php($abonne_numeros = session('abonne_numeros')->all())
                    @if(is_array($abonne_numeros) && !empty($abonne_numeros))
                    <div id="modalBox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center><br/>
                            <section>
                                <div class="one-third">
                                    <div class="arrowbox arrowbox-first">
                                        <h2 class="arrowbox-title"><i class="fa fa-search"></i> &nbsp; Consultation
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Consultez régulièrement le statut de vos numéros</p>
                                    </div>
                                </div>

                                <div class="one-third">
                                    <div class="arrowbox">
                                        <h2 class="arrowbox-title"><i class="fa fa-sack-dollar"></i> &nbsp; Paiement
                                            <span class="arrowbox-title-arrow-back"></span>
                                            <span class="arrowbox-title-arrow-front"></span>
                                        </h2>
                                        <p>Procédez au paiement du certificat de vos numéros identifiés</p>
                                    </div>
                                </div>

                                <div class="one-third" style="width: 30%">
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
                                    Numéro de validation : &nbsp; <br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N° {{ $abonne_numeros[0]->numero_dossier }}</b><br/><br/>
                                    Document justificatif : &nbsp; <br/><b style="font-size: 1rem"><i class="fad fa-id-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; {{ $abonne_numeros[0]->libelle_piece }}</b><br/>
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
                                            <th scope="col">Numéro(s) de téléphone</td>
                                            <th scope="col">Statut de l'identification</td>
                                            <th scope="col">Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($i=0;$i<sizeof(session()->get('abonne_numeros'));$i++)
                                            <tr>
                                                <td style="vertical-align: middle;"><i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ session()->get('abonne_numeros')[$i]->numero_de_telephone }}</b> ({{ session()->get('abonne_numeros')[$i]->libelle_operateur }})</td>
                                                <td style="vertical-align: middle;"><i class="fad fa-{{ session()->get('abonne_numeros')[$i]->icone }}" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ session()->get('abonne_numeros')[$i]->libelle_statut }}</b></td>
                                                <td style="vertical-align: middle;">
                                                    @if(session()->get('abonne_numeros')[$i]->code_statut==='NNV')
                                                        @if(config('services.sms.enabled'))
                                                            <div id="otp-send-link-container" class="one-third" style="display: block; margin-bottom: 1em">
                                                                <span id="otp-send-counter-{{ $i }}" style="display: none">0:00</span>
                                                                <a id="otp-send-link-{{ $i }}" href="javascript:void(0);" class="button blue otp-send-link" style="margin-bottom: 0"><i class="fa fa-envelope text-white"></i> &nbsp; Recevoir code par SMS</a>
                                                            </div>
                                                            <form id="ctptch-frm-id-{{ $i }}" class="content-form" method="post" action="{{ route('verification_code_otp_soumis') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="cli" value="{{ url()->current() }}">
                                                                <input type="hidden" name="fn" value="{{ session()->get('abonne_numeros')[$i]->numero_dossier }}">
                                                                <input type="hidden" name="idx" value="{{ $i }}">
                                                                <div class="form-group one-third" id="otp-code-field" style="display: block; margin-bottom: 1em">
                                                                    <label class="col-sm-2 control-label" for="otp-code-{{ $i }}">
                                                                        Code de vérification reçu
                                                                    </label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" id="otp-code-{{ $i }}" name="otp-code" class="otp-code" placeholder="______" maxlength="6" required="required" style="width: 6em; text-align: center"/>
                                                                    </div>
                                                                </div>
                                                                <div class="one-third column-last">
                                                                    <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn-{{ $i }}" style="margin-bottom: 0">
                                                                        <i class="fa fa-check text-white"></i> &nbsp; Vérifier ce numéro de téléphone
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @elseif(session()->get('abonne_numeros')[$i]->code_statut==='DAA')
                                                        <i class="fa fa-spinner fa-spin"></i> &nbsp; Authentification du document justificatif par l'ONECI
                                                    @elseif(session()->get('abonne_numeros')[$i]->code_statut==='NUI')
                                                        {{-- Si le numéro est identifié, que le paiement est effectué et que la date de validité du paiement n'excède pas 1 an --}}
                                                        @if(session()->get('abonne_numeros')[$i]->cinetpay_data_status==='ACCEPTED' && !empty(session()->get('abonne_numeros')[$i]->cinetpay_data_payment_date) &&
                                                            date('Y-m-d', time()) <= date('Y-m-d', strtotime('+1 year', strtotime(session()->get('abonne_numeros')[$i]->cinetpay_data_payment_date))))
                                                            {{-- Si le jour du paiement n'est pas encore passé l'otp est inactif --}}
                                                            @if(date('Y-m-d', time()) === date('Y-m-d', strtotime(session()->get('abonne_numeros')[$i]->cinetpay_data_payment_date)))
                                                                <a href="{{ route('imprimer_certificat_identification').'?n='.session()->get('abonne_numeros')[$i]->certificate_download_link }}" class="button" style="margin-bottom: 0"><i class="fa fa-download text-white"></i> &nbsp; Télécharger le certificat d'identification ONECI</a>
                                                            @else
                                                                {{-- Sinon activation de l'otp avant chaque téléchargement --}}
                                                                <a id="cert-dl-link-{{ $i }}" href="javascript:void(0);" class="button otp-send-link" style="margin-bottom: 0"><i class="fa fa-award text-white"></i> &nbsp; Télécharger le certificat d'identification ONECI</a>
                                                                <div id="otp-container-{{ $i }}" style="display: none">
                                                                    <center>
                                                                        <div class="notification-box notification-box-success">
                                                                            <form id="ctptch-frm-id-{{ $i }}" class="content-form" method="post" action="{{ route('verification_code_otp_soumis') }}">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="cli" value="{{ url()->current() }}">
                                                                                <input type="hidden" name="fn" value="{{ session()->get('abonne_numeros')[$i]->numero_dossier }}">
                                                                                <input type="hidden" name="idx" value="{{ $i }}">
                                                                                <div class="form-group" id="otp-code-field-{{ $i }}" style="display: block; margin-bottom: 1em">
                                                                                    <div><i class="fa fa-envelope-open"></i> &nbsp; Un SMS a été envoyé au numéro <b><span id="otp-sms-msisdn-{{ $i }}">{{ session()->get('abonne_numeros')[$i]->numero_de_telephone }}</span></b> !<br/><br/></div>
                                                                                    <label class="col-sm-2 control-label" for="otp-code-{{ $i }}">
                                                                                        Entrez le code de vérification reçu, puis validez afin de télécharger le certificat :<br/><br/>
                                                                                    </label>
                                                                                    <div class="col-sm-10">
                                                                                        <div id="otp-send-link-container" style="display: inline-block; margin-bottom: 1em">
                                                                                            <span id="otp-send-counter-{{ $i }}" style="margin-right: 1em">0:00</span>
                                                                                            <a id="otp-send-link-{{ $i }}" href="javascript:void(0);" class="button blue otp-send-link" style="display: none; margin-bottom: 0"><i class="fa fa-sync text-white"></i> &nbsp; Renvoyer le sms</a>
                                                                                        </div>
                                                                                        <input type="text" id="otp-code-{{ $i }}" name="otp-code" class="otp-code" placeholder="______" maxlength="6" required="required" style="width: 6em; text-align: center; margin-bottom: 0"/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="column-last">
                                                                                    <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn-{{ $i }}" style="margin-bottom: 0">
                                                                                        <i class="fa fa-download text-white"></i> &nbsp; Télécharger le certificat d'identification ONECI</a>
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #eeeeee;border-color: #bdbdbd;"><i class="fa fa-times"></i> &nbsp; Fermer</a>
                                                                        </div>
                                                                    </center>
                                                                </div>
                                                                <div id="otp-container-error-{{ $i }}" style="display: none"></div>
                                                                <div id="modalError" style="display: none"></div>
                                                            @endif
                                                        @else
                                                            <div id="certificate-get-payment-link-container" style="display: block;">
                                                                <span id="certificate-get-payment-link-loader-{{ $i }}" style="display: none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                                                <a id="certificate-get-payment-link-{{ $i }}" href="javascript:void(0);" class="button blue certificate-get-payment-link" style="margin-bottom: 0"><i class="fa fa-file-certificate text-white"></i> &nbsp; Obtenir un certificat pour ce numéro de téléphone</a>
                                                            </div>
                                                        @endif
                                                    @elseif(session()->get('abonne_numeros')[$i]->code_statut==='IDR')
                                                        <i class="fa fa-times-circle"></i> &nbsp; Document refusé par l'ONECI
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
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
                    <h5>Veuillez renseigner le formulaire ci-dessous afin de consulter le statut de votre identification<br/></h5>
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
                        <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('consulter_statut_identification') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="tsch-input" name="tsch" value="0"/>
                            <center>
                                <br/>
                                <!-- With Document Number -->
                                <div class="form-group" id="form-number-field">
                                    <label class="col-sm-2 control-label">
                                        Entrez le numéro de validation reçu lors de votre identification<span style="color: #d9534f">*</span> :
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" id="form-number-input" name="form-number" placeholder="__________" maxlength="10" minlength="10" style="width: 23.4em; text-align: center" value="{{ old('form-number') }}" autocomplete="off" required="required"/>
                                    </div>
                                    <br/>
                                </div>
                                <!-- With MSISDN -->
                                <div id="msisdn-container">
                                    <div class="form-group" id="msisdn-field" style="display: none">
                                        <label class="col-sm-2 control-label">
                                            Entrez votre numéro de téléphone<span style="color: #d9534f">*</span> :
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="msisdn-input" class="msisdn" name="msisdn" placeholder="__ __ __ __ __" maxlength="14" minlength="14" style="width: 23.4em; text-align: center" value="{{ old('msisdn') }}" autocomplete="off" />
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="form-group" id="first-name-field" style="display: none">
                                        <label class="col-sm-2 control-label">
                                            Nom de l'abonné<span style="color: #d9534f">*</span> :
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="first-name-input" name="first-name" value="{{ old('first-name') }}"
                                                   placeholder="Nom de l'abonné..." maxlength="25"
                                                   autocomplete="off"
                                                   style="text-transform: uppercase; width: 23.4em; text-align: center"/>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="form-group" id="birth-date-field" style="display: none">
                                        <label class="col-sm-2 control-label">
                                            Date de naissance de l'abonné<span
                                                style="color: #d9534f">*</span> :
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="date" id="birth-date-input" name="birth-date" value="{{ old('birth-date') }}"
                                                   placeholder="Date de Naissance"
                                                   max="{{ date('Y-m-d', strtotime('-10 years')) }}"
                                                   style="width: 23.4em; text-align: center"/>
                                        </div>
                                        <br/>
                                    </div>
                                </div>
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
