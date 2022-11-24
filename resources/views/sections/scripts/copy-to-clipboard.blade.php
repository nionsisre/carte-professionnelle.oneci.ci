<script>
    {{--
    |--------------------------------------------------------------------------
    | Copier un élément dans le presse-papier
    |--------------------------------------------------------------------------
    --}}
    function copyToClipboard(element) {
        const temp = jQuery("<input>");
        jQuery("body").append(temp);
        temp.val(jQuery(element).text()).select();
        document.execCommand("copy");
        temp.remove();
        jQuery("#copy-link").html('<i class="fa fa-check" style="color: #388E3C"></i> &nbsp; numéro copié !');
    }
</script>
