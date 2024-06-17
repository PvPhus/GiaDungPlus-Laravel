<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';

    protected $primaryKey = 'CartID';

    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'MaSanPham',
        'MaTaiKhoan',
        'SoLuong',
        'Gia'];

    // Không sử dụng timestamps Laravel
    public $timestamps = false;
}
