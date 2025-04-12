<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['_method', '_token'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
