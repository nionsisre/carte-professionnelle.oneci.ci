<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Mail\MailONECI;
use App\Models\Abonne;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesPreIdentifie;
use App\Models\AbonnesTypePiece;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

class PreIdentificationController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function showMenuPreIdentification() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        /* Retourner vue resultat */
        return view('pages.menu-pre-identification', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * @return Application|Factory|View
     */
    public function showPreIdentification() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.menu-pre-identification.pre-identification', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * @return Application|Factory|View
     */
    public function showConsultation() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.menu-pre-identification.consultation-pre-identification', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission du formulaire de pré-identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> print(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
        (new GoogleRecaptchaV3())->verify($request)['error'] ??
            redirect()->route('front_office.page.consultation')->with((new GoogleRecaptchaV3())->verify($request));
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
            'other-document-type' => ['nullable','string','max:100'],
            'pdf_doc' => ['nullable', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'selfie_img' => ['required', 'mimes:jpeg,png,jpg', 'max:4096'],
            'document-number' => ['nullable', 'string', 'max:150'],
            'document-expiry' => ['nullable', 'string', 'max:11'],
        ]);
        /* Stocker variables en base */
        $numero_dossier = (new GeneratedTokensOrIDs())->generateUniqueNumberID('numero_dossier');
        $document_justificatif_filename = (AbonnesTypePiece::where('id', $request->input('doc-type'))->exists()) ? 'preidentification_document_' . $numero_dossier . '.' . $request->pdf_doc->extension() : '';
        $photo_selfie_filename = 'preidentification_photo_' . $numero_dossier . '.' . $request->selfie_img->extension();
        $document_justificatif = (AbonnesTypePiece::where('id', $request->input('doc-type'))->exists()) ? $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public') : '';
        $photo_selfie = $request->file('selfie_img')->storeAs('media', $photo_selfie_filename, 'public');
        $civil_status_center = ($request->input('country') == 'Côte d’Ivoire') ?
            DB::table('civil_status_center')->where('civil_status_center_id', '=', $request->input('birth-place'))->get()[0]->civil_status_center_label
            : $request->input('birth-place-2');
        $type_cni = ($request->input('country') == 'Côte d’Ivoire') ? (($request->input('doc-type') == 2) ? $request->input('id-card-type') : '') : '';
        $libelle_document_justificatif = (AbonnesTypePiece::where('id', $request->input('doc-type'))->exists()) ? AbonnesTypePiece::where('id', $request->input('doc-type'))->first()->libelle_piece : '';
        $libelle_document_non_verifiable = (AbonnesTypePiece::where('id', $request->input('doc-type'))->exists()) ? '' : $request->input('other-document-type');
        $enroll_download_link = (AbonnesTypePiece::where('id', $request->input('doc-type'))->exists()) ? md5($numero_dossier) : '';
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
            'libelle_document_justificatif' => $libelle_document_justificatif,
            'libelle_document_non_verifiable' => $libelle_document_non_verifiable,
            'date_expiration_document' => $request->input('document-expiry'),
            'numero_document' => $request->input('document-number'),
            'type_cni' => $type_cni,
            'photo_selfie' => $photo_selfie,
            'uniqid' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date').$civil_status_center),
            'enroll_download_link' => $enroll_download_link,
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
        return redirect()->route('front_office.pre_identification.page')->with('abonne', $abonne);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode redonne l'accès au résultat du formulaire de pré-identification de l'abonné afin qu'il puisse
     * continuer plus tard les actions entamées<br/><br/>
     * <b>RedirectResponse</b> search(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request) {
        /* Affichage de l'espace de consultation de l'abonné soit par "soumission du formulaire de consultation" ou
        par "url (accès direct ou scan du QR Code présent sur le reçu fourni après l'identification)" */
        if(empty($request->get('t')) && empty($request->get('f'))) {
            /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
                (new GoogleRecaptchaV3())->verify($request)['error'] ??
                redirect()->route('front_office.page.consultation')->with((new GoogleRecaptchaV3())->verify($request));
            /* Récupération des informations sur l'utilisateur pré-identifié */
            request()->validate([
                'form-number' => ['required', 'numeric', 'digits:10'],
            ]);
            $abonne = AbonnesPreIdentifie::where('numero_dossier', $request->input('form-number'))->first();
            if($abonne->exists()) {
                return redirect()->route('front_office.pre_identification.page')->with('abonne', $abonne);
            } else {
                return redirect()->route('front_office.pre_identification.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        } else if (!empty($request->get('t')) && !empty($request->get('f'))) {
            /* Cas où la recherche se fait par url (accès direct) ou par scan du QR Code présent sur le reçu d'identification
            (numéro de dossier <f> + token d'authentification <t>) */
            $abonne = AbonnesPreIdentifie::where('numero_dossier', $request->input('f'))->first();
            if($abonne->exists()) {
                if ($abonne->uniqid === $request->get('t')) {
                    return redirect()->route('front_office.pre_identification.page')->with('abonne', $abonne);
                }
            } else {
                return redirect()->route('front_office.pre_identification.page')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        }
        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        return view('pages.menu-pre-identification', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode permet d'obtenir un lien de paiement du certificat d'identification auprès du service de
     * l'intégrateur de paiement<br/><br/>
     * <b>RedirectResponse</b> getCertificatePaymentLink(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getCertificatePaymentLink(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
        ]);
        /* Récupération des numéros de telephone de l'abonné à partir du numéro de validation */
        $abonne = AbonnesPreIdentifie::where('numero_dossier', '=', $request->input('fn'))->first();
        if($abonne->exists()) {
            /* Obtention du lien de paiement via l'API CinetPay */
            $payment_link_obtained = (new CinetPayAPI())->getPaymentLink($abonne,'Paiement Fiche de Pré-Identification', env('CINETPAY_SERVICE_AMOUNT_TEMP'), true);
            if ($payment_link_obtained['has_error']) {
                return response([
                    'has_error' => true,
                    'message' => 'Une erreur est survenue lors de l\'obtention du lien de paiement. Veuillez actualiser la page et/ou réessayer plus tard...',
                    'message_service' => $payment_link_obtained['message']
                ], Response::HTTP_SERVICE_UNAVAILABLE);
            } else {
                return response([
                    'has_error' => false,
                    'message' => $payment_link_obtained['message'],
                    'message_service' => 'OK',
                    'transaction_id' => $payment_link_obtained['transaction_id']
                ], Response::HTTP_OK);
            }
        } else {
            return response([
                'has_error' => true,
                'message' => 'Une erreur est survenue lors de l\'obtention du lien de paiement. Veuillez actualiser la page et/ou réessayer plus tard...',
                'message_service' => 'Police is watching you...'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode est appelée automatiquement et périodiquement par le listener javascript du navigateur du client
     * afin de vérifier si l'utilisateur a bien terminé son processus de paiement auprès du service de l'intégrateur
     * auprès de l'intégrateur de paiement<br/><br/>
     * <b>RedirectResponse</b> autoVerifyIfPaymentIsDone(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function autoVerifyIfPaymentIsDone(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            't' => ['required', 'string', 'max:100'], // Token generique
            'ti' => ['nullable', 'string', 'max:100'], // ID de transaction
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
        ]);
        /* Vérification du Token générique */
        if($request->input('t') !== md5(sha1('s@lty'.$request->input('fn').'s@lt'))) {
            return response([
                'has_error' => true,
                'message' => 'Payment in progress...'
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            /* Vérification de l'ID de transaction chez CinetPAY */
            $payment_data = (new CinetPayAPI())->verify($request->input('ti'));
            if ($payment_data['has_error']) {
                return response([
                    'has_error' => true,
                    'message' => 'Paiement en cours...'
                ], Response::HTTP_OK);
            } else {
                $res_data = (new CinetPayAPI())->notify(
                    $request->replace([
                        'cpm_site_id' => env('CINETPAY_SERVICE_KEY'), // Token generique
                        'cpm_trans_id' => $request->input('ti'), // ID de transaction
                        'cpm_custom' => $request->input('fn'), // Numero de dossier contenu dans la variable Metadata
                        'cpm_designation' => $request->input('msisdn'), // Numero de telephone a actualiser
                    ])
                );
                return response([
                    'has_error' => $res_data->original['has_error'],
                    'data' => $res_data->original,
                    'message' => $res_data->original['message']
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Téléchargement du certificat d'identification au format PDF<br/><br/>
     * <b>RedirectResponse</b> downloadCertificateIdentificationPDF(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function downloadCertificatePreIdentificationPDF(Request $request) {
        if(!empty($request->get('n'))) {
            /* Print PDF ticket according form-number */
            $enroll_download_link = $request->get('n');
            $pre_identification_resultats = AbonnesPreIdentifie::where('enroll_download_link', '=', $enroll_download_link)->first();
            if (!empty($pre_identification_resultats)) {
                $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($pre_identification_resultats->integrator_data_payment_date)) );
                $date_du_jour = date('Y-m-d', time());
                if($date_du_jour <= $date_expiration) {
                    /* PDF Download document generation */
                    $data = [
                        'title' => 'Fiche Provisoire d\'Identification Abonné Mobile',
                        'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.certificat_pre_identification.url') . '?c=' . $pre_identification_resultats->enroll_download_link, 183, 1),
                        'numero_dossier' => $pre_identification_resultats->numero_dossier,
                        'uniqid' => $pre_identification_resultats->uniqid,
                        'msisdn' => $pre_identification_resultats->numero_de_telephone,
                        'date_emission' => date('d/m/Y', strtotime($pre_identification_resultats->integrator_data_payment_date)),
                        'date_expiration' => date('d/m/Y', strtotime('+2 weeks', strtotime($pre_identification_resultats->integrator_data_payment_date))),
                        'nom' => $pre_identification_resultats->nom . ((!empty($pre_identification_resultats->nom_epouse)) ? ' epse ' . $pre_identification_resultats->nom_epouse : ''),
                        'prenoms' => $pre_identification_resultats->prenoms,
                        'date_de_naissance' => date('d/m/Y', strtotime($pre_identification_resultats->date_de_naissance)),
                        'lieu_de_naissance' => $pre_identification_resultats->lieu_de_naissance,
                        'lieu_de_residence' => $pre_identification_resultats->domicile,
                        'nationalite' => $pre_identification_resultats->nationalite,
                        'profession' => $pre_identification_resultats->profession,
                        'email' => $pre_identification_resultats->email,
                        'id_operateur' => $pre_identification_resultats->abonnes_operateur_id,
                        'document_justificatif' => (!empty($pre_identification_resultats->libelle_document_justificatif)) ? $pre_identification_resultats->libelle_document_justificatif : 'Aucun document ONECI',
                        'numero_document_justificatif' => (!empty($pre_identification_resultats->libelle_document_justificatif)) ? $pre_identification_resultats->numero_document : $pre_identification_resultats->libelle_document_non_verifiable,
                    ];
                    /*return view('layouts.certificat-pre-identification', $data);*/

                    $filename = 'fiche-provisoire-identification-' . $pre_identification_resultats->nom . '-' . $pre_identification_resultats->numero_dossier . '.pdf';
                    $pdf_certificat_pre_identification = Pdf::loadView('layouts.certificat-pre-identification', $data)->setPaper('A5', 'landscape')->setOption("dpi", 200);

                    return $pdf_certificat_pre_identification->download($filename);

                }
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('front_office.pre_identification.consultation')->with([
            'error' => true,
            'error_message' => 'Erreur est survenue lors du téléchargement de la fiche provisoire de demande d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
        ]);
    }

}
