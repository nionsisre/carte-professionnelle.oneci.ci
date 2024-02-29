<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OstatPlusTypesPerService extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    public $timestamps = false;

    public function ostatplusservice() {
        return $this->hasMany(OstatPlusService::class);
    }

    public function ostatplustypeservice() {
        return $this->hasMany(OstatPlusTypeService::class);
    }

}
