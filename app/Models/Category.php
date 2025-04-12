<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Notifiable, HasTranslations;

    public $translatable = ['title', 'description'];

    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
