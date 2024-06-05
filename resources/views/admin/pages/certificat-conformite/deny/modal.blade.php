<div class="modal fade" id="deny-documents-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-danger panel-alt modal-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-times mr10"></i>Refuser les documents de la demande N°<b><span class="deny-documents-modal-nd">XXXXXXXXXX</span></b></h3>
                </div>
                <div class="panel-body editable-list-group text-center">
                    <br/><i class="fa fa-3x fa-file-times"></i><br/><br/>
                    <p>
                        Numéro NNI ou CNI : <b><span class="deny-documents-modal-nni-or-cni">XXXXXXXXXX</span></b><br/>
                        Nom complet : <b><span class="deny-documents-modal-nc">XXXXXXXXXX</span></b><br/>
                        Nom complet sur la décision : <b><span class="deny-documents-modal-ncd">XXXXXXXXXX</span></b><br/>
                        Numéro décision : <b><span class="deny-documents-modal-ndec">XXXXXXXXXX</span></b><br/>
                        Lieu de la décision : <b><span class="deny-documents-modal-ldec">XXXXXXXXXX</span></b><br/>
                    </p><br/>
                    Veuillez renseigner un motif ou une observation afin de confirmer le refus de la demande N°<b><span class="deny-documents-modal-nd">XXXXXXXXXX</span></b> :<br/><br/>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="text" id="deny-documents-modal-observations" class="form-control" placeholder="Motif / Observations..." maxlength="150" name="observations" style="width: 100%;text-align: center" />
                    </div><br/>&nbsp;<br/>
                    <button type="button" class="btn btn-danger"><i class="fa fa-check mr10"></i>Confirmer le refus de la demande N°<span class="deny-documents-modal-nd">XXXXXXXXXX</span></button>
                    <br/>
                    <div class="deny-documents-modal-decision">
                    </div><br/><br/>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-undo mr10"></i>Annuler</button>
                </div>
            </div>
            <div class="modal-loader text-center" style="display: none">
                <br/><br/>
                Refus de la demande en cours...<br/><br/>
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
