<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Promotion extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'sub_title'];

    protected $fillable = ['title', 'sub_title', 'link', 'image', 'status'];
}
