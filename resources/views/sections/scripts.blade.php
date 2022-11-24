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
@if (Route::is('accueil'))
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
    @include('sections.scripts.smartwizard')
    @include('sections.scripts.custom-input-file')
    @include('sections.scripts.dynamic-msisdn')
    @include('sections.scripts.smartwizard-validation')
    @include('sections.scripts.copy-to-clipboard')
@elseif (Route::is('consultation_statut_identification'))
    @include('sections.scripts.recaptcha')
    @include('sections.scripts.form-masks')
@endif
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
