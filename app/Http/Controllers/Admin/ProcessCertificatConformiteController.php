<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Http\Services\NGSerAPI;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use App\Models\Client;
use App\Models\DirecteurGeneral;
use App\Models\Juridiction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    certificat-conformite
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class ProcessCertificatConformiteController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function show() {

        $username = auth()->user()->last_name.' '.auth()->user()->first_name;
        $max_chars = 35;
        $username = (strlen($username) < $max_chars) ? $username : substr($username,0,($max_chars-3))."...";

        $data_columns = Schema::getColumnListing((new Client())->getTable());
        $centres = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->get();

        /* Retourner vue Traitement des demandes de certificat de conformité */
        return view('admin.pages.certificat-conformite.index', [
            'username' => $username,
            'role_name' => auth()->user()->usersRole->user_role_label,
            'columns' => $data_columns,
            'centres' => $centres
        ]);

    }

    public function showDatatablesFrench() {
        return file_get_contents(base_path('resources/data/datatables/French.json'));
    }

    public function getClient(Request $request) {

        if ($request->ajax()) {
            $data = Client::with('juridiction')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lieu_livraison', function($row){
                    if(!empty($row->code_lieu_retrait)) {
                        $centre = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->where('code_unique_centre','=',$row->code_lieu_retrait)->first();
                        return ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label));
                    } else {
                        return "";
                    }
                })
                ->addColumn('numero_cni_nni', function($row){
                    if(!empty($row->nni)) {
                        return $row->nni;
                    } else if(!empty($row->numero_cni)) {
                        return $row->numero_cni;
                    } else {
                        return "";
                    }
                })
                ->addColumn('nom_complet', function($row){
                    return ucwords(strtolower($row->prenom)).' '.strtoupper($row->nom).' ('.date('d/m/Y', strtotime($row->date_naissance)).') ';
                })
                ->addColumn('nom_complet_mere', function($row){
                    return ucwords(strtolower($row->prenom_mere)).' '.strtoupper($row->nom_mere);
                })
                ->addColumn('nom_complet_decision', function($row){
                    return ucwords(strtolower($row->prenom_decision)).' '.strtoupper($row->nom_decision).' ('.date('d/m/Y', strtotime($row->date_naissance_decision)).') ';
                })
                ->addColumn('numero_date_decision', function($row){
                    return 'N°'.$row->numero_decision.' du '.date('d/m/Y', strtotime($row->date_decision));
                })
                ->addColumn('lieu_decision', function($row){
                    return $row->juridiction->libelle;
                })
                ->addColumn('statut_demande', function($row){
                    switch ($row->statut) {
                        case 1:
                            return '<span class="label label-warning">Demande inachevée (non-payée)</span>';
                        case 2:
                            return '<span class="label label-default">Documents en attente de vérification</span>';
                        case 3:
                            return '<span class="label label-primary">Documents acceptés (en attente de signature)</span>';
                        case 4:
                            return '<span class="label label-danger">Documents refusés</span>';
                        case 5:
                            return '<span class="label label-success">Certificat disponible dans le centre</span>';
                    }
                })
                ->addColumn('date_demande', function($row){
                    return date('d/m/Y H:i:s', strtotime($row->created_at));
                })
                ->addColumn('documents_justificatifs', function($row){
                    return '<button class="btn btn-darkblue btn-sm"><i class="fa fa-paperclip mr10"></i>Voir les documents</button>';
                })
                ->addColumn('observations', function($row){
                    return '';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <button class="btn btn-success btn-xs mb5"><i class="fa fa-check mr10"></i> Valider les documents</button><br/>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-times mr10"></i> Refuser les documents</button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['statut_demande','documents_justificatifs','action'])
                ->make(true);
        }

    }

}
