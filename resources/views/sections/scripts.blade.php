<script src='https://www.google.com/recaptcha/api.js?render=6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq'></script>
<script src="{{ URL::asset('assets/js/select2.min.js') }}" type='text/javascript'></script>
<script src="{{ URL::asset('assets/js/countrySelect.js') }}" type='text/javascript'></script>
<script>
    jQuery("#country-input").countrySelect({
        defaultCountry: 'ci',
        preferredCountries: ['ci','fr', 'us', 'cn', 'ru', 'ca', 'gb', 'de']
    });
</script>
<script src="{{ URL::asset('assets/js/smart-wizard/jquery.smartWizard.min.js') }}"></script>
@if(Route::is('accueil'))
    @if(config('services.recaptcha.enabled'))
        @include('sections.scripts.recaptcha')
    @endif
    @include('sections.scripts.form-masks')
    @include('sections.scripts.smart-wizard')
    @include('sections.scripts.custom-input-file')
    @include('sections.scripts.dynamic-msisdn')
    @include('sections.scripts.smart-wizard-validation')
    @include('sections.scripts.copy-to-clipboard')
    @if(session()->has('abonne_numeros'))
        @if(config('services.sms.enabled'))
            @include('sections.scripts.otp-verification')
        @endif
    @endif
@elseif(Route::is('consultation_statut_identification'))
    @if(config('services.recaptcha.enabled'))
        @include('sections.scripts.recaptcha')
    @endif
    @include('sections.scripts.form-masks')
    @include('sections.scripts.toggle-form-number-and-msisdn')
    @if(session()->has('abonne_numeros'))
        @if(config('services.sms.enabled'))
            @include('sections.scripts.otp-verification')
        @endif
        @if(config('services.cinetpay.enabled'))
            @include('sections.scripts.payment-processing')
        @endif
    @endif
@endif
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
