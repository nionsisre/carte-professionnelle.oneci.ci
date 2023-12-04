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
            'libelle_piece' => 'Attestation d\'identité'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CNI',
            'libelle_piece' => 'Carte nationale d\'identité'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CRE',
            'libelle_piece' => 'Carte de résident'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'AEB',
            'libelle_piece' => 'Attestation d\'enrôlement biométrique'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CRT',
            'libelle_piece' => 'Carte de résident temporaire'
        ]);
        /*AbonnesTypePiece::create([
            'code_type_piece' => 'PSP',
            'libelle_piece' => 'Passeport'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'PCO',
            'libelle_piece' => 'Permis de conduire'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CCS',
            'libelle_piece' => 'Carte Consulaire'
        ]);
        AbonnesTypePiece::create([
            'code_type_piece' => 'CMU',
            'libelle_piece' => 'Couverture Maladie Universelle'
        ]);*/
    }

}
