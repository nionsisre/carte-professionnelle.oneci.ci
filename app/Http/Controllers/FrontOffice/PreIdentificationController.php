<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\GoogleRecaptchaV3;
use App\Mail\MailONECI;
use App\Models\Abonne;
use App\Models\AbonnesPreIdentifie;
use App\Models\AbonnesTypePiece;
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
            'selfie_img' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
            'document-number' => ['nullable', 'string', 'max:150'],
            'document-expiry' => ['nullable', 'string', 'max:11'],
        ]);
        /* Stocker variables en base */
        $numero_dossier = (new GeneratedTokensOrIDs())->generateUniqueNumberID('numero_dossier');
        $document_justificatif_filename = 'identification' . '_' . $numero_dossier . '.' . $request->pdf_doc->extension();
        $photo_selfie_filename = 'photo' . '_' . $numero_dossier . '.' . $request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public');
        $photo_selfie = $request->file('selfie_img')->storeAs('media', $photo_selfie_filename, 'public');
        $civil_status_center = ($request->input('country') == 'Côte d’Ivoire') ?
            DB::table('civil_status_center')->where('civil_status_center_id', '=', $request->input('birth-place'))->get()[0]->civil_status_center_label
            : $request->input('birth-place-2');
        $type_cni = ($request->input('country') == 'Côte d’Ivoire') ? (($request->input('doc-type') == 2) ? $request->input('id-card-type') : '') : '';
        $abonne = AbonnesPreIdentifie::create([
            'numero_dossier' => $numero_dossier,
            'status' => "Formulaire en ligne renseigné",
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
            'document_justificatif' => $document_justificatif,
            'libelle_document_justificatif' => AbonnesTypePiece::where('id', $request->input('doc-type'))->first()->libelle_piece,
            'date_expiration_document' => $request->input('document-expiry'),
            'numero_document' => $request->input('document-number'),
            'type_cni' => $type_cni,
            'photo_selfie' => $photo_selfie,
            'uniqid' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date').$civil_status_center)
        ]);
        /* Envoi du reçu de pré-identification par mail */
        if(!empty($request->input('email'))) {
            MailONECI::sendMailTemplate('layouts.recu-pre-identification', [
                'title' => 'Reçu de pré-identification',
                'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.recu_identification.url') . '?f=' . $abonne->numero_dossier . '&t=' . $abonne->uniqid),
                'numero_dossier' => $abonne->numero_dossier,
                'uniqid' => $abonne->uniqid,
                'msisdn_list' => "",
                'nom_complet' => $abonne->prenoms . ' ' . $abonne->nom . ((!empty($abonne->nom_epouse)) ? ' epse ' . $abonne->nom_epouse : ''),
                'date_et_lieu_de_naissance' => date('d/m/Y', strtotime($abonne->date_de_naissance)) . ' à ' . $abonne->lieu_de_naissance,
                'lieu_de_residence' => $abonne->domicile,
                'nationalite' => $abonne->nationalite,
                'profession' => $abonne->profession,
                'email' => $abonne->email,
                'document_justificatif' => $abonne->libelle_document_justificatif . ' (N° ' . $abonne->numero_document . ')',
                'is_email' => true
            ], "Votre reçu de pré-identification ONECI");
        }
        /* Retourner vue resultat */
        return redirect()->route('front_office.page.pre_identification')->with('abonne', $abonne);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode donne l'accès à l'espace de consultation de statut d'identification à l'abonné<br/><br/>
     * <b>RedirectResponse</b> search(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function search(Request $request) {
        /* Affichage de l'espace de consultation de l'abonné soit par "soumission du formulaire de consultation" ou
        par "url (accès direct ou scan du QR Code présent sur le reçu fourni après l'identification)" */
        if(empty($request->get('t')) && empty($request->get('f'))) {
            /* Si le service de vérification Google reCAPTCHA v3 est actif */
            if(config('services.recaptcha.enabled')) {
                    (new GoogleRecaptchaV3())->verify($request)['error'] ??
                    redirect()->route('front_office.page.consultation')->with((new GoogleRecaptchaV3())->verify($request));
            }
            /* Verifier si la recherche se fait par numéro de validation ou par numéro de téléphone */
            $search_with_msisdn = $request->input('tsch');
            if ($search_with_msisdn == '0') {
                request()->validate([
                    'form-number' => ['required', 'numeric', 'digits:10'],
                ]);
                $abonne = AbonnesPreIdentifie::where('numero_dossier', $request->input('form-number'))->first();
            } else {
                request()->validate([
                    'msisdn' => ['required', 'string', 'min:14', 'max:14'],
                    'first-name' => ['required', 'string', 'min:2', 'max:150'],
                    'birth-date' => ['required', 'string', 'min:10', 'max:10'],
                ]);
                $abonne = AbonnesPreIdentifie::where('abonnes.date_de_naissance', '=', $request->input('birth-date'))
                    ->whereRaw('UCASE(abonnes.nom) = (?)', [strtoupper($request->input('first-name'))])
                    ->first();
            }
            /* Génération d'un token d'authentification pour chaque numéro de téléphone "Identifié" s'il y'en a, en session */
            if($abonne->exists()) {
                return redirect()->route('front_office.page.consultation')->with('abonne_numeros', $abonne);
            } else {
                return redirect()->route('front_office.page.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        } elseif (!empty($request->get('t')) && !empty($request->get('f'))) {
            /* Cas où la recherche se fait par url (accès direct) ou par scan du QR Code présent sur le reçu d'identification
            (numéro de dossier <f> + token d'authentification <t>) */
            $abonne = AbonnesPreIdentifie::where('numero_dossier', $request->input('f'))->first();
            if($abonne->exists()) {
                if ($abonne->uniqid === $request->get('t')) {
                    return redirect()->route('front_office.page.consultation')->with('abonne_numeros', $abonne);
                }
            } else {
                return redirect()->route('front_office.page.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        }

        return redirect()->route('front_office.page.consultation');
    }

}
