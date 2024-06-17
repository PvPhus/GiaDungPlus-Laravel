<?php

namespace App\Http\Controllers;

use App\Models\loaidogiadung;
use App\Models\taikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $userId = session('userId');
        // Thực hiện truy vấn tổng số lượng
        $totalQuantity = DB::table('giadungplus.Cart')
            ->select(DB::raw('Count(Cart.MaSanPham) AS TongSoLuong'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        // Thực hiện truy vấn tổng giá
        $totalPrice = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(Gia*SoLuong) AS TongGia'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        $loaidogiadungs = loaidogiadung::all();    

        $dogiadungs = DB::select('
        SELECT
            giadungplus.dogiadung.MaLoai,
            giadungplus.dogiadung.MaSanPham,
            giadungplus.loaidogiadung.TenLoai AS TenLoai,
            giadungplus.dogiadung.TenSanPham,
            giadungplus.dogiadung.Gia,
            giadungplus.dogiadung.MoTa,
            giadungplus.dogiadung.HinhAnh
        FROM
            giadungplus.DoGiaDung
        INNER JOIN
            giadungplus.LoaiDoGiaDung ON giadungplus.DoGiaDung.MaLoai = giadungplus.LoaiDoGiaDung.MaLoai
    ');

        // Trả về view 'dogiadung' và truyền biến 'dogiadungs' vào view
        return view('Layout\index', compact('dogiadungs', 'totalPrice', 'totalQuantity', 'loaidogiadungs'));
    }
}
