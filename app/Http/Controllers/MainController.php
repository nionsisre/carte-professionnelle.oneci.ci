<?php

namespace App\Http\Controllers;

/**
 *
 */
class MainController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index() {
        return redirect()->route('pre-identification.menu');
    }

}
