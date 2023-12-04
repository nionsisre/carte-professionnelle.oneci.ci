<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Mail\MailONECI;
use App\Models\Abonne;
use App\Models\AbonnesNumero;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Exception;
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
class SpecialCANController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function showMenuSpecialCAN() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        /* Retourner vue resultat */
        return view('pages.special-can.menu', [
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }

    /**
     * @return Application|Factory|View
     */
    public function showIdentificationSpecialCAN() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.special-can.index', [
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

        return view('pages.identification.consultation', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);
    }


    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission du formulaire d'identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> submit(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        /* Si le service de vérification Google reCAPTCHA v3 est actif */
        if(config('services.recaptcha.enabled')) {
            (new GoogleRecaptchaV3())->verify($request)['error'] ??
                redirect()->route('front_office.special_can.consultation')->with((new GoogleRecaptchaV3())->verify($request));
        }
        /* Valider les variables du formulaire */
        $validator = Validator::make(request()->all(), [
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de l'abonne
            'nit' => ['required', 'numeric', 'digits:11'],
            'msisdn' => ['required', 'string', 'max:70'],
            'telco' => ['nullable', 'string', 'max:70']
        ]);
        if ($validator->fails()) {
            return redirect()->route('front_office.special_can.consultation')->withErrors(["Erreur lors de l'identification : Veuillez recommencer votre identification (Formulaire mal renseigné)"]);
        }
        /* Stocker variables en base */
        $numero_dossier = (new GeneratedTokensOrIDs())->generateUniqueNumberID('numero_dossier');
        /*$document_justificatif_filename = 'identification' . '_' . $numero_dossier . '.' . $request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public');
        $civil_status_center = ($request->input('country') == 'Côte d’Ivoire') ?
            DB::table('civil_status_center')->where('civil_status_center_id', '=', $request->input('birth-place'))->get()[0]->civil_status_center_label
            : $request->input('birth-place-2');
        $type_cni = ($request->input('country') == 'Côte d’Ivoire') ? (($request->input('doc-type') == 2) ? $request->input('id-card-type') : '') : '';*/

        $demandecrtcan = DB::connection('maria_db_oneci_special_can')
            ->table('demandecrtcans')
            ->select('*')
            //->join('piececans', 'demandecrtcans.id', '=', 'piececans.demandecrt_id')
            ->where('demandecrtcans.nit', '=', $request->input('nni'))
            ->get();
        if(sizeof($demandecrtcan) === 0) {
            return redirect()->route('front_office.special_can.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
        }

        $demandecrtcan = $demandecrtcan[0];
        $abonne_numeros = [
            "numero_de_telephone" => $request->input('msisdn'),
            "otp_code" => null,
            "otp_sms" => null,
            "transaction_id" => null,
            "cinetpay_api_response_id" => null,
            "cinetpay_code" => null,
            "cinetpay_message" => null,
            "cinetpay_data_amount" => null,
            "cinetpay_data_currency" => null,
            "cinetpay_data_status" => null,
            "cinetpay_data_payment_method" => null,
            "cinetpay_data_description" => null,
            "cinetpay_data_metadata" => null,
            "cinetpay_data_operator_id" => null,
            "cinetpay_data_payment_date" => null,
            "certificate_download_link" => null,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
            //"abonne_id" => 5,
            "abonnes_operateur_id" => 3,
            "abonnes_statut_id" => 2,
            "observation" => null,
            "user_validation" => null,
            "date_validation" => null,
            "libelle_operateur" => null,
            "code_statut" => "NNV",
            "libelle_statut" => "Numéro non-vérifié",
            "icone" => "phone-slash",
            "numero_dossier" => $numero_dossier,
            "nom" => $demandecrtcan->nom,
            "nom_epouse" => "",
            "prenoms" => $demandecrtcan->prenom,
            "date_de_naissance" => $demandecrtcan->datenaissance,
            "lieu_de_naissance" => $demandecrtcan->lieunaissance,
            "genre" => $demandecrtcan->genre,
            "domicile" => $demandecrtcan->adresse,
            "profession" => $demandecrtcan->profession,
            "nationalite" => $demandecrtcan->nationalite,
            "email" => $demandecrtcan->email,
            "document_justificatif" => "media/...",
            "numero_document" => $demandecrtcan->nit,
            "date_expiration_document" => $demandecrtcan->dateretour,
            "type_cni" => null,
            "photo_selfie" => null,
            "uniqid" => sha1($demandecrtcan->numerodossier.strtoupper($demandecrtcan->nom).$demandecrtcan->datenaissance.$demandecrtcan->lieunaissance),
            "abonnes_type_piece_id" => 5,
            "code_type_piece" => "CRT",
            "libelle_piece" => "Carte de résident temporaire"
        ];

        $abonne = Abonne::create([
            'numero_dossier' => $numero_dossier,
            'nom' => strtoupper($abonne_numeros['nom']),
            'nom_epouse' => strtoupper($abonne_numeros['nom_epouse']),
            'prenoms' => strtoupper($abonne_numeros['prenoms']),
            'date_de_naissance' => $abonne_numeros['date_de_naissance'],
            'lieu_de_naissance' => $abonne_numeros['lieu_de_naissance'],
            'genre' => $abonne_numeros['genre'],
            'domicile' => strtoupper($abonne_numeros['domicile']),
            'profession' => strtoupper($abonne_numeros['profession']),
            'nationalite' => $abonne_numeros['nationalite'],
            'email' => $abonne_numeros['email'],
            'abonnes_type_piece_id' => 5,
            'document_justificatif' => "",
            'date_expiration_document' => $abonne_numeros['date_expiration_document'],
            'numero_document' => $abonne_numeros['numero_document'],
            'photo_selfie' => "",
            'uniqid' => sha1($numero_dossier.strtoupper($abonne_numeros['nom']).$abonne_numeros['date_de_naissance'].$abonne_numeros['lieu_de_naissance'])
        ]);
        $telco = $request->input('telco');
        $msisdn = $request->input('msisdn');
        AbonnesNumero::create([
            'abonne_id' => $abonne->id,
            'abonnes_operateur_id' => $telco,
            'abonnes_statut_id' => 3,
            'numero_de_telephone' => str_replace(' ', '', $msisdn),
            'transaction_id' => date('Y', time()).$numero_dossier,
            'cinetpay_api_response_id' => "0000000000.0000",
            'cinetpay_code' => "00",
            'cinetpay_message' => "SUCCES",
            'cinetpay_data_amount' => "0",
            'cinetpay_data_currency' => "XOF",
            'cinetpay_data_status' => "ACCEPTED",
            'cinetpay_data_payment_method' => "OM",
            'cinetpay_data_description' => "Paiement Certificat Identification Spécial CAN 2023",
            'cinetpay_data_metadata' => $numero_dossier,
            'cinetpay_data_operator_id' => "00000000.0000.000000",
            'cinetpay_data_payment_date' => "2023-11-12 15:51:36",
            'certificate_download_link' => md5($numero_dossier . (date('Y', time()).$numero_dossier) . "00000000.0000.000000"),
        ]);
        $msisdn = $msisdn . ' (' . AbonnesOperateur::find($telco)->libelle_operateur . ')';

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
        return redirect()->route('front_office.page.identification')->with('abonne_numeros', $abonne_numeros);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode donne l'accès à l'espace de consultation de statut d'identification à l'abonné<br/><br/>
     * <b>RedirectResponse</b> consulterInfoNNI(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function consulterInfoNNI(Request $request) {
        /* Affichage de l'espace de consultation de l'abonné soit par "soumission du formulaire de consultation spécial CAN" */
        $request->validate([
            'nni' => ['required', 'numeric', 'digits:11']
        ]);
        if (!empty($request->input('nni')) && !empty($request->input('nni'))) {
            $demandecrtcan = DB::connection('maria_db_oneci_special_can')
                ->table('demandecrtcans')
                ->select('*')
                //->join('piececans', 'demandecrtcans.id', '=', 'piececans.demandecrt_id')
                ->where('demandecrtcans.nit', '=', $request->get('nni'))
                ->get();
            if(sizeof($demandecrtcan) !== 0) {
                $demandecrtcan = $demandecrtcan[0];
                $abonne_numeros = [
                    "numero_de_telephone" => "0000000000",
                    "otp_code" => null,
                    "otp_sms" => null,
                    "transaction_id" => null,
                    "cinetpay_api_response_id" => null,
                    "cinetpay_code" => null,
                    "cinetpay_message" => null,
                    "cinetpay_data_amount" => null,
                    "cinetpay_data_currency" => null,
                    "cinetpay_data_status" => null,
                    "cinetpay_data_payment_method" => null,
                    "cinetpay_data_description" => null,
                    "cinetpay_data_metadata" => null,
                    "cinetpay_data_operator_id" => null,
                    "cinetpay_data_payment_date" => null,
                    "certificate_download_link" => null,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                    //"abonne_id" => 5,
                    "abonnes_operateur_id" => 3,
                    "abonnes_statut_id" => 2,
                    "observation" => null,
                    "user_validation" => null,
                    "date_validation" => null,
                    "libelle_operateur" => null,
                    "code_statut" => "NNV",
                    "libelle_statut" => "Numéro non-vérifié",
                    "icone" => "phone-slash",
                    "numero_dossier" => $demandecrtcan->numerodossier,
                    "nom" => $demandecrtcan->nom,
                    "nom_epouse" => "",
                    "prenoms" => $demandecrtcan->prenom,
                    "date_de_naissance" => $demandecrtcan->datenaissance,
                    "lieu_de_naissance" => $demandecrtcan->lieunaissance,
                    "genre" => $demandecrtcan->genre,
                    "domicile" => $demandecrtcan->adresse,
                    "profession" => $demandecrtcan->profession,
                    "nationalite" => $demandecrtcan->nationalite,
                    "email" => $demandecrtcan->email,
                    "document_justificatif" => "media/...",
                    "numero_document" => $demandecrtcan->nit,
                    "date_expiration_document" => $demandecrtcan->dateretour,
                    "type_cni" => null,
                    "photo_selfie" => null,
                    "uniqid" => sha1($demandecrtcan->numerodossier.strtoupper($demandecrtcan->nom).$demandecrtcan->datenaissance.$demandecrtcan->lieunaissance),
                    "abonnes_type_piece_id" => 5,
                    "code_type_piece" => "CRT",
                    "libelle_piece" => "Carte de résident temporaire"
                ];
                $abonne_numeros = array((object)$abonne_numeros);

                $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';
                $abonnes_operateurs = AbonnesOperateur::all();
                $abonnes_type_pieces = AbonnesTypePiece::all();

                return view('pages.special-can.index', [
                    'abonne_numeros' => $abonne_numeros,
                    'abonnes_operateurs' => $abonnes_operateurs,
                    'abonnes_type_pieces' => $abonnes_type_pieces,
                    'mobile_header_enabled' => $mobile_header_enabled,
                ]);

            } else {
                return redirect()->route('front_office.special_can.consultation')->withErrors(['not-found' => 'Numéro de validation Incorrect !']);
            }
        }

        return redirect()->route('front_office.special_can.consultation');
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Cette méthode vérifie si le numéro de téléphone présent dans la requête HTTP GET reçue par la route est déjà
     * identifié en base de données<br/><br/>
     * <b>RedirectResponse</b> checkIfMsisdnIsAlreadyIdentifed(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
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
                /* Obtention du lien de paiement via l'API CinetPay */
                $payment_link_obtained = (new CinetPayAPI())->getPaymentLink($abonne_numero, 'Paiement Certificat Identification', env('CINETPAY_SERVICE_AMOUNT'), true);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function autoVerifyIfPaymentIsDone(Request $request) {
        /* Valider les variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            't' => ['required', 'string', 'max:100'], // Token generique
            'ti' => ['nullable', 'string', 'max:100'], // ID de transaction
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
            'msisdn' => ['required', 'string', 'max:20'], // Numero de telephone
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
        return redirect()->route('front_office.page.consultation')->with([
            'error' => true,
            'error_message' => 'Erreur est survenue lors du téléchargement du certificat d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Controle par scan QR Code du certificat d'identification<br/><br/>
     * <b>RedirectResponse</b> checkCertificate(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
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
            return redirect()->route('front_office.page.consultation')->with([
                'error' => true,
                'error_message' => 'Ce certificat n\'est pas ou plus valide !'
            ]);
        }
        /* Retourner vue resultat */
        return redirect()->route('front_office.page.consultation')->with([
            'error' => true,
            'error_message' => 'Certificat incorrect !'
        ]);
    }

}
