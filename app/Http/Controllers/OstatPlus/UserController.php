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
class UserController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Téléchargement du certificat d'identification au format PDF<br/><br/>
     * <b>Response</b> userAppLogin(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    function userAppLogin(Request $request) {
        /* Récupérer les données JSON soumises */
        $jsonData = $request->json()->all();
        /* Valider les variables de l'API */
        $validator = Validator::make($jsonData, [
            'login' => ['required', 'string'], // Login
            'password' => ['required', 'string'], // Password
        ]);
        if (!$validator->fails()) {
            /* Accéder aux variables soumises dans le corps JSON */
            $login = $jsonData['login'];
            $password = $jsonData['password'];
            /* Obtention des informations sur l'utilisateur */
            $user = DB::table('users')
                ->select('*')
                ->join('users_roles', 'users_roles.user_role_id', '=', 'users.role_id')
                ->whereRaw('UCASE(users.login) = (?) or UCASE(users.email) = (?)', [strtoupper($login), strtoupper($login)])
                ->where('users.password', md5(sha1("\$@lty" . $password . "\$@lt")))
                ->first();
            if (!empty($user)) {
                return response([
                    'has_error' => false,
                    'message' => 'Ok',
                    'data' => $user
                ], Response::HTTP_OK);
            } else {
                return response([
                    'has_error' => true,
                    'message' => 'Identifiant ou mot de passe incorrect !',
                    'data' => [
                        'id' => 0,
                        'role_id' => 0,
                        'zone_code' => '',
                        'uid' => '',
                        'login' => '',
                        'status_id' => 0,
                        'monitored' => 0,
                        'first_name' => '',
                        'last_name' => '',
                        'phone_number' => '',
                        'phone_number_2' => '',
                        'phone_number_3' => '',
                        'email' => '',
                        'creation_date' => '',
                        'update_date' => ''
                    ]
                ], Response::HTTP_OK);
            }
        } else {
            return response(['errors' => $validator->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
