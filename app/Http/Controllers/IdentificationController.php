<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
use Illuminate\Http\Request;

class IdentificationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submit(Request $request) {

        /* @TODO: Valider variables du formulaire et recaptcha */
        /*request()->validate([
            'login' => ['required', 'string', 'max:150'],
            'password' => ['required', 'max:150']
        ]);*/
        /* @TODO: Stocker variables en base */
        $numero_dossier = time();
        $document_justificatif_filename = 'identification'.'_'.time().'.'.$request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media',$document_justificatif_filename,'public');

        $abonnes = Abonne::create([
            'numero_dossier' => $numero_dossier,
            'nom' => $request->input('first-name'),
            'nom_epouse' => $request->input('spouse-name'),
            'prenoms' => $request->input('last-name'),
            'date_de_naissance' => $request->input('birth-date'),
            'lieu_de_naissance' => $request->input('birth-place'),
            'genre' => '',
            'domicile' => $request->input('residence'),
            'profession' => $request->input('profession'),
            'nationalite' => $request->input('country'),
            'email' => $request->input('email'),
            'abonnes_type_piece_id' => $request->input('doc-type'),
            'document_justificatif' => $document_justificatif,
            'abonnes_statut_id' => 1,
            ]);
        $operateurs = $request->input('telco');
        $numeros = $request->input('msisdn');
        for ($i=0; $i<sizeof($operateurs); $i++) {
            $abonnes_numeros = AbonnesNumero::create([
                'abonne_id' => $abonnes->id,
                'abonnes_operateur_id' => $operateurs[$i],
                'numero_de_telephone' => $numeros[$i]
            ]);
        }
        dd($abonnes_numeros);
        /* @TODO: Retourner vue resultat */
        return view('pages.home');
    }
}
