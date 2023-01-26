<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Province Model.
 */
class Province extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use ProvinceTrait;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }

    public function villages()
    {
        return $this->hasManyDeep(
            Village::class,
            [Regency::class, District::class], // Intermediate models, beginning at the far parent (Country).
            [
                'province_id', // Foreign key on the "users" table.
                'regency_id',    // Foreign key on the "posts" table.
                'district_id'     // Foreign key on the "comments" table.
            ],
            [
                'id', // Local key on the "countries" table.
                'id', // Local key on the "users" table.
                'id'  // Local key on the "posts" table.
            ]
        );
    }
}
