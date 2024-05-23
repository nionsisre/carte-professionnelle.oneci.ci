@if(config('services.recaptcha.enabled'))
<script src='https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_CLIENT') }}'></script>
<script>
    {{--
    |--------------------------------------------------------------------------
    | Google Recaptcha
    |--------------------------------------------------------------------------
    --}}
    grecaptcha.ready(function () {
        {{-- do request for recaptcha token --}}
        grecaptcha.execute('{{ env('RECAPTCHA_CLIENT') }}', {
            action: 'validate_captcha'
        }).then(function (token) {
            {{-- response is promise with passed token --}}
            try {
                {{-- add token value to form --}}
                document.getElementById('g-recaptcha-response').value = token;
            } catch (e) {}
        });
    });
</script>
@endif
