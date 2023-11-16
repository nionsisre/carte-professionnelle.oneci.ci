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
     * Obtention de la liste des agences de l'ONECI en fonction des habilitations et du code de centre unique de l'utilisateur<br/><br/>
     * <b>Response</b> getAgenciesList(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    function getAgenciesList(Request $request) {
        /* Récupérer les données JSON soumises */
        $jsonData = $request->json()->all();
        /* Valider les variables de l'API */
        $validator = Validator::make($jsonData, [
            'role_id' => ['required'], // Role id
            'zone_code' => ['nullable', 'string'], // Zone Code
            'uid' => ['required', 'string'], // Uid
            'login' => ['required', 'string'], // Login
            'status_id' => ['required'], // Status ID
            'monitored' => ['required'], // isMonitored
        ]);
        if (!$validator->fails()) {
            /* Accéder aux variables soumises dans le corps JSON */
            $zone_code = $jsonData['zone_code'];
            /* Obtention des informations sur l'utilisateur */
            $centre_list = (!empty($zone_code) && $zone_code !== "null") ?
                DB::table('stats_centres_et_codifications')
                ->select('*')
                ->where('code_unique_centre', 'LIKE', $zone_code)
                ->orderByDesc('id')
                ->get()
            :
                DB::table('stats_centres_et_codifications')
                    ->select('*')
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
                    'message' => 'Erreur Interne'
                ], Response::HTTP_OK);
            }
        }
        return response([
            'has_error' => true,
            'message' => $validator->errors()->all()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Obtention des données statistiques selon la date ou la période<br/><br/>
     * <b>Response</b> getReport(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    function getReport(Request $request) {
        /* Récupérer les données JSON soumises */
        $jsonData = $request->json()->all();
        /* Valider les variables de l'API */
        $validator = Validator::make($jsonData, [
            'user_uid' => ['required', 'string', 'max:100'], // Uid
            'code_unique_centre' => ['nullable', 'string', 'max:20'], // Code Unique Centre
            'selected_date' => ['required', 'string', 'max:20'], // Uid
            'selected_date2' => ['nullable', 'string'] // Login
        ]);
        if (!$validator->fails()) {
            /* Accéder aux variables soumises dans le corps JSON */
            $code_unique_centre = $jsonData['code_unique_centre'];
            /* Obtention des informations sur l'utilisateur */
            $centre_list = (!empty($code_unique_centre) && $code_unique_centre !== "null") ?
                DB::table('stats_centres_et_codifications')
                    ->select('*')
                    ->where('code_unique_centre', 'LIKE', $code_unique_centre)
                    ->orderByDesc('id')
                    ->get()
                :
                DB::table('stats_centres_et_codifications')
                    ->select('*')
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
                    'message' => 'Erreur Interne'
                ], Response::HTTP_OK);
            }
        }
        return response([
            'has_error' => true,
            'message' => $validator->errors()->all()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
