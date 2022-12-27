<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketplaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'region_id' => $this->region_id,
            'country' => $this->country,
            'timezone' => $this->timezone,
            'domain_name' => $this->domain_name,
            'country_code' => $this->country_code,
            'language_code' => $this->language_code,
            'profile_id' => $this->whenPivotLoaded('account_marketplaces', function () {
                return $this->pivot->profile_id;
            }),
        ];
    }
}
