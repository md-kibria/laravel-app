<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, Notifiable, HasTranslations;

    public $translatable = ['question', 'answer'];

    protected $guarded = ['_method', '_token'];
}
