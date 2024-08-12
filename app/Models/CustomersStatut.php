<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersStatut extends Model {

    use HasFactory;

    public $guarded = [];
    public $timestamps = false;

    public function customers() {
        return $this->hasMany(Customer::class, 'id');
    }

}