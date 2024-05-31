<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group col-xs-3 col-sm-3 col-md-2 col-lg-2" style="margin: 1em 0">
            <span>Filtrer <i class="fa fa-filter align-middle ml-1"></i></span>
        </div>
        <div class="form-group col-xs-9 col-sm-9 col-md-10 col-lg-10">
            <select class="good-select form-control" id="accounts-status" style="width: 100%;">
                <option value="0">Toutes les demandes</option>
                <option value="1">Demandes inachevées (non-payées)</option>
                <option value="2">Documents en attente de vérification</option>
                <option value="3">Demandes validées</option>
                <option value="4">Demandes refusées</option>
            </select>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <!--<label class="col control-label" style="margin-top: 10px;">Rechercher&nbsp;: </label>-->
        <div style="display: inline-flex">
            <input type="text" id="table-search-text" name="table-search" required maxlength="50" class="form-control" placeholder="Rechercher une demande..." style="width: 35vw;" />
            <button id="btn-table-search" class="btn btn-dark"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>
<div class="table-responsive" style="width: 100%;margin-bottom: 15px;overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;border: 1px solid #ddd;">
    <table class="table table-dark col-xs-12 col-sm-12 col-md-12 col-lg-12 mb30" >
        <thead>
        <tr>
            <th>#</th>
            <th>Numéro de la demande</th>
            <th>Numéro NNI / CNI</th>
            <th>Nom complet</th>
            <th>Date de naissance</th>
            <th>Nom complet de la mère</th>
            <th>Nom complet sur la décision</th>
            <th>Date de naissance sur la décision</th>
            <th>Numéro décision</th>
            <th>Date de décision</th>
            <th>Lieu de décision</th>
            <th>Statut de la demande</th>
            <th>Date de la demande</th>
            <th>Documents Justificatifs</th>
            <th>Observation(s)</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="users_list">
        <tr class="glow-user-tr">
            <td>1</td>
            <td>Numéro de la demande</td>
            <td>Numéro NNI / CNI</td>
            <td>Nom complet</td>
            <td>Date de naissance</td>
            <td>Nom complet de la mère</td>
            <td>Nom complet sur la décision</td>
            <td>Date de naissance sur la décision</td>
            <td>Numéro décision</td>
            <td>Date de décision</td>
            <td>Lieu de décision</td>
            <td>Statut de la demande</td>
            <td>Date de la demande</td>
            <td>Documents Justificatifs</td>
            <td>Observation(s)</td>
            <td class="table-action col-sm-2">
                <button title="Editer le compte" onclick="" data-placement="bottom" data-toggle="modal" data-target="#edit-user" class="btn btn-sm btn-primary tooltips modal-pop" type="button">
                    <i class="fa fa-user-edit"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <div align="center" id="pagination-container" style="margin: 2em;">
        <button title="Page 1" class="btn btn-sm btn-darkblue" type="button" onclick="" style="margin: 0.2em">1</button>
    </div>
    <div id="loader_here"></div>
</div>
