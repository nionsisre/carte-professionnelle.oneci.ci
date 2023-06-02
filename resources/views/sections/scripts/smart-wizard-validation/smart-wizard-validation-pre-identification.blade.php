<script>
    {{--
    |--------------------------------------------------------------------------
    | Validation étapes formulaire
    |--------------------------------------------------------------------------
    --}}
    {{-- Fonction utile pour compter les nombre d'occurences identiques dans un tableau (pour détecter si quelqu'un entre 2 fois le même numéro --}}
    function elementCount(arr, element){
        return arr.filter((currentElement) => currentElement === element).length;
    };
    {{-- Fonction pour valider l'adresse email --}}
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    {{-- Initialisation et lancement de la fenetre Pop-up au chargement du Smart-Wizard --}}
    {{-- jQuery('#modalInfo').html(
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
    jQuery('.blocker').css('z-index','2'); --}}
    {{-- Variables --}}
    var first_name="", last_name="", birth_date="", birth_place="", residence="", profession="", doc_type="", pdf_doc="", pdf_doc_size="", fSize="", selfie_img="", selfie_img_size="", selfSize="", spouse_name="", country="", email="", gender="", document_number="", document_expiry="";
    {{-- Apparition ou non du champ nom épouse selon que le genre soit masculin ou feminin --}}
    jQuery('input[type="radio"]').click(function() {
        if(jQuery('#gender-input-male').is(':checked')) {
            jQuery("#spouse-name-field").hide();
            jQuery("#first-name-field").attr('class','form-group one-half column-last');
            jQuery("#last-name-field").attr('class','form-group one-half column-last');
            jQuery("#spouse-name-field").attr('class','form-group one-half column-last');
        } else if(jQuery('#gender-input-female').is(':checked')) {
            jQuery("#first-name-field").attr('class','form-group one-third column-last');
            jQuery("#last-name-field").attr('class','form-group one-third column-last');
            jQuery("#spouse-name-field").attr('class','form-group one-third column-last');
            jQuery("#spouse-name-field").show();
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
    });
    {{-- Modification a la selection du type de document --}}
    jQuery("#doc-type").on("change", function (e) {
        if (jQuery("#doc-type").val() === "0") { {{-- Cas où l'utilisateur n'a aucun des documents de la liste --}}
            jQuery("#cni-type-field").hide();
            jQuery("#document-number-field").hide();
            jQuery("#document-expiry-field").hide();
            jQuery("#pdf-doc-field").hide();
        } else { {{-- Cas où l'utilisateur a selectionné un des documents de la liste --}}
            jQuery("#document-number-field").show();
            jQuery("#document-expiry-field").show();
            jQuery("#pdf-doc-field").show();
            if (country === "Côte d’Ivoire") {
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
                    jQuery('.blocker').css('z-index', '2');
                    jQuery("#document-number-input").focus();
                    if (jQuery('#new-format-card').is(':checked')) {
                        jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                        jQuery("#document-number-input").attr('placeholder', 'Numéro NNI...');
                        jQuery("#document-number-input").attr('placeholder', '___________');
                        jQuery("#document-number-input").mask('99999999999');
                    } else {
                        jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                        jQuery("#document-number-input").attr('placeholder', 'Numéro pièce identité...');
                        jQuery("#document-number-input").attr('placeholder', '__________');
                        jQuery("#document-number-input").mask('9999999999');
                        jQuery('#modalInfo').html(
                            '<center> <div class="notification-box notification-box-info">\n\
                            <div class="modal-header"><img src="{{ URL::asset('assets/images/sensibilisation-nni-illustration.jpg') }}" style="width: 100%"></div>\n\
                        </div><div class="modal-footer">\n\
                        <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalInfo').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index', '2');
                    }
                } else if (jQuery("#doc-type").val() === "3") {
                    jQuery("#cni-type-field").hide();
                    jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                    jQuery("#document-number-input").attr('placeholder', 'Numéro NNI...');
                    jQuery("#document-number-input").attr('placeholder', '___________');
                    jQuery("#document-number-input").mask('99999999999');
                    jQuery('#modalInfo').html(
                        '<center> <div class="notification-box notification-box-info">\n\
                        <div class="modal-header"><img src="{{ URL::asset('assets/images/nni-illustration.png') }}" style="width: 15em"> <br/><br/><h3>NB : Le numéro de NNI à renseigner se situe au verso de votre carte de résident.</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                    );
                    jQuery('#modalInfo').modal({
                        escapeClose: false,
                        clickClose: false,
                        showClose: false
                    });
                    jQuery('.blocker').css('z-index', '2');
                } else {
                    jQuery("#cni-type-field").hide();
                    jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                    jQuery("#document-number-input").attr('placeholder', 'Numéro pièce identité...');
                    jQuery("#document-number-input").attr('placeholder', '__________');
                    jQuery("#document-number-input").mask('9999999999');
                }
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
            jQuery('#modalInfo').html(
                '<center> <div class="notification-box notification-box-info">\n\
                <div class="modal-header"><img src="{{ URL::asset('assets/images/sensibilisation-nni-illustration.jpg') }}" style="width: 100%"></div>\n\
                        </div><div class="modal-footer">\n\
                        <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
            );
            jQuery('#modalInfo').modal({
                escapeClose: false,
                clickClose: false,
                showClose: false
            });
            jQuery('.blocker').css('z-index','2');
        }
    });
    {{-- L'evenement "leaveStep" est utilise pour valider le formulaire --}}
    jQuery("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        {{-- Validation uniquement que quand le sens de l'etape est suivant --}}
        if (stepDirection === 'forward') {
            switch (currentStepIdx) {
                {{-- Step 1 --}}
                case 0:
                    first_name = document.querySelectorAll('[name="first-name"]');
                    last_name = document.querySelectorAll('[name="last-name"]');
                    spouse_name = jQuery(document.querySelectorAll('[name="spouse-name"]'));
                    birth_date = document.querySelectorAll('[name="birth-date"]');
                    country = jQuery(document.querySelectorAll('[name="country"]')).val();
                    birth_place = (country !== "Côte d’Ivoire") ? document.querySelectorAll('[name="birth-place-2"]') : document.querySelectorAll('[name="birth-place"]');
                    residence = document.querySelectorAll('[name="residence"]');
                    profession = document.querySelectorAll('[name="profession"]');
                    gender = document.querySelectorAll('[name="gender"]:checked');
                    email = jQuery(document.querySelectorAll('[name="email"]')).val();
                    {{-- gender --}}
                    if(!jQuery('#gender-input-male').is(':checked') && !jQuery('#gender-input-female').is(':checked')) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-venus-mars"></i><br/><br/><h3>Veuillez correctement renseigner votre genre SVP</h3></div>\n\
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
                    if (jQuery(gender).val().toUpperCase() === 'M') {
                        jQuery(spouse_name).val('');
                    }
                    {{-- first_name --}}
                    if(!jQuery(first_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner votre nom SVP</h3></div>\n\
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
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner votre/vos prénom(s) SVP</h3></div>\n\
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
                            <div class="modal-header"><i class="fa fa-2x fa-birthday-cake"></i><br/><br/><h3>Veuillez correctement renseigner votre date de naissance</h3></div>\n\
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
                            <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner votre lieu de naissance SVP</h3></div>\n\
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
                            <div class="modal-header"><i class="fa fa-2x fa-home"></i><br/><br/><h3>Veuillez correctement renseigner votre lieu de résidence SVP</h3></div>\n\
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
                            <div class="modal-header"><i class="fa fa-2x fa-briefcase"></i><br/><br/><h3>Veuillez correctement renseigner votre profession SVP</h3></div>\n\
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
                            if (jQuery('#new-format-card').is(':checked')) {
                                jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                                jQuery("#document-number-input").attr('placeholder', 'Numéro NNI...');
                                jQuery("#document-number-input").attr('placeholder', '___________');
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
                                jQuery('.blocker').css('z-index', '2');
                            } else {
                                jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                                jQuery("#document-number-input").attr('placeholder', 'Numéro pièce identité...');
                                jQuery("#document-number-input").attr('placeholder', '__________');
                                jQuery("#document-number-input").mask('9999999999');
                            }
                        } else if (jQuery("#doc-type").val() === "3") {
                            jQuery("#cni-type-field").hide();
                            jQuery("#document-number-label").html('Numéro NNI<span style="color: #d9534f">*</span> :');
                            jQuery("#document-number-input").attr('placeholder','Numéro NNI...');
                            jQuery("#document-number-input").attr('placeholder','___________');
                            jQuery("#document-number-input").mask('99999999999');
                            jQuery('#modalInfo').html(
                                '<center> <div class="notification-box notification-box-info">\n\
                                <div class="modal-header"><img src="{{ URL::asset('assets/images/nni-illustration.png') }}" style="width: 15em"> <br/><br/><h3>NB : Le numéro de NNI à renseigner se situe au verso de votre carte de résident.</h3></div>\n\
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
                    {{-- email --}}
                    if(email !== "" && !isEmail(email)) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-envelope"></i><br/><br/><h3>Veuillez correctement renseigner votre adresse mail SVP</h3></div>\n\
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
                    {{-- Declenchement la detection de la taille du document a charger --}}
                        pdf_doc = document.querySelectorAll('[name="pdf_doc"]');
                    $(pdf_doc).on('change', function() {
                        pdf_doc_size = this.files[0].size;
                    });
                    {{-- Declenchement la detection de la taille du selfie a charger --}}
                    selfie_img = document.querySelectorAll('[name="selfie_img"]');
                    $(selfie_img).on('change', function() {
                        selfie_img_size = this.files[0].size;
                    });
                    break;
                {{-- Step 2 --}}
                case 1:
                    doc_type = document.querySelectorAll('[name="doc-type"]');
                    document_number = document.querySelectorAll('[name="document-number"]');
                    document_expiry = document.querySelectorAll('[name="document-expiry"]');
                    {{-- doc_type --}}
                    if(!jQuery(doc_type).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>Veuillez sélectionner votre type de document justificatif</h3></div>\n\
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
                    if (jQuery("#doc-type").val() === "0") { {{-- Cas où l'utilisateur n'a aucun des documents de la liste --}}
                        jQuery("#cni-type-field").hide();
                        jQuery("#document-number-input").val('');
                        jQuery("#document-expiry-input").val('');
                        jQuery("#pdf-doc-input").val('');
                        jQuery("#pdf-doc-label").html('<i class="fad fa-file-pdf fa-3x mr10" style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em">' +
                            '</i><br/><span>Charger le document…</span>');
                        {{-- selfie_img --}}
                        if(!jQuery(selfie_img).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-portrait"></i><br/><br/><h3>Veuillez charger une photo selfie récente de vous</h3></div>\n\
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
                        {{-- selfie_img_size --}}
                        var selffSExt = new Array('Octets', 'Ko', 'Mo', 'Go');
                        selfSize = selfie_img_size; i=0;while(selfSize>900){selfSize/=1024;i++;}
                        if(pdf_doc_size >= 3145728) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-portrait"></i><br/><br/><h3>La taille de votre photo excède 3 Mo</h3>Taille actuelle du fichier : <b>'+((Math.round(selfSize*100)/100)+' '+selffSExt[i])+'</b></div>\n\
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
                        {{-- RECAP SANS PIECE --}}
                        jQuery('#recap-pdf-doc').text('Aucun document ONECI');
                        jQuery('#recap-selfie-img').text(jQuery(selfie_img).val().split('\\')[2]+' - '+((Math.round(selfSize*100)/100)+' '+selffSExt[i])+'');
                        jQuery('#recap-document-number').text('...');
                        jQuery('#recap-document-label').hide();
                    } else { {{-- Cas où l'utilisateur a selectionné un des documents de la liste --}}
                        {{-- document_number --}}
                        if(!jQuery(document_number).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-asterisk"></i><br/><br/><h3>Veuillez renseigner votre numéro de document SVP</h3></div>\n\
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
                        {{-- document_expiry --}}
                        var documentExpiryFormatted = new Date(jQuery(document_expiry).val());
                        var maxExpiryDate = new Date();
                        var minExpiryDate = new Date();
                        maxExpiryDate.setFullYear(maxExpiryDate.getFullYear()+20);
                        minExpiryDate.setFullYear(minExpiryDate.getFullYear()-5);
                        if(jQuery(document_expiry).val() === '' || (documentExpiryFormatted.getTime() < minExpiryDate.getTime() || documentExpiryFormatted.getTime() > maxExpiryDate.getTime()) ) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-calendar-day"></i><br/><br/><h3>Veuillez renseigner une date d\'expiration valide SVP</h3></div>\n\
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
                                <div class="modal-header"><i class="fa fa-2x fa-paperclip"></i><br/><br/><h3>Veuillez charger un document justificatif</h3></div>\n\
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
                        {{-- pdf_doc_size --}}
                        var fSExt = new Array('Octets', 'Ko', 'Mo', 'Go');
                        fSize = pdf_doc_size; i=0;while(fSize>900){fSize/=1024;i++;}
                        if(pdf_doc_size >= 1048576) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-paperclip"></i><br/><br/><h3>La taille de votre fichier excède 1 Mo</h3>Taille actuelle du fichier : <b>'+((Math.round(fSize*100)/100)+' '+fSExt[i])+'</b></div>\n\
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
                        {{-- selfie_img --}}
                        if(!jQuery(selfie_img).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-portrait"></i><br/><br/><h3>Veuillez charger une photo selfie récente de vous</h3></div>\n\
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
                        {{-- selfie_img_size --}}
                        var selffSExt = new Array('Octets', 'Ko', 'Mo', 'Go');
                        selfSize = selfie_img_size; i=0;while(selfSize>900){selfSize/=1024;i++;}
                        if(pdf_doc_size >= 3145728) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-portrait"></i><br/><br/><h3>La taille de votre photo excède 3 Mo</h3>Taille actuelle du fichier : <b>'+((Math.round(selfSize*100)/100)+' '+selffSExt[i])+'</b></div>\n\
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
                        {{-- RECAP AVEC PIECE --}}
                        jQuery('#recap-pdf-doc').text(jQuery(pdf_doc).val().split('\\')[2]+' ('+jQuery(doc_type).select2('data')[0].text+') - '+((Math.round(fSize*100)/100)+' '+fSExt[i])+'');
                        jQuery('#recap-selfie-img').text(jQuery(selfie_img).val().split('\\')[2]+' - '+((Math.round(selfSize*100)/100)+' '+selffSExt[i])+'');
                        jQuery('#recap-document-number').text(jQuery(document_number).val().toUpperCase() + ' (Expire le ' + jQuery(document_expiry).val() + ')');
                        jQuery('#recap-document-label').show();
                    }
                    {{-- RECAP --}}
                    var msisdn_list = "";
                    jQuery('#recap-msisdn').html(msisdn_list);
                    if(jQuery(spouse_name).val()) {
                        jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase() + ' epse ' + jQuery(spouse_name).val().toUpperCase());
                    } else {
                        jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase());
                    }
                    jQuery('#recap-last-name').text(jQuery(last_name).val().toUpperCase());
                    if (jQuery(gender).val().toUpperCase() === 'M') {
                        jQuery('#recap-gender').html('<i class="fa fa-mars"></i> &nbsp; Masculin');
                    } else if (jQuery(gender).val().toUpperCase() === 'F') {
                        jQuery('#recap-gender').html('<i class="fa fa-venus"></i> &nbsp; Feminin');
                    } else {
                        jQuery('#recap-gender').html('<i class="fa fa-venus-mars"></i> &nbsp; Indéfini');
                    }
                    jQuery('#recap-birth-date').text(jQuery(birth_date).val());
                    if(country !== "Côte d’Ivoire") {
                        jQuery('#recap-birth-place').text(jQuery(birth_place).val());
                    } else {
                        jQuery('#recap-birth-place').text(jQuery(birth_place).select2('data')[0].text);
                    }
                    jQuery('#recap-residence').text(jQuery(residence).val().toUpperCase());
                    jQuery('#recap-country').text(country.toUpperCase());
                    jQuery('#recap-profession').text(jQuery(profession).val().toUpperCase());
                    if (email === '') {
                        jQuery('#recap-email').text('...');
                    } else {
                        jQuery('#recap-email').html('<i class="fa fa-envelope"></i> &nbsp; ' + email);
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                {{-- Step 3 --}}
                case 2:
                    msisdn_length = document.querySelectorAll('[name="msisdn-length"]');
                    {{-- msisdn_length --}}
                    if(!jQuery(msisdn_length).val() || parseInt(jQuery(msisdn_length).val()) <= 0 || parseInt(jQuery(msisdn_length).val()) > 100) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-sim-card"></i><br/><br/><h3>Veuillez correctement renseigner le nombre de carte(s) SIM à acquérir en votre nom</h3></div>\n\
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
                    jQuery('#recap-msisdn-length').html(jQuery(msisdn_length).val().toUpperCase() + ' carte(s) SIM  &nbsp; <i class="fa fa-sim-card"></i>');
                    if (jQuery("#doc-type").val() === "0") { {{-- Cas où l'utilisateur n'a aucun des documents de la liste --}}
                        jQuery('#recap-prov-amount').html('&nbsp; <i class="fa fa-money-bill"></i> &nbsp; '+ jQuery(msisdn_length).val() + ' x ' + {{ env('CINETPAY_SERVICE_AMOUNT_TEMP') }} + ' FCFA = ' + (parseInt(jQuery(msisdn_length).val())*{{ env('CINETPAY_SERVICE_AMOUNT_TEMP') }}) + ' FCFA');
                        jQuery('#recap-prov-amount-label').show();
                        jQuery("#cptch-sbmt-btn").attr('class', "button");
                        jQuery("#cptch-sbmt-btn").html('<i class="fa fa-sim-card"></i> &nbsp; Soumettre votre pré-identification et Procéder au paiement (' + (parseInt(jQuery(msisdn_length).val())*{{ env('CINETPAY_SERVICE_AMOUNT_TEMP') }}) + ' FCFA)');
                    } else { {{-- Cas où l'utilisateur a selectionné un des documents de la liste --}}
                        jQuery('#recap-prov-amount').html('...');
                        jQuery('#recap-prov-amount-label').hide();
                        jQuery("#cptch-sbmt-btn").attr('class', "button");
                        jQuery("#cptch-sbmt-btn").html('<i class="fa fa-sim-card"></i> &nbsp; Soumettre votre pré-identification et Obtenir votre fiche après validation du document ONECI');
                    }
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