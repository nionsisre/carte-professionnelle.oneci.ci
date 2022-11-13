<script>
    {{--
    |--------------------------------------------------------------------------
    | Ajout dynamique des numéros
    |--------------------------------------------------------------------------
    --}}
    var max_msisdn = 6;
    var idx_msisdn = 1;
    function rmMsisdn(id, idx) {
        jQuery("#"+id).remove();
        idx_msisdn--;
        if (idx_msisdn <= max_msisdn) {
            jQuery('#rm-msisdn').removeAttr("disabled");
        }
        if (idx_msisdn > 1) {
            jQuery('#ct-msisdn-' + idx_msisdn).append('<a class="button red one-fourth" href="javascript:void(0)" id="rm-msisdn" onclick="rmMsisdn(`ct-msisdn-' + (idx_msisdn) + '`, ' + (idx_msisdn) + ')" style="width: 8em; margin-top: 1em; display: inline-block;"><i class="fa fa-minus mr10 text-white"></i> &nbsp; Retirer</a>');
        }
        jQuery('#content').height( jQuery("#content").height() - 130);
    }
    jQuery("#add-msisdn").click(function () {
        if(idx_msisdn < max_msisdn) {
            jQuery("#rm-msisdn").remove();
            var html = '';
            html += '<div class="container clearfix" id="ct-msisdn-'+(idx_msisdn+1)+'" style="background-color: #ccc; padding: 2em 2em; margin-top: 1.2em">\n\
                        <div class="three-fourths">\n\
                            <div class="form-group one-half column-last" id="telco-field-'+(idx_msisdn+1)+'">\n\
                                <label class="col-sm-2 control-label">\n\
                                    Opérateur téléphonique<span style="color: #d9534f">*</span> :\n\
                                </label>\n\
                                <span style="display: none" id="err-toast"></span>\n\
                                <div class="col-sm-10">\n\
                                    <select class="form-control good-select" id="telco-input-'+(idx_msisdn+1)+'" name="telco[]" required="required"\n\
                                            style="width: 11em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">\n\
                                        @foreach($abonnes_operateurs as $abonnes_operateur)
                                        <option value="{{ $abonnes_operateur->id }}">{{ $abonnes_operateur->libelle_operateur }}</option>\n\
                                        @endforeach
                                    </select>\n\
                                </div>\n\
                            </div>\n\
                            <div class="form-group one-half column-last" id="msisdn-field-'+(idx_msisdn+1)+'">\n\
                                <div class="col-sm-12">\n\
                                    <label class="col-sm-2 control-label">\n\
                                        Numéro de téléphone<span style="color: #d9534f">*</span> :\n\
                                    </label>\n\
                                    <span style="display: none" id="err-toast"></span>\n\
                                    <div class="col-sm-10">\n\
                                        <input type="text" class="form-control msisdn" id="msisdn-input-'+(idx_msisdn+1)+'" name="msisdn[]" placeholder="__ __ __ __ __" maxlength="14"\n\
                                               style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"\n\
                                               required="required"/>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <a class="button red one-fourth" href="javascript:void(0)" id="rm-msisdn" onclick="rmMsisdn(`ct-msisdn-'+(idx_msisdn+1)+'`, '+(idx_msisdn+1)+')" style="width: 8em; margin-top: 1em; display: inline-block;"><i class="fa fa-minus mr10 text-white"></i> &nbsp; Retirer</a>\n\
                    </div>';
            jQuery('#msisdn-container').append(html);
            jQuery('#content').height( jQuery("#content").height() + 130);
            idx_msisdn++;
            jQuery(".msisdn").mask('99 99 99 99 99');
            jQuery(".good-select").select2();
            if(idx_msisdn === max_msisdn) jQuery("#add-msisdn").attr("disabled", "disabled");
        } else {
            jQuery("#add-msisdn").attr("disabled", "disabled");
        }
    });
</script>
