<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id', 'id');
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'cate_id', 'id');
    }
}
