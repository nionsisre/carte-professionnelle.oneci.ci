<script>
    /*
    |--------------------------------------------------------------------------
    | Validation étapes formulaire
    |--------------------------------------------------------------------------
    */
    /* Leave step event is used for validating the forms */
    var msisdn="", telco="", first_name="", last_name="", birth_date="", birth_place="", residence="", profession="", doc_type="", pdf_doc="", spouse_name="", country="", email="", gender="";
    jQuery("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        /* Validate only on forward movement */
        if (stepDirection === 'forward') {
            switch (currentStepIdx) {
                /* Step 1 */
                case 0:
                    msisdn = document.querySelectorAll('[name="msisdn[]"]');
                    telco = document.querySelectorAll('[name="telco[]"]');
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
                        }
                        jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    }
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
                    break;
                /* Step 2 */
                case 1:
                    first_name = document.querySelectorAll('[name="first-name"]');
                    last_name = document.querySelectorAll('[name="last-name"]');
                    birth_date = document.querySelectorAll('[name="birth-date"]');
                    birth_place = document.querySelectorAll('[name="birth-place"]');
                    residence = document.querySelectorAll('[name="residence"]');
                    profession = document.querySelectorAll('[name="profession"]');
                    gender = document.querySelectorAll('[name="gender"]');
                    /* first_name */
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
                    /* last_name */
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
                    /* gender */
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
                    /* birth_date */
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
                    /* birth_place */
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
                    /* residence */
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
                    /* profession */
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
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                /* Step 3 */
                case 2:
                    doc_type = document.querySelectorAll('[name="doc-type"]');
                    pdf_doc = document.querySelectorAll('[name="pdf_doc"]');
                    /* last_name */
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
                    /* last_name */
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
                    /*msisdn = jQuery(document.querySelectorAll('[name="msisdn[]"]')).val();
                    telco = jQuery(document.querySelectorAll('[name="telco[]"]')).val();
                    first_name = jQuery(document.querySelectorAll('[name="first-name"]')).val();
                    last_name = jQuery(document.querySelectorAll('[name="last-name"]')).val();
                    birth_date = jQuery(document.querySelectorAll('[name="birth-date"]')).val();
                    birth_place = jQuery(document.querySelectorAll('[name="birth-place"]')).val();
                    residence = jQuery(document.querySelectorAll('[name="residence"]')).val();
                    profession = jQuery(document.querySelectorAll('[name="profession"]')).val();*/
                    spouse_name = jQuery(document.querySelectorAll('[name="spouse-name"]')).val();
                    country = jQuery(document.querySelectorAll('[name="country"]')).val();
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
                    jQuery('#recap-birth-place').text(jQuery(birth_place).select2('data')[0].text);
                    jQuery('#recap-residence').text(jQuery(residence).val().toUpperCase());
                    jQuery('#recap-country').text(country.toUpperCase());
                    jQuery('#recap-profession').text(jQuery(profession).val().toUpperCase());
                    jQuery('#recap-email').text(email);
                    jQuery('#recap-pdf-doc').text(jQuery(pdf_doc).val().split('\\')[2]+' ('+jQuery(doc_type).select2('data')[0].text+')');
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
            }
        }
    });
</script>
