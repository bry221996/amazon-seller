<?php

namespace App\Http\Resources\Account\Advertising;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
            "id" => $this->id,
            "profile_id" => $this->profile_id,
            "portfolio_id" => $this->portfolio_id,
            "name" => $this->name,
            "budget" => $this->budget,
            "budget_type" => $this->budget_type,
            "state" => $this->state,
            "targeting_type" => $this->targeting_type,
            "campaign_type" => $this->campaign_type,
            "dynamic_bidding" => $this->dynamic_bidding,
            "serving_status" => $this->serving_status,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "ad_format" => $this->ad_format,
            "creative" => $this->creative,
            "landing_page" => $this->landing_page,
            "supply_source" => $this->supply_source,
            "tactic" => $this->tactic,
            "cost_type" => $this->cost_type,
            "delivery_profile" => $this->delivery_profile,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "portfolio" => PortfolioResource::make($this->whenLoaded('portfolio'))
        ];
    }
}
