<?php

namespace App;
use App\SanPham;

use Illuminate\Database\Eloquent\Model;

class LoaiSanPham extends Model
{
    protected $table = 'loaisanpham';

    public function sanpham()
    {
        return $this->hasMany('App\SanPham', 'loaisanpham_id', 'id');
    }
}
