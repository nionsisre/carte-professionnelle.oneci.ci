@extends('layouts.app')

@section('title', 'Certificat de Conformité')

@section('scripts')
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.smart-wizard')
    @include('sections.scripts.custom-input-file')
    @include('sections.scripts.smart-wizard-validation.formulaire')
    @include('sections.scripts.copy-to-clipboard')
    @include('sections.scripts.form-tools')
    <script>
        {{--jQuery('.sw-btn-next').each(function () {
            jQuery(this).addClass('disabled');
        })
        --}}
        jQuery(document).ready(function () {
            {{-- Désactive le bouton suivant du wizard --}}
            jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
            {{--jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");--}}
            @if(session()->has('client'))
                {{-- Désactive les étapes pré-paiement du wizard --}}
                jQuery('#smartwizard').smartWizard("setState", [0,1,2,3], "disable");
                jQuery('#smartwizard').smartWizard("goToStep", 4);
            @else
                {{-- Désactive les étapes post-paiement du wizard --}}
                jQuery('#smartwizard').smartWizard("setState", [4,5], "disable");
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
                    <li>Certificat Conformité &rsaquo; </li>
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
                <h2><i class="fa fa-file-certificate text-black mr10"></i> &nbsp; Obtention du certificat de conformité
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
                                            &nbsp; Etape 3 : Documents justificatifs</a></li>
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
                    <h5>Veuillez renseigner les champs du formulaire ci-dessous afin d'obtenir votre certificat de conformité<br/></h5>
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
                                            <li><a class="nav-link" href="#etape-1"><i class="fa fa-barcode text-white"></i>
                                                    &nbsp; Etape 1 : Possession NNI</a></li>
                                            <li><a class="nav-link" href="#etape-2"><i
                                                        class="fa fa-info-circle text-white"></i> &nbsp; Etape 2 :
                                                    Informations</a></li>
                                            <li><a class="nav-link" href="#etape-3"><i class="fa fa-id-card text-white"></i>
                                                    &nbsp; Etape 3 : Documents justificatifs</a></li>
                                            <li><a class="nav-link" href="#etape-4"><i class="fa fa-eye text-white"></i>
                                                    &nbsp; Etape 4 : Récapitulatif</a></li>
                                            <li><a class="nav-link" href="#etape-5"><i class="fa fa-money-check text-white"></i>
                                                    &nbsp; Etape 5 : Paiement</a></li>
                                            <li><a class="nav-link" href="#etape-6"><i class="fa fa-check text-white"></i>
                                                    &nbsp; Etape 6 : Terminé</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="etape-1" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Avez-vous un numéro NNI ?</h2>
                                                <div class="form-group column-last" id="possession-nni-field">
                                                    <div class="form-group">
                                                        <div class="col-sm-12 container clearfix">
                                                            <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                                                                <input type="radio" name="possession_nni" id="possession-nni-oui" value="O" style="width: auto; box-shadow:none" checked/>
                                                                <label for="possession-nni-oui" style="display: inline-block; padding-right: 2em" class="col-sm-5"><b> &nbsp; Oui</b></label>
                                                            </div>
                                                            <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                                                                <input type="radio" name="possession_nni" id="possession-nni-non" value="N" style="width: auto; box-shadow:none" />
                                                                <label for="possession-nni-non" style="display: inline-block;" class="col-sm-5 pl-2"><b> &nbsp; Non</b></label>
                                                            </div>
                                                            <br/>
                                                        </div>
                                                    </div><br/>
                                                </div>
                                                <div class="form-group column-last" id="nni-field">
                                                    <label class="col-sm-2 control-label" id="nni-label">
                                                        Numéro NNI<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="nni-input" class="nni" name="nni"
                                                               placeholder="___________" maxlength="11"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div id="nni-check-spinner" style="display: none"><i class="fa fa-spinner fa-spin"></i></div>
                                                <div id="nni-check-result"></div>
                                                <br/>
                                            </div>
                                            <div id="etape-2" class="tab-pane" role="tabpanel">
                                                <div id="npdl-container">
                                                    <br/><br/>
                                                    <h2>Informations sur l'usager :</h2>
                                                    <br/>
                                                        <div class="container clearfix">
                                                            <div class="form-group one-third column-last" id="last-name-field">
                                                                <label class="col-sm-2 control-label">
                                                                    NOM<span style="color: #d9534f">*</span> :
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="last-name-input" name="last-name" value="{{ old('last-name') }}"
                                                                           placeholder="NOM..." maxlength="70"
                                                                           autocomplete="off"
                                                                           required="required"
                                                                           style="text-transform: uppercase; width: 16em; text-align: center"/>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                            <div class="form-group one-third column-last" id="first-name-field">
                                                                <label class="col-sm-2 control-label">
                                                                    Prénom(s)<span style="color: #d9534f">*</span> :
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="first-name-input" name="first-name" value="{{ old('first-name') }}"
                                                                           placeholder="Prénom(s)" maxlength="150"
                                                                           required="required"
                                                                           autocomplete="off"
                                                                           style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                            <div class="form-group one-third column-last" id="birth-date-field">
                                                                <label class="col-sm-2 control-label">
                                                                    Né(e) le<span style="color: #d9534f">*</span> :
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" id="birth-date-input" name="birth-date" value="{{ old('birth-date') }}"
                                                                           placeholder="Date de Naissance" required="required"
                                                                           max="{{ date('Y-m-d', strtotime('-10 years')) }}"
                                                                           style="width: 10.5em; text-align: center"/>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                        <div class="container clearfix">
                                                            <div class="form-group one-half column-last" id="mother-last-name-field">
                                                                <label class="col-sm-2 control-label">
                                                                    Nom de la mère<span style="color: #d9534f">*</span> :
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="mother-last-name-input" name="mother-last-name" value="{{ old('mother-last-name') }}"
                                                                           placeholder="NOM de la mère..." maxlength="70"
                                                                           autocomplete="off"
                                                                           required="required"
                                                                           style="text-transform: uppercase; width: 16em; text-align: center"/>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                            <div class="form-group one-half column-last" id="mother-first-name-field">
                                                                <label class="col-sm-2 control-label">
                                                                    Prénom(s) de la mère<span style="color: #d9534f">*</span> :
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" id="mother-first-name-input" name="mother-first-name" value="{{ old('mother-first-name') }}"
                                                                           placeholder="Prénom(s) de la mère..." maxlength="150"
                                                                           required="required"
                                                                           autocomplete="off"
                                                                           style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                        </div>
                                                </div>
                                                <br/><br/>
                                                <h2>Informations modifiées sur la décision de justice :</h2>
                                                <br/>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="decision-last-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            NOM sur la décision <br/>de justice<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="decision-last-name-input" name="decision-last-name" value="{{ old('decision-last-name') }}"
                                                                   placeholder="NOM sur décision..." maxlength="70"
                                                                   autocomplete="off"
                                                                   required="required"
                                                                   style="text-transform: uppercase; width: 16em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="decision-first-name-field">
                                                        <label class="col-sm-2 control-label">
                                                            Prénom(s) sur la décision de justice<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="decision-first-name-input" name="decision-first-name" value="{{ old('decision-first-name') }}"
                                                                   placeholder="Prénom(s) sur décision..." maxlength="150"
                                                                   required="required"
                                                                   autocomplete="off"
                                                                   style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="decision-birth-date-field">
                                                        <label class="col-sm-2 control-label">
                                                            Date de Naissance sur la décision<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" id="decision-birth-date-input" name="decision-birth-date" value="{{ old('decision-birth-date') }}"
                                                                   placeholder="Date de Naissance sur la décision..." required="required"
                                                                   max="{{ date('Y-m-d', strtotime('-10 years')) }}"
                                                                   style="width: 10.5em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-third column-last" id="decision-lieu-naissance-field">
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de naissance<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="decision-lieu-naissance-input" name="decision-lieu-naissance" value="{{ old('decision-lieu-naissance') }}"
                                                                   placeholder="Lieu de naissance..." maxlength="150"
                                                                   autocomplete="off"
                                                                   required="required"
                                                                   style="text-transform: uppercase; width: 16em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="numero-decision-field">
                                                        <label class="col-sm-2 control-label">
                                                            Numéro de la décision<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="number" id="numero-decision-input" name="numero-decision" value="{{ old('numero-decision') }}"
                                                                   placeholder="Numéro de la décision..." maxlength="25"
                                                                   required="required"
                                                                   autocomplete="off"
                                                                   style="text-transform: uppercase; width: 13.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group one-third column-last" id="decision-date-field">
                                                        <label class="col-sm-2 control-label">
                                                            Date de la décision<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" id="decision-date-input" name="decision-date" value="{{ old('decision-date-date') }}"
                                                                   placeholder="Date la décision..." required="required"
                                                                   max="{{ date('Y-m-d') }}"
                                                                   style="width: 10.5em; text-align: center"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container clearfix">
                                                    <div class="form-group one-half column-last" id="lieu-delivrance-field">
                                                        <br/>
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de délivrance<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <span style="display: none" id="err-toast"></span>
                                                        <div class="col-sm-10">
                                                            <select class="form-control good-select"
                                                                    id="lieu-delivrance" name="lieu-delivrance" required="required"
                                                                    style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Lieu de délivrance</option>
                                                                @foreach($juridictions as $juridiction)
                                                                    <option value="{{ $juridiction->id }}">{{ $juridiction->libelle.", ".$juridiction->region }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group one-half column-last" id="lieu-retrait-field">
                                                        <br/>
                                                        <label class="col-sm-2 control-label">
                                                            Lieu de retrait du certificat de conformité<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <span style="display: none" id="err-toast"></span>
                                                        <div class="col-sm-10">
                                                            <select class="form-control good-select"
                                                                    id="lieu-retrait" name="lieu-retrait" required="required"
                                                                    style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Lieu de retrait</option>
                                                                @foreach($centres as $centre)
                                                                    @if($centre->code_unique_centre !== "AB0301030102")
                                                                        <option value="{{ $centre->code_unique_centre }}">{{ ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label)) }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><br/><br/>
                                                <div>
                                                    <div class="form-group column-last" id="msisdn-field">
                                                        <div class="col-sm-12">
                                                            <label class="col-sm-2 control-label">
                                                                Numéro de téléphone<span
                                                                    style="color: #d9534f">*</span> :
                                                            </label>
                                                            <span style="display: none" id="err-toast"></span>
                                                            <div class="col-sm-10"><span style="width: 2em">+ 225</span>
                                                                &nbsp;
                                                                <input type="text" class="form-control msisdn"
                                                                       id="msisdn-input" name="msisdn"
                                                                       placeholder="__ __ __ __ __" maxlength="14"
                                                                       style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                                       required="required" autocomplete="off" /></div>
                                                        </div>
                                                    </div>
                                                </div><br/><br/>
                                            </div>
                                            <div id="etape-3" class="tab-pane" role="tabpanel">
                                                <div id="cni-number-container">
                                                    <br/><br/>
                                                    <h2><i class="fa fa-id-card"></i> &nbsp; Pièce d'identité :</h2>
                                                    <div class="form-group column-last" id="cni-number-field">
                                                        <label class="col-sm-2 control-label" id="cni-number-label">
                                                            Numéro de la Carte Nationale d'Identité<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="cni-number-input" name="cni-number"
                                                                   placeholder="___________" maxlength="11"
                                                                   style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group" id="cni-doc-field">
                                                        <div class="col-sm-10">
                                                            <div class="box">
                                                                <input type="file" name="cni-doc" id="cni-doc-input"
                                                                       class="inputfile" accept="application/pdf, image/jpeg, image/png"
                                                                       style="display: none">
                                                                <label for="cni-doc-input" class="atcl-inv hoverable"
                                                                       style="background-color: #bdbdbd6b;padding: 2em;border: 1px dashed black;border-radius: 1em; width: 20em;"><i
                                                                        class="fad fa-id-card fa-3x mr10"
                                                                        style="padding: 0.2em 0;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger la CNI…</span></label>
                                                            </div>
                                                        </div><br/>
                                                        <label for="cni-doc-input" class="col-sm-2 control-label">
                                                            Le document à charger doit être un scan <b>recto verso</b> de la Carte Nationale d'Identité <b>sur la même face</b> au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
                                                            avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.
                                                        </label>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <div id="pdf-doc-container">
                                                    <br/><br/>
                                                    <h2><i class="fa fa-balance-scale"></i> &nbsp; Décision Judiciaire :</h2>
                                                    <div class="form-group" id="pdf-doc-field">
                                                        <div class="col-sm-10">
                                                            <div class="box">
                                                                <input type="file" name="pdf-doc" id="pdf-doc-input"
                                                                       class="inputfile" accept="application/pdf, image/jpeg, image/png"
                                                                       style="display: none">
                                                                <label for="pdf-doc-input" class="atcl-inv hoverable"
                                                                       style="background-color: #bdbdbd6b;padding: 2em;border: 1px dashed black;border-radius: 1em; width: 20em;"><i
                                                                        class="fad fa-file-pdf fa-3x mr10"
                                                                        style="padding: 0.2em 0;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger le document…</span></label>
                                                            </div>
                                                        </div><br/>
                                                        <label for="pdf-doc-input" class="col-sm-2 control-label">
                                                            <em>Le document à charger doit être un scan du document  au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
                                                                avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.</em>
                                                        </label>
                                                        <br/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="etape-4" class="tab-pane" role="tabpanel">
                                                <br/><br/>
                                                <h2>Récapitulatif :</h2>
                                                <div class="form-group col-sm-12 column-last" id="doc-type-field">
                                                    <label class="col-sm-2 control-label" id="recap-cni-container">
                                                        Numéro CNI<br/><b><span id="recap-cni"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label" id="recap-nni-container">
                                                        Numéro NNI<br/><b><span id="recap-nni"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Nom : <b><span id="recap-last-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Prénom(s) : <b><span id="recap-first-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Né(e) le : <b><span id="recap-birth-date"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label" style="display: none">
                                                        Nom de la mère : <b><span id="recap-mother-last-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label" style="display: none">
                                                        Prénom(s) de la mère : <b><span id="recap-mother-first-name"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Nom sur la décision de justice : <b><span id="recap-decision-last-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Prénom(s) sur la décision de justice : <b><span id="recap-decision-first-name"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Date de Naissance sur la décision : <b><span id="recap-decision-birth-date"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de naissance : &nbsp; <b><span id="recap-decision-birth-place"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Numéro de la décision : <b><span id="recap-numero-decision"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Date de la décision : <b><span id="recap-decision-date"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de délivrance : <b><span id="recap-lieu-delivrance"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de retrait du certificat de conformité :  &nbsp; <b><i class="fa fa-map-marker-alt"></i> &nbsp; <span id="recap-lieu-retrait"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label">
                                                        Numéro de téléphone :  &nbsp; <b><i class="fa fa-sim-card"></i> &nbsp; <span id="recap-msisdn"></span></b>
                                                    </label><br/>
                                                    <label class="col-sm-2 control-label" id="recap-cni-doc-container">
                                                        Carte Nationale d'Identité : &nbsp; <b><i class="fa fa-id-card"></i> &nbsp; <span id="recap-cni-doc"></span></b>
                                                    </label>
                                                    <label class="col-sm-2 control-label">
                                                        Décision Judiciaire : &nbsp; <b><i class="fa fa-balance-scale"></i> &nbsp; <span id="recap-pdf-doc"></span></b>
                                                    </label><br/><br/>
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



