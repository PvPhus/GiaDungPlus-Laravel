<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dogiadung extends Model
{
    protected $table = 'dogiadung';

    protected $primaryKey = 'MaSanPham';

    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'MaLoai',
        'TenSanPham',
        'Gia',
        'MoTa',
        'HinhAnh',
        'TenLoai',
        'TrongLuong',
        'MauSac'];

    // Không sử dụng timestamps Laravel
    public $timestamps = false;
}
