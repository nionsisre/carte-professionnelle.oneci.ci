<?php

namespace Database\Seeders;

use App\Models\CustomersTypePiece;
use Illuminate\Database\Seeder;

class CustomersTypePieceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        CustomersTypePiece::create([
            'code_type_piece' => 'CNI',
            'libelle_piece' => 'Carte nationale d\'identité'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'CRE',
            'libelle_piece' => 'Carte de résident'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'AEB',
            'libelle_piece' => 'Attestation d\'enrôlement biométrique'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'CRT',
            'libelle_piece' => 'Carte de résident temporaire'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'PSP',
            'libelle_piece' => 'Passeport'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'PCO',
            'libelle_piece' => 'Permis de conduire'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'CCS',
            'libelle_piece' => 'Carte Consulaire'
        ]);
        CustomersTypePiece::create([
            'code_type_piece' => 'CMU',
            'libelle_piece' => 'Couverture Maladie Universelle'
        ]);
    }

}
