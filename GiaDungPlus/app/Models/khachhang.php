<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    protected $table = 'khachhang';

    protected $primaryKey = 'MaKhachHang';

    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'TenKhachHang',
        'DiaChi',
        'SoDienThoai'
    ];

    // Không sử dụng timestamps Laravel
    public $timestamps = false;
}
