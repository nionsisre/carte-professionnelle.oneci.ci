<script>
    {{--
    |--------------------------------------------------------------------------
    | OTP SMS VERIFICATION
    |--------------------------------------------------------------------------
    --}}
    @for($i=0;$i<sizeof($resultats_statut);$i++)
    var rs{{ $i }} = 0;
    var animatedTimer{{ $i }};
    var idx{{ $i }};
    function updateTime{{ $i }}() {
        if(rs{{ $i }} <= 0) {
            jQuery("#otp-send-counter-{{ $i }}").hide();
            jQuery("#otp-send-link-{{ $i }}").show();
            clearInterval(animatedTimer{{ $i }});
        } else {
            rs{{ $i }}--;
            jQuery("#otp-send-counter-{{ $i }}").html("Réessayez dans "+Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) ));
        }
    }
    jQuery("#otp-send-link-{{ $i }}").click(function () {
        var cli = "{{ env('APP_URL') }}";
        var fn = "{{ $resultats_statut[0]->numero_dossier }}";
        var idx = {{ $i }};
        $.ajax({
            url: "{{ route('envoi_code_otp_par_sms') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                cli: cli,
                tn: "{{ $otp_msisdn_tokens[$i]['value'] }}",
                ins: "SEND_OTP",
                fn: fn,
                idx: idx
            },
            dataType: "json",
            success: function (data) {

            },
            error: function (data) {
                if(data.responseJSON.has_error) {
                    jQuery("#otp-send-link-{{ $i }}").hide();
                    rs{{ $i }} = parseInt(data.responseJSON.remaining_sec);
                    animatedTimer{{ $i }} = setInterval(updateTime{{ $i }}, 1000);
                    jQuery("#otp-send-counter-{{ $i }}").text("Réessayez dans "+Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) )).show();
                    jQuery('#modalError').html(
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
    jQuery("#form-msisdn-input").mask('99 99 99 99 99');
    jQuery("#form-authcode-input").mask('999999');
    /* Initialize select2 */
    jQuery("#center-slct-lst").select2();
</script>
