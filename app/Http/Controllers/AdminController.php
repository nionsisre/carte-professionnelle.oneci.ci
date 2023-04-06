<?php

namespace App\Http\Controllers;

use App\Exports\ExportAbonnes;
use App\Imports\AbonneesImport;
use App\Imports\ImportAbonnes;
use App\Models\Abonne;
use App\Models\AbonnesNumero;
use App\Models\AbonnesOperateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
//Orange
        $OrangeEnattente1 = AbonnesNumero::where('abonnes_operateur_id', "1")
            ->Where('abonnes_numeros.abonnes_statut_id', "1")
            ->get();

        $OrangeEnattente2 = AbonnesNumero::where('abonnes_operateur_id', "1")
            ->Where('abonnes_numeros.abonnes_statut_id', "2")
            ->get();

        $OrangeValide = AbonnesNumero::where('abonnes_operateur_id', "1")
            ->Where('abonnes_numeros.abonnes_statut_id', "3")
            ->get();

        $OrangeReject = AbonnesNumero::where('abonnes_operateur_id', "1")
            ->Where('abonnes_numeros.abonnes_statut_id', "4")
            ->get();

        $OrangeEnattente = count($OrangeEnattente1) + count($OrangeEnattente2);

        $sommeOrange = $OrangeEnattente + count($OrangeValide) + count($OrangeReject);

//MTN
        $MtnEnattente1 = AbonnesNumero::where('abonnes_operateur_id', "2")
            ->Where('abonnes_numeros.abonnes_statut_id', "1")
            ->get();

        $MtnEnattente2 = AbonnesNumero::where('abonnes_operateur_id', "2")
            ->Where('abonnes_numeros.abonnes_statut_id', "2")
            ->get();


        $MtnValide = AbonnesNumero::where('abonnes_operateur_id', "2")
            ->Where('abonnes_numeros.abonnes_statut_id', "3")
            ->get();

        $MtnReject =AbonnesNumero::where('abonnes_operateur_id', "2")
            ->Where('abonnes_numeros.abonnes_statut_id', "4")
            ->get();

        $MtnEnattente = count($MtnEnattente1) + count($MtnEnattente2) ;

        $sommeMtn = $MtnEnattente + count($MtnValide) + count($MtnReject);

//Moov
        $MoovEnattente1 = AbonnesNumero::where('abonnes_operateur_id', "3")
            ->Where('abonnes_numeros.abonnes_statut_id', "1")
            ->get();

        $MoovEnattente2 = AbonnesNumero::where('abonnes_operateur_id', "3")
            ->Where('abonnes_numeros.abonnes_statut_id', "2")
            ->get();


        $MoovValide = AbonnesNumero::where('abonnes_operateur_id', "3")
            ->Where('abonnes_numeros.abonnes_statut_id', "3")
            ->get();


        $MoovReject = AbonnesNumero::where('abonnes_operateur_id', "3")
            ->Where('abonnes_numeros.abonnes_statut_id', "4")
            ->get();

        $MoovEnattente = count($MoovEnattente1) + count($MoovEnattente2);

        $sommeMoov = $MoovEnattente + count($MoovValide) + count($MoovReject);

//Somme
        $sommeEncours =  $OrangeEnattente + $MtnEnattente + $MoovEnattente;
        $sommeValide = count($OrangeValide) + count($MtnValide) + count($MoovValide);
        $sommeRejet = count($OrangeReject) + count($MtnReject) + count($MoovReject);
        $somme = $sommeEncours + $sommeValide + $sommeRejet;

        $data = collect();
//
        $operateurs = AbonnesOperateur::with("abonnesnumeros")->get();

        return view('admin/dashbord',compact('OrangeEnattente','sommeOrange','OrangeValide','OrangeReject',
                    'MtnEnattente','sommeMtn','MtnValide','MtnReject',
                    'MoovEnattente','sommeMoov','MoovValide','MoovReject',
                    'somme','sommeValide','sommeRejet','sommeEncours',
                    'data',
                    'operateurs'
                ));
