<script>
    {{--
    |--------------------------------------------------------------------------
    | Validation étapes formulaire
    |--------------------------------------------------------------------------
    --}}
    jQuery('#modalInfo').html(
        '<center> <div class="notification-box notification-box-info">\n\
        <div class="modal-header"><h3><i class="fad fa-sim-card" style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: x-large"></i><br/><br/>Merci de vous rassurer que le numéro est le votre et est accessible. <br/><br/>Il sera utilisé pour les confirmations nécessaires.</h3></div>\n\
        </div><div class="modal-footer">\n\
        <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
    );
    jQuery('#modalInfo').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('.blocker').css('z-index','2');
    {{-- Variables --}}
    var msisdn="", telco="", first_name="", last_name="", birth_date="", birth_place="", residence="", profession="", doc_type="", pdf_doc="", spouse_name="", country="", email="", gender="", document_number="";
    {{-- Detection de l'operateur telephonique a la volee lors du copier/coller du numero de telephone --}}
    jQuery(document.querySelectorAll('[name="msisdn[]"]')).bind('paste', function(e) {
        {{-- var _this = this; --}}
        {{-- Short pause to wait for paste to complete --}}
        setTimeout(function() {
            {{-- var text = jQuery(_this).val();
            jQuery(".display").html(text); --}}
            msisdn = document.querySelectorAll('[name="msisdn[]"]');
            telco = document.querySelectorAll('[name="telco[]"]');
            for(let i=0; i<msisdn.length; i++) {
                if (jQuery(msisdn[i]).val().length >= 2) {
                    if (jQuery(msisdn[i]).val().substring(0, 2) === "07") {
                        jQuery(telco[i]).val("1");
                        jQuery(telco[i]).trigger('change');
                    } else if (jQuery(msisdn[i]).val().substring(0, 2) === "05") {
                        jQuery(telco[i]).val("2");
                        jQuery(telco[i]).trigger('change');
                    } else if (jQuery(msisdn[i]).val().substring(0, 2) === "01") {
                        jQuery(telco[i]).val("3");
                        jQuery(telco[i]).trigger('change');
                    }
                }
            }
        }, 100);
    });
    {{-- Detection de l'operateur telephonique a la volee lors de la saisie du numero de telephone --}}
    jQuery(document.querySelectorAll('[name="msisdn[]"]')).keypress(function(e) {
        msisdn = document.querySelectorAll('[name="msisdn[]"]');
        telco = document.querySelectorAll('[name="telco[]"]');
        for(let i=0; i<msisdn.length; i++) {
            if (jQuery(msisdn[i]).val().length >= 2) {
                if (jQuery(msisdn[i]).val().substring(0, 2) === "07") {
                    jQuery(telco[i]).val("1");
                    jQuery(telco[i]).trigger('change');
                } else if (jQuery(msisdn[i]).val().substring(0, 2) === "05") {
                    jQuery(telco[i]).val("2");
                    jQuery(telco[i]).trigger('change');
                } else if (jQuery(msisdn[i]).val().substring(0, 2) === "01") {
                    jQuery(telco[i]).val("3");
                    jQuery(telco[i]).trigger('change');
                }
            }
        }
    });
    {{-- Changement des types de champs pour le lieu de naissance selon le choix du pays --}}
    jQuery("#country-input").change(function () {
        var selected_country = this.value;
        if(selected_country !== "Côte d’Ivoire") {
            jQuery("#birth-place-field").hide();
            jQuery("#birth-place-field-2").show();
        } else {
            jQuery("#birth-place-field").show();
            jQuery("#birth-place-field-2").hide();
        }
        {{--jQuery("#checkboxSuccess_1").prop('checked', false);--}}
    });
    {{-- Modification des libelles NNI au changement des types de documents --}}
    jQuery("#doc-type").on("change", function (e) {
        if(country === "Côte d’Ivoire") {
            if (jQuery("#doc-type").val() === "2") {
                jQuery("#cni-type-field").show();
                jQuery('#new-format-card').prop('checked', true);
                jQuery('#modalInfo').html(
                    '<center> <div class="notification-box notification-box-info">\n\
                    <div class="modal-header"><img src="{{ URL::asset('assets/images/nni-illustration.png') }}" style="width: 15em"> <br/><br/><h3>NB : Le numéro de NNI à renseigner se situe au verso de votre carte nationale d\'identité.</h3></div>\n\
                        </div><div class="modal-footer">\n\
                        <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                );
                jQuery('#modalInfo').modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
                jQuery('.blocker').css('z-index','2');
                jQuery("#document-number-input").focus();
                if(jQuery('#new-format-card').is(':checked')) {
                    jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                    jQuery("#document-number-input").attr('placeholder','Numéro NNI...');
                    jQuery("#document-number-input").attr('placeholder','___________');
                    jQuery("#document-number-input").mask('99999999999');
                } else {
                    jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                    jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
                    jQuery("#document-number-input").attr('placeholder','__________');
                    jQuery("#document-number-input").mask('9999999999');
                }
            } else {
                jQuery("#cni-type-field").hide();
                jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
                jQuery("#document-number-input").attr('placeholder','__________');
                jQuery("#document-number-input").mask('9999999999');
            }
        }
    });
    {{-- Changement dynamique du libelle pour le NNI --}}
    jQuery('input[type="radio"]').click(function() {
        if(jQuery('#new-format-card').is(':checked')) {
            jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
            jQuery("#document-number-input").attr('placeholder','___________');
            jQuery("#document-number-input").mask('99999999999');
        } else {
            jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
            jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
            jQuery("#document-number-input").attr('placeholder','__________');
            jQuery("#document-number-input").mask('9999999999');
        }
    });
    {{-- L'evenement "leaveStep" est utilise pour valider le formulaire --}}
    jQuery("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        {{-- Validation uniquement que quand le sens de l'etape est suivant --}}
        if (stepDirection === 'forward') {
            switch (currentStepIdx) {
                {{-- Step 1 --}}
                case 0:
                    msisdn = document.querySelectorAll('[name="msisdn[]"]');
                    telco = document.querySelectorAll('[name="telco[]"]');
                    for(let i=0; i<telco.length; i++) {
                        if(!jQuery(telco[i]).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><h3>Veuillez sélectionner tous les opérateurs de vos numéros à identifier !</h3></div>\n\
                                </div><div class="modal-footer">\n\
                                <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                            );
                            jQuery('#modalError').modal({
                                escapeClose: false,
                                clickClose: false,
                                showClose: false
                            });
                            jQuery('.blocker').css('z-index','2');
                            jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            return false;
                        }
                        jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    }
                    for(let i=0; i<msisdn.length; i++) {
                        if(!jQuery(msisdn[i]).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><h3>Veuillez remplir correctement les champs de tous vos numéros à identifier !</h3></div>\n\
                                </div><div class="modal-footer">\n\
                                <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                            );
                            jQuery('#modalError').modal({
                                escapeClose: false,
                                clickClose: false,
                                showClose: false
                            });
                            jQuery('.blocker').css('z-index','2');
                            jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            return false;
                        } else if (jQuery(msisdn[i]).val().length !== 14 ||
                            (jQuery(msisdn[i]).val().length === 14 && jQuery(msisdn[i]).val().substring(0, 2) !== "01" && jQuery(msisdn[i]).val().substring(0, 2) !== "05" && jQuery(msisdn[i]).val().substring(0, 2) !== "07")) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><h3>Veuillez renseigner un numéro de téléphone valide !</h3></div>\n\
                                </div><div class="modal-footer">\n\
                                <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                            );
                            jQuery('#modalError').modal({
                                escapeClose: false,
                                clickClose: false,
                                showClose: false
                            });
                            jQuery('.blocker').css('z-index','2');
                            jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            return false;
                        } else if (
                            (jQuery(telco[i]).val() === "1" && jQuery(msisdn[i]).val().substring(0, 2) !== "07") ||
                            (jQuery(telco[i]).val() === "2" && jQuery(msisdn[i]).val().substring(0, 2) !== "05") ||
                            (jQuery(telco[i]).val() === "3" && jQuery(msisdn[i]).val().substring(0, 2) !== "01")
                        ) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><h3>L\'opérateur téléphonique du numéro : <br/><b>'+jQuery(msisdn[i]).val().replaceAll(" ", "")+'</b><br/>est incorrect !</h3></div>\n\
                                </div><div class="modal-footer">\n\
                                <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                            );
                            jQuery('#modalError').modal({
                                escapeClose: false,
                                clickClose: false,
                                showClose: false
                            });
                            jQuery('.blocker').css('z-index','2');
                            jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            return false;
                        } else {
                            jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                        }
                    }
                    break;
                {{-- Step 2 --}}
                case 1:
                    first_name = document.querySelectorAll('[name="first-name"]');
                    last_name = document.querySelectorAll('[name="last-name"]');
                    birth_date = document.querySelectorAll('[name="birth-date"]');
                    country = jQuery(document.querySelectorAll('[name="country"]')).val();
                    birth_place = (country !== "Côte d’Ivoire") ? document.querySelectorAll('[name="birth-place-2"]') :
                        document.querySelectorAll('[name="birth-place"]');
                    residence = document.querySelectorAll('[name="residence"]');
                    profession = document.querySelectorAll('[name="profession"]');
                    gender = document.querySelectorAll('[name="gender"]');
                    {{-- first_name --}}
                    if(!jQuery(first_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre nom SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- last_name --}}
                    if(!jQuery(last_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre/vos prénom(s) SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- gender --}}
                    if(!jQuery(gender).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre genre SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- birth_date --}}
                    var birthdateFormatted = new Date(jQuery(birth_date).val());
                    var maxdate = new Date();
                    var mindate = new Date();
                    maxdate.setFullYear(maxdate.getFullYear()-10);
                    mindate.setFullYear(mindate.getFullYear()-140);
                    if(!jQuery(birth_date).val() || birthdateFormatted.getTime() < mindate.getTime() || birthdateFormatted.getTime() > maxdate.getTime() ) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre date de naissance</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- birth_place --}}
                    if(!jQuery(birth_place).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre lieu de naissance SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- residence --}}
                    if(!jQuery(residence).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre lieu de résidence SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- profession --}}
                    if(!jQuery(profession).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez correctement renseigner votre profession SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    if(country === "Côte d’Ivoire") {
                        if (jQuery("#doc-type").val() === "2") {
                            jQuery("#cni-type-field").show();
                            if(jQuery('#new-format-card').is(':checked')) {
                                jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                                jQuery("#document-number-input").attr('placeholder','Numéro NNI...');
                                jQuery("#document-number-input").attr('placeholder','___________');
                                jQuery("#document-number-input").mask('99999999999');
                                jQuery('#modalInfo').html(
                                    '<center> <div class="notification-box notification-box-info">\n\
                                    <div class="modal-header"><img src="{{ URL::asset('assets/images/nni-illustration.png') }}" style="width: 15em"> <br/><br/><h3>NB : Le numéro de NNI à renseigner se situe au verso de votre carte nationale d\'identité.</h3></div>\n\
                                    </div><div class="modal-footer">\n\
                                    <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                                );
                                jQuery('#modalInfo').modal({
                                    escapeClose: false,
                                    clickClose: false,
                                    showClose: false
                                });
                                jQuery('.blocker').css('z-index','2');
                            } else {
                                jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                                jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
                                jQuery("#document-number-input").attr('placeholder','__________');
                                jQuery("#document-number-input").mask('9999999999');
                            }
                        } else {
                            jQuery("#cni-type-field").hide();
                            jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                            jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
                            jQuery("#document-number-input").attr('placeholder','__________');
                            jQuery("#document-number-input").mask('9999999999');
                        }
                    } else {
                        jQuery("#cni-type-field").hide();
                        jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                        jQuery("#document-number-input").attr('placeholder','Numéro pièce identité...');
                        jQuery("#document-number-input").attr('placeholder','__________');
                        jQuery("#document-number-input").mask('9999999999');
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                {{-- Step 3 --}}
                case 2:
                    doc_type = document.querySelectorAll('[name="doc-type"]');
                    document_number = document.querySelectorAll('[name="document-number"]');
                    pdf_doc = document.querySelectorAll('[name="pdf_doc"]');
                    {{-- doc_type --}}
                    if(!jQuery(doc_type).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez selectionner votre type de document justificatif</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- document_number --}}
                    if(!jQuery(document_number).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez renseigner votre numéro de document SVP</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- pdf_doc --}}
                    if(!jQuery(pdf_doc).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><h3>Veuillez charger un document justificatif</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index','2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- RECAP --}}
                    spouse_name = jQuery(document.querySelectorAll('[name="spouse-name"]')).val();
                    email = jQuery(document.querySelectorAll('[name="email"]')).val();
                    var msisdn_list = "";
                    for(let i=0; i<msisdn.length; i++) {
                        msisdn_list += '<i class="fa fa-sim-card"></i> &nbsp; '+jQuery(msisdn[i]).val()+' ('+jQuery(telco[i]).select2('data')[0].text+')<br/>';
                    }
                    jQuery('#recap-msisdn').html(msisdn_list);
                    if(spouse_name) {
                        jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase() + ' epse ' + spouse_name.toUpperCase());
                    } else {
                        jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase());
                    }
                    jQuery('#recap-last-name').text(jQuery(last_name).val().toUpperCase());
                    jQuery('#recap-gender').text(jQuery(gender).select2('data')[0].text);
                    jQuery('#recap-birth-date').text(jQuery(birth_date).val());
                    if(country !== "Côte d’Ivoire") {
                        jQuery('#recap-birth-place').text(jQuery(birth_place).val());
                    } else {
                        jQuery('#recap-birth-place').text(jQuery(birth_place).select2('data')[0].text);
                    }
                    jQuery('#recap-residence').text(jQuery(residence).val().toUpperCase());
                    jQuery('#recap-country').text(country.toUpperCase());
                    jQuery('#recap-profession').text(jQuery(profession).val().toUpperCase());
                    jQuery('#recap-email').text(email);
                    jQuery('#recap-pdf-doc').text(jQuery(pdf_doc).val().split('\\')[2]+' ('+jQuery(doc_type).select2('data')[0].text+')');
                    jQuery('#recap-document-number').text(jQuery(document_number).val().toUpperCase());
                    if(jQuery("#agreement-input").is(':checked')) {
                        jQuery("#cptch-sbmt-btn").show();
                    } else {
                        jQuery("#cptch-sbmt-btn").hide();
                    }
                    jQuery("#agreement-input").change(function() {
                        if(this.checked) {
                            jQuery("#cptch-sbmt-btn").show();
                        } else {
                            jQuery("#cptch-sbmt-btn").hide();
                        }
                    });
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
            }
        }
    });
</script>
