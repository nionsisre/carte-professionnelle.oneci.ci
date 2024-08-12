<script type="text/javascript">
    {{-- Refresh Check Document Content --}}
    const refreshCheckDocumentsModal = $('#check-documents-modal');
    refreshCheckDocumentsModal.on('shown.bs.modal', function () {
        {{-- Refresh User Edit Content here --}}
    });
    function convertDate(dateString) {
        const [year, month, day] = dateString.split("-");
        const formattedMonth = (parseInt(month)).toString().padStart(2, "0");
        const formattedDay = day.toString().padStart(2, "0");

        return `${formattedDay}/${formattedMonth}/${year}`;
    }
    function checkDocuments(nd, t) {
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
            }, success: function(res){
                jQuery('.modal-loader').hide();
                jQuery('.modal-error').hide();
                jQuery('.modal-success').show();
                let customer = JSON.parse(res);
                if(customer !== null) {
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
                    {{-- URL de base en fonction de l'environnement --}}
                    const baseURL = "@if(App::environment(['staging', 'production'])){{ URL::asset('storage')."/" }}@else{{ env("APP_URL")."/storage/" }}@endif";
                    console.log(customer);
                    {{-- Décision Judiciaire --}}
                    if(customer.document_justificatif !== "") {
                        const decisionType = getFileType(customer.document_justificatif);
                        if (decisionType === 'image') {
                            jQuery('.check-documents-modal-justificatif').html('<h4><i class="fa fa-id-card mr10"></i>'+customer.customers_type_piece.libelle_piece+' chargée par le client : </h4><hr/><div><img src="' + baseURL + customer.document_justificatif + '" alt="Scan Document justificatif" style="width: 100%" /></div>');
                        } else if (decisionType === 'pdf') {
                            jQuery('.check-documents-modal-justificatif').html('<h4><i class="fa fa-id-card mr10"></i>'+customer.customers_type_piece.libelle_piece+' chargée par le client : </h4><hr/><div><embed src="' + baseURL + customer.document_justificatif + '" type="application/pdf" width="100%" height="300px" /></div>');
                        } else {
                            jQuery('.check-documents-modal-justificatif').html('<h4><i class="fa fa-id-card mr10"></i>'+customer.customers_type_piece.libelle_piece+' chargée par le client : </h4><hr/><div><p>Type de fichier non pris en charge</p></div>');
                        }
                    } else {
                        jQuery('.check-documents-modal-justificatif').html('');
                    }
                    jQuery('.check-documents-modal-td').html('&nbsp;<i class="fa fa-id-card mr5"></i>'+customer.customers_type_piece.libelle_piece);
                    jQuery('.check-documents-modal-nd').text(customer.numero_dossier);
                    jQuery('.check-documents-modal-ndde').html('&nbsp;<i class="fa fa-barcode mr5"></i>'+customer.numero_document+" ("+ convertDate(customer.date_expiration_document) +")");
                    if(customer.genre === "M") {
                        jQuery('.check-documents-modal-gndr').html('&nbsp;<i class="fa fa-mars mr5"></i> Masculin'+" ("+customer.civil_status.libelle_statut+")");
                    } else {
                        jQuery('.check-documents-modal-gndr').html('&nbsp;<i class="fa fa-venus mr5"></i> Feminin'+" ("+customer.civil_status.libelle_statut+")");
                    }
                    if(customer.nom_epouse !== "") {
                        jQuery('.check-documents-modal-nc').text(customer.prenom+" "+customer.nom+" épouse "+customer.nom_epouse);
                    } else {
                        jQuery('.check-documents-modal-nc').text(customer.prenom+" "+customer.nom);
                    }
                    jQuery('.check-documents-modal-dln').html('&nbsp;<i class="fa fa-calendar-day mr5"></i>'+convertDate(customer.date_naissance)+" à "+customer.lieu_naissance);
                    jQuery('.check-documents-modal-pnn').html('&nbsp;<i class="fa fa-map-marker-alt mr5"></i>'+customer.pays_naissance+" ("+customer.nationalite+")");
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
                jQuery('.modal-retry-btn').attr('onclick','checkDocuments("'+nd+'", "'+t+'")');
            }
        });
    }
</script>
