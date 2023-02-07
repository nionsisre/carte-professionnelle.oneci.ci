<?php

namespace App\Exports;

use App\Models\Procuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportAbonnes implements FromCollection, WithHeadings, WithStyles
{

    use Exportable;
    protected $ope;
    protected $status;
    protected $date1;
    protected $date2;

    function __construct($ope,$status,$date1,$date2) {
        $this->ope= $ope;
        $this->status = $status;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //dd($this->ope,$this->status);
        if ($this->ope == 0 &&  $this->status == 0 && $this->date1 == " 00:00:00" && $this->date2 == " 23:59:59"){/* Tous les operateurs et tous les statuts*/
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
            //dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        }elseif ($this->ope == 0 &&  $this->status == 0 && $this->date1 != 0 && $this->date2 != 0){/* Tous les operateurs et differents statuts */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
                ->whereBetween('abonnes_numeros.created_at',  [$this->date1,$this->date2])
                ->get();
            //dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        } elseif ($this->ope == 0 &&  $this->status  != 0){/* Tous les operateurs et differents statuts */
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
                ->Where('abonnes_statuts.id', $this->status )
                ->get();
            //dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        }elseif($this->ope != 0 &&  $this->status  == 0 ){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
                ->where('abonnes_operateurs.id', $this->ope)
                ->get();
            //dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        }elseif($this->ope != 0 &&  $this->status  != 0 ){
            //dd($this->ope,$this->status);
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
                ->where('abonnes_operateurs.id', $this->ope)
                ->Where('abonnes_statuts.id', $this->status)
                ->get();
           // dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        }elseif($this->ope != 0 &&  $this->status != 0 && $this->date1 != 0 && $this->date2 != 0){
            $operateurs = DB::table('abonnes_numeros')
                ->select('abonnes_numeros.created_at',
                    'abonnes_operateurs.libelle_operateur',
                    'abonnes_numeros.numero_de_telephone',
                    'abonnes.numero_dossier',
                    'abonnes.numero_document',
                    'abonnes.abonnes_type_piece_id',
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
                ->whereBetween('abonnes_numeros.created_at',[$this->date1,$this->date2])
                ->where('abonnes_operateurs.id', $this->status)
                ->Where('abonnes_statuts.id', $this->ope)
                ->get();
            //dd($operateurs);
            $result = array();
            $index=1;
            foreach($operateurs as $operateur){
                $indice =$index++;
                $result[] = array(
                    '#' => $indice,
                    'libelle_operateur'=>$operateur->libelle_operateur,
                    'numero_de_telephone'=>$operateur->numero_de_telephone,
                    'numero_dossier'=>$operateur->numero_dossier,
                    'numero_document'=>$operateur->numero_document,
                    'abonnes_type_piece_id'=>$operateur->abonnes_type_piece_id,
                    'nom'=>$operateur->nom,
                    'prenoms'=>$operateur->prenoms,
                    'date_de_naissance'=>$operateur->date_de_naissance,
                    'lieu_de_naissance'=>$operateur->lieu_de_naissance,
                    'nationalite'=>$operateur->nationalite,
                    'genre'=>$operateur->genre,
                    'libelle_statut'=>$operateur->libelle_statut,
                );
            }
        }


        return collect($result);
    }

    public function headings(): array
    {
        return [
            'N°',
            'Operateur',
            'N°telephone',
            'N°dossier',
            'N°document',
            'Type de document',
            'Nom',
            'Prenoms',
            'Date de naissance',
            'Lieu de naissance',
            'Nationalite',
            'Genre',
            'Statut'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1  => ['font' => [
                'bold' => true,
                'size' => 12,
                'italic' => true,]],

            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            //'C'  => ['font' => ['size' => 16]],
        ];
    }

}
