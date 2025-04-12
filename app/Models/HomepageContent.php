<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomepageContent extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'sub_title', 'description'];

    protected $guarded = ['_method', '_token'];
    // protected $fillable = ['section', 'sub_title', 'title', 'type', 'link', 'description', 'image', 'is_show'];
}
