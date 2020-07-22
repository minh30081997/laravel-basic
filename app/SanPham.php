<?php

namespace App;

use App\LoaiSanPham;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';

    public function loaisanpham()
    {
        return $this->belongsTo('App\LoaiSanPham', 'loaisanpham_id', 'id');
    }
}
