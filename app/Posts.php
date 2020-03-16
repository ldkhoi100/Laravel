<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $hidden = null;

    protected $dates = ['deleted_at'];

    //Update datetime to table categories
    protected $touches = ['categories'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var  array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsTo("App\Account", 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo("App\Categories", 'category_id');
    }
}