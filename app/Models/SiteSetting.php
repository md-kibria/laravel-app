<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasTranslations;

    public $translatable = ['subs_sub_title', 'subs_title', 'subs_desc'];

    protected $guarded = ['_token', '_method'];
}
