<script>
    {{--
    |--------------------------------------------------------------------------
    | PAYMENT PROCESSING
    |--------------------------------------------------------------------------
    --}}
    @for($i=0;$i<sizeof(session()->get('abonne_numeros'));$i++)
    var rs{{ $i }} = 0;
    var animatedTimer{{ $i }};
    var idx{{ $i }};
    function cp{{ $i }}(trans_id) {
        let url = 'https://api-checkout-oneci.cinetpay.com/v2/payment/check';
        $.post({
            type: 'POST',
            url: url,
            data: {
                'apikey':  '179990205162cc71d73e8804.22209231',
                'site_id': '298373',
                'transaction_id': trans_id,
            },
            success:function( res ){
                console.log(res.message);
                console.log(res.data.status);
                if (res.data.status === 'ACCEPTED'){
                    /*location.href = decodeURI(" ")*/
                }
                else{
                    /*location.href = decodeURI(" ")*/
                }
            }
        });
        console.log('Check payment status...');
    }
    function ccp{{ $i }}() {
        clearInterval(animatedTimer{{ $i }});
        jQuery("#certificate-get-payment-link-loader-{{ $i }}").hide();
        jQuery("#certificate-get-payment-link-{{ $i }}").show();
    }
    jQuery("#certificate-get-payment-link-{{ $i }}").click(function () {
        var cli = "{{ env('APP_URL') }}";
        var fn = "{{ session()->get('abonne_numeros')[0]->numero_dossier }}";
        var idx = {{ $i }};
        $.ajax({
            url: "{{ route('obtenir_lien_de_paiement') }}",
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
                animatedTimer{{ $i }} = setInterval(cp{{ $i }}, 1000);
                jQuery('#modalBox').html(
                    '<center> <div class="notification-box notification-box-success">\n\
                    <div class="modal-header"><i class="fa fa-file-certificate fa-2x"></i><br/><br/>Obtention d\'un certificat d\'identification ONECI pour le <br/><b><i class="fa fa-sim-card"></i> &nbsp; {{ session()->get('abonne_numeros')[$i]->numero_de_telephone }}</b><br/><br/><h3>'+data.message+'</h3></div>\n\
                    </div><div class="modal-footer">\n\
                    <a href="#" onclick="ccp{{ $i }}()" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Annuler</a></div></center>'
                ).modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
                jQuery('.blocker').css('z-index','2');
            },
            error: function (data) {
                console.log(data);
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
