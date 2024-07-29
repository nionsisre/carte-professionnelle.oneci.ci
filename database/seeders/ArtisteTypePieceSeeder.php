<?php

namespace Database\Seeders;

use App\Models\AbonnesTypePiece;
use App\Models\ArtistesTypePiece;
use Illuminate\Database\Seeder;

class ArtisteTypePieceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        ArtistesTypePiece::create([
            'code_type_piece' => 'CNI',
            'libelle_piece' => 'Carte nationale d\'identité'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'CRE',
            'libelle_piece' => 'Carte de résident'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'AEB',
            'libelle_piece' => 'Attestation d\'enrôlement biométrique'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'CRT',
            'libelle_piece' => 'Carte de résident temporaire'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'PSP',
            'libelle_piece' => 'Passeport'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'PCO',
            'libelle_piece' => 'Permis de conduire'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'CCS',
            'libelle_piece' => 'Carte Consulaire'
        ]);
        ArtistesTypePiece::create([
            'code_type_piece' => 'CMU',
            'libelle_piece' => 'Couverture Maladie Universelle'
        ]);
    }

}
