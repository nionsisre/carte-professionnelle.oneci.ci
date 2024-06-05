<div class="modal fade" id="set-signed-documents-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-success panel-alt modal-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-map-marker-alt mr10"></i>Certificat disponible au centre de retrait</h3>
                </div>
                <div class="panel-body editable-list-group text-center">
                    <br/><i class="fa fa-3x fa-check-circle"></i><br/><br/>
                    Le certificat de conformité de la demande N°<b><span class="set-signed-documents-modal-nd">XXXXXXXXXX</span></b> a été signé et acheminé avec succès dans le lieu de la livraison suivant :
                    <b><span class="set-signed-documents-modal-lr">XXXXXXXXXX</span></b>
                    <br/><br/>
                    <p>
                        Numéro NNI ou CNI : <b><span class="set-signed-documents-modal-nni-or-cni">XXXXXXXXXX</span></b><br/>
                        Nom complet : <b><span class="set-signed-documents-modal-nc">XXXXXXXXXX</span></b><br/>
                        Nom complet sur la décision : <b><span class="set-signed-documents-modal-ncd">XXXXXXXXXX</span></b><br/>
                        Numéro décision : <b><span class="set-signed-documents-modal-ndec">XXXXXXXXXX</span></b><br/>
                        Lieu de la décision : <b><span class="set-signed-documents-modal-ldec">XXXXXXXXXX</span></b><br/>
                    </p><br/>
                    {{--<em>NB : Un SMS a été envoyé au client afin de le notifier de la validation de sa demande. <br/><br/></em>
                    <br/>--}}<br/><br/>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Terminer</button>
                </div>
            </div>
            <div class="modal-loader text-center" style="display: none">
                <br/><br/>
                Validation de la demande en cours...<br/><br/>
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
