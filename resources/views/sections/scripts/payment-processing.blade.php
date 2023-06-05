<script>
    {{--
    |--------------------------------------------------------------------------
    | PAYMENT PROCESSING
    |--------------------------------------------------------------------------
    --}}
    @for($i=0;$i<sizeof(session()->get('abonne_numeros'));$i++)
    var ti{{ $i }} = 0;
    var animatedTimer{{ $i }};
    var idx{{ $i }};
    var tkn{{ $i }} = "{{ csrf_token() }}";
    function cp{{ $i }}() {
        let url = "{{ route('front_office.scripts.payment_status.verify') }}";
        let cli = "{{ url()->current() }}";
        let t = "{{ md5(sha1('s@lty'.session()->get('abonne_numeros')[0]->numero_dossier.'s@lt'))}}";
        let fn = "{{ session()->get('abonne_numeros')[$i]->numero_dossier }}";
        let msisdn = "{{ session()->get('abonne_numeros')[$i]->numero_de_telephone }}";
        $.post({
            type: 'POST',
            url: url,
            data: {
                '_token': tkn{{ $i }},
                'cli': cli,
                't': t,
                'ti': ti{{ $i }},
                'fn': fn,
                'msisdn': msisdn
            },
            success: function(res){
                if(!res.has_error) {
                    jQuery('#close-modal-{{ $i }}-btn').click();
                    location.href = encodeURI("{{ route('front_office.auth.recu_identification.url') }}"+"?f="+ "{{ session()->get('abonne_numeros')[$i]->numero_dossier }}"+"&t="+"{{ session()->get('abonne_numeros')[$i]->uniqid }}");
                }
            }
        });
    }
    function ccp{{ $i }}() {
        clearInterval(animatedTimer{{ $i }});
        jQuery("#certificate-get-payment-link-loader-{{ $i }}").hide();
        jQuery("#certificate-get-payment-link-{{ $i }}").show();
    }
    jQuery("#certificate-get-payment-link-{{ $i }}").click(function () {
        var cli = "{{ url()->current() }}";
        var fn = "{{ session()->get('abonne_numeros')[0]->numero_dossier }}";
        var idx = {{ $i }};
        $.ajax({
            url: "{{ route('front_office.scripts.certificat_identification.payment_link.get') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                cli: cli,
                tn: "{{ (session()->has('certificate_msisdn_tokens')) ? session()->get('certificate_msisdn_tokens')[$i]['value'] : '' }}",
                fn: fn,
                idx: idx
            },
            dataType: "json",
            beforeSend: function () {
                jQuery("#certificate-get-payment-link-{{ $i }}").hide();
                jQuery("#certificate-get-payment-link-loader-{{ $i }}").show();
            },
            success: function (data) {
                ti{{ $i }} = data.transaction_id;
                animatedTimer{{ $i }} = setInterval(cp{{ $i }}, 1000);
                jQuery('#modalBox').html(
                    '<center> <div class="notification-box notification-box-success">\n\
                    <div class="modal-header">\
                    <i class="fa fa-file-certificate fa-2x"></i><br/><br/>\
                        Obtention d\'un certificat d\'identification ONECI pour le <br/>\
                        <b><i class="fa fa-sim-card"></i> &nbsp; {{ session()->get('abonne_numeros')[$i]->numero_de_telephone }}\
                        </b><br/><br/>\
                        <b><i class="fa fa-money-bill fa-1x"></i> &nbsp; Coût: {{ env('CINETPAY_SERVICE_AMOUNT') }} Fcfa </b><br/><br/><h3>'+data.message+'</h3></div>\n\
                    </div><div class="modal-footer">\n\
                    <a href="#" onclick="ccp{{ $i }}()" id="close-modal-{{ $i }}-btn" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Annuler</a></div></center>'
                ).modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
                jQuery('.blocker').css('z-index','2');
            },
            error: function (data) {
                if(data.responseJSON.has_error) {
                    jQuery("#certificate-get-payment-link-loader-{{ $i }}").hide();
                    jQuery("#certificate-get-payment-link-{{ $i }}").show();
                    jQuery('#modalBox').html(
                        '<center> <div class="notification-box notification-box-error">\n\
                        <div class="modal-header"><h3>'+data.responseJSON.message+'</h3></div>\n\
                        </div><div class="modal-footer">\n\
                        <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
                    ).modal({
                        escapeClose: false,
                        clickClose: false,
                        showClose: false
                    });
                    jQuery('.blocker').css('z-index','2');
                }
            }
        });
    });
    @endfor
</script>
