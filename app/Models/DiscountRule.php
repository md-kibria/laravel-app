<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Variation;
use App\Models\VariationType;
use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    protected $fillable = [
        'service_id',
        'variation_type_id',
        'variation_id',
        'status',
        'type',
        'value',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function variationType()
    {
        return $this->belongsTo(VariationType::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
