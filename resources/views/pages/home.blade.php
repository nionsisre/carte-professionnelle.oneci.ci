@extends('layouts.app')

@section('title', 'Identification Abonné Mobile')

@section('home')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Identification Abonné Mobile</li>
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
                <h2><i class="fa fa-sim-card text-black mr10"></i> &nbsp; Identification du numéro de téléphone en ligne
                </h2>
                @if($errors->has('first-name') || $errors->has('spouse-name') || $errors->has('last-name') || $errors->has('birth-date') ||
                    $errors->has('residence') || $errors->has('profession') || $errors->has('country') || $errors->has('email') ||
                    $errors->has('doc-type') || $errors->has('pdf_doc') || $errors->has('document-number') || $errors->has('document-expiry'))
                    <center>
                        <div class="notification-box notification-box-error">
                            <div class="modal-header">
                                <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ $errors->first() }}</h6>
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
                @if(!session()->has('numero_dossier'))
                    @php
                        /**
                         * (PHP 4, PHP 5, PHP 7)<br/>
                         * This function is useful to generate Token<br/><br/>
                         * <b>array</b> createToken(<b>int</b> $expireTime)<br/>
                         * @param int $expireTime <p>
                         * Received token via post. <br/>Use <b>0</b> or <b>negative int</b> to infinite expiry date.
                         * </p>
                         * @return array Value of result
                         */
                        function createToken($expireTime) {
                            // $token["value"] = sha1(md5("\$@lty".bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM))."\$@lt")); // Mcrypt is deprecated in PHP 7
                            $token['value'] = sha1(md5("\$@lty".uniqid(rand(), TRUE)."\$@lt"));
                            $token['time'] = $expireTime;
                            $_SESSION['token_time'] = time();
                            return $token;
                        }
                        $resultats_statut = DB::table('abonnes_numeros')
                            ->select('*')
                            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                            ->where('abonnes.numero_dossier', '=', '4944196381')
                            ->get();
                        for($i=0;$i<sizeof($resultats_statut);$i++) {
                            $otp_msisdn_tokens[$i] = createToken(0);
                        }
                        session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
                    @endphp
                    <!--<div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center>
                            <i class="fad fa-check-circle" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>
                            <br/><div>
                                <p style="padding: 0em 0em 3em">
                                    Votre demande d'identification a bien été soumise avec succès !<br/>
                                    Numéro de dossier : <br/><br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N°<span id="numero-dossier">{!! session('numero_dossier') !!}</span></b> &nbsp;<br/><br/>
                                    Cette demande fera l'objet d'une analyse par l'ONECI avant d'être validée. Veuillez conserver soigneusement votre numéro de dossier afin de pouvoir suivre l'évolution de votre demande d'identification...<br/><br/>
                                    L'ONECI vous remercie !
                                </p>
                            </div>
                            <a href="javascript:void(0)" onclick="copyToClipboard('#numero-dossier')" id="copy-link" style="border-style: dashed;border-color: #d9d9d9;border-width: 1px;padding: 1em"><i class="fa fa-copy" style="color: #d9d9d9"></i> &nbsp; copier le numéro de dossier</a><br/><br/><br/>
                            <a href="{{ route('imprimer_recu_identification').'?n='.session('numero_dossier') }}" class="button blue"><i class="fa fa-download text-white"></i> &nbsp; Télécharger le reçu d'identification</a><br/>
                            <a href="{{ route('accueil') }}" class="button"><i class="fa fa-sim-card text-white"></i> &nbsp; Retour à la rubrique identification</a>
                            <a href="https://www.oneci.ci" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                        </center>
                    </div><br/><br/><br/><br/><br/><br/>-->
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center>
                            <i class="fad fa-check-circle" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 8em;margin: 0.3em 0em 0.2em;"></i>
                            <br/><div>
                                <p>
                                    Votre demande d'identification a bien été soumise avec succès !<br/>
                                    Numéro de dossier : <br/><br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N°<span id="numero-dossier">{!! session('numero_dossier') !!}</span></b> &nbsp; <br/><br/><br/>
                                    <a href="javascript:void(0)" onclick="copyToClipboard('#numero-dossier')" id="copy-link" style="border-style: dashed;border-color: #d9d9d9;border-width: 1px;padding: 1em"><i class="fa fa-copy" style="color: #d9d9d9"></i> &nbsp; copier le numéro de dossier</a><br/><br/><br/>
                                    Veuillez procéder à la vérification de vos numéros de téléphone ci-dessous afin que votre demande fasse l'objet d'une analyse par l'ONECI avant d'être validée :<br/>
                                    <table class="gen-table" style="margin-top: 0; vertical-align: middle;">
                                        <thead>
                                        <tr style="font-size: 0.75em;">
                                            <th scope="col">Numéro(s) à identifier</td>
                                            <th scope="col">Statut de l'identification</td>
                                            <th scope="col">Vérification OTP</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($msisdn_count = 0)
                                        @foreach($resultats_statut as $resultat_statut)
                                            <tr>
                                                <td style="vertical-align: middle;"><i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ $resultat_statut->numero_de_telephone }}</b> ({{ $resultat_statut->libelle_operateur }})</td>
                                                <td style="vertical-align: middle;"><i class="fad fa-{{ $resultat_statut->icone }}" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9;"></i> &nbsp; <b>{{ $resultat_statut->libelle_statut }}</b></td>
                                                <td style="vertical-align: middle;">
                                                    @if($resultat_statut->abonnes_statut_id == 1)
                                                    <div id="otp-send-link-container" class="one-third" style="display: block; margin-bottom: 1em">
                                                        <span id="otp-send-counter-{{ $msisdn_count }}" style="display: none">0:00</span>
                                                        <a id="otp-send-link-{{ $msisdn_count }}" href="javascript:void(0);" class="button blue otp-send-link" style="margin-bottom: 0"><i class="fa fa-envelope text-white"></i> &nbsp; Recevoir code par SMS</a>
                                                    </div>
                                                    <div class="form-group one-third" id="otp-code-field" style="display: block; margin-bottom: 1em">
                                                        <label class="col-sm-2 control-label">
                                                            Code de vérification reçu
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="first-name-input" name="first-name" value="{{ old('first-name') }}"
                                                                   placeholder="______" maxlength="6"
                                                                   required="required"
                                                                   style="width: 6em; text-align: center"/>
                                                        </div>
                                                    </div>
                                                    <div class="one-third column-last">
                                                        <a href="{{ route('imprimer_recu_identification').'?n='.session('numero_dossier') }}" class="button" style="margin-bottom: 0"><i class="fa fa-check text-white"></i> &nbsp; Vérifier ce numéro de téléphone</a>
                                                    </div>
                                                    @else
                                                    <i class="fa fa-check"></i> &nbsp; Vérification effectuée
                                                    @endif
                                                </td>
                                            </tr>
                                            @php($msisdn_count++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <br/>
                                <b style="color: #f44336"><i class="fa fa-exclamation-triangle"></i> &nbsp; NB : La vérification des numéros de téléphone est aussi accessible depuis la rubrique &nbsp; << <a href="{{ route('consultation_statut_identification') }}"><i class="fa fa-search"></i>&nbsp; Consultation</a> >>.</b>
                                    <br/><br/><br/>
                                    L'ONECI vous remercie !
                                    <br/><br/><br/><br/>
                                </p>
                            </div>
                            <!--<a href="{{ route('imprimer_recu_identification').'?n='.session('numero_dossier') }}" class="button blue"><i class="fa fa-download text-white"></i> &nbsp; Télécharger le reçu d'identification</a><br/>-->
                            <a href="{{ route('accueil') }}" class="button black"><i class="fa fa-arrow-alt-left text-white"></i> &nbsp; Retour à la rubrique identification</a>
                            <a href="https://www.oneci.ci" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                        </center>
                    </div><br/><br/><br/><br/><br/><br/>
                @else
                    <h5>Veuillez renseigner les champs du formulaire ci-dessous afin d'identifier votre/vos numéro(s) de
                        téléphone(s) en ligne<br/></h5>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center>
                            <div id="tvi-preorder-container">
                                <form id="ctptch-frm-id" class="content-form" method="post"
                                      action="{{ route('soumettre_identification') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="modalInfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="smartwizard">
                                        <ul class="nav">
                                            <li><a class="nav-link" href="#step-1"><i class="fa fa-sim-card text-white"></i>
                                                    &nbsp; Etape 1 : Numéro(s) à identifier</a></li>
                                            <li><a class="nav-link" href="#step-2"><i
                                                        class="fa fa-info-circle text-white"></i> &nbsp; Etape 2 :
                                                    Informations sur l'abonné</a></li>
                                            <li><a class="nav-link" href="#step-3"><i class="fa fa-id-card text-white"></i>
                                                    &nbsp; Etape 3 : Document justificatif</a></li>
                                            <li><a class="nav-link" href="#step-4"><i class="fa fa-eye text-white"></i>
                                                    &nbsp; Etape 4 : Récapitulatif</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="step-1" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Numéro(s) à identifier :</h2>
                                                <center>
                                                    <div class="notification-box notification-box-info">
                                                        <div class="modal-header">
                                                            <h3><i class="fa fa-sim-card"></i> &nbsp; Merci de vous rassurer que le numéro est le votre et est accessible. <br/>Il sera utilisé pour les confirmations nécessaires.</h3>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </center>
                                                <br/>
                                                <a class="button blue" href="javascript:void(0)" id="add-msisdn"><i class="fa fa-plus mr10 text-white"></i> &nbsp; Ajouter un numéro supplémentaire</a>
                                                <div id="msisdn-container">
                                                    <div class="container clearfix" id="ct-msisdn-1" style="background-color: #ccc; padding: 2em 2em">
                                                        <div class="form-group one-half column-last" id="msisdn-field-1">
                                                            <div class="col-sm-12">
                                                                <label class="col-sm-2 control-label">
                                                                    Numéro de téléphone<span
                                                                        style="color: #d9534f">*</span> :
                                                                </label>
                                                                <span style="display: none" id="err-toast"></span>
                                                                <div class="col-sm-10"><span style="width: 2em">+ 225</span>
                                                                    &nbsp;
                                                                    <input type="text" class="form-control msisdn"
                                                                           id="msisdn-input-1" name="msisdn[]"
                                                                           placeholder="__ __ __ __ __" maxlength="14"
                                                                           style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                                           required="required" autocomplete="off" /></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group one-half column-last" id="telco-field-1">
                                                            <label class="col-sm-2 control-label">
                                                                Opérateur téléphonique<span style="color: #d9534f">*</span> :
                                                            </label>
                                                            <span style="display: none" id="err-toast"></span>
                                                            <div class="col-sm-10">
                                                                <select class="form-control good-select"
                                                                        id="telco-input-1" name="telco[]"
                                                                        placeholder="Opérateur téléphonique" required="required" readonly="readonly"
                                                                        style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                    <option value="" selected disabled>Opérateur téléphonique</option>
                                                                    @foreach($abonnes_operateurs as $abonnes_operateur)
                                                                        <option value="{{ $abonnes_operateur->id }}">{{ $abonnes_operateur->libelle_operateur }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br/><br/>
                                            </div>
                                            <div id="step-2" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Informations sur l'abonné :</h2>
                                                <br/>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="first-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            Nom de l'abonné<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="first-name-input" name="first-name" value="{{ old('first-name') }}"
                                                                   placeholder="Nom de l'abonné..." maxlength="25"
                                                                   required="required"
                                                                   style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="spouse-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            <em>Nom d'épouse :</em>
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="spouse-name-input" name="spouse-name" value="{{ old('spouse-name') }}"
                                                                   placeholder="Nom d'épouse..." maxlength="70"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="last-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            Prénom(s) de l'abonné<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="last-name-input" name="last-name" value="{{ old('last-name') }}"
                                                                   placeholder="Prénom(s) de l'abonné..." maxlength="70"
                                                                   required="required"
                                                                   style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="gender-field">
                                                        <label class="col-sm-4 control-label">
                                                            Genre<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <span style="display: none" id="err-toast"></span>
                                                        <div class="col-sm-10">
                                                            <select class="form-control good-select" id="gender-input"
                                                                    name="gender"
                                                                    required="required"
                                                                    style="width: 11.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Choix du genre</option>
                                                                <option value="M">Masculin</option>
                                                                <option value="F">Feminin</option>
                                                            </select>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="birth-date-field">
                                                        <label class="col-sm-2 control-label">
                                                            Date de naissance de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" id="birth-date-input" name="birth-date" value="{{ old('birth-date') }}"
                                                                   placeholder="Date de Naissance" required="required"
                                                                   max="{{ date('Y-m-d', strtotime('-10 years')) }}"
                                                                   style="width: 10.5em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="country-field">
                                                        <label class="col-sm-2 control-label">
                                                            Nationalité de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="country-input" name="country"
                                                                   placeholder="Nationalité..." maxlength="70" required="required"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="birth-place-field">
                                                        <label class="col-sm-4 control-label">
                                                            Lieu de naissance de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <span style="display: none" id="err-toast"></span>
                                                        <div class="col-sm-10">
                                                            <select class="form-control good-select" id="birth-place-input"
                                                                    name="birth-place" placeholder="Lieu de naissance"
                                                                    style="width: 11.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Choisir le lieu de
                                                                    naissance
                                                                </option>
                                                                @foreach($civil_status_center as $csc)
                                                                    <option value="{{ $csc->civil_status_center_id }}">{{ $csc->civil_status_center_label }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="birth-place-field-2" style="display: none">
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de naissance de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="birth-place-input-2" name="birth-place-2" value="{{ old('birth-place-2') }}"
                                                                   placeholder="Lieu de naissance..." maxlength="70"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="residence-field">
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de résidence de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="residence-input" name="residence" value="{{ old('residence') }}"
                                                                   placeholder="Lieu de résidence..." maxlength="70" required="required"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="profession-field">
                                                        <label class="col-sm-2 control-label">
                                                            Profession de l'abonné<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="profession-input" name="profession" value="{{ old('profession') }}"
                                                                   placeholder="Profession..." maxlength="70" required="required"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="col-sm-2 control-label">
                                                        <em>Adresse email (facultatif) :</em>
                                                    </label>
                                                    <span style="display: none" id="err-mail-toast"></span>
                                                    <div><input type="email" class="form-control" value="{{ old('email') }}"
                                                                id="email-input" name="email"
                                                                placeholder="Adresse Mail..." maxlength="150"
                                                                style="width: 21.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;" /></div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div id="step-3" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Document justificatif :</h2>
                                                <div class="form-group col-sm-12 column-last" id="doc-type-field">
                                                    <label class="col-sm-2 control-label">
                                                        Type de pièce d'identité<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <select class="form-control good-select"
                                                                id="doc-type" name="doc-type" required="required"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Type de pièce d'identité</option>
                                                            @foreach($abonnes_type_pieces as $abonnes_type_piece)
                                                                <option value="{{ $abonnes_type_piece->id }}">{{ $abonnes_type_piece->libelle_piece }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div><br/>
                                                <div class="form-group col-sm-12 column-last" id="cni-type-field" style="display: none">
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-6 ckbox ckbox-success" >
                                                                    <input type="radio" name="id-card-type" id="old-format-card" value="CNI_2009" style="width: auto; box-shadow:none" />
                                                                    <label for="old-format-card" style="display: inline-block;" class="col-sm-5"><!--<img src="{{ URL::asset('assets/images/cni_old_example.png') }}" style="position: relative;top: 0.7em;">--> &nbsp; CNI <em>(ancien format valide)</em></label>
                                                                </div>
                                                                <div class="col-sm-6 ckbox ckbox-success">
                                                                    <input type="radio" name="id-card-type" id="new-format-card" value="CNI_2019" style="width: auto; box-shadow:none" checked="checked" />
                                                                    <label for="new-format-card" style="display: inline-block;" class="col-sm-5"><b><img src="{{ URL::asset('assets/images/cni_new_example.png') }}" style="position: relative;top: 0.7em;"> &nbsp; CNI <em>(Nouveau Format)</em></b></label>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group column-last" id="document-number-field">
                                                    <label class="col-sm-2 control-label" id="document-number-label">
                                                        Numéro NNI<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="document-number-input" name="document-number"
                                                               placeholder="___________" maxlength="11" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div class="form-group column-last" id="document-expiry-field">
                                                    <label class="col-sm-2 control-label" id="document-expiry-label">
                                                        <em>Date d'expiration :</em>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="date" id="document-expiry-input" name="document-expiry" placeholder="__/__/____"
                                                               max="{{ date('Y-m-d', strtotime('+20 years')) }}"
                                                               min="{{ date('Y-m-d', strtotime('-5 years')) }}" style="width: 17.4em; text-align: center"/>
                                                    </div>
                                                </div><br/>
                                                <div class="form-group" id="pdf-doc-field">
                                                    <div class="col-sm-10">
                                                        <div class="box">
                                                            <input type="file" name="pdf_doc" id="pdf-doc-input"
                                                                   class="inputfile" accept="application/pdf, image/jpeg, image/png"
                                                                   style="display: none">
                                                            <label for="pdf-doc-input" class="atcl-inv hoverable"
                                                                   style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                    class="fad fa-file-pdf fa-3x mr10"
                                                                    style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                        </div>
                                                    </div><br/>
                                                    <label for="pdf-doc-input" class="col-sm-2 control-label">
                                                        <em>Le document à charger doit être un scan <b>recto verso</b> du document <b>sur la même face</b> au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
                                                            avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.</em>
                                                    </label>
                                                    <br/>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="step-4" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Récapitulatif :</h2>
                                                <div class="form-group col-sm-12 column-last" id="doc-type-field">
                                                    <label class="col-sm-2 control-label">
                                                        Numéro(s) à Identifier<span style="color: #d9534f">*</span> : <br/><b><span id="recap-msisdn"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Nom : <b><span id="recap-first-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Prénom(s) : <b><span id="recap-last-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Genre : <b><span id="recap-gender"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Date de naissance: <b><span id="recap-birth-date"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de naissance : <b><span id="recap-birth-place"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de résidence : <b><span id="recap-residence"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Nationalité : <b><span id="recap-country"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Profession : <b><span id="recap-profession"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Email : <b><span id="recap-email"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Document justificatif : <b><i class="fa fa-file-pdf"></i> &nbsp; <span id="recap-pdf-doc"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Numéro du document : <b><span id="recap-document-number"></span></b>
                                                    </label><br/><br/>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-6 ckbox ckbox-success" style="border: solid 1px #333;padding: 1em; border-style: dashed; border-radius: 2em">
                                                                <input type="checkbox" name="agreement" id="agreement-input" value="1" style="width: auto; box-shadow:none; margin-bottom: 0.65em;" required />
                                                                <label for="agreement-input" style="display: inline-block;" class="col-sm-5"><b> &nbsp;&nbsp; Je certifie que les informations saisies sont correctes &nbsp; <i class="fad fa-award mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i></b></label>
                                                            </div>
                                                            <br/>
                                                        </div>
                                                    </div>
                                                </div><br/>
                                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                                <div class="col-sm-12">
                                                    <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn"
                                                            style="width: 100%;padding: 1em; display: none"><i
                                                            class="fa fa-sim-card"></i> &nbsp; Terminer et soumettre votre identification
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </center>
                    </div><br/><br/><br/><br/>
                @endif
            </div>
        </section>
    </section>
@endsection