//        return view('admin/dashbord', compact('operateurs'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $users  = User::all();
        return view('admin/setting', compact('users'));
    }

    public function adduser()
    {
        return view('admin/add-user');
    }
    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function postadduser(Request $request)
    {
        $pass = $request->password;
        $passhash = Hash::make($pass);


        $users = User::where('email', $request->email)->get();

        foreach ($users as $user){
            if ($user){
                return redirect()->route("user")->with("error", "Ce compte pourrait exister déja.!!");
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->identifiant = $request->login;
        $user->password = $passhash;
        $user->direction = $request->direction;
        $user->service = $request->service;
        $user->fonction = $request->fonction;
        $user->role = $request->role;
        $user->dateop = date('Y-m-d');

        $user->save();

        return redirect()->route("user")->with("info", "Ajout avec sucess");
    }


    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function updateuser(Request $request)
    {
        $this->validate($request,[
            'id'=> 'required',
            'role'=> 'required',
        ], [
            'id.required'=> 'message sur id',
            'role.required'=> 'message status',
        ]);

        $updateUser = User::find($request->id);
        $updateUser->role = $request->role;
        $updateUser->userupdate = Auth::user()->identifient;
        $updateUser->save();

        return redirect()->route("setting")->with("info", "mise à jours avec sucess");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function importation() {

        return view('admin/importation');

    }



    public function import(Request $request) {
        $this->validate($request, [
            'fichier' => 'required|file|mimes:xlsx'
        ]);
            $importAbonnes = new ImportAbonnes();
            Excel::import($importAbonnes, $request->file('fichier')->store('temp'));
            return back()->with([
                "success" => "Importation effectuée avec succès",
                "cles" => $importAbonnes->getRows(),
                "files" => $importAbonnes->getTables()
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function exportation() {

        return view('admin/exportation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function export(Request $request) {
        $abonne = $request->session()->get('abonnes');
        //dd($abonne);
        $ope  = $abonne[0];
        $status = $abonne[1];
        $date1 = $abonne[2];
        $date2 = $abonne[3];
        //dd($ope,$status);
        $file_name = 'abonne'.date('YmdHis').'.xlsx';
        return Excel::download(new ExportAbonnes($ope,$status,$date1,$date2), $file_name);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function operateur(Request $request) {
        // operateur 1 =orange; 2=mtn; 3=moov
        // statut 1 =IAT, 2=DDA, 3=IDV, 4=IDR

        $request->validate([
            'operateur' => 'required',
        ], [
            'operateur.required'=> 'message sur id',
        ]);

        $op = $request->operateur;
        $st = $request->statut;
        $date1 = $request->date1." 00:00:00";
        $date2 = $request->date2." 23:59:59";

//        dd($op,$st,$date1,$date2);

        if ($op == 0 &&  $st == 0 && $date1 == " 00:00:00" && $date2 == " 23:59:59"){/* Tous les operateurs et tous les statuts*/
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                'abonnes_operateurs.libelle_operateur',
                'abonnes_numeros.numero_de_telephone',
                'abonnes.numero_dossier',
                'abonnes.numero_document',
                'abonnes.nom',
                'abonnes.prenoms',
                'abonnes.date_de_naissance',
                'abonnes.lieu_de_naissance',
                'abonnes.nationalite',
                'abonnes.type_cni',
                'abonnes.genre',
                'abonnes_statuts.libelle_statut',
                'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->get();
                //dd("ok1",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif ($op == 0 &&  $st == 0 && $date1 !== " 00:00:00" && $date2 !== " 23:59:59"){/* Tous les operateurs et tous les statuts et par periode */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->get();
            //dd("ok2",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));

        }

        elseif ($op == 0 &&  $st !== 0 && $date1 == " 00:00:00" && $date2 == " 23:59:59") {/* Tous les operateurs et differents statuts */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->Where('abonnes_statuts.id', $st)
                ->get();
//            dd("ok3",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif($op == 0 &&  $st !== 0 && $date1 !== 0 && $date2 !== 0){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_numeros.abonnes_operateur_id','=','abonnes_operateurs.id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->Where('abonnes_statuts.id', $st)
                ->get();
//            dd("ok4",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif($op !== 0 &&  $st == 0  && $date1 == " 00:00:00" && $date2 == " 23:59:59"){/* differents les operateurs et Tous statuts  */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->get();
            //dd("ok5",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif($op !== 0 &&  $st == 0 && $date1 !== 0 && $date2 !== 0){/* differents les operateurs et Tous statuts  */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->get();
//            dd("ok6",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif($op !== 0 &&  $st  !== 0 && $date1 == " 00:00:00" && $date2 == " 23:59:59"){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->get();
//            dd("ok7",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

        elseif($op !== 0 &&  $st !== 0 && $date1 !== 0 && $date2 !== 0){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_numeros.abonnes_operateur_id','=','abonnes_operateurs.id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->get();
//            dd("ok8",$op,$st,$date1,$date2,$operateurs);
            return view('admin/operateur-result', compact('operateurs'));
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function validation() {
        $operateurs = DB::table('abonnes_numeros')
            ->select('abonnes_numeros.id',
                'abonnes_numeros.observation',
                'abonnes_numeros.created_at',
                'abonnes_operateurs.libelle_operateur',
                'abonnes_numeros.numero_de_telephone',
                'abonnes.numero_dossier',
                'abonnes.numero_document',
                'abonnes.nom',
                'abonnes.prenoms',
                'abonnes.date_de_naissance',
                'abonnes.lieu_de_naissance',
                'abonnes.nationalite',
                'abonnes.type_cni',
                'abonnes.genre',
                'abonnes_statuts.libelle_statut',
                'abonnes.document_justificatif')
            ->join('abonnes_operateurs','abonnes_numeros.abonnes_operateur_id','=','abonnes_operateurs.id')
            ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
            ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
            ->get();
        return view('admin/validation', compact('operateurs'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function validationSearch(Request $request) {

        $request->validate([
            'operateur' => 'required',
        ], [
            'operateur.required'=> 'message sur id',
        ]);

        // operateur 1 =orange; 2=mtn; 3=moov
        // statut 1 =IAT. 3=IDV. 4=IDR

        $op = $request->operateur;
        $st = $request->statut;
        $date1 = $request->date1." 00:00:00";
        $date2 = $request->date2." 23:59:59";
//        dd($op,$st,$date1,$date2);
        $request->session()->put('abonnes', [
            $op,
            $st,
            $date1,
            $date2
        ]);
//        dd($op,$st,$date1,$date2);
        if ($op == 0 &&  $st == 0 && $date1 == " 00:00:00" && $date2 == " 23:59:59"){/* Tous les operateurs et tous les statuts*/
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->get();
            //dd($date1,$date2,$operateurs);

        }elseif ($op == 0 &&  $st == 0 && $date1 != 0 && $date2 != 0){/* Tous les operateurs et tous les statuts et par periode */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->get();
            //dd($date1,$date2,$operateurs);

        }elseif ($op == 0 &&  $st != 0 ) {/* Tous les operateurs et differents statuts */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->Where('abonnes_statuts.id', $st)
                ->get();
            //dd($date1,$date2, $operateurs);
        } elseif($op != 0 &&  $st == 0  ){/* differents les operateurs et Tous statuts  */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->get();
//            dd($date1,$date2, $operateurs);
        }elseif($op != 0 &&  $st  != 0 ){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->get();
        } elseif($op != 0 &&  $st != 0 && $date1 != 0 && $date2 != 0){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.id',
                    'abonnes_numeros.observation',
                    'abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.nom',
                    'abonnes.prenoms',
                    'abonnes.date_de_naissance',
                    'abonnes.lieu_de_naissance',
                    'abonnes.nationalite',
                    'abonnes.type_cni',
                    'abonnes.genre',
                    'abonnes_statuts.libelle_statut',
                    'abonnes.document_justificatif')
                ->join('abonnes_operateurs','abonnes_numeros.abonnes_operateur_id','=','abonnes_operateurs.id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->whereBetween('abonnes_numeros.created_at',  [$date1,$date2])
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->get();
        }
//        dd($operateurs);
//        return redirect()->route('abonnes.validation',compact('operateurs'));
        return view('admin/validation-search-result', compact('operateurs'));
    }


    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validationupdate(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'id'=> 'required',
            'status'=> 'required',
        ], [
            'id.required'=> 'message sur id',
            'status.required'=> 'message status',
        ]);
        $operateurs = AbonnesNumero::find($request->id);
        $operateurs->abonnes_statut_id = $request->status;
        $operateurs->observation = $request->txtobservation;
        $operateurs->save();
//        return view('admin/validation-search-result', compact('operateurs'));
      return redirect()->route('abonnes.validation')->with(['info'=> 'valider avec succes']);


    }


}
