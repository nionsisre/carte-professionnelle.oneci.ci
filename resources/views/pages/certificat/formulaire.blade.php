@extends('layouts.app')

@section('title', 'Certificat de Conformité')

@section('scripts')
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.smart-wizard')
    @include('sections.scripts.custom-input-file')
    @include('sections.scripts.form-tools')
    @include('sections.scripts.copy-to-clipboard')
    @include('sections.scripts.smart-wizard-validation.formulaire')
    <script>
        {{--jQuery('.sw-btn-next').each(function () {
            jQuery(this).addClass('disabled');
        })
        --}}
        jQuery(document).ready(function () {
            {{-- Désactive le bouton suivant du wizard --}}
            {{-- jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true); --}}
            {{--jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");--}}
            @if(session()->has('client'))
                {{-- Désactive les étapes pré-paiement du wizard --}}
                jQuery('#smartwizard').smartWizard("setState", [0,1,2], "disable");
                jQuery('#smartwizard').smartWizard("goToStep", 4);
            @else
                {{-- Désactive les étapes post-paiement du wizard --}}
                jQuery('#smartwizard').smartWizard("setState", [3,4], "disable");
            @endif
        });
        function lwsbmt(frm_id) {
            jQuery('#cptch-sbmt-btn').hide();
            jQuery('#cptch-sbmt-loader').show();
            jQuery(frm_id).submit();
        }
    </script>
    @include('sections.scripts.payment-processing')
@endsection

@section('content')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li>Fiche de Pré-enrôlement DJ &rsaquo; </li>
                    <li><a href="{{ route('certificat.menu') }}">Menu</a> &rsaquo; </li>
                    <li>Formulaire</li>
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
                <h2><i class="fa fa-file-music text-black mr10"></i> &nbsp; Obtention de la fiche de Pré-enrôlement DJ
                </h2>
                @if(session()->has('client'))
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0 -2em;">
                        <center>
                            <div id="smartwizard" class="mb-3">
                                <ul class="nav">
                                    <li><a class="nav-link" href="#etape-1"><i class="fa fa-barcode text-white"></i>
                                            &nbsp; Etape 1 : Possession NNI</a></li>
                                    <li><a class="nav-link" href="#etape-2"><i
                                                class="fa fa-info-circle text-white"></i> &nbsp; Etape 2 :
                                            Informations</a></li>
                                    <li><a class="nav-link" href="#etape-3"><i class="fa fa-id-card text-white"></i>
                                            &nbsp; Etape 3 : Titre d'Identité</a></li>
                                    <li><a class="nav-link" href="#etape-4"><i class="fa fa-eye text-white"></i>
                                            &nbsp; Etape 4 : Récapitulatif</a></li>
                                    <li><a class="nav-link" href="#etape-5"><i class="fa fa-money-check text-white"></i>
                                            &nbsp; Etape 5 : Paiement</a></li>
                                    <li><a class="nav-link" href="#etape-6"><i class="fa fa-check text-white"></i>
                                            &nbsp; Etape 6 : Terminé</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="etape-1" class="tab-pane" role="tabpanel"></div>
                                    <div id="etape-2" class="tab-pane" role="tabpanel"></div>
                                    <div id="etape-3" class="tab-pane" role="tabpanel"></div>
                                    <div id="etape-4" class="tab-pane" role="tabpanel"></div>
                                    <div id="etape-5" class="tab-pane" role="tabpanel">
                                        <br/><br/>
                                        <div id="modalBox" style="display: none"></div>
                                        Veuillez procéder au paiement ci-dessous afin de poursuivre :
                                        <span style="display: flex;flex-direction: row;justify-content: flex-end;align-items: center;" onclick="gpl()"><i class="fa fa-sync"></i></span>
                                        <br/><br/>
                                        <section id="payment-section">
                                            <center><i class="fa fa-spinner fa-spin fa-3x"></i></center>
                                            {{--<iframe id="payment-link" src="{{ session()->get('payment_data')["message"] }}" style="border:1px #d9d9d9 solid;" name="paymentIFrame" height="400px" width="100%" allow="fullscreen"></iframe>
                                            <div class="one-half" style="width: 48%;">
                                                <div class="iconbox icon-top atcl" align="center">
                                                    <a href="javascript:void(0)" style="box-shadow:0 0 3px rgba(60,72,88,0.15) !important;">
                                                        <div class="iconbox-icon"><img src="{{ URL::asset('assets/images/logo-paynah.png') }}" alt="Paynah Icon" style="padding: 3em 6em;" /></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="one-half" style="width: 48%;">
                                                <div class="iconbox icon-top atcl" align="center">
                                                    <a href="javascript:void(0)" style="box-shadow:0 0 3px rgba(60,72,88,0.15) !important;">
                                                        <div class="iconbox-icon"><img src="{{ URL::asset('assets/images/logo-ngser.png') }}" alt="NGSer Icon" style="padding: 2.8em 6em;" /></div>
                                                    </a>
                                                </div>
                                            </div>--}}
                                        </section><br/><br/><br/>
                                        {{--Après avoir procédé au paiement, <br/><br/>
                                        Numéro de validation : <br/><br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N°<span id="numero-dossier">{{ session()->get('client')->numero_dossier }}</span></b> &nbsp;<br/><br/>
                                        <a href="javascript:void(0)" onclick="copyToClipboard('#numero-dossier')" id="copy-link" style="border-style: dashed;border-color: #d9d9d9;border-width: 1px;padding: 1em"><i class="fa fa-copy" style="color: #d9d9d9"></i> &nbsp; copier le numéro de dossier</a><br/><br/><br/>
                                        Cette demande fera l'objet d'une analyse par l'ONECI avant d'être validée. Veuillez conserver soigneusement votre numéro de dossier afin de pouvoir suivre l'évolution de votre demande de certificat de conformité dans la rubrique << <a href="{{ route('certificat.consultation') }}"><i class="fa fa-search"></i>&nbsp; Consultation</a> >>...<br/><br/>
                                        L'ONECI vous remercie !--}}
                                    </div>
                                    <div id="etape-6" class="tab-pane" role="tabpanel">
                                        <i class="fad fa-check-circle" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0 0.2em;"></i><br/>
                                        <div>
                                            <p style="padding: 0 0 3em">
                                                Votre demande de certificat de conformité a été soumise avec succès !<br/><br/>
                                                Numéro de validation : <br/><br/><b style="font-size: 1rem"><i class="fa fa-qrcode"></i>  ID N°<span id="numero-dossier">{{ session()->get('client')->numero_dossier }}</span></b> &nbsp;<br/><br/>
                                                <a href="javascript:void(0)" onclick="copyToClipboard('#numero-dossier')" id="copy-link" style="border-style: dashed;border-color: #d9d9d9;border-width: 1px;padding: 1em"><i class="fa fa-copy" style="color: #d9d9d9"></i> &nbsp; copier le numéro de dossier</a><br/><br/><br/>
                                                Cette demande fera l'objet d'une analyse par l'ONECI avant d'être validée. Veuillez conserver soigneusement votre numéro de dossier afin de pouvoir suivre l'évolution de votre demande de certificat de conformité dans la rubrique << <a href="{{ route('certificat.consultation') }}"><i class="fa fa-search"></i>&nbsp; Consultation</a> >>...<br/><br/>
                                                L'ONECI vous remercie !
                                            </p>
                                        </div>
                                        <a href="{{ route('certificat.consultation.submit.get').'?f='.session()->get('client')->numero_dossier.'&t='.session()->get('client')->uniqid }}" class="button black"><i class="fa fa-search text-white"></i> &nbsp; Cliquez ici pour consulter l'état d'avancement du dossier N°{{ session()->get('client')->numero_dossier }}</a><br/><br/>
                                    </div>
                                </div>
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
                    <h5>Veuillez renseigner les champs du formulaire ci-dessous afin d'obtenir votre fiche de pré-enrôlement<br/></h5>
                    <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0 -2em;">
                        <center>
                            <div>
                                <form id="ctptch-frm-id" class="content-form" method="post"
                                      action="{{ route('certificat.formulaire.submit') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="modalInfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="modalSnp" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                                    <div id="smartwizard" class="mb-3">
                                        <ul class="nav">
                                            <li><a class="nav-link" href="#etape-1"><i
                                                        class="fa fa-info-circle text-white"></i> &nbsp; Etape 1 :
                                                    Informations</a></li>
                                            <li><a class="nav-link" href="#etape-2"><i class="fa fa-id-card text-white"></i>
                                                    &nbsp; Etape 2 : Titre d'Identité</a></li>
                                            <li><a class="nav-link" href="#etape-3"><i class="fa fa-eye text-white"></i>
                                                    &nbsp; Etape 3 : Récapitulatif</a></li>
                                            <li><a class="nav-link" href="#etape-4"><i class="fa fa-money-check text-white"></i>
                                                    &nbsp; Etape 4 : Paiement</a></li>
                                            <li><a class="nav-link" href="#etape-5"><i class="fa fa-check text-white"></i>
                                                    &nbsp; Etape 5 : Terminé</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="etape-1" class="tab-pane" role="tabpanel">
                                                <div id="npdl-container">
                                                    <br/><br/>
                                                    <h2><i class="fa fa-info-circle"></i> &nbsp; Informations sur le DJ :</h2>
                                                    <br/>
                                                    <div class="container clearfix">
                                                        <x-input-radio title="Genre" name="gender"
                                                            :options="[
                                                                ['id' => 'gender-male', 'value' => 'M', 'label' => 'Homme', 'checked' => false, 'icon' => 'fa fa-mars'],
                                                                ['id' => 'gender-female', 'value' => 'F', 'label' => 'Femme', 'checked' => false, 'icon' => 'fa fa-venus']
                                                            ]"
                                                            required="true"
                                                        /><br/>
                                                    </div>
                                                    <div class="container clearfix">
                                                        <x-input-text id="nickname-input" name="nickname" label="Pseudonyme" placeholder="Nom d'artiste..." maxlength="150" required="true" width="16em" column="" />
                                                    </div>
                                                    <div class="container clearfix">
                                                        {{--
                                                        @component('components.input-text', [
                                                            'id' => 'last-name-input',
                                                            'name' => 'last-name',
                                                            'label' => 'NOM',
                                                            'placeholder' => 'NOM...',
                                                            'maxlength' => 70,
                                                            'required' => true,
                                                            'width' => '16em',
                                                            'column' => 'one-third'
                                                        ])
                                                        @endcomponent
                                                        --}}
                                                        <x-input-text id="last-name-input" name="last-name" label="NOM" placeholder="NOM..." maxlength="70" required="true" width="13em" column="one-third" />
                                                        <x-input-text id="first-name-input" name="first-name" label="Prénom(s)" placeholder="Prénom(s)..." maxlength="150" required="true" width="13.4em" column="one-third" />
                                                        <x-input-text id="spouse-name-input" name="spouse-name" label="NOM de l'époux" placeholder="Nom de l'époux..." maxlength="70" width="13em" column="one-third" />
                                                    </div>
                                                    <div class="container clearfix">
                                                        <x-input-date id="birth-date-input" name="birth-date" label="Né(e) le" placeholder="__/__/____" required="true" max="{{ date('Y-m-d', strtotime('-10 years')) }}" width="10.5em" column="one-half" />
                                                        <x-input-text id="birth-place-input" name="birth-place" label="Lieu de naissance" placeholder="Lieu de naissance..." required="true" maxlength="70" width="12em" column="one-half" />
                                                    </div>
                                                    <div class="container clearfix">
                                                        <x-input-select-country id="birth-country-input" name="birth-country" label="Pays de naissance" placeholder="Pays de naissance..." required="true" maxlength="70" width="12em" column="one-half" />
                                                        <x-input-text id="nationality-input" name="nationality" label="Nationalité" placeholder="Nationalité..." required="true" maxlength="70" width="12em" column="one-half" />
                                                    </div>
                                                    <div class="container clearfix">
                                                        {{--<x-input-select2 :options="[
                                                                ['value' => '0', 'label' => 'Célibataire'],['value' => '1', 'label' => 'Marié(e)'],['value' => '2', 'label' => 'Divorcé(e)'],['value' => '3', 'label' => 'Veuf / veuve']
                                                            ]" id="civil-status-field" title="Situation matrimoniale" name="civil-status" label="Situation matrimoniale..." required="true" width="15em" column="one-third"
                                                        />--}}
                                                        <x-input-select2 :options="$civil_statuses->map(function($civil_status) {
                                                                return ['value' => $civil_status->id, 'label' => $civil_status->libelle_statut];
                                                            })->toArray()" id="civil-status-field" title="Situation matrimoniale" name="civil-status" label="Situation matrimoniale..." required="true" width="15em" column="one-third"
                                                        />
                                                        <x-input-number id="number-of-children-input" name="number-of-children" label="Nombre d'enfants" placeholder="Nombre d'enfants..." required="true" maxlength="70" width="13.4em" column="one-third" />
                                                        <x-input-text id="other-activities-input" name="other-activities" label="Autres activités" placeholder="Autres activités..." maxlength="100" width="13em" column="one-third" />
                                                    </div>
                                                </div>
                                                <br/><br/>
                                                <h2><i class="fa fa-map-marker-alt"></i> &nbsp; Situation Géographique</h2>
                                                <br/>
                                                <div class="container clearfix">
                                                    <x-input-text id="city-input" name="city" label="Ville" placeholder="Ville..." required="true" maxlength="100" width="13em" column="one-third" />
                                                    <x-input-text id="town-input" name="town" label="Commune" placeholder="Commune..." required="true" maxlength="100" width="13em" column="one-third" />
                                                    <x-input-text id="street-input" name="street" label="Quartier" placeholder="Quartier..." required="true" maxlength="100" width="13em" column="one-third" />
                                                </div>
                                                <div class="container clearfix">
                                                    <x-input-text id="address-input" name="address" label="Adresse" placeholder="Adresse..." maxlength="100" width="13em" column="one-half" />
                                                    <x-input-text name="workplace" label="Lieu de travail" placeholder="Lieu de travail..." required="true" maxlength="100" width="13em" column="one-half" />
                                                </div>
                                                <div class="container clearfix">
                                                    <x-input-tel-ci id="msisdn-input" name="msisdn" label="Téléphone" placeholder="__ __ __ __ __" required="true" maxlength="100" width="13em" column="" />
                                                </div><br/><br/>
                                            </div>
                                            <div id="etape-2" class="tab-pane" role="tabpanel">
                                                <div id="doc-container">

                                                    <br/><br/>
                                                    <h2><i class="fa fa-id-card"></i> &nbsp; Titre d'identité :</h2>
                                                    <x-input-select2 :options="$artistes_type_pieces->map(function($artistes_type_piece) {
                                                                return ['value' => $artistes_type_piece->id, 'label' => $artistes_type_piece->libelle_piece];
                                                            })->toArray()" name="attached-doc-type" title="Type de pièce d'identité" label="Type de pièce d'identité..." required="true" width="17.5em" column="col-sm-12" />
                                                    <x-input-text name="attached-doc-number" label="Numéro du document" placeholder="____________" required="true" maxlength="30" width="13em" column="" />
                                                    <x-input-date name="attached-doc-expiry-date" label="Date d'expiration" placeholder="__/__/____" required="true" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+20 years')) }}" width="10.5em" column="" /><br/>
                                                    <x-input-file name="attached-doc" icon="id-card" required="true" />
                                                    <br/><br/>
                                                </div>
                                            </div>
                                            <div id="etape-3" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Récapitulatif :</h2>
                                                <div class="form-group col-sm-12 column-last" id="doc-type-field">

                                                    <label class="col-sm-2 control-label">
                                                        Pseudonyme : <b><span id="recap-nickname"></span></b>
                                                    </label><br/>

                                                    <label class="col-sm-2 control-label">
                                                        Prénom(s) : <b><span id="recap-first-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Nom : <b><span id="recap-last-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Genre : <b><span id="recap-gender"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Date de naissance : <b><span id="recap-birth-date"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de naissance : <b><span id="recap-birth-place"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Pays de naissance : <b><span id="recap-birth-country"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Nationalité : <b><span id="recap-nationality"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Statut matrimonial : <b><span id="recap-civil-status"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Nombre d'enfant(s) : <b><span id="recap-number-of-children"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Autre activité : <b><span id="recap-other-activities"></span></b>
                                                    </label><br/>

                                                    <label class="col-sm-2 control-label">
                                                        Ville : <b><span id="recap-city"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Commune : <b><span id="recap-town"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Quartier : <b><span id="recap-street"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Adresse : <b><span id="recap-address"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de travail : <b><span id="recap-workplace"></span></b>
                                                    </label><br/>

                                                    <label class="col-sm-2 control-label">
                                                        Numéro de téléphone :  &nbsp; <b><i class="fa fa-sim-card"></i> &nbsp; <span id="recap-msisdn"></span></b>
                                                    </label><br/>

                                                    <label class="col-sm-2 control-label" id="recap-attached-doc-field">
                                                        Titre d'identité : &nbsp; <b><i class="fa fa-paperclip"></i> &nbsp; <span id="recap-attached-doc"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label" id="recap-attached-doc-number-field">
                                                        Numéro du titre : &nbsp; <b><span id="recap-attached-doc-number"></span></b>
                                                    </label>
                                                    <br/><br/>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-6 ckbox ckbox-success" style="padding: 1em; border: 1px dashed #333;border-radius: 2em">
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
                                                            style="width: 100%;padding: 1em; display: none" onclick="cancelFormSubmit('#ctptch-frm-id', lwsbmt)"><i
                                                            class="fa fa-money-check"></i> &nbsp; Procéder au paiement
                                                    </button>
                                                    <span id="cptch-sbmt-loader" style="display: none"><i class="fa fa-spinner fa-spin fa-2x"></i><br/></span>
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



