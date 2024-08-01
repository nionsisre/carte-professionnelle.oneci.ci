<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model {

    use HasFactory;

    public $guarded = [];
    public $timestamps = false;

    public function artistes() {
        return $this->hasMany(Customer::class, 'id');
    }

}
