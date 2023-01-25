<script>
    {{--
    |--------------------------------------------------------------------------
    | OTP SMS VERIFICATION
    |--------------------------------------------------------------------------
    --}}
    @for($i=0;$i<sizeof(session()->get('abonne_numeros'));$i++)
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
        var cli = "{{ url()->current() }}";
        var fn = "{{ session()->get('abonne_numeros')[0]->numero_dossier }}";
        var idx = {{ $i }};
        $.ajax({
            url: "{{ route('envoi_code_otp_par_sms') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                cli: cli,
                tn: "{{ (session()->has('otp_msisdn_tokens')) ? session()->get('otp_msisdn_tokens')[$i]['value'] : '' }}",
                fn: fn,
                idx: idx
            },
            dataType: "json",
            success: function (data) {
                jQuery("#otp-send-link-{{ $i }}").hide();
                rs{{ $i }} = parseInt(data.remaining_sec);
                animatedTimer{{ $i }} = setInterval(updateTime{{ $i }}, 1000);
                jQuery("#otp-send-counter-{{ $i }}").text("Réessayez dans "+Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) )).show();
                jQuery('#modalError').html(
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
    jQuery("#cert-dl-link-{{ $i }}").click(function () {
        var cli = "{{ url()->current() }}";
        var fn = "{{ session()->get('abonne_numeros')[0]->numero_dossier }}";
        var idx = {{ $i }};
        function updateCounterTime{{ $i }}() {
            if(rs{{ $i }} <= 0) {
                jQuery("#otp-send-counter-{{ $i }}").hide();
                jQuery("#otp-send-link-{{ $i }}").show();
                clearInterval(animatedTimer{{ $i }});
            } else {
                rs{{ $i }}--;
                jQuery("#otp-send-counter-{{ $i }}").html(Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) ));
            }
        }
        $.ajax({
            url: "{{ route('envoi_code_otp_par_sms') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                cli: cli,
                tn: "{{ (session()->has('otp_msisdn_tokens')) ? session()->get('otp_msisdn_tokens')[$i]['value'] : '' }}",
                fn: fn,
                idx: idx
            },
            dataType: "json",
            success: function (data) {
                jQuery("#otp-send-link-{{ $i }}").hide();
                rs{{ $i }} = parseInt(data.remaining_sec);
                animatedTimer{{ $i }} = setInterval(updateCounterTime{{ $i }}, 1000);
                jQuery("#otp-send-counter-{{ $i }}").text(Math.floor(rs{{ $i }}/60)+" : "+Math.floor(rs{{ $i }} - (Math.floor(rs{{ $i }}/60)*60) )).show();
                {{--jQuery("#cert-dl-link-{{ $i }}").hide();--}}
                jQuery('#otp-container-{{ $i }}').modal({
                    escapeClose: false,
                    clickClose: false,
                    showClose: false
                });
                jQuery('.blocker').css('z-index','2');
            },
            error: function (data) {
                if(data.responseJSON.has_error) {
                    jQuery("#otp-send-link-{{ $i }}").hide();
                    rs{{ $i }} = parseInt(data.responseJSON.remaining_sec);
                    {{--jQuery("#cert-dl-link-{{ $i }}").hide();--}}
                    jQuery('#otp-container-error-{{ $i }}').html(
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
    jQuery("#form-authcode-input").mask('999999');
    /* Initialize select2 */
    jQuery("#center-slct-lst").select2();
</script>
