<script>
    {{--
    |--------------------------------------------------------------------------
    | Validation étapes formulaire
    |--------------------------------------------------------------------------
    --}}

    {{-- Variables --}}
    var isBusy = false,
        nni_data="", gender="", nickname="", last_name = "", first_name = "", spouse_name = "",
        birth_date = "", birth_place = "", birth_country = "", nationality = "",
        civil_status = "", number_of_children = "", other_activities = "", city = "",
        town = "", street = "", address = "", workplace = "", msisdn = "",
        attached_doc_type="", attached_doc_number="", attached_doc="", attached_doc_expiry_date="", attached_doc_size="", attached_doc_fsize="";

    {{-- Fonction pour valider l'adresse email --}}
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    {{-- Fonction Ajax pour checker le NNI --}}
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
                nni_data = "";
                jQuery('#nni-check-spinner').hide();
                jQuery('#nni-check-result').html('<i class="fa fa-times" style="color: #f44336"></i>');
                jQuery('#nni-check-result').show();
            }
        });
        @endif
    }

    {{-- Declenchement la detection de la taille du document a charger --}}
    $('#attached-doc-input').on('change', function () {
        attached_doc_size = this.files[0].size;
    });

    {{-- Afficher masquer le champ nni selon que l'utilisateur en possède un ou non --}}
    jQuery('input[name="possession_nni"]').click(function() {
        if(jQuery('#possession-nni-oui').is(':checked')) {
            nni_data = "";
            jQuery("#nni-field").show();
            jQuery('#nni-check-result').hide();
            jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
            jQuery("#npdl-container").hide();
            {{-- $('button.sw-btn-next').hasClass('disabled'); --}}
        } else if(jQuery('#possession-nni-non').is(':checked')) {
            nni_data = "";
            jQuery("#nni-input").val("");
            jQuery("#nni-field").hide();
            jQuery('#nni-check-result').hide();
            jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
            jQuery("#npdl-container").show();
        }
    });

    {{-- Afficher masquer le champ nni selon que l'utilisateur en possède un ou non --}}
    jQuery('input[name="gender"]').click(function() {
        if(jQuery('#gender-male-input').is(':checked')) {
            spouse_name = "";
            jQuery("#spouse-name-input").val("");
            jQuery("#spouse-name-field").hide();
            jQuery("#last-name-field").removeClass("one-third");
            jQuery("#first-name-field").removeClass("one-third");
            jQuery("#last-name-field").addClass("one-half");
            jQuery("#first-name-field").addClass("one-half");
        } else if(jQuery('#gender-female-input').is(':checked')) {
            spouse_name = "";
            jQuery("#spouse-name-input").val("");
            jQuery("#spouse-name-field").show();
            jQuery("#last-name-field").removeClass("one-half");
            jQuery("#first-name-field").removeClass("one-half");
            jQuery("#last-name-field").addClass("one-third");
            jQuery("#first-name-field").addClass("one-third");
        }
    });


    {{-- L'evenement "leaveStep" est utilise pour valider le formulaire --}}
    jQuery("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        {{-- Validation uniquement que quand le sens de l'etape est suivant --}}
        if (stepDirection === 'forward') {
            switch (currentStepIdx) {
                {{-- Step 1 --}}
                case 0:
                    @if(!session()->has('customer'))
                        gender = document.querySelectorAll('[name="gender"]:checked');
                        nickname = document.querySelectorAll('[name="nickname"]');
                        last_name = document.querySelectorAll('[name="last-name"]');
                        first_name = document.querySelectorAll('[name="first-name"]');
                        spouse_name = document.querySelectorAll('[name="spouse-name"]');
                        birth_date = document.querySelectorAll('[name="birth-date"]');
                        birth_place = document.querySelectorAll('[name="birth-place"]');
                        birth_country = document.querySelectorAll('[name="birth-country"]');
                        nationality = document.querySelectorAll('[name="nationality"]');
                        civil_status = document.querySelectorAll('[name="civil-status"]');
                        number_of_children = document.querySelectorAll('[name="number-of-children"]');
                        other_activities = document.querySelectorAll('[name="other-activities"]');
                        city = document.querySelectorAll('[name="city"]');
                        town = document.querySelectorAll('[name="town"]');
                        street = document.querySelectorAll('[name="street"]');
                        address = document.querySelectorAll('[name="address"]');
                        workplace = document.querySelectorAll('[name="workplace"]');
                        msisdn = document.querySelectorAll('[name="msisdn"]');

                        {{-- gender --}}
                        if(!jQuery('#gender-male-input').is(':checked') && !jQuery('#gender-female-input').is(':checked')) {
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
                        {{-- nickname --}}
                        if (!jQuery(nickname).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner votre pseudonyme SVP</h3></div>\n\
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
                        {{-- first_name --}}
                        if (!jQuery(first_name).val()) {
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
                        var birthDateFormatted = new Date(jQuery(birth_date).val());
                        var minBirthDate = new Date();
                        var maxBirthDate = new Date();
                        minBirthDate.setFullYear(minBirthDate.getFullYear() - 140);
                        maxBirthDate.setFullYear(maxBirthDate.getFullYear() - 10);
                        if (!jQuery(birth_date).val() || birthDateFormatted.getTime() < minBirthDate.getTime() || birthDateFormatted.getTime() > maxBirthDate.getTime()) {
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
                        {{-- birth_country --}}
                        if (!jQuery(birth_country).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner le pays de naissance SVP</h3></div>\n\
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
                        {{-- nationality --}}
                        if (!jQuery(nationality).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-globe-africa"></i><br/><br/><h3>Veuillez correctement renseigner votre nationalité SVP</h3></div>\n\
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
                        {{-- civil_status --}}
                        if (!jQuery(civil_status).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-rings-wedding"></i><br/><br/><h3>Veuillez correctement renseigner votre situation matrimoniale SVP</h3></div>\n\
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
                        {{-- number_of_children --}}
                        if (!jQuery(number_of_children).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-baby"></i><br/><br/><h3>Veuillez correctement renseigner le nombre de vos enfants SVP</h3></div>\n\
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
                        {{-- city --}}
                        if (!jQuery(city).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner votre ville de résidence SVP</h3></div>\n\
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
                        {{-- town --}}
                        if (!jQuery(town).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner votre commune de résidence SVP</h3></div>\n\
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
                        {{-- street --}}
                        if (!jQuery(street).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner votre quartier de résidence SVP</h3></div>\n\
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
                        {{-- workplace --}}
                        if (!jQuery(workplace).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner votre lieu de travail SVP</h3></div>\n\
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
                        {{-- msisdn --}}
                        if (!jQuery(msisdn).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-sim-card"></i><br/><br/><h3>Veuillez renseigner votre numéro de téléphone SVP</h3></div>\n\
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
                        } else if (jQuery(msisdn).val().length !== 14 ||
                            (jQuery(msisdn).val().length === 14 && jQuery(msisdn).val().substring(0, 2) !== "01" && jQuery(msisdn).val().substring(0, 2) !== "05" && jQuery(msisdn).val().substring(0, 2) !== "07")) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-sim-card"></i><br/><br/><h3>Veuillez renseigner un numéro de téléphone valide SVP</h3></div>\n\
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
                    @endif

                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                {{-- Step 2 --}}
                case 1:
                    attached_doc_type = document.querySelectorAll('[name="attached-doc-type"]');
                    attached_doc_number = document.querySelectorAll('[name="attached-doc-number"]');
                    attached_doc_expiry_date = document.querySelectorAll('[name="attached-doc-expiry-date"]');
                    attached_doc = document.querySelectorAll('#attached-doc-input');
                    {{-- attached_doc_type --}}
                    if (!jQuery(attached_doc_type).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>Veuillez correctement renseigner votre type de document SVP</h3></div>\n\
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
                    {{-- attached_doc_number --}}
                    if (!jQuery(attached_doc_number).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-hashtag"></i><br/><br/><h3>Veuillez correctement renseigner le numéro de votre titre d\'identité SVP</h3></div>\n\
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
                    {{-- attached_doc_expiry_date --}}
                    var expiryDateFormatted = new Date(jQuery(attached_doc_expiry_date).val());
                    var minExpiryDate = new Date();
                    var maxExpiryDate = new Date();
                    minExpiryDate.setFullYear(minExpiryDate.getFullYear());
                    maxExpiryDate.setFullYear(maxExpiryDate.getFullYear() + 20);
                    if (!jQuery(attached_doc_expiry_date).val() || expiryDateFormatted.getTime() < minExpiryDate.getTime() || expiryDateFormatted.getTime() > maxExpiryDate.getTime()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-calendar-exclamation"></i><br/><br/><h3>La date d\'expiration du titre d\'identité est échue ou invalide</h3></div>\n\
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
                    {{-- attached_doc --}}
                    if (!escape(jQuery(attached_doc).val())) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>Veuillez charger votre titre d\'identité SVP</h3></div>\n\
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
                    {{-- attached_doc_fsize --}}
                    var fSExt = ["Octets", "Ko", "Mo", "Go"];
                    attached_doc_fsize = attached_doc_size;
                    let i = 0;
                    while (attached_doc_fsize > 900) {
                        attached_doc_fsize /= 1024;
                        i++;
                    }
                    if (attached_doc_size >= 1048576) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-balance-scale"></i><br/><br/><h3>La taille de votre fichier de décision judiciaire excède 1 Mo</h3>Taille actuelle du fichier : <b>' + ((Math.round(attached_doc_fsize * 100) / 100) + ' ' + fSExt[i]) + '</b></div>\n\
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
                    {{-- RECAP --}}
                    attached_doc_number = document.querySelectorAll('[name="attached-doc-number"]');
                    jQuery('#recap-nickname').text(jQuery(nickname).val().toUpperCase());
                    jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase());
                    if (!jQuery(spouse_name).val()) {
                        jQuery('#recap-last-name').text(jQuery(last_name).val().toUpperCase());
                    } else {
                        jQuery('#recap-last-name').text(jQuery(last_name).val().toUpperCase()+" epse "+jQuery(spouse_name).val().toUpperCase());
                    }
                    let gender_selected = (jQuery(gender).val().toUpperCase() === "M") ? "Masculin" : "Féminin";
                    jQuery('#recap-gender').text(gender_selected.toUpperCase());
                    jQuery('#recap-birth-date').text(formatDate(jQuery(birth_date).val()));
                    jQuery('#recap-birth-place').text(jQuery(birth_place).val().toUpperCase());
                    jQuery('#recap-birth-country').text(jQuery(birth_country).val().toUpperCase());
                    jQuery('#recap-nationality').text(jQuery(nationality).val().toUpperCase());
                    jQuery('#recap-civil-status').text(jQuery(civil_status).select2('data')[0].text);
                    jQuery('#recap-number-of-children').text(jQuery(number_of_children).val().toUpperCase());
                    jQuery('#recap-other-activities').text(jQuery(other_activities).val().toUpperCase());
                    jQuery('#recap-city').text(jQuery(city).val().toUpperCase());
                    jQuery('#recap-town').text(jQuery(town).val().toUpperCase());
                    jQuery('#recap-street').text(jQuery(street).val().toUpperCase());
                    jQuery('#recap-address').text(jQuery(address).val().toUpperCase());
                    jQuery('#recap-workplace').text(jQuery(workplace).val().toUpperCase());
                    jQuery('#recap-msisdn').text(jQuery(msisdn).val());
                    jQuery('#recap-attached-doc').text(jQuery(attached_doc).val().split("\\")[2] + " - " + ((Math.round(attached_doc_fsize * 100) / 100) + " " + fSExt[i]) + ' (' + jQuery(attached_doc_type).select2('data')[0].text + ')');
                    jQuery('#recap-attached-doc-number').text(jQuery(attached_doc_number).val().toUpperCase() + ' (Expire le ' + formatDate(jQuery(attached_doc_expiry_date).val()) + ')');
                    {{--
                    if (email === '') {
                        jQuery('#recap-email').text('...');
                    } else {
                        jQuery('#recap-email').html('<i class="fa fa-envelope"></i> &nbsp; ' + email);
                    }
                    --}}
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
        }
    });
</script>
