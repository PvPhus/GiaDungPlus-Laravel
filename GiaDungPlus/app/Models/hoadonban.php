<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoadonban extends Model
{
    protected $table = 'hoadonban';

    protected $primaryKey = 'MaHoaDon';

    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'NgayBan',
        'TongTien',
        'MaTaiKhoan',
        'GhiChu',
        'KieuThanhToan'
    ];

    // Không sử dụng timestamps Laravel
    public $timestamps = false;

    public static function updateTrangThai(array $ids, array $trangThais)
    {
        // Lấy danh sách các hóa đơn cần cập nhật
        $hoaDons = self::whereIn('MaHoaDon', $ids)->get();

        // Duyệt qua từng hóa đơn và cập nhật trạng thái tương ứng
        foreach ($hoaDons as $key => $hoaDon) {
            $hoaDon->TrangThai = $trangThais[$key];
            $hoaDon->save();
        }
    }
}
