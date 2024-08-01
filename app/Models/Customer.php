<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    use HasFactory;

    public $guarded = [];

    public function civilStatus() {
        return $this->belongsTo(CivilStatus::class);
    }

    public function customersStatut() {
        return $this->belongsTo(CustomersStatut::class);
    }

    public function customersTypePiece() {
        return $this->belongsTo(CustomersTypePiece::class);
    }

}
