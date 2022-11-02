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

    jQuery('#smartwizard').smartWizard({
        selected: 0, /* Initial selected step, 0 = first step*/
        theme: 'arrows', /* theme for the wizard, related css need to include for other than default theme*/
        justified: true, /* Nav menu justification. true/false*/
        autoAdjustHeight: true, /* Automatically adjust content height*/
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
    /*
    jQuery('#smartwizard').smartWizard({
        // Initial selected step, 0 = first step
        selected: 0,
        // 'arrows', 'square', 'round', 'dots'
        theme: 'arrows',
        // lang
        lang: {
            next:'Suivant >',
            previous:'< Précédent'
        },
        // Nav menu justification. true/false
        justified: true,
        // Automatically adjust content height
        autoAdjustHeight: true,
        // Show url hash based on step
        enableURLhash: true,
        // Enable the back button support
        backButtonSupport: true,
        // <a href="https://www.jqueryscript.net/animation/">Animation</a> options
        transition: {
            // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
            animation:'slideHorizontal',
            // Animation speed. Not used if animation is 'css'
            speed:'400',
            // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
            easing:'',
            // Only used if animation is 'css'. Animation CSS prefix
            prefixCss:'',
            // Only used if animation is 'css'. Step show Animation CSS on forward direction
            fwdShowCss:'',
            // Only used if animation is 'css'. Step hide Animation CSS on forward direction
            fwdHideCss:'',
            // Only used if animation is 'css'. Step show Animation CSS on backward direction
            bckShowCss:'',
            // Only used if animation is 'css'. Step hide Animation CSS on backward direction
            bckHideCss:'',
        }
    });
    */
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
</script>
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
