<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mausoluong extends Model
{
    protected $table = 'MauSoLuong';

    protected $primaryKey = 'MaMSL';

    // Các trường có thể được gán hoặc truy vấn thông qua model này
    protected $fillable = [
        'MaSanPham',
        'MauSac',
        'SoLuong'
    ];

    // Không sử dụng timestamps Laravel
    public $timestamps = false;
    public static function updateMauSoLuong(array $ids, array $mauSoluongs)
    {
        // Lấy danh sách các bản ghi cần cập nhật
        $mauSoLuongRecords = self::whereIn('MaMSL', $ids)->get();
    
        // Duyệt qua từng bản ghi và cập nhật trạng thái tương ứng
        foreach ($mauSoLuongRecords as $key => $mauSoLuongRecord) {
            // Cập nhật các trường dữ liệu mới
            $mauSoLuongRecord->MauSac = $mauSoluongs[$key]['MauSac'];
            $mauSoLuongRecord->SoLuong = $mauSoluongs[$key]['SoLuong'];
            $mauSoLuongRecord->save();
        }
    }
    
}
