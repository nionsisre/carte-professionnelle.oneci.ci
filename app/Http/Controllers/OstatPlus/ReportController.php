<?php

namespace App\Http\Controllers\OstatPlus;

use App\Http\Controllers\Controller;
use App\Models\OstatPlusReport;
use App\Models\OstatPlusService;
use App\Models\OstatPlusTypeService;
use App\Models\OstatPlusTypesPerService;
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
            if (!empty($zone_code) && $zone_code !== "null") {
                // Vérification si le code_unique_centre contient plusieurs codes de centres
                if(!empty($zone_code) && strpos($zone_code, ';') !== false) {
                    $zone_codes = explode(';', $zone_code);
                    // Initialiser un tableau pour stocker les résultats
                    $centre_list = [];
                    // Traiter chaque code de zone individuellement
                    foreach ($zone_codes as $code) {
                        $centres = DB::table('centre_unified')
                            ->select([
                                "id", "zone",
                                "code_zone", DB::raw('region_label as region_coordination'),
                                "code_region", DB::raw('department_label as departement'),
                                "code_departement", "sous_prefecture_commune",
                                "code_sp_commune", DB::raw('area_label as localite'),
                                DB::raw('area_code as code_localite'), DB::raw('location_label as centre'),
                                DB::raw('location_code as code_centre'), "code_unique_centre",
                                DB::raw('lon as date_ouverture'), DB::raw('lat as date_fermeture')
                            ])
                            ->where('code_unique_centre', 'LIKE', $code."%")
                            ->orderByDesc('id')
                            ->get();
                        // Fusionner les résultats dans le tableau principal
                        $centre_list = array_merge($centre_list, $centres->toArray());
                    }
                } else {
                    // S'il n'y a qu'un seul code, le met dans un tableau pour un traitement uniforme
                    $centre_list = DB::table('centre_unified')
                        ->select([
                            "id", "zone",
                            "code_zone", DB::raw('region_label as region_coordination'),
                            "code_region", DB::raw('department_label as departement'),
                            "code_departement", "sous_prefecture_commune",
                            "code_sp_commune", DB::raw('area_label as localite'),
                            DB::raw('area_code as code_localite'), DB::raw('location_label as centre'),
                            DB::raw('location_code as code_centre'), "code_unique_centre",
                            DB::raw('lon as date_ouverture'), DB::raw('lat as date_fermeture')
                        ])
                        ->where('code_unique_centre', 'LIKE', $zone_code."%")
                        ->orderByDesc('id')
                        ->get();
                }
            } else {
                $centre_list = DB::table('centre_unified')
                    ->select([
                        "id", "zone",
                        "code_zone", DB::raw('region_label as region_coordination'),
                        "code_region", DB::raw('department_label as departement'),
                        "code_departement", "sous_prefecture_commune",
                        "code_sp_commune", DB::raw('area_label as localite'),
                        DB::raw('area_code as code_localite'), DB::raw('location_label as centre'),
                        DB::raw('location_code as code_centre'), "code_unique_centre",
                        DB::raw('lon as date_ouverture'), DB::raw('lat as date_fermeture')
                    ])
                    ->whereNotNull('code_unique_centre')
                    ->orderByDesc('id')
                    ->get();
            }
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

        // Requêtes depuis OStat Plus < v1.1.0
        if($request->input('client') === null) {


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

            $code_unique_centre = $request->input('code_unique_centre');

            // Vérification si le code_unique_centre contient plusieurs codes de centres
            if(!empty($code_unique_centre) && strpos($code_unique_centre, ';') !== false) {
                $codes_uniques_centres = explode(';', $code_unique_centre);
            } else {
                // S'il n'y a qu'un seul code, le met dans un tableau pour un traitement uniforme
                if($code_unique_centre == "000000000000") {
                    $codes_uniques_centres = [""];
                } else {
                    $codes_uniques_centres = [$code_unique_centre];
                }
            }

            $start_date = $request->input('selected_date');
            $end_date = ($request->input('selected_date_2') == "null" || $request->input('selected_date_2') == null || empty($request->input('selected_date_2'))) ? "" : $request->input('selected_date_2');

            $services = DB::table('ostat_plus_services')->select('*')->get();
            $type_services = DB::table('ostat_plus_type_services')->select('*')->get();
            $reports = [];
            $id = 1;

            foreach ($services as $service) {

                if($service->id != 15) {

                    foreach ($type_services as $type_service) {

                        foreach ($codes_uniques_centres as $code) {
                            if ($type_service->id != 14 && $type_service->id != 15 && $type_service->id != 16 && $type_service->id != 17) {

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
                                    ->where('code_centre', 'LIKE', $code . '%')
                                    ->when(empty($end_date), function ($query) use ($start_date) {
                                        return $query->where('date', 'LIKE', $start_date);
                                    })
                                    ->when(!empty($end_date), function ($query) use ($start_date, $end_date) {
                                        return $query->whereBetween('date', [$start_date, $end_date]);
                                    });
                                $query->groupBy('ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'status', 'doer_uid', 'doer_name', 'reason', 'created_at', 'updated_at');

                                $query = $query->get();

                                $report_value = 0;
                                $qtemp = [];
                                foreach ($query as $qr) {
                                    $tmpvalue = $qr->value ?? 0;
                                    if ($qr->ostat_plus_type_service_id == 9) {
                                        $report_value = $tmpvalue;
                                    } else {
                                        $report_value += $tmpvalue;
                                    }
                                    $qtemp = $qr;
                                }
                                $query = $qtemp;

                                $reason_tmp = "";
                                if (!empty($code_unique_centre) && empty($end_date)) {
                                    if(property_exists($query, 'reason') && !empty($query->reason) ?? 'Non renseigné') {
                                        $reason_tmp = $query->reason." | Mise à jour version OStat+ v2.0.0 disponible ! Veuillez contacter le service support SVP";
                                    } else {
                                        //$reason_tmp = "MNon renseigné";
                                        $reason_tmp = "Mise à jour version OStat+ v2.0.0 disponible ! Veuillez contacter le service support SVP";
                                    }
                                } else {
                                    $reason_tmp = "";
                                }

                                $reports[] = [
                                    "id" => $id,
                                    "service_name" => $service->label,
                                    "type_service_name" => $type_service->label,
                                    "code_centre" => $query->code_centre ?? '',
                                    "date" => (empty($end_date)) ? $start_date : $end_date,
                                    "value" => $report_value,
                                    "status" => $query->status ?? '',
                                    "doer_uid" => $query->doer_uid ?? '',
                                    "doer_name" => $query->doer_name ?? '',
                                    "reason" => $reason_tmp,
                                    "created_at" => $query->created_at ?? '',
                                    "updated_at" => $query->updated_at ?? ''
                                ];

                                $id++;

                            }
                        }
                    }

                }
            }

            return response([
                'has_error' => false,
                'message' => 'Ok',
                'data' => $reports
            ], Response::HTTP_OK);


        } else {


            // Requêtes depuis OStat Plus v2+
            switch ($request->input('client')) {
                case "OSTAT_PLUS_20000":

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

                    $code_unique_centre = $request->input('code_unique_centre');

                    // Vérification si le code_unique_centre contient plusieurs codes de centres
                    if(!empty($code_unique_centre) && strpos($code_unique_centre, ';') !== false) {
                        $codes_uniques_centres = explode(';', $code_unique_centre);
                    } else {
                        // S'il n'y a qu'un seul code, le met dans un tableau pour un traitement uniforme
                        if($code_unique_centre == "000000000000") {
                            $codes_uniques_centres = [""];
                        } else {
                            $codes_uniques_centres = [$code_unique_centre];
                        }
                    }

                    $start_date = $request->input('selected_date');
                    $end_date = ($request->input('selected_date_2') == "null" || $request->input('selected_date_2') == null || empty($request->input('selected_date_2'))) ? "" : $request->input('selected_date_2');

                    $types_per_services = DB::table('ostat_plus_types_per_services')
                        ->join('ostat_plus_services', 'ostat_plus_types_per_services.ostat_plus_service_id', '=', 'ostat_plus_services.id')
                        ->join('ostat_plus_type_services', 'ostat_plus_types_per_services.ostat_plus_type_service_id', '=', 'ostat_plus_type_services.id')
                        ->select('ostat_plus_services.id as service_id', 'ostat_plus_type_services.id as type_service_id')
                        ->orderBy('ostat_plus_types_per_services.ostat_plus_service_id')
                        ->orderBy('ostat_plus_types_per_services.ostat_plus_type_service_id')
                        ->get();
                    //$types_per_services = OstatPlusTypesPerService::with(['ostatplusservice','ostatplustypeservice'])->get();

                    $services = DB::table('ostat_plus_services')->select('*')->get();
                    $type_services = DB::table('ostat_plus_type_services')->select('*')->get();
                    $reports = [];
                    $id = 1;

                    foreach ($codes_uniques_centres as $code) {
                        foreach ($types_per_services as $type_per_service) {

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
                                ->where('ostat_plus_service_id', $type_per_service->service_id)
                                ->where('ostat_plus_type_service_id', $type_per_service->type_service_id)
                                //->where('ostat_plus_service_id', $service->id)
                                //->where('ostat_plus_type_service_id', $type_service->id)
                                ->where('code_centre', 'LIKE', $code . '%')
                                ->when(empty($end_date), function ($query) use ($start_date) {
                                    return $query->where('date', 'LIKE', $start_date);
                                })
                                ->when(!empty($end_date), function ($query) use ($start_date, $end_date) {
                                    return $query->whereBetween('date', [$start_date, $end_date]);
                                });
                            $query->groupBy('ostat_plus_service_id', 'ostat_plus_type_service_id', 'code_centre', 'date', 'status', 'doer_uid', 'doer_name', 'reason', 'created_at', 'updated_at');

                            $query = $query->get();

                            $report_value = 0;
                            $qtemp = [];
                            foreach ($query as $qr) {
                                $tmpvalue = $qr->value ?? 0;
                                if($qr->ostat_plus_type_service_id == 9) {
                                    $report_value = $tmpvalue;
                                } else {
                                    $report_value += $tmpvalue;
                                }
                                $qtemp = $qr;
                            }
                            $query = $qtemp;

                            $reports[] = [
                                "id" => $id,
                                'service_id' => OstatPlusService::where('id', $type_per_service->service_id)->value('id'),
                                'service_name' => OstatPlusService::where('id', $type_per_service->service_id)->value('label'),
                                'type_service_id' => OstatPlusTypeService::where('id', $type_per_service->type_service_id)->value('id'),
                                'type_service_name' => OstatPlusTypeService::where('id', $type_per_service->type_service_id)->value('label'),
                                //"service_name" => $service->label,
                                //"type_service_name" => $type_service->label,
                                "code_centre" => $query->code_centre ?? '',
                                "date" => (empty($end_date)) ? $start_date : $end_date,
                                "value" => $report_value,
                                "status" => $query->status ?? '',
                                "doer_uid" => $query->doer_uid ?? '',
                                "doer_name" => $query->doer_name ?? '',
                                "reason" => (!empty($code_unique_centre) && empty($end_date)) ? ($query->reason ?? 'Non renseigné') : "",
                                'icon' => OstatPlusService::where('id', $type_per_service->service_id)->value('icon'),
                                "created_at" => $query->created_at ?? '',
                                "updated_at" => $query->updated_at ?? ''
                            ];

                            $id++;

                        }
                    }

                    return response([
                        'has_error' => false,
                        'message' => "Ok",
                        'data' => (object) [
                            'reports' => $reports,
                            'insights' => [
                                /*[
                                    'icon' => "https://www.oneci.ci/assets/images/oneci_logo.png",
                                    'title' => "texte 1",
                                    'content' => "contenu 1"
                                ],
                                [
                                    'icon' => "",
                                    'title' => "texte 2",
                                    'content' => "contenu 2"
                                ]*/
                            ],
                            'welcome_message' => [
                                /*'icon' => "",
                                'title' => "",
                                'content' => "" */
                                'icon' => "", //"https://www.oneci.ci/assets/images/oneci_logo.png",
                                'title' => "OStat+ v2.0.0",
                                'content' => "Bienvenue sur OStat Plus 2 !! De nombreuses améliorations d'ergonomie, de sécurité et de performance ont été effectuées par la DSI dans cette version de l'application. Bon service !"
                            ]
                        ]
                    ], Response::HTTP_OK);
                default:
                    return response([
                        'has_error' => true,
                        'message' => "Client Inconnu"
                    ], Response::HTTP_UNAUTHORIZED);
            }


        }

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

        /*$filePath = 'android_query_logs.txt';
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
                ->get();

            if(sizeof($existingRecord) > 1) {
                // Existence de doublons dans la base de données si on rentre ici
                /*$doublons = OstatPlusReport::select('code_centre','date','ostat_plus_service_id','ostat_plus_type_service_id','value')
                    ->groupBy('code_centre','date','ostat_plus_service_id','ostat_plus_type_service_id','value')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();*/
                $latestRecordId = $existingRecord->max('id'); // Récupérer l'ID de l'enregistrement le plus récent parmi les doublons
                // Supprimer les enregistrements plus anciens que l'enregistrement le plus récent
                DB::table('ostat_plus_reports')
                    ->where('date', $item['date'])
                    ->where('code_centre', $item['code_centre'])
                    ->where('ostat_plus_service_id', $service->id ?? null)
                    ->where('ostat_plus_type_service_id', $type_service->id ?? null)
                    ->where('id', '<', $latestRecordId)
                    ->delete();

                // Conserver uniquement l'enregistrement le plus récent
                $existingRecord = DB::table('ostat_plus_reports')->find($latestRecordId);
            } else {
                $existingRecord = DB::table('ostat_plus_reports')
                    ->where('date', $item['date'])
                    ->where('code_centre', $item['code_centre'])
                    ->where('ostat_plus_service_id', $service->id ?? null)
                    ->where('ostat_plus_type_service_id', $type_service->id ?? null)
                    ->first();
            }

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
                        'reason' => $user ? "Données du ".date('d/m/Y', strtotime($item['date']))." modifiées par ".$user->last_name . ' ' . $user->first_name .' le '.date('d/m/Y').' à '.date('H:i:s') : '',
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
                    'reason' => $user ? "Données du ".date('d/m/Y', strtotime($item['date']))." publiées par ".$user->last_name . ' ' . $user->first_name .' le '.date('d/m/Y').' à '.date('H:i:s') : '',
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

    /**
     * A str_replace_array for PHP
     *
     * As described in http://php.net/str_replace this wouldnot make sense
     * However there are chances that we need it, so often !
     * See https://wiki.php.net/rfc/cyclic-replace
     *
     * @author Jitendra Adhikari | adhocore <jiten.adhikary@gmail.com>
     *
     * @param string $search  The search string
     * @param array  $replace The array to replace $search in cyclic order
     * @param string $subject The subject on which to search and replace
     *
     * @return string
     */
    function str_replace_array($search, array $replace, $subject)
    {
        if (0 === $tokenc = substr_count($subject, $search)) {
            return $subject;
        }

        $string  = '';
        if (count($replace) >= $tokenc) {
            $replace = array_slice($replace, 0, $tokenc);
            $tokenc += 1;
        } else {
            $tokenc = count($replace) + 1;
        }

        foreach(explode($search, $subject, $tokenc) as $part) {
            $string .= $part.array_shift($replace);
        }

        return $string;
    }

}
