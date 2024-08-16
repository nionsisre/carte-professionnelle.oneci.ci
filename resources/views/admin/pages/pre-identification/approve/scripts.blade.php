<script type="text/javascript">
    {{-- Refresh Approve Document Content --}}
    const refreshApproveDocumentsModal = $('#approve-documents-modal');
    refreshApproveDocumentsModal.on('shown.bs.modal', function () {
        {{-- Refresh Approve Edit Content here --}}
    });
    refreshApproveDocumentsModal.on('hidden.bs.modal', function () {
        {{-- Refresh Datatable Content here --}}
        myDatatable.draw();
    });
    function approveDocuments(nd, t, lr) {
        let url = "{!! route('admin.pre-identification.client.approve', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
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
                jQuery('.approve-documents-modal-dl-lnk').attr('href', "javascript:void(0)");
            }, success: function(res){
                jQuery('.modal-loader').hide();
                jQuery('.modal-error').hide();
                jQuery('.modal-success').show();
                let customer = JSON.parse(res);
                if(customer !== null) {
                    jQuery('#approve-documents-modal').modal("hide");
                    jQuery('.approve-documents-modal-td').html('&nbsp;<i class="fa fa-id-card mr5"></i>'+customer.customers_type_piece.libelle_piece);
                    jQuery('.approve-documents-modal-nd').text(customer.numero_dossier);
                    jQuery('.approve-documents-modal-ndde').html('&nbsp;<i class="fa fa-barcode mr5"></i>'+customer.numero_document+" ("+ convertDate(customer.date_expiration_document) +")");
                    if(customer.genre === "M") {
                        jQuery('.approve-documents-modal-gndr').html('&nbsp;<i class="fa fa-mars mr5"></i> Masculin'+" ("+customer.civil_status.libelle_statut+")");
                    } else {
                        jQuery('.approve-documents-modal-gndr').html('&nbsp;<i class="fa fa-venus mr5"></i> Feminin'+" ("+customer.civil_status.libelle_statut+")");
                    }
                    if(customer.nom_epouse !== "") {
                        jQuery('.approve-documents-modal-nc').text(customer.prenom+" "+customer.nom+" épouse "+customer.nom_epouse);
                    } else {
                        jQuery('.approve-documents-modal-nc').text(customer.prenom+" "+customer.nom);
                    }
                    jQuery('.approve-documents-modal-dln').html('&nbsp;<i class="fa fa-calendar-day mr5"></i>'+convertDate(customer.date_naissance)+" à "+customer.lieu_naissance);
                    jQuery('.approve-documents-modal-pnn').html('&nbsp;<i class="fa fa-map-marker-alt mr5"></i>'+customer.pays_naissance+" ("+customer.nationalite+")");
                    jQuery('.approve-documents-modal-lr').text(lr);
                    jQuery('.approve-documents-modal-dl-lnk').attr('href', "{{ route('pre-identification.download.pdf') }}?n="+customer.certificate_download_link);
                    jQuery('.approve-documents-modal-t').text(t);
                    jQuery.gritter.add({
                        title: 'Confirmation de la demande N°'+nd,
                        text: 'La demande N°'+nd+' a été approuvée avec succès',
                        class_name: 'growl-success',
                        image: '{{ URL::asset('back-office/assets/images/is-document.png') }}',
                        sticky: false,
                        time: '5000'
                    });
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
                jQuery('.modal-retry-btn').attr('onclick','approveDocuments("'+nd+'", "'+t+'")');
            }
        });
    }
</script>
