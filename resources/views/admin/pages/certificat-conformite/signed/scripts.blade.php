<script type="text/javascript">
    {{-- Refresh Set Signed Document Content --}}
    const refreshSetSignedDocumentsModal = $('#set-signed-documents-modal');
    refreshSetSignedDocumentsModal.on('shown.bs.modal', function () {
        {{-- Refresh Set Signed Edit Content here --}}
    });
    refreshSetSignedDocumentsModal.on('hidden.bs.modal', function () {
        {{-- Refresh Datatable Content here --}}
        myDatatable.draw();
    });
    function setSignedDocuments(nd, t, lr) {
        let url = "{!! route('admin.certificat.client.signed', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
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
                jQuery('.set-signed-documents-modal-dl-lnk').attr('href', "javascript:void(0)");
            }, success: function(res){
                jQuery('.modal-loader').hide();
                jQuery('.modal-error').hide();
                jQuery('.modal-success').show();
                let client = JSON.parse(res);
                if(client !== null) {
                    let nniorcni = "";
                    if(client.cni !== "") {
                        nniorcni = client.numero_cni;
                    } else {
                        nniorcni = client.nni;
                    }
                    jQuery('.set-signed-documents-modal-nd').text(client.numero_dossier);
                    jQuery('.set-signed-documents-modal-nni-or-cni').text(nniorcni);
                    jQuery('.set-signed-documents-modal-nc').text(client.prenom+" "+client.nom+" ("+convertDate(client.date_naissance)+") ");
                    jQuery('.set-signed-documents-modal-ncd').text(client.prenom_decision+" "+client.nom_decision+" ("+convertDate(client.date_naissance_decision)+") ");
                    jQuery('.set-signed-documents-modal-ndec').text("N°"+client.numero_decision+" du "+convertDate(client.date_decision));
                    jQuery('.set-signed-documents-modal-ldec').text(client.juridiction.libelle);
                    jQuery('.set-signed-documents-modal-lr').text(lr);
                    jQuery('.set-signed-documents-modal-dl-lnk').attr('href', "{{ route('certificat.download.pdf') }}?n="+client.certificat);
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
                jQuery('.modal-retry-btn').attr('onclick','setSignedDocuments("'+nd+'", "'+t+'")');
            }
        });
    }
</script>
