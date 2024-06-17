<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\user;
use App\Models\cart;
use App\Models\khachhang;

use Illuminate\Http\Request;

class thanhtoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy mã tài khoản từ session
        $userId = session('userId');

        // Truy vấn thông tin khách hàng
        $khachhang = khachhang::where('MaTaiKhoan', $userId)->first();

        // Truy vấn danh sách giỏ hàng với mã tài khoản
        $carts = DB::table('giadungplus.Cart as c')
            ->select('c.CartID', 'c.MaSanPham', 'c.MaTaiKhoan', 'c.SoLuong', 'c.Gia', 'c.MauSac', 'd.HinhAnh', 'd.TenSanPham')
            ->join('giadungplus.DoGiaDung as d', 'c.MaSanPham', '=', 'd.MaSanPham')
            ->where('c.MaTaiKhoan', $userId)
            ->get();
        // Thực hiện truy vấn tổng số lượng
        $totalQuantity = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(SoLuong) AS TongSoLuong'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        // Thực hiện truy vấn tổng giá
        $totalPrice = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(Gia*SoLuong) AS TongGia'))
            ->where('MaTaiKhoan', $userId)
            ->first();
        return view('Layout\thanhtoan', compact('khachhang', 'carts', 'totalQuantity', 'totalPrice'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lấy mã tài khoản từ session
        $userId = session('userId');

        // Thực hiện truy vấn tổng giá
        $totalPrice = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(Gia) AS TongGia'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        // Bắt đầu giao dịch
        DB::beginTransaction();

        // Lấy giá trị kiểu thanh toán từ request
        $typePrice = $request->input('typePrice');

        // Kiểm tra xem kiểu thanh toán có được chọn hay không
        if (empty($typePrice)) {
            return redirect()->back()->with('error', 'Vui lòng chọn kiểu thanh toán.'); // Redirect về trang trước với thông báo lỗi
        }

        // Nếu kiểu thanh toán đã được chọn, tiếp tục thực hiện chèn dữ liệu vào bảng HoaDonBan
        $maHoaDon = DB::table('HoaDonBan')->insertGetId([
            'NgayBan' => date('Y-m-d'),
            'TongTien' => $totalPrice->TongGia, // Sử dụng biến $totalPrice trực tiếp
            'KieuThanhToan' => $typePrice,
            'GhiChu' => $request->input('GhiChu'),
            'MaTaiKhoan' => $userId,
        ]);

        // Lấy danh sách sản phẩm trong giỏ hàng của người dùng
        $carts = DB::select("
        SELECT 
            giadungplus.c.CartID,
            giadungplus.c.MaSanPham,
            giadungplus.c.MaTaiKhoan,
            giadungplus.c.SoLuong,
            giadungplus.c.Gia,
            giadungplus.c.MauSac
        FROM 
            giadungplus.Cart c
        JOIN 
            giadungplus.DoGiaDung d ON giadungplus.c.MaSanPham = giadungplus.d.MaSanPham
        JOIN 
            giadungplus.TaiKhoan tk ON giadungplus.c.MaTaiKhoan = tk.MaTaiKhoan
        WHERE
            giadungplus.c.MaTaiKhoan = :maTaiKhoan;
        ", ['maTaiKhoan' => $userId]);

        // Thêm từng sản phẩm trong giỏ hàng vào bảng ChiTietHoaDonBan
        foreach ($carts as $cart) {
            DB::table('ChiTietHoaDonBan')->insert([
                'MaHoaDon' => $maHoaDon,
                'MaSanPham' => $cart->MaSanPham,
                'SoLuong' => $cart->SoLuong,
                'Gia' => $cart->Gia,
                'MauSac' => $cart->MauSac
            ]);
        }

        // Nếu không có lỗi, giao dịch được hoàn thành
        DB::commit();

        // Thực hiện xóa tất cả các cart của người dùng sau khi tạo hóa đơn
        $this->destroyall($userId);

        // Thực hiện các thao tác khác sau khi giao dịch thành công
        return redirect()->route('cart.show', ['userId' => $userId])->with('success', 'Thanh toán thành công!');
    }


    //Xóa tất cả sản phẩm trong giỏ hàng của 1 người dùng
    public function destroyall($userId)
    {
        $userId = session('userId');
        // Sử dụng phương thức where() để lấy tất cả các cart của $userId
        $carts = cart::where('MaTaiKhoan', $userId)->get();

        // Duyệt qua từng cart và xóa
        foreach ($carts as $cart) {
            $cart->delete();
        }
    }

    public function index1($userId)
    {
        // Lấy mã tài khoản từ session
        $userId = session('userId');

        // Tìm tài khoản theo mã tài khoản
        $TaiKhoan = user::find($userId);

        // Truy vấn danh sách giỏ hàng với mã tài khoản

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
