<?php

namespace App\Http\Resources\Account\Advertising;

use App\Http\Resources\MarketplaceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'account_id' => $this->account_id,
            'marketplace_id' => $this->marketplace_id,
            'daily_budget' => $this->daily_budget,
            'marketplace' => MarketplaceResource::make($this->whenLoaded('marketplace'))
        ];
    }
}
