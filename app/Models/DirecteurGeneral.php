<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirecteurGeneral extends Model
{
    use HasFactory;

    protected $table = 'directeur_general';
    public $guarded = [];
}
