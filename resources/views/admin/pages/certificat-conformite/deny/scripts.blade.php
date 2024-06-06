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
        let url = "{!! route('admin.certificat.client.get', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
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
                let client = JSON.parse(res);
                if(client !== null) {
                    let nniorcni = "";
                    if(client.cni !== "") {
                        nniorcni = client.numero_cni;
                    } else {
                        nniorcni = client.nni;
                    }
                    jQuery('.deny-documents-modal-nd').text(client.numero_dossier);
                    jQuery('.deny-documents-modal-nni-or-cni').text(nniorcni);
                    jQuery('.deny-documents-modal-nc').text(client.prenom+" "+client.nom+" ("+convertDate(client.date_naissance)+") ");
                    jQuery('.deny-documents-modal-ncd').text(client.prenom_decision+" "+client.nom_decision+" ("+convertDate(client.date_naissance_decision)+") ");
                    jQuery('.deny-documents-modal-ndec').text("N°"+client.numero_decision+" du "+convertDate(client.date_decision));
                    jQuery('.deny-documents-modal-ldec').text(client.juridiction.libelle);
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
        let url = "{!! route('admin.certificat.client.get', ['numero_dossier' => '__numero_dossier__']) !!}".replace('__numero_dossier__', nd);
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
                let client = JSON.parse(res);
                if(client !== null) {
                    jQuery('#deny-documents-modal').modal("hide");
                    let nniorcni = "";
                    if(client.cni !== "") {
                        nniorcni = client.numero_cni;
                    } else {
                        nniorcni = client.nni;
                    }
                    jQuery('.deny-documents-modal-nd').text(client.numero_dossier);
                    jQuery('.deny-documents-modal-nni-or-cni').text(nniorcni);
                    jQuery('.deny-documents-modal-nc').text(client.prenom+" "+client.nom+" ("+convertDate(client.date_naissance)+") ");
                    jQuery('.deny-documents-modal-ncd').text(client.prenom_decision+" "+client.nom_decision+" ("+convertDate(client.date_naissance_decision)+") ");
                    jQuery('.deny-documents-modal-ndec').text("N°"+client.numero_decision+" du "+convertDate(client.date_decision));
                    jQuery('.deny-documents-modal-ldec').text(client.juridiction.libelle);
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
