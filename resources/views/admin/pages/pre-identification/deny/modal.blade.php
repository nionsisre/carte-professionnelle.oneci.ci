<div class="modal fade" id="deny-documents-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-danger panel-alt modal-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-times mr10"></i>Refuser les documents de la demande N°<b><span class="deny-documents-modal-nd">XXXXXXXXXX</span></b></h3>
                </div>
                <div class="panel-body editable-list-group text-center">
                    <span class="deny-documents-modal-t hidden"></span>
                    <br/><i class="fa fa-3x fa-file-times"></i><br/><br/>
                    <p>
                        Type de document justificatif : <b><span class="deny-documents-modal-td">XXXXXXXXXX</span></b><br/>
                        Numéro du document et date d'expiration : <b><span class="deny-documents-modal-ndde">XXXXXXXXXX</span></b><br/>
                        Genre : <b><span class="deny-documents-modal-gndr">XXXXXXXXXX</span></b><br/>
                        Nom complet : <b><span class="deny-documents-modal-nc">XXXXXXXXXX</span></b><br/>
                        Date et Lieu de naissance : <b><span class="deny-documents-modal-dln">XXXXXXXXXX</span></b><br/>
                        Pays de naissance et Nationalité : <b><span class="deny-documents-modal-pnn">XXXXXXXXXX</span></b><br/>
                    </p><br/>
                    Veuillez renseigner un motif ou une observation afin de confirmer le refus de la demande N°<b><span class="deny-documents-modal-nd">XXXXXXXXXX</span></b> :<br/><br/>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="text" id="deny-documents-modal-observations" class="form-control" placeholder="Motif / Observations..." maxlength="150" name="observations" style="width: 100%;text-align: center" />
                    </div><br/>&nbsp;<br/>
                    <button type="button" class="btn btn-danger deny-documents-modal-btn"><i class="fa fa-check mr10"></i>Confirmer le refus de la demande</button>
                    <br/><br/><br/>
                    <em>NB : Un SMS sera envoyé au client afin de le notifier du refus de sa demande avec le motif mentionné.<br/><br/></em>
                    <br/>
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
