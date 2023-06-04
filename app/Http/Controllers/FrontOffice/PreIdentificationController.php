<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreIdentificationController extends Controller {

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Soumission du formulaire de pré-identification par l'abonné<br/><br/>
     * <b>RedirectResponse</b> print(<b>Request</b> $request)<br/>
     * @param Request $request <p>Client Request object.</p>
     * @return \Illuminate\Http\RedirectResponse Return RedirectResponse to view
     */
    public function submit(Request $request) {
        dd($request);
    }

}
