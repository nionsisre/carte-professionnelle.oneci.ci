<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesPreIdentifie;
use App\Models\AbonnesTypePiece;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class MainController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index() {
        return redirect()->route('certificat.menu');
    }

}
