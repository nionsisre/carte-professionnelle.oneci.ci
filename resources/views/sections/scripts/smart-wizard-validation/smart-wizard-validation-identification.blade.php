<script>
    {{--
    |--------------------------------------------------------------------------
    | Validation étapes formulaire
    |--------------------------------------------------------------------------
    --}}

    {{-- Fonction pour valider l'adresse email --}}
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    {{-- Variables --}}
    var isBusy = false, nni_data="", msisdn="", telco="", first_name="", last_name="", birth_date="", birth_place="", residence="", profession="", doc_type="", pdf_doc="", pdf_doc_size="", fSize="", selfie_img="", selfie_img_size="", selfie_img_txt="", selfSize="", spouse_name="", country="", email="", gender="", document_number="", document_expiry="";
    {{-- Afficher masquer le champ nni selon que l'utilisateur en possède un ou non --}}
    jQuery('input[name="possession_nni"]').click(function() {
        if(jQuery('#possession-nni-oui').is(':checked')) {
            jQuery("#nni-field").show();
            jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
            {{-- $('button.sw-btn-next').hasClass('disabled'); --}}
        } else if(jQuery('#possession-nni-non').is(':checked')) {
            jQuery("#nni-input").val("");
            jQuery("#nni-field").hide();
            jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
        }
    });
    function checkNNI(){
        @if(config('services.verifapi.enabled'))
        let nni = jQuery("#nni-input").val();
        let url = '{{ route('verifapi.nni') }}';
        let cli = "{{ url()->current() }}";
        jQuery('#nni-check-spinner').show();
        jQuery('#nni-check-result').hide();
        $.ajax({
            url: url,
            data: {
                '_token': "{{ csrf_token() }}",
                cli: cli,
                nni: nni,
            }, beforeSend: function(res) {
                isBusy = true;
                jQuery('#nni-check-spinner').show();
                jQuery('#nni-check-result').hide();
                jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
            }, success: function(res) {
                isBusy = false;
                jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
                jQuery('#nni-check-spinner').hide();
                jQuery('#nni-check-result').html('<i class="fa fa-check" style="color: #4caf50"></i>');
                jQuery('#nni-check-result').show();
                nni_data = res.data;
                return true;
            }, error: function(xhr) {
                isBusy = false;
                jQuery('#nni-check-spinner').hide();
                jQuery('#nni-check-result').html('<i class="fa fa-times" style="color: #f44336"></i>');
                jQuery('#nni-check-result').show();
            }
        });
        @endif
    }
    jQuery("#nni-field").bind("paste", function(e){
        // access the clipboard using the api
        let pastedData = e.originalEvent.clipboardData.getData('text');
        if(jQuery("#nni-input").val().length >= 11 && (!isBusy)) {
            checkNNI();
        }
    }).keyup(function() {
        if(jQuery("#nni-input").val().length >= 11 && (!isBusy)) {
            checkNNI();
            jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
        } else {
            jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
        }
    })
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
            jQuery("#document-number-input").unmask().attr('maxlength', 20);
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
                    if(jQuery('#possession-nni-oui').is(':checked')) {
                        {{-- check_nni --}}
                        if(!jQuery('#nni-input').val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-barcode"></i><br/><br/><h3>Veuillez correctement renseigner votre numéro NNI SVP</h3></div>\n\
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
                        {{-- Assign values and Disable All fields if NNI OK --}}
                        jQuery('#last-name-input').val(nni_data.LAST_NAME).prop('disabled', true);
                        jQuery('#first-name-input').val(nni_data.FIRST_NAME).prop('disabled', true);
                        jQuery('#birth-date-input').val(nni_data.BIRTH_DATE).prop('disabled', true);
                        jQuery('#mother-last-name-input').val(nni_data.MOTHER_LAST_NAME).prop('disabled', true);
                        jQuery('#mother-first-name-input').val(nni_data.MOTHER_FIRST_NAME).prop('disabled', true);
                    } else if(jQuery('#possession-nni-non').is(':checked')) {
                        {{-- Empty and Enable All fields --}}
                        jQuery('#last-name-input').val("").prop('disabled', false);
                        jQuery('#first-name-input').val("").prop('disabled', false);
                        jQuery('#birth-date-input').val("").prop('disabled', false);
                        jQuery('#mother-last-name-input').val("").prop('disabled', false);
                        jQuery('#mother-first-name-input').val("").prop('disabled', false);
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
                    break;
                {{-- Step 2 --}}
                case 1:
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
                    if (!jQuery('#gender-input-male').is(':checked') && !jQuery('#gender-input-female').is(':checked')) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    if (jQuery(gender).val().toUpperCase() === 'M') {
                        jQuery(spouse_name).val('');
                    }
                    {{-- first_name --}}
                    if (!jQuery(first_name).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- last_name --}}
                    if (!jQuery(last_name).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                {{-- birth_date --}}
                    var birthdateFormatted = new Date(jQuery(birth_date).val());
                    var maxdate = new Date();
                    var mindate = new Date();
                    maxdate.setFullYear(maxdate.getFullYear() - 10);
                    mindate.setFullYear(mindate.getFullYear() - 140);
                    if (!jQuery(birth_date).val() || birthdateFormatted.getTime() < mindate.getTime() || birthdateFormatted.getTime() > maxdate.getTime()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- birth_place --}}
                    if (!jQuery(birth_place).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- residence --}}
                    if (!jQuery(residence).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- profession --}}
                    if (!jQuery(profession).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    if (country === "Côte d’Ivoire") {
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
                                jQuery("#document-number-input").unmask().attr('maxlength', 20);
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
                            jQuery("#document-number-input").unmask().attr('maxlength', 20);
                        }
                    } else {
                        jQuery("#cni-type-field").hide();
                        jQuery("#document-number-label").html('Numéro de la pièce d\'identité<span style="color: #d9534f">*</span> :');
                        jQuery("#document-number-input").attr('placeholder', 'Numéro pièce identité...');
                        jQuery("#document-number-input").attr('placeholder', '__________');
                        jQuery("#document-number-input").unmask().attr('maxlength', 20);
                    }
                    {{-- email --}}
                    if (email !== "" && !isEmail(email)) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    {{-- Declenchement la detection de la taille du document a charger --}}
                        pdf_doc = document.querySelectorAll('[name="pdf_doc"]');
                    $(pdf_doc).on('change', function () {
                        pdf_doc_size = this.files[0].size;
                    });
                    {{-- Declenchement la detection de la taille du selfie a charger --}}
                        selfie_img = document.querySelectorAll('[name="selfie_img"]');
                    $(selfie_img).on('change', function () {
                        selfie_img_size = this.files[0].size;
                    });
                    break;
                {{-- Step 3 --}}
                case 2:
                    doc_type = document.querySelectorAll('[name="doc-type"]');
                    document_number = document.querySelectorAll('[name="document-number"]');
                    document_expiry = document.querySelectorAll('[name="document-expiry"]');
                    selfie_img_txt = document.querySelectorAll('[name="selfie_img_txt"]');
                    {{-- doc_type --}}
                    if (!jQuery(doc_type).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>Veuillez selectionner votre type de document justificatif</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- document_number --}}
                    if (!jQuery(document_number).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- selfie_img_txt --}}
                    if (!jQuery(selfie_img_txt).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-portrait"></i><br/><br/><h3>Veuillez capturer une photo récente de vous pour continuer</h3></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                {{-- document_expiry --}}
                    var documentExpiryFormatted = new Date(jQuery(document_expiry).val());
                    var maxExpiryDate = new Date();
                    var minExpiryDate = new Date();
                    maxExpiryDate.setFullYear(maxExpiryDate.getFullYear() + 20);
                    minExpiryDate.setFullYear(minExpiryDate.getFullYear() - 5);
                    if (jQuery(document_expiry).val() === '' || (documentExpiryFormatted.getTime() < minExpiryDate.getTime() || documentExpiryFormatted.getTime() > maxExpiryDate.getTime())) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                    {{-- pdf_doc --}}
                    if (!jQuery(pdf_doc).val()) {
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
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                {{-- pdf_doc_size --}}
                    var fSExt = ["Octets", "Ko", "Mo", "Go"];
                    fSize = pdf_doc_size;
                    i = 0;
                    while (fSize > 900) {
                        fSize /= 1024;
                        i++;
                    }
                    console.log((Math.round(fSize * 100) / 100) + ' ' + fSExt[i]);
                    if (pdf_doc_size >= 1048576) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-paperclip"></i><br/><br/><h3>La taille de votre fichier excède 1 Mo</h3>Taille actuelle du fichier : <b>' + ((Math.round(fSize * 100) / 100) + ' ' + fSExt[i]) + '</b></div>\n\
                            </div><div class="modal-footer">\n\
                            <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                        );
                        jQuery('#modalError').modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false
                        });
                        jQuery('.blocker').css('z-index', '2');
                        jQuery('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                        return false;
                    }
                {{-- selfie_img --}}
                {{-- if(!jQuery(selfie_img).val()) {
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
                } --}}
                {{-- selfie_img_size --}}
                {{-- var selffSExt = ["Octets", "Ko", "Mo", "Go"];
                selfSize = selfie_img_size; i=0;while(selfSize>900){selfSize/=1024;i++;}
                if(selfie_img_size >= 3145728) {
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
                } --}}
                {{-- RECAP --}}
                    var msisdn_list = "";
                    for (let i = 0; i < msisdn.length; i++) {
                        msisdn_list += '<i class="fa fa-sim-card"></i> &nbsp; ' + jQuery(msisdn[i]).val() + ' (' + jQuery(telco[i]).select2('data')[0].text + ')<br/>';
                    }
                    jQuery('#recap-msisdn').html(msisdn_list);
                    if (jQuery(spouse_name).val()) {
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
                    if (country !== "Côte d’Ivoire") {
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
                    jQuery('#recap-pdf-doc').text(jQuery(pdf_doc).val().split("\\")[2] + " (" + jQuery(doc_type).select2('data')[0].text + ") - " + ((Math.round(fSize * 100) / 100) + " " + fSExt[i]));
                    {{--jQuery('#recap-selfie-img').text(jQuery(selfie_img).val().split("\\")[2]+" - "+((Math.round(selfSize*100)/100)+" "+selffSExt[i]));--}}
                    jQuery('#recap-selfie-img').text(jQuery(first_name).val().toLowerCase().replace(/'/g, "") + ".jpg");
                    jQuery('#recap-document-number').text(jQuery(document_number).val().toUpperCase() + ' (Expire le ' + jQuery(document_expiry).val() + ')');
                    if (jQuery("#agreement-input").is(':checked')) {
                        jQuery("#cptch-sbmt-btn").show();
                    } else {
                        jQuery("#cptch-sbmt-btn").hide();
                    }
                    jQuery("#agreement-input").change(function () {
                        if (this.checked) {
                            jQuery("#cptch-sbmt-btn").show();
                        } else {
                            jQuery("#cptch-sbmt-btn").hide();
                        }
                    });
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
            }
        } else if (stepDirection === 'backward') {
            switch (currentStepIdx) {
                {{-- Back to Step 1 --}}
                case 1:
                    if(jQuery('#possession-nni-oui').is(':checked')) {
                        jQuery("#nni-field").show();
                        jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
                        {{-- $('button.sw-btn-next').hasClass('disabled'); --}}
                    } else if(jQuery('#possession-nni-non').is(':checked')) {
                        jQuery("#nni-input").val("");
                        jQuery("#nni-field").hide();
                        jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
                    }
                    break;
            }
        }
    });
</script>
