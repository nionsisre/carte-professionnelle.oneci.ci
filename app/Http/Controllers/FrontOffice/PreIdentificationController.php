<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Http\Controllers\Controller;
use App\Http\Services\GoogleRecaptchaV3;
use App\Models\Abonne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreIdentificationController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission du formulaire de pré-identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> print(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        //dd($request);
        /* Si le service de vérification Google reCAPTCHA v3 est actif */
        if(config('services.recaptcha.enabled')) {
                (new GoogleRecaptchaV3())->verify($request)['error'] ??
                redirect()->route('front_office.page.consultation')->with((new GoogleRecaptchaV3())->verify($request));
        }
        /* Valider les variables du formulaire */
        request()->validate([
            'first-name' => ['required', 'string', 'max:70'],
            'spouse-name' => ['nullable', 'string', 'max:70'],
            'last-name' => ['required', 'string', 'max:70'],
            'birth-date' => ['required', 'string', 'max:11'],
            'residence' => ['required', 'string', 'max:70'],
            'profession' => ['required', 'string', 'max:70'],
            'country' => ['required', 'string', 'max:70'],
            'email' => ['nullable', 'string', 'max:150'],
            'doc-type' => ['required', 'string', 'max:150'],
            'pdf_doc' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'document-number' => ['nullable', 'string', 'max:150'],
            'document-expiry' => ['nullable', 'string', 'max:11'],
        ]);
        /* Stocker variables en base */
        $numero_dossier = (new GeneratedTokensOrIDs())->generateUniqueNumberID('numero_dossier');
        $document_justificatif_filename = 'identification' . '_' . $numero_dossier . '.' . $request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public');
        $civil_status_center = ($request->input('country') == 'Côte d’Ivoire') ?
            DB::table('civil_status_center')->where('civil_status_center_id', '=', $request->input('birth-place'))->get()[0]->civil_status_center_label
            : $request->input('birth-place-2');
        $type_cni = ($request->input('country') == 'Côte d’Ivoire') ? (($request->input('doc-type') == 2) ? $request->input('id-card-type') : '') : '';
        $abonne = Abonne::create([
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
            'date_expiration_document' => $request->input('document-expiry'),
            'numero_document' => $request->input('document-number'),
            'type_cni' => $type_cni,
            'uniqid' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date').$civil_status_center)
        ]);
    }

}
