<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin: 1em 0">
            <span>Filtrer <i class="fa fa-filter align-middle ml-1"></i></span>
        </div>
        <div class="form-group col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <select class="good-select form-control" id="statut-demande" style="width: 100%;">
                <option value="0">Toutes les demandes</option>
                <option value="1">Demandes inachevées (non-payées)</option>
                <option value="2">Documents en attente de vérification</option>
                <option value="3">Demandes validées</option>
                <option value="4">Demandes refusées</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <select class="good-select form-control" id="lieux-livraison" style="width: 100%;">
                <option value="0">Tous les lieux de livraison</option>
                @foreach($centres as $centre)
                    <option value="{{ $centre->code_unique_centre }}">{{ ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label)) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <!--<label class="col control-label" style="margin-top: 10px;">Rechercher&nbsp;: </label>-->
        <div style="display: inline-flex">
            <input type="text" id="table-search-text" name="table-search" required maxlength="50" class="form-control" placeholder="Rechercher une demande..." style="width: 18em;" />
            <button id="btn-table-search" class="btn btn-dark"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>
<div class="table-responsive" style="width: 100%;margin-bottom: 15px;overflow-x: auto;overflow-y: hidden;
        -webkit-overflow-scrolling: touch;-ms-overflow-style: -ms-autohiding-scrollbar;border: 1px solid #ddd;">
    <table class="table table-dark my-datatable col-xs-12 col-sm-12 col-md-12 col-lg-12 mb30" >
        <thead>
            <tr>
                <th>#</th>
                <th>Lieu de la livraison</th>
                <th>Numéro de la demande</th>
                <th>Numéro NNI / CNI</th>
                <th>Nom complet</th>
                <th>Nom complet de la mère</th>
                <th>Nom complet sur la décision</th>
                <th>Numéro décision</th>
                <th>Lieu de décision</th>
                <th>Statut de la demande</th>
                <th>Date de la demande</th>
                <th>Documents Justificatifs</th>
                <th>Observation(s)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div id="loader" style="display:none;" align="center">
        <br/><br/><i class="fa fa-2x fa-spinner fa-spin"></i><br/><br/><br/>
    </div>
</div>
