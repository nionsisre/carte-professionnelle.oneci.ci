<script>
    {{--
    ---------------------------------------------
    TOGGLE BETWEEN FORM NUMBER & MSISDN
    ---------------------------------------------
    --}}
    let formNumberTypeSearch = true;
    jQuery('#no-form-number').click(function () {
        if (formNumberTypeSearch) {
            jQuery('#tsch-input').val(1);
            jQuery('#msisdn-input').attr('required', 'required');
            jQuery('#form-number-input').removeAttr('required');
            jQuery('#form-number-field').hide();
            jQuery('#msisdn-field').show();
            jQuery('#no-form-number-text').text("Vérifier avec mon numéro de dossier");
            formNumberTypeSearch = false;
        } else {
            jQuery('#tsch-input').val(0);
            jQuery('#form-number-input').attr('required', 'required');
            jQuery('#msisdn-input').removeAttr('required');
            jQuery('#msisdn-field').hide();
            jQuery('#form-number-field').show();
            jQuery('#no-form-number-text').text("Vérifier plutôt avec mon numéro de téléphone");
            formNumberTypeSearch = true;
        }
    });
</script>
