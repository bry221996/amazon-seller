<?php

namespace App\Models\Account\Advertising;

use App\Models\Account\Marketplace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }
}
