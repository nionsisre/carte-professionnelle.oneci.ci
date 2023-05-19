<?php

namespace App\Imports;

use App\Models\Abonne;
use App\Models\AbonnesNumero;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAbonnes implements ToCollection ,WithHeadingRow
{
private $numero_non_trouvers =array();
private $ficher_importer =array();
    public function collection(Collection $rows){
        $numero_non_trouvers =array();
        $ficher_importer =array();
        if (!empty($rows)){
            foreach ($rows as $row){
//                dd($row);
                $excelTel = $row['ntelephone'];
                $excelstatut = $row['statut'];
                $excelobservation = $row['observation'];
                $excelnumdoss= $row['ndossier'];
                $ficher_importer[]= $row;

                $table = DB::table('abonnes_numeros')
                    ->select('abonnes_numeros.id','abonnes_numeros.numero_de_telephone', 'abonnes.numero_dossier','abonnes_numeros.observation','abonnes_numeros.abonnes_statut_id')
                    ->join('abonnes_operateurs', 'abonnes_numeros.abonnes_operateur_id', '=', 'abonnes_operateurs.id')
                    ->join('abonnes', 'abonnes.id', '=', 'abonnes_numeros.abonne_id')
                    ->join('abonnes_statuts', 'abonnes_statuts.id', '=', 'abonnes_numeros.abonnes_statut_id')
                    ->where('abonnes_numeros.numero_de_telephone', $excelTel)
                    ->where('abonnes.numero_dossier', $excelnumdoss)
                    ->first();

                if ($table !== null){
                    $abonnesNumeros = AbonnesNumero::find($table->id);
                    $abonnesNumeros->abonnes_statut_id = $excelstatut;
                    $abonnesNumeros->observation = $excelobservation;
                    $abonnesNumeros->save();
//                    dd($table,$abonnesNumeros);

                }else{
                    $numero_non_trouvers[] = (array) $row;
                }

            }
            $this->ficher_importer = $ficher_importer;
            $this->numero_non_trouvers = $numero_non_trouvers;
        }
    }

    // Specify header row index position to skip
    public function headingRow(): int {
        return 1;
    }

    public function getRows():array {
        return $this->numero_non_trouvers;
    }

    public function getTables():array {
        return $this->ficher_importer;
    }
}
