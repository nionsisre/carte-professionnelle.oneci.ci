<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin: 1em 0">
            <span>Filtrer <i class="fa fa-filter align-middle ml-1"></i></span>
        </div>
        <div class="form-group col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <select class="good-select form-control" id="statut-demande" style="width: 100%;">
                <option value="">Toutes les demandes</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->libelle_statut }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="margin-top: 0.8em;">
                <span id="total-rows" class="label label-default">0</span>
            </div>
            <select class="good-select form-control col-xs-10 col-sm-10 col-md-10 col-lg-10" id="lieux-livraison">
                <option value="">Tous les lieux de livraison</option>
                @foreach($centres as $centre)
                    @if($centre->code_unique_centre !== "AB0301030102")
                        <option value="{{ $centre->code_unique_centre }}">{{ ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label)) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>--}}
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
                <th>Numéro de la demande</th>
                <th>Date de la demande</th>
                <th>Pseudonyme</th>
                <th>Nom complet</th>
                <th>Date et lieu de naissance</th>
                <th>Pays de naissance</th>
                <th>Nationalité</th>
                <th>Situation matrimoniale</th>
                <th>Nombre d'enfants</th>
                <th>Autres activités</th>
                <th>Ville, Commune, Quartier</th>
                <th>Adresse</th>
                <th>Lieu de travail</th>
                <th>Numéro de téléphone</th>
                <th>Statut ID de la demande</th>
                <th>Statut de la demande</th>
                <th>Type de document</th>
                <th>Documents Justificatifs</th>
                <th>Actions</th>
                <th>Observation(s)</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div id="loader" style="display:none;" align="center">
        <br/><br/><i class="fa fa-2x fa-spinner fa-spin"></i><br/><br/><br/>
    </div>
</div>
