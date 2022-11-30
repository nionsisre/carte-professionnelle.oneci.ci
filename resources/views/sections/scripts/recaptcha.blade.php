<script>
    {{--
    |--------------------------------------------------------------------------
    | Google Recaptcha
    |--------------------------------------------------------------------------
    --}}
    grecaptcha.ready(function () {
        {{-- do request for recaptcha token --}}
        grecaptcha.execute('6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq', {
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
