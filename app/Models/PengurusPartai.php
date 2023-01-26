<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusPartai extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function regency()
    {
        return $this->hasOne(Regency::class, 'id', 'regency_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function village()
    {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }
}
