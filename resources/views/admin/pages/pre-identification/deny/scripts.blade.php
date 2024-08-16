<script type="text/javascript">
    {{-- Refresh Deny Document Content --}}
    const refreshDenyDocumentsModal = jQuery('#deny-documents-modal');
    refreshDenyDocumentsModal.on('shown.bs.modal', function () {
        {{-- Refresh Deny Edit Content here --}}
    });
    refreshDenyDocumentsModal.on('hidden.bs.modal', function () {
        {{-- Refresh Datatable Content here --}}
        myDatatable.draw();
    });
    function denyDocuments(nd, t) {
        let url = "{!! route('admin.pre-identification.client.get', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
        let cli = "{{ url()->current() }}";
        jQuery.ajax({
            type: 'POST',
            url: url,
            data: {
                '_token': "{{ csrf_token() }}",
                'cli': cli,
                'c': nd,
                't': t
            }, beforeSend: function () {
                jQuery('.modal-loader').show();
                jQuery('.modal-success').hide();
                jQuery('.modal-error').hide();
                jQuery('#deny-documents-modal-observations').val("");
            }, success: function(res){
                jQuery('.modal-loader').hide();
                jQuery('.modal-error').hide();
                jQuery('.modal-success').show();
                let customer = JSON.parse(res);
                if(customer !== null) {
                    jQuery('.deny-documents-modal-td').html('&nbsp;<i class="fa fa-id-card mr5"></i>'+customer.customers_type_piece.libelle_piece);
                    jQuery('.deny-documents-modal-nd').text(customer.numero_dossier);
                    jQuery('.deny-documents-modal-ndde').html('&nbsp;<i class="fa fa-barcode mr5"></i>'+customer.numero_document+" ("+ convertDate(customer.date_expiration_document) +")");
                    if(customer.genre === "M") {
                        jQuery('.deny-documents-modal-gndr').html('&nbsp;<i class="fa fa-mars mr5"></i> Masculin'+" ("+customer.civil_status.libelle_statut+")");
                    } else {
                        jQuery('.deny-documents-modal-gndr').html('&nbsp;<i class="fa fa-venus mr5"></i> Feminin'+" ("+customer.civil_status.libelle_statut+")");
                    }
                    if(customer.nom_epouse !== "") {
                        jQuery('.deny-documents-modal-nc').text(customer.prenom+" "+customer.nom+" épouse "+customer.nom_epouse);
                    } else {
                        jQuery('.deny-documents-modal-nc').text(customer.prenom+" "+customer.nom);
                    }
                    jQuery('.deny-documents-modal-dln').html('&nbsp;<i class="fa fa-calendar-day mr5"></i>'+convertDate(customer.date_naissance)+" à "+customer.lieu_naissance);
                    jQuery('.deny-documents-modal-pnn').html('&nbsp;<i class="fa fa-map-marker-alt mr5"></i>'+customer.pays_naissance+" ("+customer.nationalite+")");
                    jQuery('.deny-documents-modal-t').text(t);
                }
            }, error: function (data) {
                let errorMessage = "";
                if(data.status === 0) {
                    errorMessage = 'Erreur : '+data.status+' (Pas de connexion internet)';
                } else if (data.status === 419) {
                    errorMessage = 'Erreur : '+data.status+' (Session expirée, veuillez actualiser la page et réessayer)';
                } else {
                    errorMessage = 'Erreur : '+data.status+' ('+data.statusText+')';
                }
                jQuery('.modal-loader').hide();
                jQuery('.modal-success').hide();
                jQuery('.modal-error').show();
                jQuery('.modal-error-message').text(errorMessage);
                jQuery('.modal-retry-btn').attr('onclick','denyDocuments("'+nd+'", "'+t+'")');
            }
        });
    }
    jQuery('.deny-documents-modal-btn').click(function() {
        let nd = jQuery('.deny-documents-modal-nd').html();
        let t = jQuery('.deny-documents-modal-t').text();
        let obs = jQuery('#deny-documents-modal-observations').val();
        let url = "{!! route('admin.pre-identification.client.deny', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
        let cli = "{{ url()->current() }}";
        jQuery.ajax({
            type: 'POST',
            url: url,
            data: {
                '_token': "{{ csrf_token() }}",
                'cli': cli,
                'c': nd,
                'obs': obs,
                't': t
            }, beforeSend: function () {
                jQuery('.modal-loader').show();
                jQuery('.modal-success').hide();
                jQuery('.modal-error').hide();
            }, success: function(res){
                let customer = JSON.parse(res);
                if(customer !== null) {
                    jQuery('#deny-documents-modal').modal("hide");
                    jQuery('.deny-documents-modal-td').html('&nbsp;<i class="fa fa-id-card mr5"></i>'+customer.customers_type_piece.libelle_piece);
                    jQuery('.deny-documents-modal-nd').text(customer.numero_dossier);
                    jQuery('.deny-documents-modal-ndde').html('&nbsp;<i class="fa fa-barcode mr5"></i>'+customer.numero_document+" ("+ convertDate(customer.date_expiration_document) +")");
                    if(customer.genre === "M") {
                        jQuery('.deny-documents-modal-gndr').html('&nbsp;<i class="fa fa-mars mr5"></i> Masculin'+" ("+customer.civil_status.libelle_statut+")");
                    } else {
                        jQuery('.deny-documents-modal-gndr').html('&nbsp;<i class="fa fa-venus mr5"></i> Feminin'+" ("+customer.civil_status.libelle_statut+")");
                    }
                    if(customer.nom_epouse !== "") {
                        jQuery('.deny-documents-modal-nc').text(customer.prenom+" "+customer.nom+" épouse "+customer.nom_epouse);
                    } else {
                        jQuery('.deny-documents-modal-nc').text(customer.prenom+" "+customer.nom);
                    }
                    jQuery('.deny-documents-modal-dln').html('&nbsp;<i class="fa fa-calendar-day mr5"></i>'+convertDate(customer.date_naissance)+" à "+customer.lieu_naissance);
                    jQuery('.deny-documents-modal-pnn').html('&nbsp;<i class="fa fa-map-marker-alt mr5"></i>'+customer.pays_naissance+" ("+customer.nationalite+")");
                    jQuery('.deny-documents-modal-t').text(t);
                    jQuery.gritter.add({
                        title: 'Refus de la demande N°'+nd,
                        text: 'La demande N°'+nd+' a été rejetée avec succès',
                        class_name: 'growl-success',
                        image: '{{ URL::asset('back-office/assets/images/is-document.png') }}',
                        sticky: false,
                        time: '5000'
                    });
                } else {
                    jQuery('.modal-loader').hide();
                    jQuery('.modal-error').hide();
                    jQuery('.modal-success').show();
                }
            }, error: function (data) {
                let errorMessage = "";
                if(data.status === 0) {
                    errorMessage = 'Erreur : '+data.status+' (Pas de connexion internet)';
                } else if (data.status === 419) {
                    errorMessage = 'Erreur : '+data.status+' (Session expirée, veuillez actualiser la page et réessayer)';
                } else {
                    errorMessage = 'Erreur : '+data.status+' ('+data.statusText+')';
                }
                jQuery('.modal-loader').hide();
                jQuery('.modal-success').hide();
                jQuery('.modal-error').show();
                jQuery('.modal-error-message').text(errorMessage);
                jQuery('.modal-retry-btn').attr('onclick','denyDocuments("'+nd+'", "'+t+'")');
            }
        });
    });
</script>
