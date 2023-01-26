<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PengurusPartaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'ketua_partai' => $this->ketua_partai,
            'province'     => $this->province,
            'regency'      => $this->regency,
            'district'     => $this->district,
            'village'      => $this->village,
        ];
    }
}
