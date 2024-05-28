{{-- Le processus ci dessous ne se déclenche que si l'un des services d'aggrégation de paiement est actif en variable environnement --}}
@if(config('services.cinetpay.enabled') || config('services.ngser.enabled') || config('services.paynah.enabled'))
<script>
    {{--
    |--------------------------------------------------------------------------
    | GESTION DU PROCESSUS DE PAIEMENT NIVEAU FRONTEND
    |--------------------------------------------------------------------------
    --}}
    @if(session()->has('client') && session()->get('client')->statut == 1)
        {{-- Récupérer le lien de paiement + activer le listener de paiement Javascript dès que la page est chargée --}}
        @if(Route::is('certificat.formulaire'))
        jQuery(document).ready(function () {
            gpl();
        });
        @endif
        {{-- Initiliatisation des variables utiles --}}
        var ti = 0;
        var animatedTimer;
        var tkn = "{{ csrf_token() }}";
        var withModalSet = false;
        {{-- Fonction de récupération du lien unique et temporaire de paiement auprès du serveur --}}
        function gpl(withModal){
            {{-- appeler gpl en mettant le paramètre withModal à true pour afficher le frame de paiement à l'intérieur d'un modal --}}
            withModal = withModal || false;
            withModalSet = withModal;
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
                    {{-- Afficher un spinner pendant la récupération du lien au niveau du serveur --}}
                    jQuery('#payment-section').html('<center><i class="fa fa-spinner fa-spin fa-3x"></i></center>');
                    if(withModal) {
                        jQuery('#payment-link-btn').hide();
                        jQuery('#payment-link-loader').show();
                    }
                },
                success: function (data) {
                    {{-- En cas de récupération réussie du lien depuis le serveur, appeler la fonction de vérification du statut de paiement périodiquement --}}
                        ti = data.transaction_id;
                    animatedTimer = setInterval(cp, {{ env("PAYMENT_LISTENER_TIMEOUT_MILLISECONDS") }});
                    {{-- Afficher le frame de paiement soit dans un modal ou dans un frame simple selon la valeur de withModal --}}
                    if(withModal) {
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
                    } else {
                        jQuery('#payment-section').html('<iframe id="payment-link" src="'+data.message+'" style="border:1px #d9d9d9 solid;" name="paymentIFrame" height="400px" width="100%" allow="fullscreen"></iframe>')
                    }
                },
                error: function (data) {
                    {{-- En cas d'échec de récupération du lien de paiement depuis le serveur, afficher un message d'erreur puis un bouton permettant de relancer et rappeler la fonction --}}
                    if(data.responseJSON.has_error) {
                        jQuery('#payment-section').html('<center><p>Une erreur est survenue lors du chargement de la page de paiement.</p><br/><a href="javascript:void(0);" class="button black" onclick="gpl()"><i class="fa fa-sync text-white"></i> &nbsp; Cliquez ici pour réessayer</a></center>');
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
        {{-- Fonction de vérification du statut de payment auprès du serveur appelée chaque env('PAYMENT_LISTENER_TIMEOUT_MILLISECONDS') millisecondes  --}}
        function cp() {
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
                        ccp();
                        {{-- Fonction de vérification du statut de payment auprès du serveur appelée chaque env('PAYMENT_LISTENER_TIMEOUT_MILLISECONDS') millisecondes  --}}
                        if(withModalSet) {
                            jQuery('#close-modal-btn').click();
                        }
                        jQuery(".sw-btn-next").removeClass("disabled").removeAttr("disabled");
                        jQuery('#smartwizard').smartWizard("goToStep", 5);
                    }
                }
            });
        }
        {{-- Fonction de fermeture ou d'arrêt de la vérification du statut de paiement --}}
        function ccp() {
            clearInterval(animatedTimer);
            if(withModalSet) {
                jQuery('#payment-link-loader').hide();
                jQuery('#payment-link-btn').show();
            }
            jQuery("#certificate-get-payment-link-loader").hide();
            jQuery("#cptch-sbmt-btn").show();
        }
    @endif
</script>
@endif
