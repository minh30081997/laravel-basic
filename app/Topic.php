<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    public function category()
    {
        return $this->hasMany('App\Category', 'topic_id', 'id');
    }

    public function post()
    {
        return $this->hasManyThrough('App\Post', 'App\Category', 'topic_id', 'cate_id', 'id');
    }
}
