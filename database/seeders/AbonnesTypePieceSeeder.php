<?php

namespace Database\Seeders;

use App\Models\AbonnesTypePiece;
use Illuminate\Database\Seeder;

class AbonnesTypePieceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        AbonnesTypePiece::create([
            'code_type_piece' => 'ATT',
            'libelle_piece' => 'Attestation d\'Identité'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CNI',
            'libelle_piece' => 'Carte Nationale d\'Identité'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CRE',
            'libelle_piece' => 'Carte de résident'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'PSP',
            'libelle_piece' => 'Passport'
        ]);
    }

}
