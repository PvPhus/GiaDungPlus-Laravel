<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitiethoadonban extends Model
{
    protected $table = 'giadungplus.chitiethoadonban';

    protected $primaryKey = 'MaChiTietHDB';
    public $timestamps = false;
    
    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'MaHoaDon',
        'MaSanPham',
        'SoLuong',
        'Gia',
        'TrangThai'
    ];

    // Phương thức để cập nhật trạng thái của các chi tiết hóa đơn
    public static function updateTrangThai(array $ids,array $trangThais)
    {
       
        // Lấy danh sách các hóa đơn cần cập nhật
        $chiTietHoaDons = self::whereIn('MaChiTietHDB', $ids)->get();

        // Duyệt qua từng hóa đơn và cập nhật trạng thái tương ứng
        foreach ($chiTietHoaDons as $key => $chiTietHoaDon) {
            $chiTietHoaDon->TrangThai = $trangThais[$key];
            $chiTietHoaDon->save();
        }
    }
}
