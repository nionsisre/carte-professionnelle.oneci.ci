@if(config('services.recaptcha.enabled'))
<script src='https://www.google.com/recaptcha/api.js?render=6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq'></script>
@endif
<script src="{{ URL::asset('assets/js/select2.min.js') }}" type='text/javascript'></script>
<script src="{{ URL::asset('assets/js/countrySelect.js') }}" type='text/javascript'></script>
<script>
    jQuery("#country-input").countrySelect({
        defaultCountry: 'ci',
        preferredCountries: ['ci','fr', 'us', 'cn', 'ru', 'ca', 'gb', 'de']
    });
</script>
<script src="{{ URL::asset('assets/js/smart-wizard/jquery.smartWizard.min.js') }}"></script>
@yield('scripts')
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
