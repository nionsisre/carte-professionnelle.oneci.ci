<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Services\CinetPayAPI;
use App\Http\Services\GoogleRecaptchaV3;
use App\Http\Services\NGSerAPI;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use App\Models\Client;
use App\Models\DirecteurGeneral;
use App\Models\Juridiction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

/**
 * (PHP 5, PHP 7, PHP 8+)<br/>
 * @package    certificat-conformite
 * @subpackage Controller
 * @author     ONECI-DEV <info@oneci.ci>
 * @github     https://github.com/oneci-dev
 */
class ProcessCertificatConformiteController extends Controller {

    /**
     * @return Application|Factory|View
     */
    public function show() {

        $username = auth()->user()->last_name.' '.auth()->user()->first_name;
        $max_chars = 35;
        $username = (strlen($username) < $max_chars) ? $username : substr($username,0,($max_chars-3))."...";

        $data_columns = Schema::getColumnListing((new Client())->getTable());
        /* Retourner vue Traitement des demandes de certificat de conformité */
        return view('admin.pages.certificat-conformite.index', [
            'username' => $username,
            'role_name' => auth()->user()->usersRole->user_role_label,
            'columns' => $data_columns
        ]);

    }

    public function showDatatablesFrench() {
        return file_get_contents(base_path('resources/data/datatables/French.json'));
    }

    public function getClient(Request $request) {

        if ($request->ajax()) {
            $data = Client::with('usersRole')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

    }

}
