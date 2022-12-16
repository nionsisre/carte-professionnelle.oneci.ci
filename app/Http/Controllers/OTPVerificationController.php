<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    identification-abonnes-mobile
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class OTPVerificationController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission d'une demande d'envoi de SMS<br/><br/>
     * <b>RedirectResponse</b> sendSMS(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function sendSMS(Request $request) {

    }

}
