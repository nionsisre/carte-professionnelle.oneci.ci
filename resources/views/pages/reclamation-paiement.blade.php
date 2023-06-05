@extends('layouts.app')

@section('title', 'Reclamation Post-Paiement')

@section('reclamation_paiement')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo; </li>
                    <li>Nos services &rsaquo; </li>
                    <li>Effectuer une réclamation post-paiement</li>
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
                <h2><i class="fa fa-headset text-black mr10"></i> &nbsp; Effectuer une réclamation sur un paiement non pris en compte</h2>
                <h5>Veuillez renseigner le formulaire ci-dessous afin de relancer la synchronisation de prise en compte du paiement de votre service<br/></h5>
                <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                    @if(session()->has('response'))
                        @if(session('response.has_error'))
                            <center>
                                <div class="notification-box notification-box-error">
                                    <div class="modal-header">
                                        <h6 style="color: #f44336"><i class="fa fa-exclamation-triangle fa-flip-horizontal mr10"></i> &nbsp; {{ session('response.message') }}</h6>
                                    </div>
                                </div>
                            </center>
                        @else
                            <center>
                                <div class="notification-box notification-box-success">
                                    <div class="modal-header">
                                        <h6 style="color: #388e3c"><i class="fa fa-check mr10"></i> &nbsp; {{ session('response.message') }}</h6>
                                    </div>
                                </div>
                            </center>
                        @endif
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
                    <form id="ctptch-frm-id" class="content-form" method="post" action="{{ route('front_office.form.soumettre_reclamation_paiement') }}">
                        {{ csrf_field() }}
                        <center>
                            <br/>
                            <!-- With Document Number -->
                            <div class="form-group" id="transaction-id-field">
                                <label class="col-sm-2 control-label">
                                    Entrez l'ID de transaction présent sur le reçu de paiement<span style="color: #d9534f">*</span> :
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" id="transaction-id-input" name="transaction_id" placeholder="{{ date('Y') }}**********" maxlength="14" minlength="14" style="width: 23.4em; text-align: center" value="{{ old('transaction_id') }}" autocomplete="off" required="required"/>
                                </div>
                                <br/>
                            </div>
                            <div class="form-group" id="form-number-field">
                                <label class="col-sm-2 control-label">
                                    Entrez le numéro de validation reçu lors de votre identification<span style="color: #d9534f">*</span> :
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" id="form-number-input" name="form_number" placeholder="__________" maxlength="10" minlength="10" style="width: 23.4em; text-align: center" value="{{ old('form_number') }}" autocomplete="off" required="required"/>
                                </div>
                                <br/>
                            </div>
                            <div class="form-group" id="msisdn-field">
                                <label class="col-sm-2 control-label">
                                    Entrez le numéro de téléphone identifié / pré-identifié<span style="color: #d9534f">*</span> :
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" id="msisdn-input" class="msisdn" name="msisdn" placeholder="__ __ __ __ __" maxlength="14" minlength="14" style="width: 23.4em; text-align: center" value="{{ old('msisdn') }}" autocomplete="off" />
                                </div>
                                <br/>
                            </div>
                            <!-- Captcha and submit -->
                            <br/><br/>
                            <div class="form-group">
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                <div class="col-sm-12">
                                    <button type="submit" value="Submit" class="button" style="width: 100%;padding: 1em;"><i class="fa fa-sync"></i> &nbsp; Relancer la synchronisation du paiement</button>
                                </div>
                            </div>
                            <br/>
                        </center>
                    </form>
                </div>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div>
        </section>
    </section>
@endsection
