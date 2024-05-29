<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentCandidatAdmis;
use App\Models\AgentPresence;
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

        return view('pages.home', [
            'username' => $username,
            'role_name' => auth()->user()->usersRole->user_role_label
        ]);

    }

    public function nombrePointagesSeptDerniersJours(): array
    {
        // Initialiser un tableau pour stocker le nombre de pointages par jour
        $nombrePointagesParJour = [];

        // Boucle pour les sept derniers jours
        for ($i = 6; $i >= 0; $i--) {
            // Date du jour actuel moins $i jours
            $currentDate = Carbon::now()->subDays($i)->toDateString();

            // Date du lendemain pour obtenir la borne supérieure de la journée
            $nextDate = Carbon::parse($currentDate)->addDay()->toDateString();

            // Requête pour récupérer le nombre de pointages de présence pour la journée actuelle
            $nombrePointages = AgentPresence::whereBetween('created_at', [$currentDate, $nextDate])
                ->count();

            // Stocker le nombre de pointages pour la journée actuelle dans le tableau
            $nombrePointagesParJour[$currentDate] = $nombrePointages;
        }

        return $nombrePointagesParJour;
    }

    public function nombrePointagesDouzeDerniersMois()
    {
        // Initialiser un tableau pour stocker le nombre de pointages par mois
        $nombrePointagesParMois = [];

        // Boucle pour les douze derniers mois
        for ($i = 11; $i >= 0; $i--) {
            // Date du mois actuel moins $i mois
            $currentMonth = Carbon::now()->subMonths($i);

            // Début du mois
            $startOfMonth = $currentMonth->startOfMonth()->toDateString();

            // Fin du mois
            $endOfMonth = $currentMonth->endOfMonth()->toDateString();

            // Requête pour récupérer le nombre de pointages de présence pour le mois actuel
            $nombrePointages = AgentPresence::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            // Stocker le nombre de pointages pour le mois actuel dans le tableau
            $nombrePointagesParMois[$currentMonth->format('F Y')] = $nombrePointages;
        }

        return $nombrePointagesParMois;
    }


}
