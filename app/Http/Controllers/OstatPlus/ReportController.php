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
    /*function getReport(Request $request) {
        // Valider les variables de l'API
        $validator = Validator::make($request->all(), [
            'uid' => ['required', 'string', 'max:100'], // Uid
            'code_unique_centre' => ['nullable', 'string', 'max:20'], // Code Unique Centre
            'selected_date' => ['required', 'string', 'max:20'], // Uid
            'selected_date_2' => ['nullable', 'string'] // Login
        ]);
        if (!$validator->fails()) {
            // Accéder aux variables soumises
            $user_uid = $request->input('user_uid');
            $code_unique_centre = $request->input('code_unique_centre');
            $start_date = date('Y-m-d', strtotime($request->input('selected_date')." 00:00:00"));
            $end_date = date('Y-m-d', strtotime($request->input('selected_date2')." 00:00:00"));
            // Obtention des données du jour
            $services = DB::table('ostat_plus_services')
                ->select('*')
                ->get();
            $type_services = DB::table('ostat_plus_type_services')
                ->select('*')
                ->get();
            $reports = [];
            foreach ($services as $indexService => $service) {
                foreach ($type_services as $indexTypeService => $type_service) {
                    if (!empty($code_unique_centre) && $code_unique_centre !== "null") {
                        if(empty($end_date)) {
                            $query = DB::table('ostat_plus_reports')
                                ->select(['ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'value', 'status', 'reason', 'created_at', 'updated_at'])
                                ->where('ostat_plus_service_id',$service->id)
                                ->where('ostat_plus_type_service_id',$type_service->id)
                                ->where('code_centre','LIKE',$code_unique_centre.'%')
                                ->where('date','LIKE',$start_date)
                                ->first();
                        } else {
                            $query = DB::table('ostat_plus_reports')
                                ->select(['ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'SUM(value) value', 'status', 'reason', 'created_at', 'updated_at'])
                                ->where('ostat_plus_service_id',$service->id)
                                ->where('ostat_plus_type_service_id',$type_service->id)
                                ->where('code_centre','LIKE',$code_unique_centre.'%')
                                ->whereBetween('DATE(date)', ['DATE('.$start_date.')', 'DATE('.$end_date.')'])
                                ->groupBy('SUM(value)')
                                ->first();
                        }
                    } else {
                        if(empty($end_date)) {
                            $query = DB::table('ostat_plus_reports')
                                ->select(['ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'SUM(value) value', 'status', 'reason', 'created_at', 'updated_at'])
                                ->where('date','LIKE',$start_date)
                                ->first();
                        } else {
                            $query = DB::table('ostat_plus_reports')
                                ->select(['ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'SUM(value) value', 'status', 'reason', 'created_at', 'updated_at'])
                                ->whereBetween('DATE(date)', ['DATE('.$start_date.')', 'DATE('.$end_date.')'])
                                ->first();
                        }
                    }
                    $reports[] = array(
                        "id" => (($indexService * sizeof($type_services)) + $indexTypeService) + 1,
                        "service_name" => $service->label,
                        "type_service_name" => $type_service->label,
                        "date" => (empty($end_date)) ? $start_date : $end_date,
                        "value" => (!empty($query->value)) ? $query->value : 0,
                        "status" => $query->status,
                        "reason" => $query->reason,
                        "created_at" => $query->created_at,
                        "updated_at" => $query->updated_at
                    );
                }
            }
            if (!empty($code_unique_centre) && $code_unique_centre !== "null") {
                if(!empty($request->input('selected_date2')) && $request->input('selected_date2') !== ""  && $request->input('selected_date2') !== "null") {
                    // Date interval case
                    $reports = DB::table('ostat_plus_reports')
                        ->select(['ostat_plus_reports.id', 'ostat_plus_services.label','ostat_plus_type_services.label','ostat_plus_reports.date','SUM(ostat_plus_reports.value)','ostat_plus_reports.status','ostat_plus_reports.reason','ostat_plus_reports.created_at','ostat_plus_reports.updated_at'])
                        ->join('ostat_plus_services', 'ostat_plus_services.id', '=', 'ostat_plus_reports.ostat_plus_service_id')
                        ->join('ostat_plus_type_services', 'ostat_plus_type_services.id', '=', 'ostat_plus_reports.ostat_plus_type_service_id')
                        ->whereRaw('DATE(opr.date) BETWEEN DATE(?) AND DATE(?)', [$start_date,$end_date])
                        ->orderByDesc('ostat_plus_reports.id')
                        ->get();
                } else {
                    // One Date only
                    $reports = DB::table('ostat_plus_reports')
                        ->select(['ostat_plus_reports.id', 'ostat_plus_services.label','ostat_plus_type_services.label','ostat_plus_reports.date','ostat_plus_reports.value','ostat_plus_reports.status','ostat_plus_reports.reason','ostat_plus_reports.created_at','ostat_plus_reports.updated_at'])
                        ->join('ostat_plus_services', 'ostat_plus_services.id', '=', 'ostat_plus_reports.ostat_plus_service_id')
                        ->join('ostat_plus_type_services', 'ostat_plus_type_services.id', '=', 'ostat_plus_reports.ostat_plus_type_service_id')
                        ->where('date', 'LIKE', $code_unique_centre)
                        ->orderByDesc('ostat_plus_reports.id')
                        ->get();
                }
            } else {
                if($code_unique_centre == "000000000000") {
                    $reports = DB::table('stats_centres_et_codifications')
                        ->select('*')
                        ->orderByDesc('id')
                        ->get();
                } else {
                    $reports = "";
                }
            }
            if(!is_array($reports) || sizeof($reports) !== 0) {
                $services = DB::table('ostat_plus_services')
                    ->select('*')
                    ->get();
                $type_services = DB::table('ostat_plus_type_services')
                    ->select('*')
                    ->get();
                $reports = [];
                foreach ($services as $indexService => $service) {
                    foreach ($type_services as $indexTypeService => $type_service) {
                        $reports[] = array(
                            "id" => (($indexService * sizeof($type_services)) + $indexTypeService) + 1,
                            "service_name" => $service->label,
                            "type_service_name" => $type_service->label,
                            "date" => $start_date,
                            "value" => 0,
                            "status" => "",
                            "reason" => "",
                            "created_at" => "",
                            "updated_at" => ""
                        );
                    }
                }
            }
            return response([
                'has_error' => false,
                'message' => 'Ok',
                'data' => $reports
            ], Response::HTTP_OK);
        }
        return response([
            'has_error' => true,
            'message' => $validator->errors()->all()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }*/
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

        $user_uid = $request->input('user_uid'); // pour le monitoring
        $code_unique_centre = $request->input('code_unique_centre');
        $start_date = date('Y-m-d', strtotime($request->input('selected_date') . " 00:00:00"));
        $end_date = date('Y-m-d', strtotime($request->input('selected_date_2') . " 00:00:00"));

        $services = DB::table('ostat_plus_services')->select('*')->get();
        $type_services = DB::table('ostat_plus_type_services')->select('*')->get();
        $reports = [];
        $id = 1;

        foreach ($services as $service) {
            foreach ($type_services as $type_service) {
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
                    ->when(!$end_date, function ($query) use ($start_date) {
                        return $query->where('date', 'LIKE', $start_date);
                    })
                    ->when($end_date, function ($query) use ($start_date, $end_date) {
                        return $query->whereBetween('date', [$start_date, $end_date]);
                    });

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

        /* Récupérer les données JSON soumises */
        $data = $request->json()->all();

        /* Valider les variables de l'API */
        $validator = Validator::make($data, [
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

        foreach ($data as $item) {

            $user = DB::table('users')
                ->where('uid', $item['doer_uid'])
                ->first();
            $service = DB::table('ostat_plus_services')
                ->where('label', $item['service_name'])
                ->first();
            $type_service = DB::table('ostat_plus_type_services')
                ->where('label', $item['type_service_name'])
                ->first();
            $existingRecord = DB::table('ostat_plus_reports')
                ->where('date', $item['date'])
                ->where('code_centre', $item['code_centre'])
                ->first();

            if ($existingRecord) {
                DB::table('ostat_plus_reports')
                    ->where('date', $item['date'])
                    ->where('code_centre', $item['code_centre'])
                    ->update([
                        'value' => $item['value'],
                        'status' => $item['status'],
                        'doer_uid' => $item['doer_uid'] ?? '',
                        'doer_name' => $user->last_name.' '.$user->first_name ?? '',
                        'reason' => $item['reason'],
                        'updated_at' => now()
                    ]);
            } else {
                DB::table('ostat_plus_reports')->insert([
                    'ostat_plus_service_id' => $service->id,
                    'ostat_plus_type_service_id' => $type_service->id,
                    'code_centre' => $item['code_centre'],
                    'date' => $item['date'],
                    'value' => $item['value'],
                    'status' => $item['value'],
                    'doer_uid' => $item['doer_uid'] ?? '',
                    'doer_name' => $user->last_name." ".$user->first_name ?? '',
                    'reason' => $item['reason'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

        }

        return response([
            'has_error' => true,
            'message' => 'Données mises à jour avec succès !'
        ], Response::HTTP_OK);
    }

}
