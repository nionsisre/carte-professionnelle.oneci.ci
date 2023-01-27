<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonnesNumero extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }

    public function abonnesOperateur()
    {
        return $this->belongsTo(AbonnesOperateur::class);
    }

    public function abonnestaut()
    {
        return $this->belongsTo(AbonnesStatut::class);
    }
}
