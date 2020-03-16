<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public function posts()
    {
        return $this->hasMany("App\Posts", 'category_id');
    }

    public function users()
    {
        return $this->belongsTo("App\Account", 'user_id');
    }
}