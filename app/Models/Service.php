<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, Notifiable, HasTranslations;

    public $translatable = ['name', 'short_description', 'description', 'label1_title', 'label2_title'];

    protected $guarded = ['_method', '_token'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function faqs() {
        return $this->hasMany(Faq::class);
    }
    
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    
    public function orders() {
        return $this->hasMany(OrderItem::class);
    }

    public function variationTypes() {
        return $this->hasMany(VariationType::class);
    }
}
