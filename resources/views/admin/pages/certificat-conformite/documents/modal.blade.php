<div class="modal fade" id="check-documents-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-primary panel-alt modal-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-paperclip mr10"></i>Documents justificatifs de la demande N°<b><span class="check-documents-modal-nd">XXXXXXXXXX</span></b></h3>
                    <p>
                        Veuillez vous assurer de la conformité des informations des documents ci-dessous avec les informations de la demande de ce client : <br/><br/>
                        Numéro NNI ou CNI : <b><span class="check-documents-modal-nni-or-cni">XXXXXXXXXX</span></b><br/>
                        Nom complet : <b><span class="check-documents-modal-nc">XXXXXXXXXX</span></b><br/>
                        Nom complet sur la décision : <b><span class="check-documents-modal-ncd">XXXXXXXXXX</span></b><br/>
                        Numéro décision : <b><span class="check-documents-modal-ndec">XXXXXXXXXX</span></b><br/>
                        Lieu de la décision : <b><span class="check-documents-modal-ldec">XXXXXXXXXX</span></b><br/>
                    </p>
                </div>
                <div class="panel-body editable-list-group">
                    <div>
                        <h4>Carte Nationale d'Identité : </h4>
                        <div class="check-documents-modal-cni">
                        </div>
                    </div><br/>
                    <div>
                        <h4>Décision Judiciaire : </h4>
                        <div class="check-documents-modal-decision">

                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
                </div>
            </div>
            <div class="modal-loader text-center" style="display: none">
                <br/><br/>
                Chargement des données...<br/><br/>
                <i class="fa fa-2x fa-spinner fa-spin"></i>
                <br/><br/><br/>
            </div>
            <div class="panel panel-primary panel-alt modal-error" style="display: none">
                <br/><br/>
                <div class="text-center">
                    Une erreur est survenue lors de la récupération des données...<br/><br/><span class="modal-error-message"></span><br/><br/>
                    <button type="button" class="btn btn-warning modal-retry-btn">Réessayer</button>
                </div>
                <br/><br/><br/>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
                </div>
            </div>
        </div>
    </div>
</div>
