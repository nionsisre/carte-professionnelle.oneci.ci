@extends('layouts.app')

@section('title', 'Pré-Identification Abonné Mobile')

@section('pre_identification_abonnes_mobile')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Pré-identification pour l'acquisition d'un nouveau numéro de téléphone (Carte SIM)</li>
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
                <h2><i class="fa fa-sim-card text-black mr10"></i> &nbsp; Pré-identification pour l'acquisition d'un nouveau numéro de téléphone (Carte SIM)</h2>
                @if(session()->has('abonne'))
                    <div id="modalBox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding: 5px 5px 15px;"></div>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center>
                            <i class="fad fa-check-circle" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 8em;margin: 0.3em 0em 0.2em;"></i>
                            <br/>
                            <div>
                                Votre pré-identification a été effectuée avec succès !<br/><br><br>
                                Numéro de validation : <br/><br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N°<span id="numero-dossier">{{ session()->get('abonne')->numero_dossier }}</span></b> &nbsp; <br/><br/><br/>
                                <a href="javascript:void(0)" onclick="copyToClipboard('#numero-dossier')" id="copy-link" style="border-style: dashed;border-color: #d9d9d9;border-width: 1px;padding: 1em"><i class="fa fa-copy" style="color: #d9d9d9"></i> &nbsp; copier le numéro de dossier</a><br/><br/><br/>
                                <p style="color: #2A8FBD"><i class="fa fa-info-circle"></i> &nbsp; NB : Votre demande a été prise en compte et les informations renseignées seront par la suite vérifiées par votre Opérateur téléphonique et par l'ONECI.</p>
                                @if(!empty(session()->get('abonne')->libelle_document_justificatif))
                                    {{-- Formulaire soumis avec document justificatif ONECI --}}
                                    <p>Veuillez cliquer sur le bouton ci-dessous pour télécharger votre fiche de pré-identification et vous rendre par la suite chez votre opérateur téléphonique afin de rentrer en possession de votre carte SIM :</p><br/>
                                    <a href="{{ route('front_office.download.certificat_pre_identification.pdf').'?n='.session()->get('abonne')->enroll_download_link }}" class="button blue"><i class="fa fa-download text-white"></i> &nbsp; Télécharger votre fiche de pré-identification</a><br/>
                                    <br/>
                                    <p>Votre fiche est téléchargeable à tout moment depuis le menu de pré-identification en cliquant sur <b><a href="{{ route('front_office.pre_identification.consultation') }}">consulter ma fiche de pré-identification</a></b> et en renseignant votre <b>numéro de validation</b> ci-dessus (ou reçu par mail). <br/><br/><br/><br/>L'ONECI vous remercie !</p>
                                    <br/><br/>
                                    <a href="{{ route('front_office.pre_identification.menu') }}" class="button black"><i class="fa fa-arrow-alt-left text-white"></i> &nbsp; Retour au menu de Pré-Identification</a>
                                    <a href="https://www.oneci.ci" class="button black"><i class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                                @else
                                    {{-- Formulaire soumis sans document justificatif ONECI (Avec paiement de frais d'exemption) --}}
                                    <p>Veuillez cliquer sur le bouton ci-dessous pour procéder au paiement des <b>frais d'exemption de document</b> et télécharger votre fiche de pré-identification :</p><br/>
                                    <span id="certificate-get-payment-link-loader" style="display: none"><i class="fa fa-spinner fa-spin fa-2x"></i><br/></span>
                                    @if(!empty(session()->get('abonne')->transaction_id))
                                        <a href="{{ route('front_office.download.certificat_pre_identification.pdf').'?n='.session()->get('abonne')->enroll_download_link }}" class="button blue"><i class="fa fa-download text-white"></i> &nbsp; Télécharger votre fiche de pré-identification</a><br/>
                                    @else
                                        <a href="javascript:void(0)" id="certificate-get-payment-link" class="button"><i class="fa fa-sack-dollar text-white"></i> &nbsp; Procéder au paiement ({{ env('CINETPAY_SERVICE_AMOUNT_TEMP') }} FCFA)</a><br/>
                                    @endif
                                    <br/>
                                    <p>Le paiement des frais d'exemption de document est disponible à tout moment depuis le menu de pré-identification en cliquant sur <b><a href="{{ route('front_office.pre_identification.consultation') }}">consulter ma fiche de pré-identification</a></b> et en renseignant votre <b>numéro de validation</b> ci-dessus (ou reçu par mail). <br/><br/><br/><br/>L'ONECI vous remercie !</p>
                                    <br/><br/>
                                @endif
                            </div>
                        </center>
                    </div><br/><br/><br/><br/><br/><br/>
                    <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                @else
                    @if($errors->any())
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
                    <h5>Veuillez renseigner les champs du formulaire ci-dessous afin d'Obtenir une fiche provisoire de pré-identification pour l'acquisition d'un nouveau numéro de téléphone Ivoirien<br/></h5>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                        <center>
                            <div id="tvi-preorder-container">
                                <form id="ctptch-frm-id" class="content-form" method="post"
                                      action="{{ route('front_office.form.soumettre_pre_identification') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="modalInfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="smartwizard">
                                        <ul class="nav">
                                            <li><a class="nav-link" href="#etape-1"><i class="fa fa-info-circle text-white"></i>
                                                    &nbsp; Etape 1 : Informations sur l'abonné</a></li>
                                            <li><a class="nav-link" href="#etape-2"><i class="fa fa-id-card text-white"></i>
                                                    &nbsp; Etape 2 : Justificatif d'identité</a></li>
                                            <li><a class="nav-link" href="#etape-3"><i class="fa fa-eye text-white"></i>
                                                    &nbsp; Etape 3 : Récapitulatif</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="etape-1" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Informations sur l'abonné :</h2>
                                                <br/>
                                                <div class="container clearfix">
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="form-group column-last" id="gender-field">
                                                        <label class="col-sm-4 control-label">
                                                            Genre<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="form-group">
                                                            <div class="col-sm-12 container clearfix">
                                                                <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                                                                    <input type="radio" name="gender" id="gender-input-male" value="M" style="width: auto; box-shadow:none" />
                                                                    <label for="gender-input-male" style="display: inline-block;" class="col-sm-5"> &nbsp; <i class="fa fa-mars"></i><b> &nbsp; Masculin</b></label>
                                                                </div>
                                                                <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                                                                    <input type="radio" name="gender" id="gender-input-female" value="F" style="width: auto; box-shadow:none" />
                                                                    <label for="gender-input-female" style="display: inline-block;" class="col-sm-5"> &nbsp; <i class="fa fa-venus"></i><b> &nbsp; Feminin</b></label>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                        </div><br/>
                                                        <!--<div class="col-sm-10">
                                                            <select class="form-control good-select" id="gender-input"
                                                                    name="gender"
                                                                    required="required"
                                                                    style="width: 11.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Choix du genre</option>
                                                                <option value="M">Masculin</option>
                                                                <option value="F">Feminin</option>
                                                            </select>
                                                        </div>-->
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="first-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            Nom<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="first-name-input" name="first-name" value="{{ old('first-name') }}"
                                                                   placeholder="Nom de l'abonné..." maxlength="25"
                                                                   required="required"
                                                                   autocomplete="off"
                                                                   style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="last-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            Prénom(s)<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="last-name-input" name="last-name" value="{{ old('last-name') }}"
                                                                   placeholder="Prénom(s) de l'abonné..." maxlength="70"
                                                                   autocomplete="off"
                                                                   required="required"
                                                                   style="text-transform: uppercase; width: 16em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="spouse-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            <em>Nom d'épouse (facultatif) :</em>
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="spouse-name-input" name="spouse-name" value="{{ old('spouse-name') }}"
                                                                   placeholder="Nom d'épouse..." maxlength="70"
                                                                   autocomplete="off"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="birth-date-field">
                                                        <label class="col-sm-2 control-label">
                                                            Date de naissance<span
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
                                                            Nationalité<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="country-input" name="country"
                                                                   placeholder="Nationalité..." maxlength="70"
                                                                   autocomplete="off" required="required"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="birth-place-field">
                                                        <label class="col-sm-4 control-label">
                                                            Lieu de naissance<span
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
                                                            Lieu de naissance<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="birth-place-input-2" name="birth-place-2" value="{{ old('birth-place-2') }}"
                                                                   placeholder="Lieu de naissance..." maxlength="70"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="residence-field">
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de résidence<span
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
                                                            Profession<span
                                                                style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="profession-input" name="profession" value="{{ old('profession') }}"
                                                                   placeholder="Profession..." maxlength="70" required="required"
                                                                   style="text-transform: uppercase; width: 11.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="email-field">
                                                        <label class="col-sm-2 control-label">
                                                            <em>Adresse email (facultatif) :</em>
                                                        </label>
                                                        <span style="display: none" id="err-mail-toast"></span>
                                                        <div><input type="email" class="form-control" value="{{ old('email') }}"
                                                                    id="email-input" name="email"
                                                                    autocomplete="off"
                                                                    placeholder="Adresse Mail..." maxlength="150"
                                                                    style="width: 21.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;" /></div>
                                                        <br/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="etape-2" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2><i class="fa fa-id-card"></i> &nbsp; Document justificatif :</h2>
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
                                                            <option value="0">Je n'ai aucun des documents ci-dessus</option>
                                                        </select>
                                                    </div>
                                                </div><br/>
                                                <div class="form-group column-last" id="other-document-type-field" style="display: none">
                                                    <label class="col-sm-2 control-label" id="other-document-type-label">
                                                        <b style="color: #2A8FBD">Entrez le type de document en votre possession<span style="color: #d9534f">*</span> :</b>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="other-document-type-input" name="other-document-type"
                                                               placeholder="Type de document d'identité" maxlength="100"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                    <p style="color: #2A8FBD"><em><i class="fa fa-info-circle"></i> &nbsp; NB : Ce document sera celui que vous <b>associerez</b> à la <b>fiche provisoire de demande d'identification</b> <br/>auprès votre <b>Opérateur téléphonique</b> lors de l'acquisition de votre <b>carte SIM</b>.</em></p>
                                                    <br/>
                                                </div>
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
                                                               placeholder="___________" maxlength="11"
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
                                                                   style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;" id="pdf-doc-label"><i
                                                                    class="fad fa-file-pdf fa-3x mr10"
                                                                    style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger le document…</span></label>
                                                        </div>
                                                    </div><br/>
                                                    <label for="pdf-doc-input" class="col-sm-2 control-label">
                                                        <em>Le document à charger doit être un scan <b>recto verso</b> du document <b>sur la même face</b> au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
                                                            avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.</em>
                                                    </label>
                                                    <br/>
                                                </div>
                                                <br/><br/>
                                                <h2><i class="fa fa-portrait"></i> &nbsp; Photo d'identité :</h2>
                                                Veuillez charger <b>une photo selfie récente</b> de <b>vous</b>.<br/>
                                                Cette photo doit être <b>différente</b> de celle présente sur <b>votre document d'identité</b>.<br/><br/>
                                                <div class="form-group" id="selfie-img-field">
                                                    <div class="col-sm-10">
                                                        <div class="box">
                                                            <input type="file" name="selfie_img" id="selfie-img-input"
                                                                   class="inputfile" accept="image/jpeg, image/png"
                                                                   style="display: none">
                                                            <label for="selfie-img-input" class="atcl-inv hoverable"
                                                                   style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;" id="selfie-img-label"><i
                                                                    class="fad fa-user fa-3x mr10"
                                                                    style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-camera"></i> &nbsp; <span>Charger votre photo...</span></label>
                                                        </div>
                                                    </div><br/>
                                                    <label for="selfie-img-input" class="col-sm-2 control-label">
                                                        <em>Votre photo doit être au format <b>*.jpg</b> ou <b>*.png</b> et ne doit pas excéder <b>3 Mo</b>.</em>
                                                    </label>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div id="etape-3" class="tab-pane" role="tabpanel">
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
                                                        Document justificatif : &nbsp; <b><i class="fa fa-paperclip"></i> &nbsp; <span id="recap-pdf-doc"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Photo selfie récente : &nbsp; <b><i class="fa fa-portrait"></i> &nbsp; <span id="recap-selfie-img"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label" id="recap-document-label">
                                                        Numéro du document : <b><span id="recap-document-number"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label" id="recap-prov-amount-label" style="display: none">
                                                        Frais d'exemption de document <em>(Sans document justificatif ONECI uniquement)</em> : <b><span id="recap-prov-amount"></span></b>
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
