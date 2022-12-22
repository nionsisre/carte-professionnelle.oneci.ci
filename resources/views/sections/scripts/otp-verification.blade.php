<script>
    {{--
    |--------------------------------------------------------------------------
    | OTP SMS VERIFICATION
    |--------------------------------------------------------------------------
    --}}
    var flagwrap = 0;
    var rs = 0;
    var animatedTimer;
    var idx;
    function updateTime(indx) {
        if(rs <= 0) {
            jQuery("#otp-send-link-"+indx).show();
            clearInterval(animatedTimer);
        } else {
            rs--;
            jQuery("#otp-send-counter-"+indx).text("SMS envoyé ! Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) ));
        }
    }
    @for($i=0;$i<sizeof($resultats_statut);$i++)
    jQuery("#otp-send-link-"+{{ $i }}).click(function () {
        /*jQuery("#otp-send-link-"+{{ $i }}).hide();
        rs = parseInt('180');
        idx = {{ $i }};
        animatedTimer = setInterval(updateTime(idx), 1000);
        jQuery("#otp-send-counter-"+{{ $i }}).text("SMS envoyé ! Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) )).show();*/
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
                console.log("ok");
                /*if (!data.error) {
                    jQuery("#err-toast").text("SMS envoyé avec succès au +225 " + msisdn).attr("style", "color: green;font-style: italic;");
                    setTimeout(function () {
                        jQuery("#err-toast").attr("style", "display: none");
                    }, 10000);
                    rs = parseInt(data.remaining_sec);
                    animatedTimer = setInterval(updateTime, 1000);
                    jQuery("#form-send-authcode-link").text("Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) ));
                } else {
                    jQuery("#err-toast").text(data.error_msg).attr("style", "color: red;font-style: italic;");
                    setTimeout(function () {
                        jQuery("#err-toast").attr("style", "display: none");
                    }, 3000);
                    rs = parseInt(data.remaining_sec);
                    animatedTimer = setInterval(updateTime, 1000);
                    jQuery("#form-send-authcode-link").text("Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) ));
                }*/
            },
            error: function () {
                jQuery("#err-toast").text("Impossible de joindre le serveur, vérifiez votre connexion ou réessayez plus tard...").attr("style", "color: red;font-style: italic;");
                setTimeout(function () {
                    jQuery("#err-toast").attr("style", "display: none");
                }, 3000);
            }
        });
        /*jQuery(this.id+':hidden').show();*/
        /*if(jQuery("#form-send-authcode-link").text() == "Cliquez ici pour recevoir un code par SMS") {
            var msisdn = jQuery("#form-msisdn-input").val();
            if (msisdn.length < 11) {
                jQuery("#err-toast").text("Veuillez saisir un numéro de téléphone correct SVP");
                jQuery("#err-toast").attr("style", "color: red;font-style: italic;");
                setTimeout(function () {
                    jQuery("#err-toast").attr("style", "display: none");
                }, 3000);
            } else {
                if (msisdn.substring(0, 2) == "01" || msisdn.substring(0, 2) == "05" || msisdn.substring(0, 2) == "07") {
                    var cli = "ONECI.CI";
                    var vtkn = jQuery("#vtkn").val();
                    var rcp = jQuery("#rcp").val();
                    var msisdn = jQuery("#form-msisdn-input").val();
                    $.ajax({
                        url: {{ Url::to('/') }} + "cni-status-checker",
                        type: "POST",
                        data: {cli: cli, tn: vtkn, ins: "SEND_VCODE", rcp: rcp, msisdn: msisdn},
                        dataType: "json",
                        success: function (data) {
                            if (!data.error) {
                                jQuery("#err-toast").text("SMS envoyé avec succès au +225 " + msisdn).attr("style", "color: green;font-style: italic;");
                                setTimeout(function () {
                                    jQuery("#err-toast").attr("style", "display: none");
                                }, 10000);
                                rs = parseInt(data.remaining_sec);
                                animatedTimer = setInterval(updateTime, 1000);
                                jQuery("#form-send-authcode-link").text("Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) ));
                            } else {
                                jQuery("#err-toast").text(data.error_msg).attr("style", "color: red;font-style: italic;");
                                setTimeout(function () {
                                    jQuery("#err-toast").attr("style", "display: none");
                                }, 3000);
                                rs = parseInt(data.remaining_sec);
                                animatedTimer = setInterval(updateTime, 1000);
                                jQuery("#form-send-authcode-link").text("Réessayez dans "+Math.floor(rs/60)+" : "+Math.floor(rs - (Math.floor(rs/60)*60) ));
                            }
                        },
                        error: function () {
                            jQuery("#err-toast").text("Impossible de joindre le serveur, vérifiez votre connexion ou réessayez plus tard...").attr("style", "color: red;font-style: italic;");
                            setTimeout(function () {
                                jQuery("#err-toast").attr("style", "display: none");
                            }, 3000);
                        }
                    });
                } else {
                    jQuery("#err-toast").text("Le numéro de téléphone saisi est invalide").attr("style", "color: red;font-style: italic;");
                    setTimeout(function () {
                        jQuery("#err-toast").attr("style", "display: none");
                    }, 3000);
                }
            }
        }*/
    });
    @endfor
    jQuery("#form-msisdn-input").mask('99 99 99 99 99');
    jQuery("#form-authcode-input").mask('999999');
    /* Initialize select2 */
    jQuery("#center-slct-lst").select2();
</script>
