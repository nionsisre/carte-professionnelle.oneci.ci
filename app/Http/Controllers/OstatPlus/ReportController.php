<?php

namespace App\Http\Controllers\OstatPlus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    ostat-plus
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class ReportController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Téléchargement du certificat d'identification au format PDF<br/><br/>
     * <b>Response</b> userAppLogin(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    function getAgenciesList(Request $request) {
        /* Récupérer les données JSON soumises */
        $jsonData = $request->json()->all();
        /* Valider les variables de l'API */
        $validator = Validator::make($jsonData, [
            'role_id' => ['required', 'string'], // Role id
            'user_role_label' => ['required', 'string'], // Role Label
            'zone_code' => ['required', 'string'], // Zone Code
            'uid' => ['required', 'string'], // Uid
            'login' => ['required', 'string'], // Login
            'status_id' => ['required', 'string'], // Status ID
            'monitored' => ['required', 'string'], // isMonitored
            'first_name' => ['required', 'string'], // First Name
            'last_name' => ['required', 'string'], // Last Name
            'phone_number' => ['required', 'string'], // Phone Number
            'phone_number_2' => ['required', 'string'], // Phone Number 2
            'phone_number_3' => ['required', 'string'], // Phone Number 3
            'email' => ['required', 'string'], // Email
            'creation_date' => ['required'], // Created At
            'update_date' => ['required'], // Updated At
        ]);
        if (!$validator->fails()) {
            /* Accéder aux variables soumises dans le corps JSON */
            $zone_code = $jsonData['zone_code'];
            /* Obtention des informations sur l'utilisateur */
            $centre_list = DB::table('stats_centres_et_codifications')
                ->select('*')
                ->where('code_unique_centre', 'LIKE', $zone_code)
                ->orderByDesc('id')
                ->get();
            if (!empty($centre_list)) {
                return response([
                    'has_error' => false,
                    'message' => 'Ok',
                    'data' => $centre_list
                ], Response::HTTP_OK);
            } else {
                return response([
                    'has_error' => true,
                    'message' => 'Erreur Interne',
                    'data' => []
                ], Response::HTTP_OK);
            }
        }
        return response(['errors' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
