<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class VariationType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'type', 'service_id'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
    
    public function variations() {
        return $this->hasMany(Variation::class);
    }
}
