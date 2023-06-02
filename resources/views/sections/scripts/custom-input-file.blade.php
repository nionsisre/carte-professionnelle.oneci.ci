<script>
{{--
|--------------------------------------------------------------------------
| Input file stylé
|--------------------------------------------------------------------------
--}}
jQuery('.inputfile').each(function () {
    var $input = jQuery(this),
        $label = $input.next('label'),
        labelVal = $label.html();

    $input.on('change', function (e) {
        var fileName = '';

        if (this.files && this.files.length > 1) {
            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
        } else if (e.target.value) {
            fileName = e.target.value.split('\\').pop();
            {{-- Renommage du fichier en retirant les espaces et les caracteres speciaux --}}
            {{-- fileName = e.target.value.split('\\').pop().replace(/['"[\]{}()<>+*=/\\|?:^~]/g, '').replace(/[^\w.-]/g, '-'); --}}
        }

        if (fileName) {
            $label.find('span').html(fileName);
        } else {
            $label.html(labelVal);
        }

        {{-- attribution de la valeur du fileName du fichier chargé dans le champ input du formulaire a soumettre --}}
        {{-- $input.val(fileName); --}}
    });

    {{-- Firefox bug fix --}}
    $input
        .on('focus', function () {
            $input.addClass('has-focus');
        })
        .on('blur', function () {
            $input.removeClass('has-focus');
        });
});
</script>
