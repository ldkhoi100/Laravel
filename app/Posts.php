<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo("App\Account", 'user_id');
    }
}