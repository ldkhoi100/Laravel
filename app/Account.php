<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    public function posts()
    {
        return $this->hasMany("App\Posts");
    }

    public function categories()
    {
        return $this->hasMany("App\Categories");
    }
}