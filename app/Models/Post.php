<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'excerpt', 'content'];

    protected $guarded = ['_method', '_token'];
    // protected $fillable = [
    //     'title', 'slug', 'content', 'excerpt', 'thumbnail', 'user_id'
    // ];

    public function user_comments() {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
