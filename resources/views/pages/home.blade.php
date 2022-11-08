@extends('layouts.app')

@section('title', 'Identification Abonné Mobile')

@section('home')
    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="https://www.oneci.ci">Accueil</a> &rsaquo;</li>
                    <li>Nos services &rsaquo;</li>
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
                <h5>Veuillez renseigner les champs du formulaire ci-dessous afin d'identifier votre/vos numéro(s) de
                    téléphone(s) en ligne<br/></h5>
                <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                    <center>
                        <div id="tvi-preorder-container">
                            <form id="ctptch-frm-id" class="content-form" method="post"
                                  action="{{ URL::to('/') }}/soumettre-identification" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
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
                                            <h2>Numéro(s) à identifier :</h2><br/>
                                            <br/>
                                            <a class="button blue" href="javascript:void(0)" id="add-msisdn"><i class="fa fa-plus mr10 text-white"></i> &nbsp; Ajouter un numéro supplémentaire</a>
                                            <div id="msisdn-container">
                                                <div class="container clearfix" id="ct-msisdn-1" style="background-color: #ccc; padding: 2em 2em">
                                                    <div class="form-group one-half column-last" id="telco-field-1">
                                                        <label class="col-sm-2 control-label">
                                                            Opérateur téléphonique<span style="color: #d9534f">*</span> :
                                                        </label>
                                                        <span style="display: none" id="err-toast"></span>
                                                        <div class="col-sm-10">
                                                            <select class="form-control good-select"
                                                                    id="telco-input-1" name="telco[]"
                                                                    placeholder="Opérateur téléphonique" required="required"
                                                                    style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                                <option value="" selected disabled>Opérateur téléphonique</option>
                                                                @foreach($abonnes_operateurs as $abonnes_operateur)
                                                                    <option value="{{ $abonnes_operateur->id }}">{{ $abonnes_operateur->libelle_operateur }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
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
                                                                       required="required"/></div>
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
                                                        <input type="text" id="first-name-input" name="first-name"
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
                                                        <input type="text" id="spouse-name-input" name="spouse-name"
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
                                                        <input type="text" id="last-name-input" name="last-name"
                                                               placeholder="Prénom(s) de l'abonné..." maxlength="70"
                                                               required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="birth-date-field">
                                                    <label class="col-sm-2 control-label">
                                                        Date de naissance de l'abonné<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="date" id="birth-date-input" name="birth-date"
                                                               placeholder="Date de Naissance" required="required"
                                                               max="{{ date('Y-m-d', strtotime('-10 years')) }}"
                                                               style="width: 17.5em; text-align: center"/>
                                                    </div>
                                                </div>
                                                <div class="form-group one-half column-last" id="birth-place-field">
                                                    <label class="col-sm-4 control-label">
                                                        Lieu de naissance de l'abonné<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <select class="form-control good-select" id="birth-place-input"
                                                                name="birth-place" placeholder="Lieu de naissance"
                                                                required="required"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Choisir le lieu de
                                                                naissance
                                                            </option>
                                                            @foreach($civil_status_center as $csc)
                                                                <option value="{{ $csc->civil_status_center_id }}">{{ $csc->civil_status_center_label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group column-last" id="residence-field">
                                                <label class="col-sm-2 control-label">
                                                    Lieu de résidence de l'abonné<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="residence-input" name="residence"
                                                           placeholder="Lieu de résidence..." maxlength="70" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group column-last" id="country-field">
                                                <label class="col-sm-2 control-label">
                                                    Nationalité de l'abonné<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="country-input" name="country"
                                                           placeholder="Nationalité..." maxlength="70" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group column-last" id="profession-field">
                                                <label class="col-sm-2 control-label">
                                                    Profession de l'abonné<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="profession-input" name="profession"
                                                           placeholder="Profession..." maxlength="70" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 control-label">
                                                    <em>Entrez votre adresse mail pour recevoir toute notification
                                                        relative à votre requête :</em>
                                                </label>
                                                <span style="display: none" id="err-mail-toast"></span>
                                                <div><input type="email" class="form-control"
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
                                                    Type de document<span style="color: #d9534f">*</span> :
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
                                            </div><br/><br/>
                                            <div class="form-group" id="pdf-doc-field">
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="pdf_doc" id="pdf-doc-input"
                                                               class="inputfile" accept="application/pdf"
                                                               style="display: none">
                                                        <label for="pdf-doc-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-pdf fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div><br/>
                                                <label for="pdf-doc-input" class="col-sm-2 control-label">
                                                    <em>Le document scanné à charger doit être en <b>*.pdf</b>
                                                        et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                        excéder <b>800 Ko</b>.</em>
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
                                                    Numéros à Identifier<span style="color: #d9534f">*</span> : <br/><b><span id="recap-msisdn"></span></b>
                                                </label><br/>
                                                <label class="col-sm-2 control-label">
                                                    Nom : <b><span id="recap-first-name"></span></b>
                                                </label>
                                                <label class="col-sm-2 control-label">
                                                    Prénom(s) : <b><span id="recap-last-name"></span></b>
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
                                                </label>
                                            </div><br/><br/>
                                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                            <div class="col-sm-12">
                                                <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn"
                                                        style="width: 100%;padding: 1em;"><i
                                                        class="fa fa-sim-card"></i> &nbsp; Terminer et soumettre votre identification
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            </form>
                        </div>
                    </center>
                </div>

            </div>
        </section>
    </section>
@endsection
