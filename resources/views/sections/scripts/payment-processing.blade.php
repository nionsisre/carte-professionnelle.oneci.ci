@if(config('services.cinetpay.enabled') || config('services.ngser.enabled') || config('services.paynah.enabled'))
<script>
    {{--
    |--------------------------------------------------------------------------
    | PAYMENT PROCESSING
    |--------------------------------------------------------------------------
    --}}
    @if(session()->has('client'))
        {{-- "Certificat Conformité" Payment Javascript Process --}}
        var ti = 0;
        var animatedTimer;
        var tkn = "{{ csrf_token() }}";
        function cp() { {{-- Check Payment Listener --}}
            let url = "{{ route('certificat.payment.verify') }}";
            let cli = "{{ url()->current() }}";
            let t = "{{ md5(sha1('s@lty'.session()->get('client')->numero_dossier.'s@lt'))}}";
            let fn = "{{ session()->get('client')->numero_dossier }}";
            $.post({
                type: 'POST',
                url: url,
                data: {
                    '_token': tkn,
                    'cli': cli,
                    't': t,
                    'ti': ti,
                    'fn': fn,
                    'pt': "{{ env('PAYMENT_TYPE') }}"
                },
                success: function(res){
                    if(!res.has_error) {
                        jQuery('#close-modal-btn').click();
                        location.href = encodeURI("{{ route('certificat.payment.done') }}"+"?f="+ "{{ session()->get('client')->numero_dossier }}"+"&t="+"{{ session()->get('client')->uniqid }}");
                    }
                }
            });
            {{-- $(form).submit(); --}}
        }
        function ccp() { {{-- Close Check Payment Listener --}}
            clearInterval(animatedTimer);
            jQuery("#certificate-get-payment-link-loader").hide();
            jQuery("#cptch-sbmt-btn").show();
        }
        function gpl(form_id){
            var cli = "{{ url()->current() }}";
            var fn = "{{ session()->get('client')->numero_dossier }}";
            $.ajax({
                url: "{{ route('certificat.payment.get') }}",
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    cli: cli,
                    fn: fn
                },
                dataType: "json",
                beforeSend: function () {
                    jQuery("#cptch-sbmt-btn").hide();
                    jQuery("#certificate-get-payment-link-loader").show();
                },
                success: function (data) {
                    ti = data.transaction_id;
                    animatedTimer = setInterval(cp, 1000);
                    jQuery('#modalBox').html(
                        '<center> \
                            <div>\
                                <div class="modal-header">\
                                    <iframe id="payment-link" src="'+data.message+'" style="border:1px #d9d9d9 solid;" name="paymentIFrame" height="400px" width="100%" allow="fullscreen"></iframe>\
                                </div>\
                                <div class="modal-footer" style="margin-top: 1.2em">\
                                    <a href="#" onclick="ccp()" id="close-modal-btn" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Annuler</a>\
                                </div>\
                            </div>\
                        </center>'
                    ).modal({
                        escapeClose: false,
                        clickClose: false,
                        showClose: false
                    });
                    jQuery('.blocker').css('z-index','2');
                },
                error: function (data) {
                    if(data.responseJSON.has_error) {
                        jQuery("#certificate-get-payment-link-loader").hide();
                        jQuery("#cptch-sbmt-btn").show();
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
        }
    @endif
</script>
@endif
