<script src='https://www.google.com/recaptcha/api.js?render=6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq'></script>
<script src="{{ URL::asset('assets/js/select2.min.js') }}" type='text/javascript'></script>
<script src="{{ URL::asset('assets/js/smart-wizard/jquery.smartWizard.min.js') }}"></script>
<script>
    grecaptcha.ready(function () {
        /* do request for recaptcha token */
        /* response is promise with passed token */
        grecaptcha.execute('6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq', {action: 'validate_captcha'})
            .then(function (token) {
                /* add token value to form */
                document.getElementById('g-recaptcha-response').value = token;
            });
    });

    jQuery(".msisdn").mask('99 99 99 99 99');
    jQuery("#birth-place-input").select2();

    jQuery('#smartwizard').smartWizard({
        selected: 0, /* Initial selected step, 0 = first step*/
        theme: 'arrows', /* theme for the wizard, related css need to include for other than default theme*/
        justified: true, /* Nav menu justification. true/false*/
        autoAdjustHeight: false, /* Automatically adjust content height*/
        backButtonSupport: true, /* Enable the back button support*/
        enableUrlHash: true, /* Enable selection of the step based on url hash*/
        transition: {
            animation: 'none', /* Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)*/
            speed: '400', /* Animation speed. Not used if animation is 'css'*/
            easing: '', /* Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'*/
            prefixCss: '', /* Only used if animation is 'css'. Animation CSS prefix*/
            fwdShowCss: '', /* Only used if animation is 'css'. Step show Animation CSS on forward direction*/
            fwdHideCss: '', /* Only used if animation is 'css'. Step hide Animation CSS on forward direction*/
            bckShowCss: '', /* Only used if animation is 'css'. Step show Animation CSS on backward direction*/
            bckHideCss: '', /* Only used if animation is 'css'. Step hide Animation CSS on backward direction*/
        },
        toolbar: {
            position: 'bottom', /* none|top|bottom|both*/
            showNextButton: true, /* show/hide a Next button*/
            showPreviousButton: true, /* show/hide a Previous button*/
            extraHtml: '' /* Extra html to show on toolbar*/
        },
        anchor: {
            enableNavigation: true, /* Enable/Disable anchor navigation*/
            enableNavigationAlways: false, /* Activates all anchors clickable always*/
            enableDoneState: true, /* Add done state on visited steps*/
            markPreviousStepsAsDone: true, /* When a step selected by url hash, all previous steps are marked done*/
            unDoneOnBackNavigation: false, /* While navigate back, done state will be cleared*/
            enableDoneStateNavigation: true /* Enable/Disable the done state navigation*/
        },
        keyboard: {
            keyNavigation: true, /* Enable/Disable keyboard navigation(left and right keys are used if enabled)*/
            keyLeft: [37], /* Left key code*/
            keyRight: [39] /* Right key code*/
        },
        lang: { /* Language variables for button*/
            next: 'Suivant >',
            previous: '< Précédent'
        },
        disabledSteps: [], /* Array Steps disabled*/
        errorSteps: [], /* Array Steps error*/
        warningSteps: [], /* Array Steps warning*/
        hiddenSteps: [], /* Hidden steps*/
        getContent: null /* Callback function for content loading*/
    });

    jQuery('.inputfile').each(function () {
        var $input = jQuery(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });

        /* Firefox bug fix */
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });
    });

    var max_msisdn = 10;
    var idx_msisdn = 1;
    $("#add-msisdn").click(function () {
        if(idx_msisdn < max_msisdn) {
            $("#rm-msisdn").remove();
            var html = '';
            html += '<br/>\n\
                    <div class="container clearfix" style="background-color: #ccc; padding: 2em 2em">\n\
                        <div class="three-fourths">\n\
                            <div class="form-group one-half column-last" id="telco-'+(idx_exams+1)+'">\n\
                                <label class="col-sm-2 control-label">\n\
                                    Opérateur téléphonique<span style="color: #d9534f">*</span> :\n\
                                </label>\n\
                                <span style="display: none" id="err-toast"></span>\n\
                                <div class="col-sm-10">\n\
                                    <select class="form-control good-select" id="telco-input" name="telco" placeholder="Lien de parenté" required="required"\n\
                                            style="width: 11em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">\n\
                                        <option value="1">Orange CI</option>\n\
                                        <option value="2">MTN CI</option>\n\
                                        <option value="3">Moov Africa</option>\n\
                                    </select>\n\
                                </div>\n\
                            </div>\n\
                            <div class="form-group one-half column-last" id="msisdn-field">\n\
                                <div class="col-sm-12">\n\
                                    <label class="col-sm-2 control-label">\n\
                                        Numéro de téléphone<span style="color: #d9534f">*</span> :\n\
                                    </label>\n\
                                    <span style="display: none" id="err-toast"></span>\n\
                                    <div class="col-sm-10">\n\
                                        <input type="text" class="form-control good-select msisdn" id="msisdn-input" name="msisdn" placeholder="__ __ __ __ __" maxlength="14"\n\
                                               style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"\n\
                                               required="required"/>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <a class="button red one-fourth" href="javascript:void(0)" id="add-msisdn" style="width: 8em; margin-top: 1em; display: inline-block;"><i class="fa fa-minus mr10 text-white"></i> &nbsp; Retirer</a>\n\
                    </div>';
            $('#msisdn-container').append(html);
            $('#content').height( $("#content").height() + 100);
            idx_msisdn++;
            if(idx_msisdn == max_msisdn) $("#add-msisdn").attr("disabled", "disabled");
            $('#idx-exams-amount').text(idx_msisdn);
            $('select.bulletin-exam-category-'+idx_msisdn).select2();
            $('select.bulletin-exam-type-'+idx_msisdn).select2();
            var pvalue = $("select.dyn-select-parent").val();
            var apiUrl = "<?php echo $SUBSTR_URL; ?>/get-exam-categories?token=123&v="+pvalue;
            $.ajax({
                url: apiUrl,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(items) {
                    var newOptions = '<option value="" disabled selected>------</option>';
                    for (var id in items) {
                        newOptions += '<option value="' + items[id]["type_category_label"] + '">' + items[id]["type_category_label"] + '</option>';
                    }
                    $('select.bulletin-exam-category-'+idx_msisdn).select2('destroy').html(newOptions).prop("disabled", false)
                        .select2();
                    $('select.bulletin-exam-type-'+idx_msisdn).select2('destroy').html('<option value="" disabled selected>------</option>').prop("disabled", false)
                        .select2();
                }
            });
        } else {
            $("#add-msisdn").attr("disabled", "disabled");
        }
    });
</script>
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
