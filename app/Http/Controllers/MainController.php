<?php

namespace App\Http\Controllers;

use App\Models\AbonnesOperateur;
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
     * @return Application|Factory|View
     */
    public function index(Request $request) {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.home', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function consultation() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.consultation', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function preIdentificationAbonnesMobile() {

        $mobile_header_enabled = isset($_GET['displaymode']) && $_GET['displaymode'] == 'myoneci';

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.pre-identification', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'mobile_header_enabled' => $mobile_header_enabled,
        ]);

    }


}
