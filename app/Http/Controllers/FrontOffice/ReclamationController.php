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
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    identification-abonnes-mobile
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class ReclamationController extends Controller {

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
                redirect()->route('front_office.page.reclamation_paiement')->with((new GoogleRecaptchaV3())->verify($request));
        }
        /* Valider les variables du formulaire */
        request()->validate([
            'transaction_id' => ['required', 'string', 'max:14'],
            'form_number' => ['required', 'string', 'max:10'],
            'msisdn' => ['required', 'string', 'max:20']
        ]);
        /* Activation de la synchronisation manuelle de paiement */
        $res_data = (new CinetPayAPI())->notify(
            $request->replace([
                'cpm_site_id' => env('CINETPAY_SERVICE_KEY'), // Token generique
                'cpm_trans_id' => $request->input('transaction_id'), // ID de transaction
                'cpm_custom' => $request->input('form_number'), // Numero de validation contenu dans la variable Metadata
                'cpm_designation' => str_replace(' ', '', $request->input('msisdn')), // Numero de telephone a actualiser
            ])
        );
        /* Retourner vue resultat */
        return redirect()->route('front_office.page.reclamation_paiement')->with('response', $res_data->original);
    }

}
