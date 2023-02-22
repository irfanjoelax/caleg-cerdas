<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendukung extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function relawan()
    {
        return $this->belongsTo(Relawan::class);
    }

    public function neighbourhood()
    {
        return $this->belongsTo(Neighbourhood::class);
    }
}
