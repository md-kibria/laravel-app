<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['_method', '_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
