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
                jQuery("#certificate-get-payment-link-loader-{{ $i }}").hide();
                jQuery("#certificate-get-payment-link-{{ $i }}").show();
                jQuery('#modalBox').html(
                    '<center> <div class="notification-box notification-box-success">\n\
                    <div class="modal-header"><i class="fa fa-envelope fa-2x"></i><br/><br/><h3>'+data.message+'</h3></div>\n\
                    </div><div class="modal-footer">\n\
                    <a href="#" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a></div></center>'
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
                    /*jQuery("#certificate-get-payment-link-{{ $i }}").hide();
                    rs{{ $i }} = parseInt(data.responseJSON.remaining_sec);
                    animatedTimer{{ $i }} = setInterval(updateTime{{ $i }}, 1000);
                    jQuery("#otp-send-counter-{{ $i }}").text("Réessayez dans "+Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) )).show();
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
                    jQuery('.blocker').css('z-index','2');*/
                }
            }
        });
    });
    @endfor
</script>
