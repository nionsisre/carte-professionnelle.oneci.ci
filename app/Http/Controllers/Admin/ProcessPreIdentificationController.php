<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Http\Services\NGSerAPI;
use App\Http\Services\SMS;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use App\Models\Customer;
use App\Models\CustomersStatut;
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
class ProcessPreIdentificationController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function show() {

        $username = auth()->user()->last_name.' '.auth()->user()->first_name;
        $max_chars = 35;
        $username = (strlen($username) < $max_chars) ? $username : substr($username,0,($max_chars-3))."...";

        $data_columns = Schema::getColumnListing((new Customer())->getTable());
        $centres = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->get();

        /* Retourner vue Traitement des demandes de certificat de conformité */
        return view('admin.pages.pre-identification.index', [
            'username' => $username,
            'role_name' => auth()->user()->usersRole->user_role_label,
            'columns' => $data_columns,
            'statuses' => CustomersStatut::all(),
            'centres' => $centres
        ]);

    }

    public function showDatatablesFrench() {
        return file_get_contents(base_path('resources/data/datatables/French.json'));
    }

    public function getClient(Request $request) {

        if ($request->ajax()) {
            $data = Customer::with('civilStatus')->with('customersStatut')->with('customersTypePiece')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('numero_dossier', function($row){
                    if(!empty($row->nni)) {
                        return $row->nni;
                    } else if(!empty($row->numero_dossier)) {
                        return $row->numero_dossier;
                    } else {
                        return "";
                    }
                })
                ->addColumn('date_demande', function($row){
                    return date('d/m/Y H:i:s', strtotime($row->created_at));
                })
                ->addColumn('pseudonyme', function($row){
                    return $row->pseudonyme;
                })
                ->addColumn('nom_complet', function($row){
                    if(!empty($row->nom_epouse)) {
                        return ucwords(strtolower($row->prenom)).' '.strtoupper($row->nom).' épouse '.$row->nom_epouse;
                    } else {
                        return ucwords(strtolower($row->prenom)).' '.strtoupper($row->nom);
                    }
                })
                ->addColumn('date_lieu_naissance', function($row){
                    return date('d/m/Y', strtotime($row->date_naissance)).' à '.$row->lieu_naissance;
                })
                ->addColumn('pays_naissance', function($row){
                    return $row->pays_naissance;
                })
                ->addColumn('nationalite', function($row){
                    return $row->nationalite;
                })
                ->addColumn('situation_matrimoniale', function($row){
                    return $row->civilStatus->libelle_statut;
                })
                ->addColumn('nombre_enfants', function($row){
                    return $row->nombre_enfants;
                })
                ->addColumn('autre_activite', function($row){
                    return $row->autre_activite;
                })
                ->addColumn('ville_commune_quartier', function($row){
                    return ucwords(strtolower($row->ville)).', '.ucwords(strtolower($row->commune)).', '.ucwords(strtolower($row->quartier));
                })
                ->addColumn('adresse', function($row){
                    return $row->adresse;
                })
                ->addColumn('lieu_travail', function($row){
                    return $row->lieu_travail;
                })
                ->addColumn('msisdn', function($row){
                    return $row->msisdn;
                })
                ->addColumn('statut_id', function($row){
                    return $row->customersStatut->id;
                })
                ->addColumn('statut_demande', function($row){
                    return '<span class="label label-default"><i class="fa fa-'.$row->customersStatut->icone.'"></i> &nbsp; '.$row->customersStatut->libelle_statut.'</span>';
                })
                ->addColumn('type_document_justificatif', function($row){
                    return '<i class="fa fa-id-card"></i> &nbsp; '.$row->customersTypePiece->libelle_piece;
                })
                ->addColumn('documents_justificatifs', function($row){
                    return '<button data-placement="bottom" data-toggle="modal" data-target="#check-documents-modal" class="btn btn-darkblue btn-sm" onclick="checkDocuments(\''.$row->numero_dossier.'\',\''.md5(date('Ymd').$row->numero_dossier.env('APP_KEY').'1').'\')"><i class="fa fa-paperclip mr10"></i>Voir les documents</button>';
                })
                ->addColumn('observations', function($row) {
                    if(!empty($row->observation)) {
                        return $row->observation;
                    }
                    return '';
                })
                ->addColumn('action', function($row){
                    $actionBtn = "";
                    $centre = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->where('code_unique_centre','=',$row->code_lieu_retrait)->first();
                    if($centre) {
                        $lieu_livraison = ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label));
                    } else {
                        $lieu_livraison = 'Non-renseigné';
                    }
                    if($row->customersStatut->id == 1) { // Demandes inachevées (non-payées)
                        $actionBtn = '<a href="'.route('pre-identification.consultation.submit.get').'?f='.$row->numero_dossier.'&t='.$row->uniqid.'" class="btn btn-success approve-documents-modal-dl-lnk"><i class="fa fa-money-check mr10"></i>Payer depuis l\'espace client</a>';
                    } else if($row->customersStatut->id == 2) { // Documents en attente de vérification
                        $actionBtn = '
                            <button data-placement="bottom" data-toggle="modal" data-target="#approve-documents-modal" class="btn btn-success btn-xs mb5"  onclick="approveDocuments(\''.$row->numero_dossier.'\',\''.md5(date('Ymd').$row->numero_dossier.env('APP_KEY').'2').'\',\''.$lieu_livraison.'\')"><i class="fa fa-file-check mr10"></i>Valider les documents</button><br/>
                            <button data-placement="bottom" data-toggle="modal" data-target="#deny-documents-modal" class="btn btn-danger btn-xs" onclick="denyDocuments(\''.$row->numero_dossier.'\',\''.md5(date('Ymd').$row->numero_dossier.env('APP_KEY').'3').'\')"><i class="fa fa-file-times mr10"></i>Refuser les documents</button>
                        ';
                    } else if($row->customersStatut->id == 3) { // Demande refusée
                        $actionBtn = "Demande refusée";
                    } else if($row->customersStatut->id == 4) { // Fiche de pré-enrôlement disponible
                        $actionBtn = '
                            <a href="'.route('pre-identification.download.pdf').'?n='.$row->certificate_download_link.'" class="btn btn-default btn-xs mb5 approve-documents-modal-dl-lnk"><i class="fa fa-file-certificate mr10"></i> Re-télécharger la fiche de pré-identification '.env('APP_NAME').'</a><br/>
                        ';
                    } else if($row->customersStatut->id == 5) { // Fiche de pré-enrôlement disponible avec déclaration requise
                        $actionBtn = '
                            <a href="'.route('pre-identification.download.pdf').'?n='.$row->certificate_download_link.'" class="btn btn-default btn-xs mb5 approve-documents-modal-dl-lnk"><i class="fa fa-file-certificate mr10"></i> Re-télécharger la fiche de pré-identification '.env('APP_NAME').'</a><br/>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['statut_demande','type_document_justificatif','documents_justificatifs','action'])
                ->make(true);
        }

    }

    public function getClientByNumeroDossier(Request $request, $numero_dossier) {
        request()->validate([
            'cli' => ['required', 'string', 'max:150'],
            'c' => ['required', 'string', 'max:150'],
            't' => ['required', 'string', 'max:150']
        ]);
        $client = Customer::with('civilStatus')->with('customersStatut')->with('customersTypePiece')->where('numero_dossier', '=', $numero_dossier)->first();
        if(
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'1')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'2')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'3'))
        ) {
            return json_encode($client);
        }
        return false;
    }

    public function approveClientByNumeroDossier(Request $request, $numero_dossier) {
        request()->validate([
            'cli' => ['required', 'string', 'max:150'],
            'c' => ['required', 'string', 'max:150'],
            't' => ['required', 'string', 'max:150']
        ]);
        $client = Customer::with('civilStatus')->with('customersStatut')->with('customersTypePiece')->where('numero_dossier', '=', $numero_dossier)->first();
        if(
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'1')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'2')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'3'))
        ) {
            $client->customersStatut->id = 4;
            $client->save();
            (new SMS)->sendSMS(
                $client->msisdn,
                "M(Mme) ".$client->nom.", vos documents justificatifs de votre demande N°".$client->numero_dossier." de pré-enrôlement ".strtolower(env('APP_NAME'))." ont été approuvés avec succès. Vous pouvez maintenant télécharger votre fiche de pré-enrôlement à l'adresse suivante : ".route('pre-identification.consultation.submit.get').'?f='.session()->get('customer')->numero_dossier.'&t='.session()->get('customer')->uniqid,
            );
            return json_encode($client);
        }
        return false;
    }

    public function denyClientByNumeroDossier(Request $request, $numero_dossier) {
        request()->validate([
            'cli' => ['required', 'string', 'max:150'],
            'c' => ['required', 'string', 'max:150'],
            'obs' => ['nullable', 'string', 'max:150'],
            't' => ['required', 'string', 'max:150']
        ]);
        $client = Customer::with('civilStatus')->with('customersStatut')->with('customersTypePiece')->where('numero_dossier', '=', $numero_dossier)->first();
        if(
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'1')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'2')) ||
            ($request->input('t') === md5(date('Ymd').$numero_dossier.env('APP_KEY').'3'))
        ) {
            if(!empty(request()->input('obs'))) {
                (new SMS)->sendSMS(
                    $client->msisdn,
                    "M(Mme) ".$client->nom.", votre demande de certificat de conformité N°".$client->numero_dossier." a été rejetée pour le motif suivant : ".$request->input('obs'),
                );
            } else {
                (new SMS)->sendSMS(
                    $client->msisdn,
                    "M(Mme) ".$client->nom.", votre demande de certificat de conformité N°".$client->numero_dossier." a été rejetée par l'ONECI",
                );
            }
            $client->customersStatut->id = 3;
            $client->observation = $request->input('obs');
            $client->save();
            return json_encode($client);
        }
        return false;
    }

}
