<?php

namespace App\Http\Controllers;

use App\Mail\MailONECI;
use App\Models\Abonne;
use App\Models\AbonnesNumero;
use App\Models\AbonnesOperateur;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpFoundation\Response;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    identification-abonnes-mobile
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class IdentificationController extends Controller {

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
            $this->verifyGoogleRecaptchaV3($request)['error'] ??
                redirect()->route('consultation_statut_identification')->with($this->verifyGoogleRecaptchaV3($request));
        }
        /* Valider variables du formulaire */
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
            'document-number' => ['required', 'string', 'max:150'],
            'document-expiry' => ['nullable', 'string', 'max:11'],
        ]);
        /* Stocker variables en base */
        $numero_dossier = time();
        $document_justificatif_filename = 'identification' . '_' . time() . '.' . $request->pdf_doc->extension();
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
        $this->sendMailTemplate('layouts.recu-identification', [
            'title' => 'Reçu d\'identification',
            'qrcode' => $this->generateQrBase64(route('obtenir_info_abonne').'?f='.$abonne->numero_dossier.'&t='.$abonne->uniqid),
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
        ]);
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
                $otp_msisdn_tokens[$i] = $this->createToken(0);
            }
            session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
        }
        /* Retourner vue resultat */
        return redirect()->route('accueil')->with('abonne_numeros', $abonne_numeros);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Recherche d'une identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> search(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function search(Request $request) {
        /* Search according if it's a 'Form POST search' or a 'Url GET search' */
        if($request->get('t') === null && $request->get('f') === null) {
            /* Si le service de vérification Google reCAPTCHA v3 est actif */
            if(config('services.recaptcha.enabled')) {
                $this->verifyGoogleRecaptchaV3($request)['error'] ??
                    redirect()->route('consultation_statut_identification')->with($this->verifyGoogleRecaptchaV3($request));
            }
            /* Search with msisdn or form number */
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
            /* Génération d'un token certificat pour chaque numéro de téléphone < Identifié > en session */
            if(sizeof($abonne_numeros) !== 0) {
                for ($i = 0; $i < sizeof($abonne_numeros); $i++) $certificate_msisdn_tokens[$i] = $this->createToken(0);
                session()->put('certificate_msisdn_tokens', $certificate_msisdn_tokens);
                /* Si le service d'envoi de SMS est actif */
                if(config('services.sms.enabled')) {
                    /* Génération d'un token OTP pour chaque numéro de téléphone en session */
                    for ($i = 0; $i < sizeof($abonne_numeros); $i++) {
                        $otp_msisdn_tokens[$i] = $this->createToken(0);
                    }
                    session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
                }
                return redirect()->route('consultation_statut_identification')->with('abonne_numeros', $abonne_numeros);
            } else {
                return redirect()->route('consultation_statut_identification');
            }
        } elseif ($request->get('f') != null && $request->get('t') != null) {
            /* Url GET search */
            $abonne_numeros = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes.numero_dossier', '=', $request->get('f'))
                ->get();
            if ($abonne_numeros[0]->uniqid === $request->get('t')) {
                /* Génération d'un token certificat pour chaque numéro de téléphone < Identifié > en session */
                for ($i = 0; $i < sizeof($abonne_numeros); $i++) $certificate_msisdn_tokens[$i] = $this->createToken(0);
                session()->put('certificate_msisdn_tokens', $certificate_msisdn_tokens);
                /* Si le service d'envoi de SMS est actif */
                if(config('services.sms.enabled')) {
                    /* Génération d'un token OTP pour chaque numéro de téléphone en session */
                    for ($i = 0; $i < sizeof($abonne_numeros); $i++) {
                        $otp_msisdn_tokens[$i] = $this->createToken(0);
                    }
                    session()->put('otp_msisdn_tokens', $otp_msisdn_tokens);
                }
                return redirect()->route('consultation_statut_identification')->with('abonne_numeros', $abonne_numeros);
            }
        }

        return redirect()->route('consultation_statut_identification');
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Vérification du statut pour détection de numéro déjà vérifié<br/><br/>
     * <b>RedirectResponse</b> statusCheck(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function statusCheck(Request $request) {
        /* Valider variables du formulaire */
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
     * Obtention d'un lien de paiement<br/><br/>
     * <b>RedirectResponse</b> getPaymentLink(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getPaymentLink(Request $request) {
        /* Valider variables du formulaire */
        request()->validate([
            'cli' => ['required', 'string', 'max:100'], // Url du client
            'tn' => ['required', 'string', 'max:100'], // Token du client
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier de l'abonne
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de l'abonne
        ]);
        /* Vérification du Token client */
        try {
            $client_certificate_msisdn_token = $request->input('tn');
            $session_certificate_msisdn_tokens = session()->get('certificate_msisdn_tokens');
            for ($i=0;$i<sizeof($session_certificate_msisdn_tokens);$i++) {
                if ($this->checkToken($client_certificate_msisdn_token, $session_certificate_msisdn_tokens[$i])) {
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
                /* Récupération des numéros de telephone de l'abonné à partir du numéro de dossier */
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
                $payment_link_obtained = $this->getPaymentLinkCinetPayAPI($abonne_numero);
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
        } catch (\Exception $e) {
            return response([
                'has_error' => true,
                'message' => 'Veuillez actualiser la page et/ou réessayer plus tard SVP'. $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Obtention d'un certificat d'identification ONECI<br/><br/>
     * <b>RedirectResponse</b> getCertificate(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function getCertificate(Request $request) {
        /* Valider variables du formulaire */
        request()->validate([
            't' => ['required', 'string', 'max:100'], // Token generique
            'ti' => ['nullable', 'string', 'max:100'], // ID de transaction
            'fn' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
            'idx' => ['required', 'numeric', 'max:10'], // Index de position du numero de telephone
            'oid' => ['required', 'string', 'max:70'], // Operator ID (CinetPAY)
            'ari' => ['required', 'string', 'max:70'], // API Response ID (CinetPAY)
            'code' => ['required', 'string', 'max:70'], // Code (CinetPAY)
            'msg' => ['nullable', 'string', 'max:150'], // Message retour API CinetPAY
            'pm' => ['required', 'string', 'max:150'], // Methode de paiement CinetPAY
            'pd' => ['required', 'string', 'max:150'], // Date de paiement CinetPAY
        ]);
        /* Vérification du Token générique */
        if($request->input('t') !== md5(sha1('s@lty'.$request->input('fn').'s@lt'))) {
            return redirect()->route('consultation_statut_identification');
        } else {
            /* Vérification de l'ID de transaction chez CinetPAY */
            $payment_data = $this->verifyCinetPayAPI($request->input('ti'));
            if($payment_data['has_error']) {
                return redirect()->route('consultation_statut_identification');
            } else {
                /* Récupération des numéros de telephone de l'abonné à partir du numéro de dossier */
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
                    return redirect()->route('consultation_statut_identification');
                }
                /* Récupération du numéro de telephone valide et sauvegarde les informations de paiement en base de données */
                $abonne_numero = $abonne_numeros[$request->input('idx')];
                DB::table('abonnes_numeros')
                    ->where('abonne_id','=', $abonne_numero->abonne_id)
                    ->where('numero_de_telephone','=', $abonne_numero->numero_de_telephone)
                    ->update([
                        'transaction_id' => $payment_data['transaction_id'],
                        'cinetpay_api_response_id' => $payment_data['data']['api_response_id'],
                        'cinetpay_code' => $payment_data['data']['code'],
                        'cinetpay_message' => $payment_data['data']['message'],
                        'cinetpay_data_amount' => $payment_data['data']['data']['amount'],
                        'cinetpay_data_currency' => $payment_data['data']['data']['currency'],
                        'cinetpay_data_status' => $payment_data['data']['data']['status'],
                        'cinetpay_data_payment_method' => $payment_data['data']['data']['payment_method'],
                        'cinetpay_data_description' => $payment_data['data']['data']['description'],
                        'cinetpay_data_metadata' => $payment_data['data']['data']['metadata'],
                        'cinetpay_data_operator_id' => $payment_data['data']['data']['operator_id'],
                        'cinetpay_data_payment_date' => $payment_data['data']['data']['payment_date'],
                        'certificate_download_link' => md5($request->input('fn').$payment_data['transaction_id'].$payment_data['data']['data']['operator_id']),
                    ]);
                return redirect()->route('consultation_statut_identification')->with('abonne_numeros', $abonne_numeros);
            }
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Impression du reçu d'identification<br/><br/>
     * <b>RedirectResponse</b> printRecu(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function printRecu(Request $request) {
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
                    'qrcode' => $this->generateQrBase64(route('obtenir_info_abonne') . '?f=' . $identification_resultats->numero_dossier . '&t=' . $identification_resultats->uniqid),
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
                /* Envoi de mail */
                /*if (!empty($identification_resultats->email)) {
                    $this->sendMailTemplate('layouts.recu-identification', $data);
                }*/
                /*$request->session()->remove('numero_dossier');*/
                return $pdf_recu_identification->download($filename);
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('consulter_statut_identification')->with([
            'error' => true,
            'error_message' => 'Erreur est survenue lors du téléchargement du reçu d\'identification. Veuillez actualiser la page et/ou réessayer plus tard'
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Impression du certificat d'identification<br/><br/>
     * <b>RedirectResponse</b> printCertficate(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     */
    public function printCertificate(Request $request) {
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
                        'qrcode' => $this->generateQrBase64(route('checker_certificat_identification') . '?c=' . $identification_resultats->certificate_download_link, 183, 1),
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
                        $this->sendMailTemplate('layouts.certificat-identification', $data);
                    }*/
                    return $pdf_certificat_identification->download($filename);
                }
            }
        }
        /* Retourner vue resultat */
        return redirect()->route('consultation_statut_identification')->with([
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
                        'qrcode' => $this->generateQrBase64(route('checker_certificat_identification') . '?c=' . $identification_resultats->certificate_download_link, 183, 1),
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
            return redirect()->route('consultation_statut_identification')->with([
                'error' => true,
                'error_message' => 'Ce certificat n\'est pas ou plus valide !'
            ]);
        }
        /* Retourner vue resultat */
        return redirect()->route('consultation_statut_identification')->with([
            'error' => true,
            'error_message' => 'Certificat incorrect !'
        ]);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * QrCode Raw Image Generator from Request Message<br/><br/>
     * <b>void</b> generateQrCode(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return bool Return true after displaying QrCode
     */
    public function generateQrCode(Request $request) {
        $message = $request->get('m');
        $qrresult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($message)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        /* Directly output the QR code */
        header('Content-Type: '.$qrresult->getMimeType());
        echo $qrresult->getString();
        return true;
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * QrCode Base64 Image Generator from String Message<br/><br/>
     * <b>void</b> generateQrBase64(<b>String</b> $message [, <b>Integer</b> $size, <b>Integer</b> $margin])<br/>
     * @param String $message <p>QR Code message.</p>
     * @param Integer $size <p>QR Code size (optional).</p>
     * @param Integer $margin <p>QR Code margin (optional).</p>
     * @return String Return QrCode Base64 value
     */
    private function generateQrBase64($message, $size=300, $margin=10) {
        $qrresult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($message)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size($size)
            ->logoPath(asset('assets/images/logo_qrcode.png'))
            ->logoResizeToWidth(60)
            ->margin($margin)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
            /*
            ->logoPath(URL::asset('assets/images/logo-o-white.svg'))
            ->labelText('Numéro de dossier : '.$identification_resultats->numero_dossier)
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            */
        return $qrresult->getDataUri();
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Send custom email using a blade view layout<br/><br/>
     * <b>void</b> sendMailTemplate(<b>array</b> $data, <b>String</b> $blade_view_layout)<br/>
     * @param String $blade_view_layout <p>Blade view layout path.</p>
     * @param array $data <p>Blade view layout data</p>
     * @return bool Return true if mail is sent successfully
     */
    private function sendMailTemplate($blade_view_layout, $data) {
        $data['is_email'] = true;
        if (App::environment(['staging', 'production'])) {
            /* We use the method below because production server doesn't allow custom SMTP server */
            $headers = 'From: ONECI <' .env('MAIL_USERNAME').">\r\n";
            $headers .= 'Reply-To: ' .env('MAIL_USERNAME')."\r\n";
            /*$headers .= "CC: info@oneci.ci\r\n";*/
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $to = $data['email'];
            $subject = "Identification d'abonné mobile ONECI";
            $content = view($blade_view_layout, $data);
            mail($to, $subject, $content, $headers);
            if (mail($to, $subject, $content, $headers)) {
                return true;
            } else {
                return false;
            }
        } else {
            Mail::to($data['email'])->queue(new MailONECI($blade_view_layout, $data));
            return true;
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Google reCAPTCHA v3 Verification (works in "Staging" and "Production" only, not "Local" environment)<br/><br/>
     * <b>void</b> verifyGoogleRecaptchaV3(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return array Value of result
     */
    private function verifyGoogleRecaptchaV3(Request $request) {
        /* Google reCAPTCHA v3 Verification (works in "Staging" and "Production" only, not "Local" environment) */
        if (App::environment(['staging', 'production'])) {
            $client = new Client();
            try {
                $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                    'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                    'form_params' => [
                        'secret' => env('RECAPTCHA_SECRET'), /* config('services.recaptcha.secret'), */
                        'response' => $request->input('g-recaptcha-response'),
                        'remoteip' => $request->ip()
                    ]
                ]);
                $recaptcha_result = json_decode($response->getBody(), true);
                if (!$recaptcha_result['success']) {
                    return [
                        'error' => true,
                        'error_message' => 'Le captcha n\'a pas été correctement renseigné ou le délai a expiré. Veuillez actualiser la page et réessayer SVP'
                    ];
                }
            } catch (GuzzleException $guzzle_exception) {
                /* Moving here if something is wrong with reCAPTCHA v3 on server side service API */
                return [
                    'error' => true,
                    'error_message' => 'Une erreur interne est survenue. Veuillez réessayer plus tard. ('
                        .$guzzle_exception->getMessage()
                        .' -- Code : '.$guzzle_exception->getCode().')'
                ];
            }
        }
        return [
            'error' => false,
            'error_message' => 'reCAPTCHA sent is ok'
        ];
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Get CinetPay API payment link method<br/><br/>
     * <b>void</b> getPaymentLinkCinetPayAPI(<b>Array</b> $abonne_infos)<br/>
     * @param array $request <p>Client Request object.</p>
     * @return array Value of result
     */
    private function getPaymentLinkCinetPayAPI($abonne_infos) {
        $client = new Client();
        try {
            $transaction_id = date('Y', time()).time();
            $response = $client->request('POST', 'https://api-checkout-oneci.cinetpay.com/v2/payment', [
                'verify' => false,
                'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apikey' => env('CINETPAY_API_KEY'),
                    'site_id' => env('CINETPAY_SERVICE_KEY'),
                    'transaction_id' => $transaction_id,
                    'amount' => env('CINETPAY_SERVICE_AMOUNT'),
                    'currency' => 'XOF',
                    'alternative_currency' => '',
                    'description' => 'Paiement Certificat Identification',
                    'customer_id' => $abonne_infos->numero_dossier,
                    'customer_name' => $abonne_infos->nom,
                    'customer_surname' => $abonne_infos->prenoms,
                    'customer_email' => $abonne_infos->email,
                    'customer_phone_number' => $abonne_infos->numero_de_telephone,
                    'customer_address' => 'Antananarivo',
                    'customer_city' => 'Antananarivo',
                    'customer_country' => 'CM',
                    'customer_state' => 'CM',
                    'customer_zip_code' => '065100',
                    'channels' => 'ALL',
                    'metadata' => 'user1',
                    'lang' => 'FR',
                    'invoice_data' => [
                        'Numéro de validation' => $abonne_infos->numero_dossier
                    ],
                ]
            ]);
            $cinetpay_api_result = json_decode($response->getBody(), true);
            /* Response check up */
            if ($cinetpay_api_result['code']=='201') {
                return [
                    'has_error' => false,
                    'message' => '<a id="payment-link" target="_blank" href="'.$cinetpay_api_result['data']['payment_url'].'" class="button payment-link" style="margin-bottom: 0"><i class="fa fa-sack-dollar text-white"></i> &nbsp; Procéder au paiement...</a>',
                    'data' => $cinetpay_api_result['data'],
                    'transaction_id' => $transaction_id
                ];
            } else {
                return [
                    'has_error' => true,
                    'message' => 'Payment failed'
                ];
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with CinetPay API */
            return [
                'has_error' => true,
                'message' => 'CinetPay API client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * CinetPAY transaction ID Verification (works in "Staging" and "Production" only, not "Local" environment)<br/><br/>
     * <b>void</b> verifyCinetPayAPI(<b>Request</b> $request)<br/>
     * @param String $transaction_id <p>Transaction ID.</p>
     * @return array Value of result
     */
    private function verifyCinetPayAPI($transaction_id) {
        /* CinetPAY transaction ID Verification (works in "Staging" and "Production" only, not "Local" environment) */
        $client = new Client();
        try {
            $response = $client->request('POST', env('CINETPAY_CHECK_URL'), [
                'verify' => false,
                'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'apikey' => env('CINETPAY_API_KEY'),
                    'site_id' => env('CINETPAY_SERVICE_KEY'),
                    'transaction_id' => $transaction_id,
                ]
            ]);
            $cinetpay_api_result = json_decode($response->getBody(), true);
            /* Response check up */
            if ($cinetpay_api_result['data']['status']=='ACCEPTED') {
                return [
                    'has_error' => false,
                    'message' => 'Payment done !',
                    'data' => $cinetpay_api_result,
                    'transaction_id' => $transaction_id
                ];
            } else {
                return [
                    'has_error' => true,
                    'message' => 'Payment failed',
                    'data' => $cinetpay_api_result,
                    'transaction_id' => $transaction_id
                ];
            }
        } catch (GuzzleException $guzzle_exception) {
            /* Moving here if something is wrong with CinetPay API */
            return [
                'has_error' => true,
                'message' => 'CinetPay API client exception : ['
                    .$guzzle_exception->getMessage()
                    .' -- Code : '.$guzzle_exception->getCode().']'
            ];
        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Notification de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> notifyCinetPayAPI(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function notifyCinetPayAPI(Request $request) {
        /* @TODO: Mettre à jour les informations de paiement fournie par CinetPAY */
//        request()->validate([
//            'cpm_site_id' => ['required', 'string', 'max:100'], // Token generique
//            'cpm_trans_id' => ['nullable', 'string', 'max:100'], // ID de transaction
//            'cpm_trans_date' => ['required', 'string', 'max:10'], // Numero de dossier (validation)
//            'cpm_amount' => ['required', 'numeric', 'max:10'], // Index de position du numero de telephone
//            'cpm_currency' => ['required', 'string', 'max:70'], // Operator ID (CinetPAY)
//            'signature' => ['required', 'string', 'max:70'], // API Response ID (CinetPAY)
//            'payment_method' => ['required', 'string', 'max:70'], // Code (CinetPAY)
//            'cel_phone_num' => ['nullable', 'string', 'max:150'], // Message retour API CinetPAY
//            'cpm_phone_prefixe' => ['required', 'string', 'max:150'], // Methode de paiement CinetPAY
//            'cpm_payment_config' => ['required', 'string', 'max:150'], // Date de paiement CinetPAY
//        ]);
//        /* Vérification du Token générique */
//        if($request->input('t') !== md5(sha1('s@lty'.$request->input('fn').'s@lt'))) {
//            return redirect()->route('consultation_statut_identification');
//        } else {
//            /* Vérification de l'ID de transaction chez CinetPAY */
//            $payment_data = $this->verifyCinetPayAPI($request->input('ti'));
//            if($payment_data['has_error']) {
//                return redirect()->route('consultation_statut_identification');
//            } else {
//                /* Récupération des numéros de telephone de l'abonné à partir du numéro de dossier */
//                $abonne_numeros = DB::table('abonnes_numeros')
//                    ->select('*')
//                    ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
//                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
//                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
//                    ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
//                    ->where('abonnes.numero_dossier', '=', $request->input('fn'))
//                    ->get();
//                /* Vérification du statut du numéro de téléphone : seuls les numéros valides sont autorisés */
//                if(!isset($abonne_numeros[$request->input('idx')]) || $abonne_numeros[$request->input('idx')]->code_statut!=='NUI') {
//                    return redirect()->route('consultation_statut_identification');
//                }
//                /* Récupération du numéro de telephone valide et sauvegarde les informations de paiement en base de données */
//                $abonne_numero = $abonne_numeros[$request->input('idx')];
//                DB::table('abonnes_numeros')
//                    ->where('abonne_id','=', $abonne_numero->abonne_id)
//                    ->where('numero_de_telephone','=', $abonne_numero->numero_de_telephone)
//                    ->update([
//                        'transaction_id' => $payment_data['transaction_id'],
//                        'cinetpay_api_response_id' => $payment_data['data']['api_response_id'],
//                        'cinetpay_code' => $payment_data['data']['code'],
//                        'cinetpay_message' => $payment_data['data']['message'],
//                        'cinetpay_data_amount' => $payment_data['data']['data']['amount'],
//                        'cinetpay_data_currency' => $payment_data['data']['data']['currency'],
//                        'cinetpay_data_status' => $payment_data['data']['data']['status'],
//                        'cinetpay_data_payment_method' => $payment_data['data']['data']['payment_method'],
//                        'cinetpay_data_description' => $payment_data['data']['data']['description'],
//                        'cinetpay_data_metadata' => $payment_data['data']['data']['metadata'],
//                        'cinetpay_data_operator_id' => $payment_data['data']['data']['operator_id'],
//                        'cinetpay_data_payment_date' => $payment_data['data']['data']['payment_date'],
//                        'certificate_download_link' => md5($request->input('fn').$payment_data['transaction_id'].$payment_data['data']['data']['operator_id']),
//                    ]);
//                return redirect()->route('consultation_statut_identification')->with('abonne_numeros', $abonne_numeros);
//            }
//        }
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * retour de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> returnCinetPayAPI(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function returnCinetPayAPI(Request $request) {

    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Annulation de Paiement par l'API CinetPay<br/><br/>
     * <b>RedirectResponse</b> cancelCinetPayAPI(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function cancelCinetPayAPI(Request $request) {

    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function is useful to generate Token<br/><br/>
     * <b>array</b> createToken(<b>int</b> $expireTime)<br/>
     * @param int $expireTime <p>
     * Received token via post. <br/>Use <b>0</b> or <b>negative int</b> to infinite expiry date.
     * </p>
     * @return array Value of result
     */
    private function createToken($expireTime) {
        $token['value'] = sha1(md5("\$@lty".uniqid(rand(), TRUE)."\$@lt"));
        $token['time'] = $expireTime;
        session()->put('token_time', time());
        return $token;
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function checks generated token<br/><br/>
     * <b>bool</b> checkToken(<b>string</b> $token_received, <b>array</b> $token_session)<br/>
     * @param string $token_received <p>
     * Received token via post
     * </p>
     * @param array $token_session <p>
     * Session token variable
     * </p>
     * @return bool Value of result
     */
    private function checkToken($token_received, $token_session){
        try {
            $token_age = time() - session()->get('token_time', time());
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return FALSE;
        }
        if ( ($token_received===$token_session["value"]) && $token_session['time']<=0 ) {
            return TRUE;
        } elseif ( ($token_received===$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return TRUE;
        } elseif ( ($token_received===$token_session["value"]) && ($token_age>$token_session['time']) ) {
            return FALSE;
        } elseif ( ($token_received!==$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return FALSE;
        } elseif ( ($token_received!==$token_session["value"]) && ($token_age<=$token_session['time']) ) {
            return FALSE;
        }
        return FALSE;
    }

}
