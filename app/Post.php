<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo('App\Category', 'cate_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function scopePublished($query) 
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query) 
    {
        return $query->where('published', false);
    }
}
