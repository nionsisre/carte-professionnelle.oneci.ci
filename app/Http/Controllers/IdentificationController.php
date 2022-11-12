<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdentificationController extends Controller {

    /**
     *  Identification Form Submit
     */
    public function submit(Request $request) {
        /* @TODO: Valider variables du formulaire et recaptcha */
        /*request()->validate([
            'nom' => ['required', 'string', 'max:150'],
            'prenoms' => ['required', 'string', 'max:150'],
            'pdf_doc' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);*/
        /* @TODO: Stocker variables en base */
        $numero_dossier = time();
        $document_justificatif_filename = 'identification' . '_' . time() . '.' . $request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public');
        $civil_status_center = DB::table('civil_status_center')->where('civil_status_center_id','=',$request->input('birth-place'))->get()[0]->civil_status_center_label;
        $abonnes = Abonne::create([
            'numero_dossier' => $numero_dossier,
            'nom' => strtoupper($request->input('first-name')),
            'nom_epouse' => strtoupper($request->input('spouse-name')),
            'prenoms' => strtoupper($request->input('last-name')),
            'date_de_naissance' => $request->input('birth-date'),
            'lieu_de_naissance' => $civil_status_center,
            'genre' => $request->input('gender'),
            'domicile' => strtoupper($request->input('residence')),
            'profession' => strtoupper($request->input('profession')),
            'nationalite' => $request->input('country'),
            'email' => $request->input('email'),
            'abonnes_type_piece_id' => $request->input('doc-type'),
            'document_justificatif' => $document_justificatif,
            'numero_document' => $request->input('document-number'),
        ]);
        $operateurs = $request->input('telco');
        $numeros = $request->input('msisdn');
        for ($i = 0; $i < sizeof($operateurs); $i++) {
            AbonnesNumero::create([
                'abonne_id' => $abonnes->id,
                'abonnes_operateur_id' => $operateurs[$i],
                'abonnes_statut_id' => 1,
                'numero_de_telephone' => str_replace(' ', '', $numeros[$i])
            ]);
        }
        /* @TODO: Retourner vue resultat */
        $numero_dossier = $abonnes->numero_dossier;
        return redirect()->route('accueil')->with('numero_dossier', $numero_dossier);
    }

    /**
     * Identification Form Search
     */
    public function search(Request $request) {
        /* @TODO: Valider variables du formulaire et recaptcha */
        request()->validate([
            /*'form-number' => ['required', 'required|numeric', 'min:10', 'max:10'],*/
            'form-number' => ['required'],
        ]);
        /* @TODO: Requête variables en base */
        $resultats_statut = DB::table('abonnes_numeros')
            ->select('*')
            ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
            ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
            ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
            ->join('abonnes_type_pieces','abonnes_type_pieces.id','=','abonnes.abonnes_type_piece_id')
            ->where('numero_dossier', '=', $request->input('form-number'))
            ->get();
        //dd($resultats_statut);
        /* @TODO: Retourner vue resultat */
        return redirect()->route('consultation_statut_identification')->with('resultats_statut', $resultats_statut);

    }

}
