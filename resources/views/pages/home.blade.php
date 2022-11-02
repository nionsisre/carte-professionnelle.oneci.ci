@extends('layouts.app')

@section('title', 'Identification Abonné mobile')

@section('home')
<!-- begin page title -->
<section id="page-title">
    <div class="container clearfix">
        <nav id="breadcrumbs" style="float: left !important">
            <ul>
                <li><a href="<?php echo 'https://www.oneci.ci' ?>">Accueil</a> &rsaquo;</li>
                <li>Nos services &rsaquo;</li>
                <li>Retrait par procuration</li>
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

            <?php if (isset($_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"]) && $_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"] == "1") { ?>

            <center>
                <i class="fad fa-check-circle"
                   style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>
                <br/>
                <div><?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?></div>
                <a href="https://www.oneci.ci" class="button black"><i
                        class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
            </center>

                <?php session_destroy(); ?>

            <?php } else { ?>

            <h2><i class="fa fa-hands-helping text-black mr10"></i> &nbsp; Initier un retrait de Carte Nationale
                d'Identité par procuration</h2>
            <h5>
                Veuillez renseigner les champs du formulaire ci-dessous afin d'initier un retrait de Carte Nationale
                d'Identité par procuration<br/>
            </h5>

                <?php if (isset($_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"]) && $_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"] == "2") { ?>

            <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <center>
                    <div class="notification-box notification-box-error">
                        <div class="modal-header">
                            <h3><i class="fa fa-warning"></i>
                                &nbsp; <?php echo $_SESSION["PRE_ORDER_TVI"]["TITLE"]; ?></h3>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" rel="modal:close"
                           style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a>
                    </div>
                </center>
            </div>
            <div id="contact-notification-box-error" class="notification-box notification-box-error">
                <p>
                    <b><?php echo $_SESSION["PRE_ORDER_TVI"]["TITLE"]; ?> :</b><br/>
                        <?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?>
                </p>
            </div>

            <?php } ?>

            <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                <center>
                    <div id="tvi-preorder-container">
                        <form id="ctptch-frm-id" class="content-form" method="post"
                              action="<?php echo $SUBSTR_URL."/signaler-retard-de-production"; ?>">
                                <?php
                                // --------------------------------------------------------------------------
                                // Everything is ok so getting data using REST-API Micro service
                                // --------------------------------------------------------------------------
                                $get_parameters = array(
                                    "instruction" => "GET_CIVIL_STATUS_CENTRES_LIST",
                                    "client" => "KERNEL"
                                );
                                $url = $ONECI_KERNEL_URL . '/get-info?API_KEY=' . $ONECI_PANEL_MICROSERVICES_API_KEY . '&' . http_build_query($get_parameters);
                                $contents = file_get_contents($url);
                                // --------------------------------------------------------------------------
                                // REST-API Micro service feedback processing
                                // --------------------------------------------------------------------------
                                if (isset($contents) && !empty($contents)) {
                                    // --------------------------------------------------------------------------
                                    // JSON Clean
                                    // --------------------------------------------------------------------------
                                    for ($i = 0; $i <= 31; ++$i) $contents = str_replace(chr($i), "", $contents);
                                    $contents = str_replace(chr(127), "", $contents);
                                    if (0 === strpos(bin2hex($contents), 'efbbbf')) $contents = substr($contents, 3);
                                    // --------------------------------------------------------------------------
                                    // Result USE Cases
                                    // --------------------------------------------------------------------------
                                    try {
                                        $result = json_decode($contents, true); // Decoding serialized json into an array
                                        //var_dump($result);
                                        if (isset($result["error"]) && !$result["error"]) {
                                            $result = $result["data"];
                                        }
                                    } catch (Exception $e) {
                                        $flag = true;
                                    }
                                }
                                /*echo $url."<br/>";
                                var_dump($contents);*/
                                ?>
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li>
                                        <a class="nav-link" href="#step-1"><i
                                                class="fa fa-info-circle text-white"></i> &nbsp; Etape 1 :
                                            Numéro(s) à identifier</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-2"><i class="fa fa-id-card text-white"></i>
                                            &nbsp; Etape 2 : Informations sur l'abonné</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-3"><i class="fa fa-copy text-white"></i>
                                            &nbsp; Etape 3 : Documents justificatifs</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-4"><i class="fa fa-eye text-white"></i>
                                            &nbsp; Etape 4 : Récapitulatif</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="step-1" class="tab-pane" role="tabpanel">
                                        <br/><br/>
                                        <h2>Informations sur le mandataire :</h2><br/>
                                        <input type="hidden" name="context" value="WITHDRAWAL_WITH_PROCURATION"/>
                                        <input type="hidden" name="token"
                                               value=""/>
                                        <br/>
                                        <div class="container clearfix">
                                            <div class="form-group one-half column-last" id="birth-place-field">
                                                <label class="col-sm-2 control-label">
                                                    Quel est votre lien de parenté avec le propriétaire de la
                                                    CNI<span style="color: #d9534f">*</span> :
                                                </label>
                                                <span style="display: none" id="err-toast"></span>
                                                <div class="col-sm-10">
                                                    <select class="form-control good-select"
                                                            id="delegate-filiation-input" name="delegate-filiation"
                                                            placeholder="Lien de parenté" required="required"
                                                            style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                        <option value="" selected disabled>Lien de parenté</option>
                                                        <option value="1">Grand-Parent</option>
                                                        <option value="2">Père / Mère</option>
                                                        <option value="3">Oncle / Tante</option>
                                                        <option value="4">Frère / Soeur</option>
                                                        <option value="5">Epoux / Epouse</option>
                                                        <option value="6">Cousin / Cousine</option>
                                                        <option value="7">Fils / Fille</option>
                                                        <option value="8">Ami(e) / Proche</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group one-half column-last" id="last-name-field">
                                                <div class="col-sm-12">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre numéro de téléphone mobile<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10"><span style="width: 2em">+ 225</span> &nbsp;
                                                        <input type="text" class="form-control good-select"
                                                               id="delegate-msisdn-input" name="delegate-msisdn"
                                                               placeholder="__ __ __ __ __" maxlength="14"
                                                               style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"] . '"';
                                                               } ?> required="required"/></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="form-number-field">
                                            <br/>
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 control-label">
                                                    Entrez votre numéro de téléphone mobile<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <span style="display: none" id="err-toast"></span>
                                                <div class="col-sm-10"><span style="width: 2em">+ 225</span> &nbsp;
                                                    <input type="text" class="form-control good-select"
                                                           id="delegate-msisdn-input" name="delegate-msisdn"
                                                           placeholder="__ __ __ __ __" maxlength="14"
                                                           style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"] . '"';
                                                           } ?> required="required"/></div>
                                            </div>
                                            <br/>
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 control-label">
                                                    <em>Entrez votre adresse mail pour recevoir toute notification
                                                        relative à votre requête :</em>
                                                </label>
                                                <span style="display: none" id="err-mail-toast"></span>
                                                <div><input type="email" class="form-control good-select"
                                                            id="email-input" name="email"
                                                            placeholder="Adresse Mail..." maxlength="150"
                                                            style="width: 21.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                            <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"])) {
                                                        echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"] . '"';
                                                    } ?> /></div>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2" class="tab-pane" role="tabpanel">
                                        <br/><br/>
                                        <h2>Informations sur l'abonné :</h2>
                                        <br/>
                                        <div class="container clearfix">
                                            <div class="form-group one-third column-last" id="first-name-field">
                                                <label class="col-sm-2 control-label">
                                                    Nom de l'abonné<span style="color: #d9534f">*</span>
                                                    :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="first-name-input" name="first-name"
                                                           placeholder="Nom de l'abonné..."
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"] . '"';
                                                           } ?> maxlength="25" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="form-group one-third column-last" id="last-name-field">
                                                <label class="col-sm-2 control-label">
                                                    Nom d'épouse<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="last-name-input" name="last-name"
                                                           placeholder="Nom d'épouse..."
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                           } ?> maxlength="70" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="form-group one-third column-last" id="last-name-field">
                                                <label class="col-sm-2 control-label">
                                                    Prénom(s) de l'abonné<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="last-name-input" name="last-name"
                                                           placeholder="Prénom(s) de l'abonné..."
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                           } ?> maxlength="70" required="required"
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
                                                           placeholder="Date de Naissance"
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"] . '"';
                                                           } ?>  required="required"
                                                           style="width: 17.5em; text-align: center"/>
                                                </div>
                                                <br/>
                                            </div>
                                                <?php if (isset($result) && is_array($result)) { ?>
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
                                                            <?php foreach ($result as $ec) { ?>
                                                        <option
                                                            value="<?php echo $ec["civil_status_center_id"]; ?>" <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]) && $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_place"] == $ec["civil_status_center_id"]) {
                                                            echo 'selected';
                                                        } ?>><?php echo $ec["civil_status_center_label"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <br/>
                                        <div class="form-group column-last" id="last-name-field">
                                            <label class="col-sm-2 control-label">
                                                Lieu de résidence de l'abonné<span
                                                    style="color: #d9534f">*</span> :
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" id="residence-input" name="residence"
                                                       placeholder="Lieu de résidence..."
                                                       <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                           echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                       } ?> maxlength="70" required="required"
                                                       style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="col-sm-2 control-label">
                                                <em>Entrez votre adresse mail pour recevoir toute notification
                                                    relative à votre requête :</em>
                                            </label>
                                            <span style="display: none" id="err-mail-toast"></span>
                                            <div><input type="email" class="form-control good-select"
                                                        id="email-input" name="email"
                                                        placeholder="Adresse Mail..." maxlength="150"
                                                        style="width: 21.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"])) {
                                                    echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"] . '"';
                                                } ?> /></div>
                                            <br/>
                                        </div>

                                        <div class="form-group column-last" id="last-name-field">
                                            <label class="col-sm-2 control-label">
                                                Profession de l'abonné<span
                                                    style="color: #d9534f">*</span> :
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" id="residence-input" name="residence"
                                                       placeholder="Profession..."
                                                       <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                           echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                       } ?> maxlength="70" required="required"
                                                       style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                            </div>
                                        </div>
                                        <div class="form-group column-last" id="last-name-field">
                                            <label class="col-sm-2 control-label">
                                                Nationalité de l'abonné<span
                                                    style="color: #d9534f">*</span> :
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" id="residence-input" name="residence"
                                                       placeholder="Nationalité..."
                                                       <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                           echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                       } ?> maxlength="70" required="required"
                                                       style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                            </div>
                                        </div>
                                        <br/>
                                    </div>
                                    <div id="step-3" class="tab-pane" role="tabpanel">
                                        <br/><br/>
                                        <h2>Photocopie de la pièce d'identité du mandataire en cours de validité
                                            :</h2>
                                        <label for="document-input" class="col-sm-2 control-label">
                                            <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                excéder <b>800 Ko</b>.</em>
                                        </label>
                                        <div class="form-group" id="form-number-field">
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <b><i class="fa fa-id-card"></i>&nbsp; Pièce d'identité acceptée :
                                                    <br>
                                                    <span>(Carte Nationale d'Identité valide, Récépissé d’enrôlement ou l’Attestation d’Identité valide)</span></b>
                                            </label>
                                            <div class="col-sm-10">
                                                <div class="box">
                                                    <input type="file" name="documents[]" id="document-2-input"
                                                           class="inputfile" accept="application/pdf, image/jpeg"
                                                           style="display: none">
                                                    <label for="document-2-input" class="atcl-inv hoverable"
                                                           style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                            class="fad fa-file-upload fa-3x mr10"
                                                            style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                </div>
                                            </div>
                                            <br/>
                                        </div>
                                        <br/>
                                    </div>
                                    <div id="step-4" class="tab-pane" role="tabpanel">
                                        <br/><br/>
                                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                        <div class="col-sm-12">
                                            <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn"
                                                    style="width: 100%;padding: 1em;"><i
                                                    class="fa fa-credit-card"></i> &nbsp; Procéder au paiement
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

                <?php if (isset($_SESSION["PRE_ORDER_TVI"])) unset($_SESSION["PRE_ORDER_TVI"]); ?>

            <?php } ?>

        </div>
    </section>
</section>
@endsection
