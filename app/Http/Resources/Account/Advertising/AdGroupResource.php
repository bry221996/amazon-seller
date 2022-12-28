<?php

namespace App\Http\Resources\Account\Advertising;

use Illuminate\Http\Resources\Json\JsonResource;

class AdGroupResource extends JsonResource
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
            'campaign_id' => $this->campaign_id,
            'name' => $this->name,
            'default_bid' => $this->default_bid,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'campaign' => CampaignResource::make($this->whenLoaded('campaign'))
        ];
    }
}
