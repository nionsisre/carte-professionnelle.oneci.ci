<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentCandidatAdmis;
use App\Models\AgentPresence;
use App\Models\Client;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show() {

        $username = auth()->user()->last_name.' '.auth()->user()->first_name;
        $max_chars = 35;
        $username = (strlen($username) < $max_chars) ? $username : substr($username,0,($max_chars-3))."...";

        $nombre_demandes = Client::where('statut','>=','2')->count();
        $nombre_demandes_non_traitees = Client::where('statut','=','2')->count();
        $nombre_demandes_daily = Client::where('statut','>=','2')->where('updated_at','LIKE',date("Y-m-d").'%')->count();
        $nombre_demandes_monthly = Client::where('statut','>=','2')->where('updated_at','LIKE',date("Y-m").'%')->count();
        $nombre_demandes_validees = Client::where('statut','=','3')->count();
        $nombre_demandes_validees_daily = Client::where('statut','=','3')->where('updated_at','LIKE',date("Y-m-d").'%')->count();
        $nombre_demandes_validees_monthly = Client::where('statut','=','3')->where('updated_at','LIKE',date("Y-m").'%')->count();
        $nombre_demandes_refusees = Client::where('statut','=','4')->count();
        $nombre_demandes_refusees_daily = Client::where('statut','=','4')->where('updated_at','LIKE',date("Y-m-d").'%')->count();
        $nombre_demandes_refusees_monthly = Client::where('statut','=','4')->where('updated_at','LIKE',date("Y-m").'%')->count();
        $nombre_demandes_traitees = Client::where('statut','>=','3')->count();
        $nombre_demandes_traitees_daily = Client::where('statut','>=','3')->where('updated_at','LIKE',date("Y-m-d").'%')->count();
        $nombre_demandes_traitees_monthly = Client::where('statut','>=','3')->where('updated_at','LIKE',date("Y-m").'%')->count();
        $taux_demandes_traitees = ($nombre_demandes != 0) ? (intval($nombre_demandes_traitees)*100) / intval($nombre_demandes) : 0;
        $taux_demandes_traitees_daily = ($nombre_demandes_daily != 0) ? (intval($nombre_demandes_traitees_daily)*100) / intval($nombre_demandes_daily) : 0;
        $taux_demandes_traitees_monthly = ($nombre_demandes_monthly != 0) ? (intval($nombre_demandes_traitees_monthly)*100) / intval($nombre_demandes_monthly) : 0;

        return view('admin.pages.home', [
            'username' => $username,
            'role_name' => auth()->user()->usersRole->user_role_label,
            'nombre_demandes' => $nombre_demandes,
            'nombre_demandes_non_traitees' => $nombre_demandes_non_traitees,
            'nombre_demandes_daily' => $nombre_demandes_daily,
            'nombre_demandes_monthly' => $nombre_demandes_monthly,
            'nombre_demandes_validees' => $nombre_demandes_validees,
            'nombre_demandes_validees_daily' => $nombre_demandes_validees_daily,
            'nombre_demandes_validees_monthly' => $nombre_demandes_validees_monthly,
            'nombre_demandes_refusees' => $nombre_demandes_refusees,
            'nombre_demandes_refusees_daily' => $nombre_demandes_refusees_daily,
            'nombre_demandes_refusees_monthly' => $nombre_demandes_refusees_monthly,
            'taux_demandes_traitees' => $taux_demandes_traitees,
            'taux_demandes_traitees_daily' => $taux_demandes_traitees_daily,
            'taux_demandes_traitees_monthly' => $taux_demandes_traitees_monthly,
        ]);

    }

}
