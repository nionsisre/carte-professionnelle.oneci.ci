<script>
    {{--
    |--------------------------------------------------------------------------
    | Initialize smartwizard library
    |--------------------------------------------------------------------------
    --}}
    window.location.hash = '';
    jQuery('#smartwizard').smartWizard({
        selected: 0, {{-- Initial selected step, 0 = first step --}}
        theme: 'arrows', {{-- theme for the wizard, related css need to include for other than default theme --}}
        justified: true, {{-- Nav menu justification. true/false --}}
        autoAdjustHeight: false, {{-- Automatically adjust content height --}}
        backButtonSupport: true, {{-- Enable the back button support --}}
        enableUrlHash: false, {{-- Enable selection of the step based on url hash --}}
        transition: {
        animation: 'none', {{-- Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify) --}}
        speed: '400', {{-- Animation speed. Not used if animation is 'css' --}}
        easing: '', {{-- Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css' --}}
        prefixCss: '', {{-- Only used if animation is 'css'. Animation CSS prefix */
        fwdShowCss: '', {{-- Only used if animation is 'css'. Step show Animation CSS on forward direction --}}
        fwdHideCss: '', {{-- Only used if animation is 'css'. Step hide Animation CSS on forward direction --}}
        bckShowCss: '', {{-- Only used if animation is 'css'. Step show Animation CSS on backward direction --}}
        bckHideCss: '', {{-- Only used if animation is 'css'. Step hide Animation CSS on backward direction --}}
        },
        toolbar: {
        position: 'bottom', {{-- none|top|bottom|both --}}
        showNextButton: true, {{-- show/hide a Next button --}}
        showPreviousButton: true, {{-- show/hide a Previous button --}}
        extraHtml: '' {{-- Extra html to show on toolbar --}}
        },
        anchor: {
        enableNavigation: false, {{-- Enable/Disable anchor navigation --}}
        enableNavigationAlways: false, {{-- Activates all anchors clickable always --}}
        enableDoneState: true, {{-- Add done state on visited steps --}}
        markPreviousStepsAsDone: true, {{-- When a step selected by url hash, all previous steps are marked done --}}
        unDoneOnBackNavigation: false, {{-- While navigate back, done state will be cleared --}}
        enableDoneStateNavigation: true {{-- Enable/Disable the done state navigation --}}
        },
        keyboard: {
        keyNavigation: true, {{-- Enable/Disable keyboard navigation(left and right keys are used if enabled) --}}
        keyLeft: [37], {{-- Left key code --}}
        keyRight: [39] {{-- Right key code --}}
        },
        lang: { {{-- Language variables for button --}}
        next: 'Suivant >',
        previous: '< Précédent'
        },
        disabledSteps: [], {{-- Array Steps disabled --}}
        errorSteps: [], {{-- Array Steps error --}}
        warningSteps: [], {{-- Array Steps warning --}}
        hiddenSteps: [], {{-- Hidden steps --}}
        getContent: null {{-- Callback function for content loading --}}
    });
</script>
