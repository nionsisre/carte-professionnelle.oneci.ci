<?php

namespace App\Imports;

use App\Models\AbonnesNumero;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAbonnes implements ToCollection ,WithHeadingRow
{
private $numero_non_trouvers =array();
    public function collection(Collection $rows){
        $numero_non_trouvers =array();
        if (!empty($rows)){
            foreach ($rows as $row){
                //dd($row);
                $excelTel = $row['ntelephone'];
                $excelstatut = $row['statut'];
                $table = AbonnesNumero::where('abonnes_numeros.numero_de_telephone',$excelTel )->first();
                if (!empty($table)){
                    $table->abonnes_statut_id = $excelstatut;
                    $table->save();
                }else{
                    $numero_non_trouvers[]= $row;
                }
            }
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
}
