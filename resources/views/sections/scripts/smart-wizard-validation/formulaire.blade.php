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
    {{-- Variables --}}
    var isBusy = false,
        nni_data="",
        first_name = "", last_name = "", birth_date = "", mother_first_name = "", mother_last_name = "",
        decision_first_name = "", decision_last_name = "", decision_birth_date = "", decision_lieu_naissance = "",
        numero_decision = "", decision_date = "", lieu_delivrance = "", lieu_retrait = "",
        cni_number="", cni_doc="", cni_doc_size="", cni_fsize="", pdf_doc="", pdf_doc_size="", fSize="", nni="",
        email="";

    {{-- Declenchement la detection de la taille de la CNI a charger --}}
    $('#cni-doc-input').on('change', function () {
        cni_doc_size = this.files[0].size;
        {{-- console.log(cni_doc_size); --}}
    });
    {{-- Declenchement la detection de la taille du document a charger --}}
    $('#pdf-doc-input').on('change', function () {
        pdf_doc_size = this.files[0].size;
        {{-- console.log(pdf_doc_size); --}}
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
    {{-- Checker le NNI au remplissage de l'input ou au copier coller du NNI --}}
    jQuery("#nni-field").bind("paste", function(e){
        {{-- access the clipboard using the api --}}
        let pastedData = e.originalEvent.clipboardData.getData('text');
        if(jQuery("#nni-input").val().length >= 11 && (!isBusy)) {
            checkNNI();
        }
    }).keyup(function() {
        if(jQuery("#nni-input").val().length >= 11 && (!isBusy)) {
            checkNNI();
        } else {
            jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
        }
    })
    {{-- L'evenement "leaveStep" est utilise pour valider le formulaire --}}
    jQuery("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        {{-- Validation uniquement que quand le sens de l'etape est suivant --}}
        if (stepDirection === 'forward') {
            switch (currentStepIdx) {
                {{-- Step 1 --}}
                case 0:
                    nni = document.querySelectorAll('#nni-input');
                    if(jQuery('#possession-nni-oui').is(':checked')) {
                        {{-- check_nni --}}
                        if(!jQuery(nni).val()) {
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
                        {{-- Assign values and Disable All fields if NNI OK ".prop('disabled', true)" --}}
                        jQuery('#last-name-input').val(nni_data.LAST_NAME);
                        jQuery('#first-name-input').val(nni_data.FIRST_NAME);
                        jQuery('#birth-date-input').val(nni_data.BIRTH_DATE);
                        jQuery('#mother-last-name-input').val(nni_data.MOTHER_LAST_NAME);
                        jQuery('#mother-first-name-input').val(nni_data.MOTHER_FIRST_NAME);
                        jQuery("#npdl-container").hide();
                        {{-- Enable next button --}}
                    } else if(jQuery('#possession-nni-non').is(':checked')) {
                        {{-- Empty and Enable All fields ".prop('disabled', false)" --}}
                        jQuery('#last-name-input').val("");
                        jQuery('#first-name-input').val("");
                        jQuery('#birth-date-input').val("");
                        jQuery('#mother-last-name-input').val("");
                        jQuery('#mother-first-name-input').val("");
                        jQuery("#npdl-container").show();
                        {{-- Disable next button --}}
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                {{-- Step 2 --}}
                case 1:
                    first_name = document.querySelectorAll('[name="first-name"]');
                    last_name = document.querySelectorAll('[name="last-name"]');
                    birth_date = document.querySelectorAll('[name="birth-date"]');
                    mother_first_name = document.querySelectorAll('[name="mother-first-name"]');
                    mother_last_name = document.querySelectorAll('[name="mother-last-name"]');
                    decision_first_name = document.querySelectorAll('[name="decision-first-name"]');
                    decision_last_name = document.querySelectorAll('[name="decision-last-name"]');
                    decision_birth_date = document.querySelectorAll('[name="decision-birth-date"]');
                    decision_lieu_naissance = document.querySelectorAll('[name="decision-lieu-naissance"]');
                    numero_decision = document.querySelectorAll('[name="numero-decision"]');
                    decision_date = document.querySelectorAll('[name="decision-date"]');
                    lieu_delivrance = document.querySelectorAll('[name="lieu-delivrance"]');
                    lieu_retrait = document.querySelectorAll('[name="lieu-retrait"]');
                    {{-- email = jQuery(document.querySelectorAll('[name="email"]')).val(); --}}
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
                    {{-- mother_first_name --}}
                    if (!jQuery(mother_first_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner le/les prénom(s) de votre mère SVP</h3></div>\n\
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
                    {{-- mother_last_name --}}
                    if (!jQuery(mother_last_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner le nom de votre mère SVP</h3></div>\n\
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
                    {{-- decision_first_name --}}
                    if (!jQuery(decision_first_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner votre/vos prénom(s) sur la décision de justice SVP</h3></div>\n\
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
                    {{-- decision_last_name --}}
                    if (!jQuery(decision_last_name).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner votre nom sur la décision de justice SVP</h3></div>\n\
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
                    {{-- decision_birth_date --}}
                    var decisionBirthdateFormatted = new Date(jQuery(decision_birth_date).val());
                    var decisionMaxdate = new Date();
                    var decisionMindate = new Date();
                    decisionMaxdate.setFullYear(decisionMaxdate.getFullYear() - 10);
                    decisionMindate.setFullYear(decisionMindate.getFullYear() - 140);
                    if (!jQuery(decision_birth_date).val() || decisionBirthdateFormatted.getTime() < decisionMindate.getTime() || decisionBirthdateFormatted.getTime() > decisionMaxdate.getTime()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-birthday-cake"></i><br/><br/><h3>Veuillez correctement renseigner votre date de naissance sur la décision de justice</h3></div>\n\
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
                    {{-- decision_lieu_naissance --}}
                    if (!jQuery(decision_lieu_naissance).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-map-marker-alt"></i><br/><br/><h3>Veuillez correctement renseigner le lieu de naissance sur la décision de justice SVP</h3></div>\n\
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
                    {{-- lieu_retrait --}}
                    if (!jQuery(lieu_retrait).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-file-certificate"></i><br/><br/><h3>Veuillez correctement renseigner le lieu de retrait de votre certificat de conformité SVP</h3></div>\n\
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
                    {{-- numero_decision --}}
                    if (!jQuery(numero_decision).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-barcode"></i><br/><br/><h3>Veuillez correctement renseigner le numéro de la décision SVP</h3></div>\n\
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
                    {{-- decision_date --}}
                    var decisionDateFormatted = new Date(jQuery(decision_date).val());
                    var decisionDateMaxdate = new Date();
                    var decisionDateMindate = new Date();
                    decisionDateMaxdate.setFullYear(decisionDateMaxdate.getFullYear());
                    decisionDateMindate.setFullYear(decisionDateMindate.getFullYear() - 140);
                    if (!jQuery(decision_date).val() || decisionDateFormatted.getTime() < decisionDateMindate.getTime() || decisionDateFormatted.getTime() > decisionDateMaxdate.getTime()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-calendar-day"></i><br/><br/><h3>Veuillez correctement renseigner la date de la décision</h3></div>\n\
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
                    {{-- lieu_delivrance --}}
                    if (!jQuery(lieu_delivrance).val()) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-font-case"></i><br/><br/><h3>Veuillez correctement renseigner le lieu de délivrance SVP</h3></div>\n\
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
                    if(jQuery('#possession-nni-non').is(':checked')) {
                        jQuery('#cni-number-container').show();
                        {{--
                        jQuery('#cni-number-container').html('<br/><br/>\n\
                            <h2><i class="fa fa-id-card"></i> &nbsp; Pièce d\'identité :</h2>\n\
                            <div class="form-group column-last" id="cni-number-field">\n\
                                <label class="col-sm-2 control-label" id="cni-number-label">\n\
                                Numéro de la Carte Nationale d\'Identité<span style="color: #d9534f">*</span> :\n\
                                </label>\n\
                                <div class="col-sm-10">\n\
                                    <input type="text" id="cni-number-input" name="cni-number"\n\
                                           placeholder="___________" maxlength="11" required="required"\n\
                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>\n\
                                </div>\n\
                                <br/>\n\
                            </div>\n\
                            <div class="form-group" id="cni-doc-field">\n\
                                <div class="col-sm-10">\n\
                                    <div class="box">\n\
                                        <input type="file" name="pdf_doc" id="cni-doc-input"\n\
                                            class="inputfile" accept="application/pdf, image/jpeg, image/png"\n\
                                            style="display: none">\n\
                                        <label for="cni-doc-input" class="atcl-inv hoverable"\n\
                                            style="background-color: #bdbdbd6b;padding: 2em;border: 1px dashed black;border-radius: 1em; width: 20em;"><i\n\
                                            class="fad fa-id-card fa-3x mr10"\n\
                                            style="padding: 0.2em 0;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger la CNI…</span></label>\n\
                                    </div>\n\
                                </div><br/>\n\
                                <label for="cni-doc-input" class="col-sm-2 control-label">\n\
                                    Le document à charger doit être un scan <b>recto verso</b> de la Carte Nationale d\'Identité <b>sur la même face</b> au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,\n\
                                    avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.\n\
                                </label>\n\
                                <br/>\n\
                            </div>');
                            --}}
                    } else if(jQuery('#possession-nni-oui').is(':checked')) {
                        jQuery('#cni-number-container').hide();
                        {{--
                        jQuery('#cni-number-container').html('');
                        --}}
                    }
                    jQuery('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    break;
                {{-- Step 3 --}}
                case 2:
                    cni_number = document.querySelectorAll('[name="cni-number"]');
                    cni_doc = document.querySelectorAll('#cni-doc-input');
                    pdf_doc = document.querySelectorAll('#pdf-doc-input');

                    {{-- filtre_cas_non_nni --}}
                    if(jQuery('#possession-nni-non').is(':checked')) {
                        {{-- cni_number --}}
                        if (!jQuery(cni_number).val()) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-asterisk"></i><br/><br/><h3>Veuillez renseigner votre numéro de CNI SVP</h3></div>\n\
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
                        {{-- cni_doc --}}
                        if (!escape(jQuery(cni_doc).val())) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>Veuillez charger votre Carte Nationale d\'Identité</h3></div>\n\
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
                        {{--cni_doc_size --}}
                        var cnifSExt = ["Octets", "Ko", "Mo", "Go"];
                        cni_fsize = cni_doc_size;
                        var i = 0;
                        while (cni_fsize > 900) {
                            cni_fsize /= 1024;
                            i++;
                        }
                        {{-- console.log((Math.round(fSize * 100) / 100) + ' ' + fSExt[i]); --}}
                        if (cni_doc_size >= 1048576) {
                            jQuery('#modalError').html(
                                '<center> <div class="notification-box notification-box-error">\n\
                                <div class="modal-header"><i class="fa fa-2x fa-id-card"></i><br/><br/><h3>La taille de votre fichier de CNI excède 1 Mo</h3>Taille actuelle du fichier : <b>' + ((Math.round(cni_fsize * 100) / 100) + ' ' + cnifSExt[i]) + '</b></div>\n\
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
                    }

                    {{-- pdf_doc --}}
                    if (!escape(jQuery(pdf_doc).val())) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-balance-scale"></i><br/><br/><h3>Veuillez charger la décision judiciaire</h3></div>\n\
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
                    {{-- console.log((Math.round(fSize * 100) / 100) + ' ' + fSExt[i]); --}}
                    if (pdf_doc_size >= 1048576) {
                        jQuery('#modalError').html(
                            '<center> <div class="notification-box notification-box-error">\n\
                            <div class="modal-header"><i class="fa fa-2x fa-balance-scale"></i><br/><br/><h3>La taille de votre fichier de décision judiciaire excède 1 Mo</h3>Taille actuelle du fichier : <b>' + ((Math.round(fSize * 100) / 100) + ' ' + fSExt[i]) + '</b></div>\n\
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
                    cni_number = document.querySelectorAll('[name="cni-number"]');
                    jQuery('#recap-last-name').text(jQuery(last_name).val().toUpperCase());
                    jQuery('#recap-first-name').text(jQuery(first_name).val().toUpperCase());
                    jQuery('#recap-birth-date').text(jQuery(birth_date).val());
                    jQuery('#recap-mother-last-name').text(jQuery(mother_last_name).val().toUpperCase());
                    jQuery('#recap-mother-first-name').text(jQuery(mother_first_name).val().toUpperCase());
                    jQuery('#recap-decision-last-name').text(jQuery(decision_last_name).val().toUpperCase());
                    jQuery('#recap-decision-first-name').text(jQuery(decision_first_name).val().toUpperCase());
                    jQuery('#recap-decision-birth-date').text(jQuery(decision_birth_date).val().toUpperCase());
                    jQuery('#recap-decision-birth-place').text(jQuery(decision_lieu_naissance).val().toUpperCase());
                    jQuery('#recap-numero-decision').text(jQuery(numero_decision).val().toUpperCase());
                    jQuery('#recap-decision-date').text(jQuery(decision_date).val().toUpperCase());
                    jQuery('#recap-lieu-delivrance').text(jQuery(lieu_delivrance).select2('data')[0].text);
                    jQuery('#recap-lieu-retrait').text(jQuery(lieu_retrait).select2('data')[0].text);
                    if(jQuery('#possession-nni-non').is(':checked')) {
                        jQuery('#recap-nni').text("");
                        jQuery('#recap-nni-container').hide();
                        jQuery('#recap-cni').text(jQuery(cni_number).val());
                        jQuery('#recap-cni-container').show();
                        jQuery('#recap-cni-doc').text(jQuery(cni_doc).val().split("\\")[2] + " - " + ((Math.round(cni_fsize * 100) / 100) + " " + cnifSExt[i]));
                        jQuery('#recap-cni-doc-container').show();
                    } else if(jQuery('#possession-nni-oui').is(':checked')) {
                        jQuery('#recap-nni').text(jQuery(nni).val());
                        jQuery('#recap-nni-container').show();
                        jQuery('#recap-cni').text("");
                        jQuery('#recap-cni-container').hide();
                        jQuery('#recap-cni-doc-container').hide();
                        jQuery('#recap-cni-doc').text("");
                    }
                    jQuery('#recap-pdf-doc').text(jQuery(pdf_doc).val().split("\\")[2] + " - " + ((Math.round(fSize * 100) / 100) + " " + fSExt[i]));
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
        } else if (stepDirection === 'backward') {
            switch (currentStepIdx) {
                {{-- Back to Step 1 --}}
                case 1:
                    if(jQuery('#possession-nni-oui').is(':checked')) {
                        jQuery("#nni-field").show();
                        jQuery(".sw-btn-next").addClass("disabled").prop("disabled", true);
                        if(nni_data.FIRST_NAME !== undefined) {
                            jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
                        }
                        jQuery("#npdl-container").hide();
                        {{-- $('button.sw-btn-next').hasClass('disabled'); --}}
                    } else if(jQuery('#possession-nni-non').is(':checked')) {
                        jQuery("#nni-input").val("");
                        jQuery("#nni-field").hide();
                        jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
                        jQuery("#npdl-container").show();
                    }
                    break;
            }
        }
    });
</script>
