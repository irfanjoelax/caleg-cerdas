<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Regency;

class PengurusDpcKotaKab extends Model
{
    use HasFactory;

    protected $table = 'pengurus_dpc_kota_kabs';

    public $fillable = [
        'regency_id',
        'pengurus',
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
