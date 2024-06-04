<script type="text/javascript">
    {{-- Refresh Check Document Content --}}
    const refreshUserEditContent = $('#check-documents-modal');
    refreshUserEditContent.on('shown.bs.modal', function () {
        {{-- Refresh User Edit Content here --}}
    });
    function checkDocuments(nd, t) {
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
            }, success: function(res){
                jQuery('.modal-loader').hide();
                jQuery('.modal-error').hide();
                jQuery('.modal-success').show();
                let client = JSON.parse(res);
                if(client !== null) {
                    {{-- Fonction pour déterminer le type de fichier en fonction de l'extension --}}
                    function getFileType(fileName) {
                        const extension = fileName.split('.').pop().toLowerCase();
                        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
                        if (imageExtensions.includes(extension)) {
                            return 'image';
                        } else if (extension === 'pdf') {
                            return 'pdf';
                        } else {
                            return 'unknown';
                        }
                    }
                    console.log(client);
                    {{-- URL de base en fonction de l'environnement --}}
                    const baseURL = "@if(App::environment(['staging', 'production'])){{ URL::asset('storage')."/" }}@else{{ "https://certificat-conformite.oneci.ci/storage/" }}@endif";
                    {{-- CNI --}}
                    let nniorcni = "";
                    if(client.cni !== "") {
                        nniorcni = client.numero_cni;
                        const cniType = getFileType(client.cni);
                        if (cniType === 'image') {
                            jQuery('.check-documents-modal-cni').html('<img src="' + baseURL + client.cni + '" alt="Scan CNI" style="width: 100%" />');
                        } else if (cniType === 'pdf') {
                            jQuery('.check-documents-modal-cni').html('<embed src="' + baseURL + client.cni + '" type="application/pdf" width="100%" height="300px" />');
                        } else {
                            jQuery('.check-documents-modal-cni').html('<p>Type de fichier non pris en charge</p>');
                        }
                    } else {
                        nniorcni = client.nni;
                    }
                    {{-- Décision Judiciaire --}}
                    if(client.decision_judiciaire !== "") {
                        const decisionType = getFileType(client.decision_judiciaire);
                        if (decisionType === 'image') {
                            jQuery('.check-documents-modal-decision').html('<img src="' + baseURL + client.decision_judiciaire + '" alt="Scan Décision Judiciaire" style="width: 100%" />');
                        } else if (decisionType === 'pdf') {
                            jQuery('.check-documents-modal-decision').html('<embed src="' + baseURL + client.decision_judiciaire + '" type="application/pdf" width="100%" height="300px" />');
                        } else {
                            jQuery('.check-documents-modal-decision').html('<p>Type de fichier non pris en charge</p>');
                        }
                    }
                    jQuery('.check-documents-modal-nd').text(client.numero_dossier);
                    jQuery('.check-documents-modal-nni-or-cni').text(nniorcni);
                    jQuery('.check-documents-modal-nc').text(client.prenom+" "+client.nom+" ("+client.date_naissance+") ");
                    jQuery('.check-documents-modal-ncd').text(client.prenom_decision+" "+client.nom_decision+" ("+client.date_naissance_decision+") ");
                    jQuery('.check-documents-modal-ndec').text("N°"+client.numero_decision+" du "+client.date_decision);
                    jQuery('.check-documents-modal-ldec').text(client.juridiction.libelle);
                }
            }, error: function (data) {
                jQuery('.modal-loader').hide();
                jQuery('.modal-success').hide();
                jQuery('.modal-error').show();
                jQuery('.modal-error-message').text('Code d\'erreur : '+data.status);
                jQuery('.modal-retry-btn').attr('onclick','checkDocuments("'+nd+'", "'+t+'")');
            }
        });
    }
</script>
