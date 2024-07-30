<?php

namespace App\Http\Controllers;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Http\Services\NGSerAPI;
use App\Http\Services\SMS;
use App\Models\Artiste;
use App\Models\ArtistesTypePiece;
use App\Models\CivilStatus;
use App\Models\DirecteurGeneral;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    certificat-conformite
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class CertificatConformiteController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function showMenu() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        /* Retourner vue resultat */
        return view('pages.certificat.menu', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * @return Application|Factory|View
     */
    public function showFormulaire() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';
        $centres = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->get();
        $artistes_type_pieces = ArtistesTypePiece::all();
        $civil_statuses = CivilStatus::all();

        return view('pages.certificat.formulaire', [
            'mobile_header_enabled' => $mobile_header_enabled,
            'civil_statuses' => $civil_statuses,
            'artistes_type_pieces' => $artistes_type_pieces,
            'centres' => $centres
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showConsultation() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        return view('pages.certificat.consultation', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showReclamationPaiement() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = Artiste::all();

        return view('pages.reclamation-paiement', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode est appelée automatiquement par le listener javascript du navigateur du client
     * après avoir saisi son NNI afin de préremplir les informations de l'utilisateur<br/><br/>
     * <b>RedirectResponse</b> verifapi(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function verifapi(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'nni' => ['required', 'string', 'max:11'], // Numero de telephone
        ]);
        /* Vérification du NNI */
        if(config('services.verifapi.enabled')) {
            /*
                Verif ONECI getting authentication token
            */
            $client = new \GuzzleHttp\Client();
            try {
                $response_token = $client->post(env('VERIF_API_LINK').'/api/v1/authenticate', [
                    'verify' => false,
                    'headers' => [
                        'Content-type' => 'application/json',
                        'Cache-Control' => 'no-cache'
                    ],
                    'json' => [
                        "apiKey" => env('VERIF_API_KEY'),
                        "secretKey" => env('VERIF_API_SECRET_KEY')
                    ]
                ]);
                $response_token = json_decode($response_token->getBody()->getContents(),true);
                if(!empty($response_token["bearerToken"])) {
                    /*
                        Verif ONECI NNI Verification
                    */
                    try {
                        $options = "?attributeNames=FIRST_NAME&attributeNames=LAST_NAME&attributeNames=BIRTH_DATE&attributeNames=GENDER&attributeNames=BIRTH_TOWN&attributeNames=BIRTH_COUNTRY&attributeNames=NATIONALITY&attributeNames=RESIDENCE_ADR_1&attributeNames=RESIDENCE_ADR_2&attributeNames=RESIDENCE_TOWN&attributeNames=MOTHER_UIN&attributeNames=FATHER_UIN&attributeNames=ID_CARD_NUMBER&attributeNames=SPOUSE_NAME&attributeNames=NATIONALITY&attributeNames=RESIDENCE_TOWN&attributeNames=FATHER_FIRST_NAME&attributeNames=FATHER_LAST_NAME&attributeNames=FATHER_BIRTH_DATE&attributeNames=MOTHER_FIRST_NAME&attributeNames=MOTHER_LAST_NAME&attributeNames=MOTHER_BIRTH_DATE&attributeNames=UIN";
                        $response = $client->request('GET', env('VERIF_API_LINK')."/api/v1/oneci/persons/".$request->input('nni').$options, [
                            'headers' => [
                                'Authorization' => 'Bearer '.$response_token["bearerToken"],
                                'Content-type' => 'application/x-www-form-urlencoded',
                            ]
                        ]);
                        $nni_check_result = json_decode($response->getBody(),true);
                        if ($response->getStatusCode() == 200) {
                            return response([
                                'error' => false,
                                'message' => 'Ok',
                                'data' => $nni_check_result,
                            ], Response::HTTP_OK);
                        } else {
                            return response([
                                'error' => false,
                                'message' => 'Aucune donnée trouvé',
                            ], Response::HTTP_NOT_FOUND);
                        }
                    } catch(\Exception $e) {
                        return response([
                            'has_error' => true,
                            'message' => $e->getMessage()
                        ], Response::HTTP_SERVICE_UNAVAILABLE);
                    }
                }
            } catch(\Exception $e) {
                return response([
                    'has_error' => true,
                    'message' => $e->getMessage()
                ], Response::HTTP_SERVICE_UNAVAILABLE);
            }
        } else {
            return response([
                'error' => false,
                'message' => 'Aucune donnée trouvé',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission du formulaire de demande du certificat de conformité par l'utilisateur<br/><br/>
     * <b>RedirectResponse</b> print(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        /* Si le service de vérification Google reCAPTCHA v3 est actif */
        if(config('services.recaptcha.enabled')) {
            (new GoogleRecaptchaV3())->verify($request)['error'] ??
                redirect()->route('certificat.formulaire')->with((new GoogleRecaptchaV3())->verify($request));
        }
        /* Valider les variables du formulaire */
        request()->validate([
            'gender' => ['required', 'string', 'max:1'],
            'nickname' => ['nullable', 'string', 'max:150'],
            'last-name' => ['required', 'string', 'max:70'],
            'first-name' => ['required', 'string', 'max:150'],
            'spouse-name' => ['nullable', 'string', 'max:70'],
            'birth-date' => ['required', 'string', 'max:20'],
            'birth-place' => ['required', 'string', 'max:150'],
            'birth-country' => ['required', 'string', 'max:150'],
            'nationality' => ['required', 'string', 'max:150'],
            'civil-status' => ['required', 'numeric'],
            'number-of-children' => ['required', 'numeric', 'min:0', 'max:50'],
            'other-activities' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:150'],
            'town' => ['required', 'string', 'max:150'],
            'street' => ['required', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:150'],
            'workplace' => ['required', 'string', 'max:150'],
            'msisdn' => ['required', 'string', 'max:20'],
            'attached-doc-type' => ['required', 'string', 'max:150'],
            'attached-doc-number' => ['required', 'string', 'max:30'],
            'attached-doc-expiry-date' => ['required', 'string', 'max:20'],
            'attached-doc' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:2048']
        ]);

        /* Stocker variables en base */
        $numero_dossier = (new GeneratedTokensOrIDs())->generateUniqueNumberID('numero_dossier');

        dd($request);

        /* Pièces jointes */
        // Récupération du titre d'identité
        $titre_identite_filename = 'titre-identite' . '_' . $numero_dossier . '.' . $request->file('attached-doc')->extension();
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* If Current server OS is windows */
            $titre_identite = $request->file('attached-doc')->storeAs('data\\titre-identite', $titre_identite_filename, 'public');
        } else { /* If Current server OS is not windows */
            $titre_identite = $request->file('attached-doc')->storeAs('data/titre-identite', $titre_identite_filename, 'public');
        }

        $client = Artiste::create([
            'numero_dossier' => $numero_dossier,
            'pseudonyme' => "",
            'nom' => strtoupper($request->input('last-name')),
            'nom_epouse' => "",
            'prenoms' => "",
            'genre' => "",
            'date_naissance' => "",
            'lieu_naissance' => "",
            'pays_naissance' => "",
            'nationalite' => "",
            'civil_status_id' => "",
            'nombre_enfants' => "",
            'autre_activite' => "",
            'ville' => "",
            'commune' => "",
            'quartier' => "",
            'adresse' => "",
            'lieu_travail' => "",
            'msisdn' => str_replace(" ", "", $request->input("msisdn")),
            'email' => "",
            'artiste_type_piece_id' => "",
            'type_cni' => "",
            'numero_document' => "",
            'document' => $titre_identite,
            'date_expiration_document' => "",
            'uniqid' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date').strtoupper($request->input('mother-last-name'))),
            'artiste_statut_id' => 1,
            'transaction_id' => "",
            'integrator_api_response_id' => "",
            'integrator_code' => "",
            'integrator_message' => "",
            'integrator_data_amount' => "",
            'integrator_data_currency' => "",
            'integrator_data_status' => "",
            'integrator_data_payment_method' => "",
            'integrator_data_description' => "",
            'integrator_data_metadata' => "",
            'integrator_data_operator_id' => "",
            'integrator_data_payment_date' => "",
            'certificate_download_link' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date')),

            'numero_dossier' => $numero_dossier,
            'nni' => $request->input('nni'),
            'numero_cni' => $request->input('cni-number'),
            'prenom' => strtoupper($request->input('first-name')),
            'date_naissance' => $request->input('birth-date'),
            'lieu_naissance' => "",
            'nom_mere' => strtoupper($request->input('mother-last-name')),
            'prenom_mere' => strtoupper($request->input('mother-first-name')),
            'nom_decision' => strtoupper($request->input('decision-last-name')),
            'prenom_decision' => strtoupper($request->input('decision-first-name')),
            'date_naissance_decision' => $request->input('decision-birth-date'),
            'lieu_naissance_decision' => strtoupper($request->input('decision-lieu-naissance')),
            'numero_decision' => $request->input('numero-decision'),
            'date_decision' => $request->input('decision-date'),
            'lieu_decision' => $request->input("lieu-delivrance"),
            'cni' => $cni ?? "",
            'statut' => 1,
            'observation' => "",
            'doer_uid' => "",
        ]);

        /* Obtention des informations sur le client enregistré et sa juridiction */
        $client = Artiste::with('juridiction')->find($client->id);
        $centres = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->get();
        //$payment_data = (new NGSerAPI())->getPaymentLink($client, env('PAYMENT_TYPE'), env('NGSER_SERVICE_AMOUNT'), true);

        $centre = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->where('code_unique_centre','=',$request->input("lieu-retrait"))->first();
        if($centre) {
            $lieu_livraison = ucwords(strtolower($centre->location_label.', '.$centre->area_label.', '.$centre->department_label));
        } else {
            $lieu_livraison = 'Non-renseigné';
        }

        /* Retourner vue resultat */
        return redirect()->route('certificat.formulaire')->with([
            'client' => $client,
            'centres' => $centres,
            'lieu_livraison' => $lieu_livraison
            //'payment_data' => $payment_data
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode donne l'accès à l'espace de consultation de statut de la demande du certificat de conformité<br/><br/>
     * <b>RedirectResponse</b> search(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function search(Request $request) {
        /* Affichage de l'espace de consultation de l'abonné soit par "soumission du formulaire de consultation" ou
        par "url (accès direct ou scan du QR Code présent sur le reçu fourni après la demande du certficat de conformité)" */
        if(empty($request->get('t')) && empty($request->get('f'))) {
            /* Si le service de vérification Google reCAPTCHA v3 est actif */
            if(config('services.recaptcha.enabled')) {
                (new GoogleRecaptchaV3())->verify($request)['error'] ??
                    redirect()->route('certificat.consultation')->with((new GoogleRecaptchaV3())->verify($request));
            }
            /* Verifier si la recherche se fait par numéro de validation ou par numéro de téléphone */
            request()->validate([
                'form-number' => ['required', 'numeric', 'digits:10'],
            ]);
            $client = Artiste::with('juridiction')->where('numero_dossier', '=', $request->input('form-number'))->first();
            /* Génération d'un token d'authentification pour chaque numéro de téléphone "Identifié" s'il y'en a, en session */
            if($client) {
                return $this->prepareAndRedirectClientToConsultation($client);
            } else {
                return redirect()->route('certificat.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        } elseif (!empty($request->get('t')) && !empty($request->get('f'))) {
            /* Cas où la recherche se fait par url (accès direct) ou par scan du QR Code présent sur le reçu de la demande du certificat de conformité
            (numéro de dossier <f> + token d'authentification <t>) */
            $client = Artiste::with('juridiction')->where('numero_dossier', '=', $request->get('f'))->first();
            if($client) {
                if ($client->uniqid === $request->get('t')) {
                    return $this->prepareAndRedirectClientToConsultation($client);
                }
            } else {
                return redirect()->route('certificat.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        }

        return redirect()->route('certificat.consultation');
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode permet d'obtenir un lien de paiement du certificat de conformité auprès du service de
     * l'intégrateur de paiement<br/><br/>
     * <b>RedirectResponse</b> getCertificatePaymentLink(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getCertificatePaymentLink(Request $request) {

        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
        ]);
        /* Récupération des numéros de telephone de l'abonné à partir du numéro de validation */
        $client = Artiste::where('numero_dossier', '=', $request->input('fn'))->first();
        if($client->exists()) {
            /* Obtention du lien de paiement via l'API Aggrégateur */
            if(config('services.ngser.enabled')) {
                $payment_link_obtained = (new NGSerAPI())->getPaymentLink($client, env('PAYMENT_TYPE'), env('NGSER_SERVICE_AMOUNT'), true);
            } else if(config('services.cinetpay.enabled')) {
                $payment_link_obtained = (new CinetPayAPI())->getPaymentLink($client, env('PAYMENT_TYPE'), env('CINETPAY_SERVICE_AMOUNT'), true);
            }
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
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function autoVerifyIfPaymentIsDone(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            't' => ['required', 'string', 'max:100'], // Token generique
            'ti' => ['nullable', 'string', 'max:100'], // ID de transaction
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
            'pt' => ['nullable', 'string', 'max:100'], // Type de paiement
        ]);

        /* Vérification du Token générique */
        if($request->input('t') !== md5(sha1('s@lty'.$request->input('fn').'s@lt'))) {
            return response([
                'has_error' => true,
                'message' => 'Unauthorized...'
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            /* Vérification de l'ID de transaction chez l'aggrégateur de paiement */
            if(config('services.ngser.enabled')) {
                $payment_data = (new NGSerAPI())->verify($request->input('ti'), $request->input('pt'));
                if ($payment_data['has_error']) {
                    return response([
                        'has_error' => true,
                        'data' => $payment_data,
                        'message' => 'Une erreur est survenue lors du paiement'
                    ], Response::HTTP_SERVICE_UNAVAILABLE);

                    /*if(isset($payment_data['code'])) { // Cette option if ne doit normalement pas exister
                        // Retrouver le numéro de dossier et le numéro de téléphone à actualiser à partir du numéro de transaction
                        $res_data = (new NGSerAPI())->notify(
                            $request->replace([
                                'order_id' => $request->input('ti'), // ID de transaction
                                'payment_type' => $request->input('pt'), // Type de paiement effectué
                            ])
                        );

                        return response([
                            'has_error' => $res_data->original['has_error'],
                            'data' => $res_data->original,
                            'message' => $res_data->original['message']
                        ], Response::HTTP_OK);
                    } else {
                        return response([
                            'has_error' => true,
                            'message' => 'Paiement en cours...'
                        ], Response::HTTP_OK);
                    }*/
                } else {
                    // Retrouver le numéro de dossier et le numéro de téléphone à actualiser à partir du numéro de transaction
                    $res_data = (new NGSerAPI())->notify(
                        $request->replace([
                            'order_id' => $request->input('ti'), // ID de transaction
                            'payment_type' => $request->input('pt'), // Type de paiement effectué
                        ])
                    );

                    return response([
                        'has_error' => $res_data->original['has_error'],
                        'data' => $res_data->original,
                        'message' => $res_data->original['message']
                    ], Response::HTTP_OK);
                }
            } else if(config('services.cinetpay.enabled')) {
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
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Téléchargement du certificat de conformité au format PDF<br/><br/>
     * <b>RedirectResponse</b> downloadCertificateConformitePDF(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function downloadCertificateConformitePDF(Request $request) {

        if(!empty($request->get('n'))) {
            /* Print PDF ticket according form-number */
            $certificate_download_link = $request->get('n');
            $client = Artiste::with('juridiction')->where('certificat', '=', $certificate_download_link)->first();
            if ($client) {
                $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($client->updated_at->format('Y-m-d'))) );
                $date_du_jour = date('Y-m-d', time());
                if($date_du_jour <= $date_expiration) {
                    /* PDF Download document generation */
                    $data = [
                        'title' => 'Certificat de conformité',
                        'qrcode' => (new QrCode())->generateQrBase64(route('certificat.check.url') . '?c=' . $client->certificate_download_link, 183, 1),
                        'directeur_general' => "Ago Christian KODIA", //DirecteurGeneral::where('statut','=','1')->latest()->first() ?? "",
                        'nom' => $client->nom,
                        'prenom' => $client->prenom,
                        'nom_complet' => $client->prenom." ".$client->nom,
                        'nni' => $client->nni,
                        'numero_cni' => $client->numero_cni,
                        'nom_decision' => $client->nom_decision,
                        'prenom_decision' => $client->prenom_decision,
                        'nom_complet_decision' => $client->prenom_decision." ".$client->nom_decision,
                        'numero_decision' => $client->numero_decision,
                        'date_decision' => date('d/m/Y', strtotime($client->date_decision)),
                        'lieu_decision' => $client->juridiction->libelle.", ".$client->juridiction->region,
                        'lieu_certificat' => "ABIDJAN",
                        'date_certificat' => $client->updated_at->format('d/m/Y')
                    ];
                    $data['qrcode'] = (new QrCode())->generateQrCEVBase64($data);
                    //$data['qrcode'] = (new QrCode())->generateQrBase64(route('certificat.check.url') . '?c=' . $client->certificate_download_link, 183, 1);
                    $filename = 'certificat-conformite-'.$client->numero_dossier.'.pdf';
                    $pdf_certificat_conformite = Pdf::loadView('layouts.certificat-conformite', $data)->setPaper([0, -10, 445, 617.5]);
                    /* Envoi de mail */
                    /*if (!empty($client->email)) {(new MailONECI())->sendMailTemplate('layouts.certificat-conformite', $data, "À propos de votre demande de certficat de conformité ONECI") ;}*/

                    //return view('layouts.certificat-conformite', $data);
                    return $pdf_certificat_conformite->download($filename);
                }
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('certificat.consultation')->with([
            'error' => true,
            'error_message' => 'Une erreur est survenue lors du téléchargement du certificat d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
        ]);

    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Controle par scan QR Code du certificat d'identification<br/><br/>
     * <b>RedirectResponse</b> checkCertificate(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkCertificate(Request $request) {
        if(!empty($request->get('c'))) {
            $certificate_download_link = $request->get('c');
            $client = Artiste::with('juridiction')->where('certificate_download_link', '=', $certificate_download_link)->first();
            if ($client) {
                $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($client->cinetpay_data_payment_date)) );
                $date_du_jour = date('Y-m-d', time());
                if($date_du_jour <= $date_expiration) {
                    /* PDF Certficate document generation */
                    return view('layouts.certificat-identification', [
                        'title' => 'Certificat d\'identification',
                        'qrcode' => (new QrCode())->generateQrBase64(route('certificat.check.url') . '?c=' . $client->certificate_download_link, 183, 1),
                        'numero_dossier' => $client->numero_dossier,
                        'uniqid' => $client->uniqid,
                        'msisdn' => $client->numero_de_telephone,
                        'date_emission' => date('d/m/Y', strtotime($client->cinetpay_data_payment_date)),
                        'date_expiration' => date('d/m/Y', strtotime('+1 year', strtotime($client->cinetpay_data_payment_date))),
                        'nom' => $client->nom . ((!empty($client->nom_epouse)) ? ' epse ' . $client->nom_epouse : ''),
                        'prenoms' => $client->prenoms,
                        'date_de_naissance' => date('d/m/Y', strtotime($client->date_de_naissance)),
                        'lieu_de_naissance' => $client->lieu_de_naissance,
                        'lieu_de_residence' => $client->domicile,
                        'nationalite' => $client->nationalite,
                        'profession' => $client->profession,
                        'email' => $client->email,
                        'id_operateur' => $client->abonnes_operateur_id,
                        'document_justificatif' => $client->libelle_piece,
                        'numero_document_justificatif' => $client->numero_document,
                    ]);
                }
            }
            return redirect()->route('certificat.consultation')->with([
                'error' => true,
                'error_message' => 'Ce certificat n\'est pas ou plus valide !'
            ]);
        }
        /* Retourner vue resultat */
        return redirect()->route('certificat.consultation')->with([
            'error' => true,
            'error_message' => 'Certificat incorrect !'
        ]);
    }

    /**
     * @param $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prepareAndRedirectClientToConsultation($client): \Illuminate\Http\RedirectResponse
    {
        $centre = DB::connection(env('DB_CONNECTION_KERNEL'))->table('centre_unified')->where('code_unique_centre', '=', $client->code_lieu_retrait)->first();
        if ($centre) {
            $lieu_livraison = ucwords(strtolower($centre->location_label . ', ' . $centre->area_label . ', ' . $centre->department_label));
        } else {
            $lieu_livraison = 'Non-renseigné';
        }
        return redirect()->route('certificat.consultation')->with([
            'client' => $client,
            'lieu_livraison' => $lieu_livraison
        ]);
    }

}
