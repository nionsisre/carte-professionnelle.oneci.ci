<?php

namespace App\Http\Controllers\OstatPlus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $validator = Validator::make($request->all(), [
            'uid' => ['required', 'string', 'max:100'],
            'code_unique_centre' => ['nullable', 'string', 'max:20'],
            'selected_date' => ['required', 'string', 'max:20'],
            'selected_date_2' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return response([
                'has_error' => true,
                'message' => $validator->errors()->all()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        /*$filePath = 'android_query_logs.txt';
        // Vérifier si le fichier existe déjà
        if (Storage::disk('local')->exists($filePath)) {
            // Si le fichier existe, ajouter les données à la suite
            Storage::disk('local')->append($filePath, json_encode($request->all()));
        } else {
            // Si le fichier n'existe pas, le créer et y écrire les données
            Storage::disk('local')->put($filePath, json_encode($request->all()));
        }*/

        $user_uid = $request->input('user_uid'); // pour le monitoring
        $code_unique_centre = $request->input('code_unique_centre');
        $start_date = $request->input('selected_date');
        $end_date = $request->input('selected_date_2');

        $services = DB::table('ostat_plus_services')->select('*')->get();
        $type_services = DB::table('ostat_plus_type_services')->select('*')->get();
        $reports = [];
        $id = 1;

        foreach ($services as $service) {
            foreach ($type_services as $type_service) {
                if($code_unique_centre !== "000000000000") {
                    $query = DB::table('ostat_plus_reports')
                        ->select([
                            'ostat_plus_service_id',
                            'ostat_plus_type_service_id',
                            'code_centre',
                            'date',
                            DB::raw('SUM(value) as value'),
                            'status',
                            'doer_uid',
                            'doer_name',
                            'reason',
                            'created_at',
                            'updated_at'
                        ])
                        ->where('ostat_plus_service_id', $service->id)
                        ->where('ostat_plus_type_service_id', $type_service->id)
                        ->where('code_centre', 'LIKE', $code_unique_centre . '%')
                        /*->when(!$end_date, function ($query) use ($start_date) {
                            return $query->where('date', 'LIKE', $start_date);
                        })
                        ->when($end_date, function ($query) use ($start_date, $end_date) {
                            return $query->whereBetween('date', [$start_date, $end_date]);
                        })*/
                        ->when(!$end_date, function ($query) use ($start_date) {
                            return $query->where('date', 'LIKE', $start_date);
                        })
                        ->when($end_date, function ($query) use ($start_date, $end_date) {
                            return $query->whereBetween('date', [$start_date, $end_date]);
                        });
                } else {
                    $code_unique_centre = "";
                    $query = DB::table('ostat_plus_reports')
                        ->select([
                            'ostat_plus_service_id',
                            'ostat_plus_type_service_id',
                            'code_centre',
                            'date',
                            DB::raw('SUM(value) as value'),
                            'status',
                            'doer_uid',
                            'doer_name',
                            'reason',
                            'created_at',
                            'updated_at'
                        ])
                        ->where('ostat_plus_service_id', $service->id)
                        ->where('ostat_plus_type_service_id', $type_service->id)
                        ->where('code_centre', 'LIKE', $code_unique_centre . '%')
                        /*->when(!$end_date, function ($query) use ($start_date) {
                            return $query->where('date', 'LIKE', $start_date);
                        })
                        ->when($end_date, function ($query) use ($start_date, $end_date) {
                            return $query->whereBetween('date', [$start_date, $end_date]);
                        })*/
                        ->when(!$end_date, function ($query) use ($start_date) {
                            return $query->where('date', 'LIKE', $start_date);
                        })
                        ->when($end_date, function ($query) use ($start_date, $end_date) {
                            return $query->whereBetween('date', [$start_date, $end_date]);
                        });
                }
                $query->groupBy('ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'status', 'doer_uid', 'doer_name', 'reason', 'created_at', 'updated_at');

                $query = $query->first();

                $reports[] = [
                    "id" => $id,
                    "service_name" => $service->label,
                    "type_service_name" => $type_service->label,
                    "code_centre" => $query->code_centre ?? '',
                    "date" => (!$end_date) ? $start_date : $end_date,
                    "value" => $query->value ?? 0,
                    "status" => $query->status ?? '',
                    "doer_uid" => $query->doer_uid ?? '',
                    "doer_name" => $query->doer_name ?? '',
                    "reason" => $query->reason ?? 'Non renseigné',
                    "created_at" => $query->created_at ?? '',
                    "updated_at" => $query->updated_at ?? ''
                ];

                $id++;
            }
        }

        return response([
            'has_error' => false,
            'message' => 'Ok',
            'data' => $reports
        ], Response::HTTP_OK);
    }

    function addOrEditReport(Request $request) {
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'agency.centre' => ['required', 'string', 'max:100'],
            'agency.code_unique_centre' => ['required', 'string', 'max:20'],
            'selected_date' => ['required', 'string', 'max:20'],
            'report.*.code_centre' => ['required', 'string', 'max:100'],
            'report.*.date' => ['required', 'string', 'max:20'],
            'report.*.value' => ['required', 'string', 'max:50'],
            'report.*.status' => ['nullable', 'string', 'max:100'],
            'report.*.doer_uid' => ['nullable', 'string', 'max:100'],
            'report.*.doer_name' => ['nullable', 'string', 'max:200'],
            'report.*.reason' => ['nullable', 'string', 'max:200'],
            'report.*.service_name' => ['required', 'string', 'max:100'],
            'report.*.type_service_name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response([
                'has_error' => true,
                'message' => $validator->errors()->all()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*
        $filePath = 'android_query_logs.txt';
        // Vérifier si le fichier existe déjà
        if (Storage::disk('local')->exists($filePath)) {
            // Si le fichier existe, ajouter les données à la suite
            Storage::disk('local')->append($filePath, json_encode($data));
        } else {
            // Si le fichier n'existe pas, le créer et y écrire les données
            Storage::disk('local')->put($filePath, json_encode($data));
        }*/

        foreach ($data['report'] as $item) {
            $user = DB::table('users')->where('uid', $item['doer_uid'])->first();
            $service = DB::table('ostat_plus_services')->where('label', $item['service_name'])->first();
            $type_service = DB::table('ostat_plus_type_services')->where('label', $item['type_service_name'])->first();

            $existingRecord = DB::table('ostat_plus_reports')
                ->where('date', $item['date'])
                ->where('code_centre', $item['code_centre'])
                ->where('ostat_plus_service_id', $service->id ?? null)
                ->where('ostat_plus_type_service_id', $type_service->id ?? null)
                ->first();

            if ($existingRecord) {
                // Mise à jour de l'enregistrement existant
                DB::table('ostat_plus_reports')
                    ->where('date', $item['date'])
                    ->where('code_centre', $item['code_centre'])
                    ->where('ostat_plus_service_id', $service->id ?? null)
                    ->where('ostat_plus_type_service_id', $type_service->id ?? null)
                    ->update([
                        'value' => $item['value'],
                        'status' => $item['status'],
                        'doer_uid' => $item['doer_uid'] ?? '',
                        'doer_name' => $user ? $user->last_name . ' ' . $user->first_name : '',
                        'reason' => $user ? "Données publiées par ".$user->last_name . ' ' . $user->first_name .' le '.date('d/m/Y').' à '.date('H:i:s') : '',
                        //'reason' => $item['reason'],
                        'updated_at' => now()
                    ]);
            } else {
                // Insertion d'un nouvel enregistrement
                DB::table('ostat_plus_reports')->insert([
                    'ostat_plus_service_id' => $service ? $service->id : null,
                    'ostat_plus_type_service_id' => $type_service ? $type_service->id : null,
                    'code_centre' => $item['code_centre'],
                    'date' => $item['date'],
                    'value' => $item['value'],
                    'status' => $item['value'],
                    'doer_uid' => $item['doer_uid'] ?? '',
                    'doer_name' => $user ? $user->last_name . ' ' . $user->first_name : '',
                    'reason' => $user ? "Données publiées par ".$user->last_name . ' ' . $user->first_name .' le '.date('d/m/Y').' à '.date('H:i:s') : '',
                    //'reason' => $item['reason'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return response([
            'has_error' => false,
            'message' => 'Données mises à jour avec succès !'
        ], Response::HTTP_OK);
    }


}
