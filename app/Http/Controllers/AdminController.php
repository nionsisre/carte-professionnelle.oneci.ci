<?php

namespace App\Http\Controllers;

use App\Exports\ExportAbonnes;
use App\Imports\AbonneesImport;
use App\Imports\ImportAbonnes;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
////Orange
//        $OrangeEnattente = AbonnesNumero::where('abonnes_operateur_id', "1")
//            ->Where('abonnes_numeros.abonnes_statut_id', "1")
//            ->get();
//
//        $OrangeValide = AbonnesNumero::where('abonnes_operateur_id', "1")
//            ->Where('abonnes_numeros.abonnes_statut_id', "3")
//            ->get();
//
//        $OrangeReject = AbonnesNumero::where('abonnes_operateur_id', "1")
//            ->Where('abonnes_numeros.abonnes_statut_id', "4")
//            ->get();
//
//        $sommeOrange = count($OrangeEnattente) + count($OrangeValide) + count($OrangeReject);
//
////MTN
//        $MtnEnattente = AbonnesNumero::where('abonnes_operateur_id', "2")
//            ->Where('abonnes_numeros.abonnes_statut_id', "1")
//            ->get();
//
//        $MtnValide = AbonnesNumero::where('abonnes_operateur_id', "2")
//            ->Where('abonnes_numeros.abonnes_statut_id', "3")
//            ->get();
//
//        $MtnReject =AbonnesNumero::where('abonnes_operateur_id', "2")
//            ->Where('abonnes_numeros.abonnes_statut_id', "4")
//            ->get();
//
//        $sommeMtn = count($MtnEnattente) + count($MtnValide) + count($MtnReject);
//
////Moov
//        $MoovEnattente = AbonnesNumero::where('abonnes_operateur_id', "3")
//            ->Where('abonnes_numeros.abonnes_statut_id', "1")
//            ->get();
//
//        $MoovValide = AbonnesNumero::where('abonnes_operateur_id', "3")
//            ->Where('abonnes_numeros.abonnes_statut_id', "3")
//            ->get();
//
//
//        $MoovReject = AbonnesNumero::where('abonnes_operateur_id', "3")
//            ->Where('abonnes_numeros.abonnes_statut_id', "4")
//            ->get();
//
//        $sommeMoov = count($MoovEnattente) + count($MoovValide) + count($MoovReject);
//
////Somme
//        $sommeEncours =  count($OrangeEnattente) + count($MtnEnattente) + count($MoovEnattente);
//        $sommeValide = count($OrangeValide) + count($MtnValide) + count($MoovValide);
//        $sommeRejet = count($OrangeReject) + count($MtnReject) + count($MoovReject);
//        $somme = $sommeEncours + $sommeValide + $sommeRejet;
//
//        $data = collect();
//
        $operateurs = AbonnesOperateur::with("abonnesnumeros")->get();
//
//        return view('admin/index',compact('OrangeEnattente','sommeOrange','OrangeValide','OrangeReject',
//                    'MtnEnattente','sommeMtn','MtnValide','MtnReject',
//                    'MoovEnattente','sommeMoov','MoovValide','MoovReject',
//                    'somme','sommeValide','sommeRejet','sommeEncours',
//                    'data',
//                    'operateurs'
//                ));
        return view('admin/dashbord', compact('operateurs'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rapport()
    {
        return view('admin/rapport');
    }

    public function rapportsearch(Request $request)
    {

        $transationstatus = "1";
        $status = $request->status;
        $date1 = $request->date1;
        $date2 = $request->date2;

        $request->session()->put('procurations', [
            $transationstatus,
            $status,
            $date1,
            $date2
        ]);

        if ($request->status == 'En attente'){
            if($date1 == null && $date2 == null){
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->get();
            }else{
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->whereBetween('dateop',[$date1,$date2])
                    ->get();
            }
        }

        if ($request->status == 'Accepter'){
            if($date1 == null && $date2 == null){
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->get();
            }else{
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->whereBetween('dateop',[$date1,$date2])
                    ->get();
            }

        }

        if ($request->status == 'Refuser'){
            if($date1 == null && $date2 == null){
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->get();
            }else{
                $procurations = Procuration::where('procurationstatus', $status)
                    ->where('transationstatus', $transationstatus)
                    ->whereBetween('dateop',[$date1,$date2])
                    ->get();
            }

        }
        return view('admin/rapport-result', compact('procurations'));
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
//        dd($importAbonnes->getRows());
        return back()->with(["success"=>"Importation effectuée avec succes", "cles"=>$importAbonnes->getRows()]);
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
    public function operateur(Request $request) {
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

        $request->session()->put('abonnes', [
            $op,
            $st,
            $date1,
            $date2
        ]);

        if ($op == 0 &&  $st == 0 ){/* Tous les operateurs et tous les statuts*/
            $operateurs = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->get();
            //dd($operateurs);
        }elseif ($op == 0 &&  $st != 0 ){/* Tous les operateurs et differents statuts */
            $operateurs = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->Where('abonnes_statuts.id', $st)
                ->get();
            //dd($operateurs);
        } elseif($op != 0 &&  $st != 0 ){

            $operateurs = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->get();
            //dd($operateurs);
        } elseif($op != 0 &&  $st == 0 ){
            $operateurs = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->where('abonnes_operateurs.id', $op)
                ->get();
            //dd($operateurs);
        }else{
            $operateurs = DB::table('abonnes_numeros')
                ->select('*')
                ->join('abonnes_operateurs','abonnes_operateurs.id','=','abonnes_numeros.abonnes_operateur_id')
                ->join('abonnes','abonnes.id','=','abonnes_numeros.abonne_id')
                ->join('abonnes_statuts','abonnes_statuts.id','=','abonnes_numeros.abonnes_statut_id')
                ->whereBetween('abonnes_numeros.created_at',[$date1,$date2])
                ->where('abonnes_operateurs.id', $op)
                ->Where('abonnes_statuts.id', $st)
                ->get();
            //dd($operateurs);
        }
        return view('admin/operateur-result', compact('operateurs'));
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


}
