<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
    use HasFactory;

    public $guarded = [];

    public function civilStatus() {
        return $this->belongsTo(CivilStatus::class);
    }

    public function artistesStatut() {
        return $this->belongsTo(ArtistesStatut::class);
    }

    public function artistesTypePiece() {
        return $this->belongsTo(ArtistesTypePiece::class);
    }

}
