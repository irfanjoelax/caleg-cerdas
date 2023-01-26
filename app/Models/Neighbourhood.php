<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function voting_places()
    {
        return $this->hasMany(VotingPlace::class);
    }
}
