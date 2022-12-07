<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
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

class IdentificationController extends Controller {

    /**
     *  Identification Form Submit
     */
    public function submit(Request $request) {
        /* @TODO: Valider variables du formulaire et recaptcha */
        /*request()->validate([
            'nom' => ['required', 'string', 'max:150'],
            'prenoms' => ['required', 'string', 'max:150'],
            'pdf_doc' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
        ]);*/
        /* @TODO: Stocker variables en base */
        $numero_dossier = time();
        $document_justificatif_filename = 'identification' . '_' . time() . '.' . $request->pdf_doc->extension();
        $document_justificatif = $request->file('pdf_doc')->storeAs('media', $document_justificatif_filename, 'public');
        $civil_status_center = ($request->input('country') == 'Côte d’Ivoire') ?
            DB::table('civil_status_center')->where('civil_status_center_id', '=', $request->input('birth-place'))->get()[0]->civil_status_center_label
            : $request->input('birth-place-2');
        $type_cni = ($request->input('country') == 'Côte d’Ivoire') ? (($request->input('doc-type') == 2) ? $request->input('id-card-type') : '') : '';
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
            'type_cni' => $type_cni
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
                    return redirect()->route('consultation_statut_identification')->with([
                        'error' => true,
                        'error_message' => 'Le captcha n\'a pas été correctement renseigné ou le délai a expiré. Veuillez actualiser la page et réessayer SVP'
                    ]);
                }
            } catch (GuzzleException $guzzle_exception) {
                /* Moving here if something is wrong with reCAPTCHA v3 on server side service API */
                return redirect()->route('consultation_statut_identification')->with([
                    'error' => true,
                    'error_message' => 'Une erreur interne est survenue. Veuillez réessayer plus tard. ('
                        .$guzzle_exception->getMessage()
                        .' -- Code : '.$guzzle_exception->getCode().')'
                ]);
            }
        }
        /* Search with msisdn or form number */
        $search_with_msisdn = $request->input('tsch');
        if ($search_with_msisdn == '0') {
            request()->validate([
                'form-number' => ['required', 'numeric', 'digits:10'],
            ]);
            $resultats_statut = DB::table('abonnes_numeros')
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
            ]);
            $resultats_statut = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
                ->where('abonnes_numeros.numero_de_telephone', '=', str_replace(' ', '', $request->input('msisdn')))
                ->get();
        }
        return redirect()->route('consultation_statut_identification')->with('resultats_statut', $resultats_statut);
    }

    /**
     * Identification Form print ticket
     */
    public function print(Request $request) {
        /* Print PDF ticket according form-number */
        /*$numero_dossier = $request->session()->get('numero_dossier');*/
        $numero_dossier = $request->get('n');
        $identification_resultats = DB::table('abonnes_numeros')
            ->select('*')
            ->join('abonnes_operateurs', 'abonnes_operateurs.id', '=', 'abonnes_numeros.abonnes_operateur_id')
            ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
            ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
            ->join('abonnes_type_pieces', 'abonnes_type_pieces.id', '=', 'abonnes.abonnes_type_piece_id')
            ->where('abonnes.numero_dossier', '=', $numero_dossier)
            ->get();
        for ($i = 0; $i < sizeof($identification_resultats); $i++) {
            $msisdn[] = $identification_resultats[$i]->numero_de_telephone.' ('.$identification_resultats[$i]->libelle_operateur.') | ';
        }
        $identification_resultats = $identification_resultats[0];
        /* QR CODE Server Generation */
        $qrresult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($identification_resultats->numero_dossier)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(100)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        /*->logoPath(URL::asset('assets/images/logo.png'))
            ->labelText('Numéro de dossier : '.$identification_resultats->numero_dossier)
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())*/
        $qrdataUri_base64 = $qrresult->getDataUri();
        /* PDF Download document generation */
        $data = [
            'title' => 'Reçu d\'identification',
            'qrcode' => $qrdataUri_base64,
            'numero_dossier' => $identification_resultats->numero_dossier,
            'msisdn_list' => $msisdn,
            'nom_complet' => $identification_resultats->prenoms.' '.$identification_resultats->prenoms,
            'date_et_lieu_de_naissance' => $identification_resultats->date_de_naissance.' à '.$identification_resultats->lieu_de_naissance,
            'lieu_de_residence' => $identification_resultats->lieu_de_naissance,
            'nationalite' => $identification_resultats->nationalite,
            'profession' => $identification_resultats->profession,
            'email' => $identification_resultats->email,
            'document_justificatif' => $identification_resultats->libelle_piece.' ('.$identification_resultats->numero_document.')',
        ];
        $filename = 'identification-'.$identification_resultats->prenoms.'-'.$identification_resultats->numero_dossier.'.pdf';
        $pdf_recu_identification = Pdf::loadView('layouts.recu-identification', $data);
        /*$request->session()->remove('numero_dossier');*/
        /*return view('layouts.recu-identification', [
            'title' => 'Reçu d\'identification',
            'qrcode' => $qrdataUri_base64,
            'numero_dossier' => $identification_resultats->numero_dossier,
            'msisdn_list' => $msisdn,
            'nom_complet' => $identification_resultats->prenoms.' '.$identification_resultats->prenoms,
            'date_et_lieu_de_naissance' => $identification_resultats->date_de_naissance.' à '.$identification_resultats->lieu_de_naissance,
            'lieu_de_residence' => $identification_resultats->lieu_de_naissance,
            'nationalite' => $identification_resultats->nationalite,
            'profession' => $identification_resultats->profession,
            'email' => $identification_resultats->email,
            'document_justificatif' => $identification_resultats->libelle_piece.' ('.$identification_resultats->numero_document.')',
        ]);*/
        return $pdf_recu_identification->download($filename);
    }

}
