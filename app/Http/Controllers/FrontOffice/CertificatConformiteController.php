<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Http\Services\NGSerAPI;
use App\Mail\MailONECI;
use App\Models\Abonne;
use App\Models\AbonnesNumero;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use App\Models\Juridiction;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\Base64Image;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    identification-abonnes-mobile
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
        return view('pages.identification.menu', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * @return Application|Factory|View
     */
    public function showFormulaire() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';
        $juridictions = Juridiction::all();

        return view('pages.certificat.index', [
            'mobile_header_enabled' => $mobile_header_enabled,
            'juridictions' => $juridictions,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showConsultation() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        return view('pages.identification.consultation', [
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
        $abonnes_type_pieces = AbonnesTypePiece::all();

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
     * après avoir saisi son NNI afin de pré-remplir les informations de l'utilisateur<br/><br/>
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
            $client = new Client();
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
     * Soumission du formulaire d'identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> print(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        /* Si le service de vérification Google reCAPTCHA v3 est actif */
        if(config('services.recaptcha.enabled')) {
            (new GoogleRecaptchaV3())->verify($request)['error'] ??
                redirect()->route('certificat.index')->with((new GoogleRecaptchaV3())->verify($request));
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
            'selfie_img_txt' => [
                'nullable',
                'string',
                'max:10000000',
                new Base64Image
            ],
            'document-number' => ['required', 'string', 'max:150'],
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
            'photo_selfie' => $request->input('selfie_img_txt'),
            'uniqid' => sha1($numero_dossier.strtoupper($request->input('first-name')).$request->input('birth-date').$civil_status_center)
        ]);
        $telco = $request->input('telco');
        $msisdn = $request->input('msisdn');
        for ($i = 0; $i < sizeof($telco); $i++) {
            AbonnesNumero::create([
                'abonne_id' => $abonne->id,
                'abonnes_operateur_id' => $telco[$i],
                'abonnes_statut_id' => 1,
                'numero_de_telephone' => str_replace(' ', '', $msisdn[$i])
            ]);
            $msisdn[$i] = $msisdn[$i] . ' (' . AbonnesOperateur::find($telco[$i])->libelle_operateur . ') | ';
        }
        /* Envoi de mail */
        if(!empty($request->input('email'))) {
            MailONECI::sendMailTemplate('layouts.recu-identification', [
                'title' => 'Reçu d\'identification',
                'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.recu_identification.url') . '?f=' . $abonne->numero_dossier . '&t=' . $abonne->uniqid),
                'numero_dossier' => $abonne->numero_dossier,
                'uniqid' => $abonne->uniqid,
                'msisdn_list' => $msisdn,
                'nom_complet' => $abonne->prenoms . ' ' . $abonne->nom . ((!empty($abonne->nom_epouse)) ? ' epse ' . $abonne->nom_epouse : ''),
                'date_et_lieu_de_naissance' => date('d/m/Y', strtotime($abonne->date_de_naissance)) . ' à ' . $abonne->lieu_de_naissance,
                'lieu_de_residence' => $abonne->domicile,
                'nationalite' => $abonne->nationalite,
                'profession' => $abonne->profession,
                'email' => $abonne->email,
                'document_justificatif' => $abonne->libelle_piece . ' (' . $abonne->numero_document . ')',
            ], "À propos de votre identification d'abonné mobile ONECI");
        }
        /* Obtention des informations sur l'abonné et ses numéros */
        $abonne_numeros = DB::table('abonnes_numeros')
            ->select('*')
            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
            ->where('abonnes.numero_dossier', '=', $abonne->numero_dossier)
            ->get();
        /* Si le service d'envoi de SMS est actif */
        if(config('services.sms.enabled')) {
            /* Génération d'un token OTP pour chaque numéro de téléphone en session */
            for ($i = 0; $i < sizeof($abonne_numeros); $i++) {
                $otp_msisdn_tokens[$i] = (new GeneratedTokensOrIDs())->createToken(0);
            }
            session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
        }
        /* Retourner vue resultat */
        return redirect()->route('certificat.index')->with('abonne_numeros', $abonne_numeros);
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
                    redirect()->route('certificat.consultation')->with((new GoogleRecaptchaV3())->verify($request));
            }
            /* Verifier si la recherche se fait par numéro de validation ou par numéro de téléphone */
            $search_with_msisdn = $request->input('tsch');
            if ($search_with_msisdn == '0') {
                request()->validate([
                    'form-number' => ['required', 'numeric', 'digits:10'],
                ]);
                $abonne_numeros = DB::table('abonnes_numeros')
                    ->select('*')
                    ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                    ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                    ->where('abonnes.numero_dossier', '=', $request->input('form-number'))
                    ->get();
            } else {
                request()->validate([
                    'msisdn' => ['required', 'string', 'min:14', 'max:14'],
                    'first-name' => ['required', 'string', 'min:2', 'max:150'],
                    'birth-date' => ['required', 'string', 'min:10', 'max:10'],
                ]);
                $abonne_numeros = DB::table('abonnes_numeros')
                    ->select('*')
                    ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                    ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                    ->where('abonnes_numeros.numero_de_telephone', '=', str_replace(' ', '', $request->input('msisdn')))
                    ->whereRaw('UCASE(abonnes.nom) = (?)', [strtoupper($request->input('first-name'))])
                    ->where('abonnes.date_de_naissance', '=', $request->input('birth-date'))
                    ->get();
            }
            /* Génération d'un token d'authentification pour chaque numéro de téléphone "Identifié" s'il y'en a, en session */
            if(sizeof($abonne_numeros) !== 0) {
                return (new GeneratedTokensOrIDs())->applyCertificatedTokenToEachMSISDNs($abonne_numeros);
            } else {
                return redirect()->route('certificat.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        } elseif (!empty($request->get('t')) && !empty($request->get('f'))) {
            /* Cas où la recherche se fait par url (accès direct) ou par scan du QR Code présent sur le reçu d'identification
            (numéro de dossier <f> + token d'authentification <t>) */
            $abonne_numeros = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes.numero_dossier', '=', $request->get('f'))
                ->get();
            if(sizeof($abonne_numeros) !== 0) {
                if ($abonne_numeros[0]->uniqid === $request->get('t')) {
                    /* Génération d'un token certificat pour chaque numéro de téléphone < Identifié > en session */
                    return (new GeneratedTokensOrIDs())->applyCertificatedTokenToEachMSISDNs($abonne_numeros);
                }
            } else {
                return redirect()->route('certificat.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        }

        return redirect()->route('certificat.consultation');
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode vérifie si le numéro de téléphone présent dans la requête HTTP GET reçue par la route est déjà
     * identifié en base de données<br/><br/>
     * <b>RedirectResponse</b> checkIfMsisdnIsAlreadyIdentifed(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function checkIfMsisdnIsAlreadyIdentifed(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'msdn' => ['required', 'string', 'max:14'], // Numero de telephone a verifier
        ]);
        /* Récupération des numéros de telephone de l'abonné à partir du numéro de téléphone vérifié */
        $abonne_numeros = DB::table('abonnes_numeros')
            ->select('*')
            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
            ->where('abonnes_numeros.numero_de_telephone', '=', str_replace(' ', '', $request->input('msdn')))
            ->get();
        /* Vérification du statut du numéro de téléphone : seuls les numéros valides sont autorisés */
        if(sizeof($abonne_numeros) > 0) {
            foreach ($abonne_numeros as $abonne_numero) {
                if($abonne_numero->code_statut==='NUI') {
                    return response([
                        'has_error' => true,
                        'message' => 'Numéro déjà identifié !'
                    ], Response::HTTP_ACCEPTED);
                }
            }
        }
        return response([
            'has_error' => false,
            'message' => 'Ok'
        ], Response::HTTP_OK);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode permet d'obtenir un lien de paiement du certificat d'identification auprès du service de
     * l'intégrateur de paiement<br/><br/>
     * <b>RedirectResponse</b> getCertificatePaymentLink(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getCertificatePaymentLink(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'tn' => ['required', 'string', 'max:100'], // Token du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de l'abonne
        ]);
        /* Vérification du Token d'authentification émis par la requête du client avec celui présent en session */
        try {
            $client_certificate_msisdn_token = $request->input('tn');
            $session_certificate_msisdn_tokens = session()->get('certificate_msisdn_tokens');
            for ($i=0;$i<sizeof($session_certificate_msisdn_tokens);$i++) {
                if ((new GeneratedTokensOrIDs())->checkToken($client_certificate_msisdn_token, $session_certificate_msisdn_tokens[$i])) {
                    $is_token_correct = true;
                    break;
                }
            }
            if (!isset($is_token_correct)) {
                return response([
                    'has_error' => true,
                    'message' => 'Token invalide ! Veuillez actualiser la page et/ou réessayer plus tard...'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                /* Récupération des numéros de telephone de l'abonné à partir du numéro de validation */
                $abonne_numeros = DB::table('abonnes_numeros')
                    ->select('*')
                    ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                    ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                    ->where('abonnes.numero_dossier', '=', $request->input('fn'))
                    ->get();
                /* Vérification du statut du numéro de téléphone : seuls les numéros valides sont autorisés */
                if(!isset($abonne_numeros[$request->input('idx')]) || $abonne_numeros[$request->input('idx')]->code_statut!=='NUI') {
                    return response([
                        'has_error' => true,
                        'message' => 'What are doing ?'
                    ], Response::HTTP_BAD_REQUEST);
                }
                /* Récupération du numéro de telephone valide */
                $abonne_numero = $abonne_numeros[$request->input('idx')];
                /* Obtention du lien de paiement via l'API Aggrégateur */
                if(config('services.ngser.enabled')) {
                    $payment_link_obtained = (new NGSerAPI())->getPaymentLink($abonne_numero, env('PAYMENT_TYPE_1'), env('NGSER_SERVICE_AMOUNT'), true);
                } else if(config('services.cinetpay.enabled')) {
                    $payment_link_obtained = (new CinetPayAPI())->getPaymentLink($abonne_numero, env('PAYMENT_TYPE_1'), env('CINETPAY_SERVICE_AMOUNT'), true);
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
            }
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface | Exception $e) {
            return response([
                'has_error' => true,
                'message' => 'Veuillez actualiser la page et/ou réessayer plus tard SVP'. $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
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
            'msisdn' => ['required', 'string', 'max:20'], // Numero de telephone
            'pt' => ['nullable', 'string', 'max:100'], // Type de paiement
        ]);

        /* Vérification du Token générique */
        if($request->input('t') !== md5(sha1('s@lty'.$request->input('fn').'s@lt'))) {
            return response([
                'has_error' => true,
                'message' => 'Payment in progress...'
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            /* Vérification de l'ID de transaction chez l'aggrégateur de paiement */
            if(config('services.ngser.enabled')) {
                $payment_data = (new NGSerAPI())->verify($request->input('ti'), $request->input('pt'));
                if ($payment_data['has_error']) {
                    return response([
                        'has_error' => true,
                        'message' => 'Paiement en cours...'
                    ], Response::HTTP_OK);
                } else {
                    // Retrouver le numéro de dossier et le numéro de téléphone à actualiser à partir du numéro de transaction
                    $res_data = (new NGSerAPI())->notify(
                        $request->replace([
                            'order_id' => $payment_data["transaction_id"], // ID de transaction
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
     * Téléchargement du reçu d'identification au format PDF<br/><br/>
     * <b>RedirectResponse</b> downloadRecuIdentificationPDF(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function downloadRecuIdentificationPDF(Request $request) {
        /*$numero_dossier = $request->session()->get('numero_dossier');*/
        if(!empty($request->get('n'))) {
            /* Print PDF ticket according form-number */
            $numero_dossier = $request->get('n');
            $identification_resultats = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes.numero_dossier', '=', $numero_dossier)
                ->get();
            if (!empty($identification_resultats[0])) {
                for ($i = 0; $i < sizeof($identification_resultats); $i++) {
                    $msisdn[] = $identification_resultats[$i]->numero_de_telephone . ' (' . $identification_resultats[$i]->libelle_operateur . ') | ';
                }
                $identification_resultats = $identification_resultats[0];
                /* PDF Download document generation */
                $data = [
                    'title' => 'Reçu d\'identification',
                    'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.recu_identification.url') . '?f=' . $identification_resultats->numero_dossier . '&t=' . $identification_resultats->uniqid),
                    'numero_dossier' => $identification_resultats->numero_dossier,
                    'uniqid' => $identification_resultats->uniqid,
                    'msisdn_list' => $msisdn,
                    'nom_complet' => $identification_resultats->prenoms . ' ' . $identification_resultats->nom . ((!empty($identification_resultats->nom_epouse)) ? ' epse ' . $identification_resultats->nom_epouse : ''),
                    'date_et_lieu_de_naissance' => date('d/m/Y', strtotime($identification_resultats->date_de_naissance)) . ' à ' . $identification_resultats->lieu_de_naissance,
                    'lieu_de_residence' => $identification_resultats->domicile,
                    'nationalite' => $identification_resultats->nationalite,
                    'profession' => $identification_resultats->profession,
                    'email' => $identification_resultats->email,
                    'document_justificatif' => $identification_resultats->libelle_piece . ' (' . $identification_resultats->numero_document . ')',
                ];
                $filename = 'identification-' . $identification_resultats->nom . '-' . $identification_resultats->numero_dossier . '.pdf';
                $pdf_recu_identification = Pdf::loadView('layouts.recu-identification', $data);
                /*$request->session()->remove('numero_dossier');*/
                return $pdf_recu_identification->download($filename);
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('front_office.form.consulter_statut_identification')->with([
            'error' => true,
            'error_message' => 'Erreur est survenue lors du téléchargement du reçu d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Téléchargement du certificat d'identification au format PDF<br/><br/>
     * <b>RedirectResponse</b> downloadCertificateIdentificationPDF(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function downloadCertificateIdentificationPDF(Request $request) {
        if(!empty($request->get('n'))) {
            /* Print PDF ticket according form-number */
            $certificate_download_link = $request->get('n');
            $identification_resultats = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes_numeros.certificate_download_link', '=', $certificate_download_link)
                ->first();
            if (!empty($identification_resultats)) {
                $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($identification_resultats->cinetpay_data_payment_date)) );
                $date_du_jour = date('Y-m-d', time());
                if($date_du_jour <= $date_expiration) {
                    /* PDF Download document generation */
                    $data = [
                        'title' => 'Certificat d\'identification',
                        'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.certificat_identification.url') . '?c=' . $identification_resultats->certificate_download_link, 183, 1),
                        'numero_dossier' => $identification_resultats->numero_dossier,
                        'uniqid' => $identification_resultats->uniqid,
                        'msisdn' => $identification_resultats->numero_de_telephone,
                        'date_emission' => date('d/m/Y', strtotime($identification_resultats->cinetpay_data_payment_date)),
                        'date_expiration' => date('d/m/Y', strtotime('+1 year', strtotime($identification_resultats->cinetpay_data_payment_date))),
                        'nom' => $identification_resultats->nom . ((!empty($identification_resultats->nom_epouse)) ? ' epse ' . $identification_resultats->nom_epouse : ''),
                        'prenoms' => $identification_resultats->prenoms,
                        'date_de_naissance' => date('d/m/Y', strtotime($identification_resultats->date_de_naissance)),
                        'lieu_de_naissance' => $identification_resultats->lieu_de_naissance,
                        'lieu_de_residence' => $identification_resultats->domicile,
                        'nationalite' => $identification_resultats->nationalite,
                        'profession' => $identification_resultats->profession,
                        'email' => $identification_resultats->email,
                        'id_operateur' => $identification_resultats->abonnes_operateur_id,
                        'document_justificatif' => $identification_resultats->libelle_piece,
                        'numero_document_justificatif' => $identification_resultats->numero_document,
                    ];
                    $filename = 'identification-' . $identification_resultats->nom . '-' . $identification_resultats->numero_dossier . '.pdf';
                    $pdf_certificat_identification = Pdf::loadView('layouts.certificat-identification', $data)->setPaper([0, -10, 445, 617.5]);
                    /* Envoi de mail */
                    /*if (!empty($identification_resultats->email)) {
                        (new MailONECI())->sendMailTemplate('layouts.certificat-identification', $data, "À propos de votre identification d'abonné mobile ONECI");
                    }*/
                    return $pdf_certificat_identification->download($filename);
                }
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('certificat.consultation')->with([
            'error' => true,
            'error_message' => 'Erreur est survenue lors du téléchargement du certificat d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
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
            $identification_resultats = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes_numeros.certificate_download_link', '=', $certificate_download_link)
                ->first();
            if (!empty($identification_resultats)) {
                $date_expiration = date('Y-m-d', strtotime('+1 year', strtotime($identification_resultats->cinetpay_data_payment_date)) );
                $date_du_jour = date('Y-m-d', time());
                if($date_du_jour <= $date_expiration) {
                    /* PDF Certficate document generation */
                    return view('layouts.certificat-identification', [
                        'title' => 'Certificat d\'identification',
                        'qrcode' => (new QrCode())->generateQrBase64(route('front_office.auth.certificat_identification.url') . '?c=' . $identification_resultats->certificate_download_link, 183, 1),
                        'numero_dossier' => $identification_resultats->numero_dossier,
                        'uniqid' => $identification_resultats->uniqid,
                        'msisdn' => $identification_resultats->numero_de_telephone,
                        'date_emission' => date('d/m/Y', strtotime($identification_resultats->cinetpay_data_payment_date)),
                        'date_expiration' => date('d/m/Y', strtotime('+1 year', strtotime($identification_resultats->cinetpay_data_payment_date))),
                        'nom' => $identification_resultats->nom . ((!empty($identification_resultats->nom_epouse)) ? ' epse ' . $identification_resultats->nom_epouse : ''),
                        'prenoms' => $identification_resultats->prenoms,
                        'date_de_naissance' => date('d/m/Y', strtotime($identification_resultats->date_de_naissance)),
                        'lieu_de_naissance' => $identification_resultats->lieu_de_naissance,
                        'lieu_de_residence' => $identification_resultats->domicile,
                        'nationalite' => $identification_resultats->nationalite,
                        'profession' => $identification_resultats->profession,
                        'email' => $identification_resultats->email,
                        'id_operateur' => $identification_resultats->abonnes_operateur_id,
                        'document_justificatif' => $identification_resultats->libelle_piece,
                        'numero_document_justificatif' => $identification_resultats->numero_document,
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

}
