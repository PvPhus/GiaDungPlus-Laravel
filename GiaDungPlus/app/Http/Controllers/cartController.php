<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\user;
use App\Models\hoadonban;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getTableNames()
    {
        $tables = DB::select('SHOW TABLES FROM giadungplus');
        $tableNames = [];
        foreach ($tables as $table) {
            $tableName = current((array) $table);
            $tableNames[] = $tableName;
        }
        return $tableNames;
    }
    public function index($userId)
    {
        // Lấy mã tài khoản từ session
        $userId = session('userId');

        // Kiểm tra nếu không tồn tại mã tài khoản trong session
        if (!$userId) {
            // Nếu không có, bạn có thể chuyển hướng người dùng đến trang đăng nhập hoặc trang khác
            return redirect()->route('login.index'); // Ví dụ chuyển hướng đến trang đăng nhập
        }

        // Tìm tài khoản theo mã tài khoản
        $TaiKhoan = user::find($userId);

        // Truy vấn danh sách giỏ hàng với mã tài khoản
        $carts = DB::select("
        SELECT 
            giadungplus.c.CartID,
            giadungplus.c.MaSanPham,
            giadungplus.c.MaTaiKhoan,
            giadungplus.c.SoLuong,
            giadungplus.c.MauSac,
            giadungplus.c.Gia,
            giadungplus.d.HinhAnh,
            giadungplus.d.TenSanPham
        FROM 
            giadungplus.Cart c
        JOIN 
            giadungplus.DoGiaDung d ON giadungplus.c.MaSanPham = giadungplus.d.MaSanPham
        JOIN 
            giadungplus.TaiKhoan tk ON giadungplus.c.MaTaiKhoan = tk.MaTaiKhoan
        WHERE
            giadungplus.c.MaTaiKhoan = :maTaiKhoan;
    ", ['maTaiKhoan' => $userId]);
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

        // Trả về view với dữ liệu giỏ hàng và thông tin tài khoản
        return view('Layout\cart', compact('carts', 'TaiKhoan', 'totalQuantity', 'totalPrice'));
    }

    public function viewHoaDon($userId)
    {
        // Lấy mã tài khoản từ session
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

        // Thực hiện truy vấn để lấy tất cả các hóa đơn bán từ bảng 'hoadonban'
        $hoadons = DB::table('giadungplus.hoadonban')
        ->where('MaTaiKhoan','=', $userId)
        ->get();

        // Trả về view và truyền dữ liệu hóa đơn bán vào view
        return view('Layout\lichsugiaodich', compact('hoadons','totalQuantity', 'totalPrice'));
    }
    //Xem chi tiết hóa đơn của người dùng
    public function viewChiTietHoaDon($id)
    {
        // Lấy mã tài khoản từ session
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
        // Tìm mã hoá đơn bán
        $hoadons = hoadonban::findOrFail($id);

        // Truy vấn chi tiết hoá đơn bán
        $chiTietHoaDon = DB::table('giadungplus.ChiTietHoaDonBan AS cthdb')
            ->select(
                'dg.TenSanPham',
                'dg.HinhAnh',
                'dg.TrongLuong',
                'cthdb.MaChiTietHDB',
                'cthdb.SoLuong',
                'cthdb.Gia',
                'cthdb.MauSac',
                'cthdb.TrangThai'
            )
            ->join('giadungplus.HoaDonBan AS hdb', 'cthdb.MaHoaDon', '=', 'hdb.MaHoaDon')
            ->join('DoGiaDung AS dg', 'cthdb.MaSanPham', '=', 'dg.MaSanPham')
            ->where('cthdb.MaHoaDon', $hoadons->MaHoaDon)
            ->get();

        // Trả về view với dữ liệu của chi tiết hoá đơn
        return view('Layout\chitietlichsugiaodich', compact('chiTietHoaDon', 'hoadons','totalQuantity','totalPrice'));
    }
    public function destroyhoadon(string $id)
    {  
        // Lấy mã tài khoản từ session
        $userId = session('userId');
        DB::beginTransaction();
        DB::table('chitiethoadonban')->where('MaHoaDon', $id)->delete();
        DB::table('hoadonban')->where('MaHoaDon', $id)->delete();
        DB::commit();
        return redirect()->route('lichsu.show',['userId'=>$userId])->with('success', 'Xóa đồ gia dụng thành công!');
    }

    public function index2()
    {
        // Lấy tên của các bảng
        $tableNames = $this->getTablenames();

        // Lấy dữ liệu từ bảng Cart và các bảng liên quan
        $carts = DB::table('giadungplus.Cart as c')
            ->select(
                'c.CartID',
                'dg.HinhAnh',
                'ldg.TenLoai',
                'dg.TenSanPham',
                'kh.TenKhachHang',
                'tk.TenTaiKhoan',
                'c.SoLuong',
                'dg.Gia'
            )
            ->join('giadungplus.DoGiaDung as dg', 'c.MaSanPham', '=', 'dg.MaSanPham')
            ->join('giadungplus.LoaiDoGiaDung as ldg', 'dg.MaLoai', '=', 'ldg.MaLoai')
            ->leftJoin('giadungplus.TaiKhoan as tk', 'c.MaTaiKhoan', '=', 'tk.MaTaiKhoan')
            ->leftJoin('giadungplus.KhachHang as kh', 'tk.MaTaiKhoan', '=', 'kh.MaTaiKhoan')
            ->paginate(10);

        return view('Pages\cart\show', compact('carts', 'tableNames'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lấy userId từ session
        $userId = session('userId');

        // Lấy dữ liệu từ request
        $data = $request->all();

        // Trích xuất giá trị gốc từ chuỗi đã được định dạng
        $giaDaDinhDang = $data['Gia'];
        $giaGoc = (float) str_replace(',', '', $giaDaDinhDang); // Chuyển đổi chuỗi thành số và loại bỏ dấu phân cách hàng nghìn

        // Thực hiện phép tính
        $TongGia = $data['SoLuong'] * $giaGoc;

        // Thực hiện câu truy vấn INSERT
        DB::table('giadungplus.cart')->insert([
            'MaSanPham' => $data['MaSanPham'],
            'MaTaiKhoan' => $userId,
            'SoLuong' => $data['SoLuong'],
            'Gia' => $TongGia,
            'MauSac' => $data['MauSac'],
        ]);
        return redirect()->route('giadungplus.home')->with('success', 'Thêm vào giỏ hàng thành công!');
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
    public function destroy($id)
    {
        // Lấy userId từ session
        $userId = session('userId');

        // Sử dụng phương thức findOrFail để tìm cart theo $id
        $carts = cart::findOrFail($id);
        // Xóa cart
        $carts->delete();

        return redirect()->route('cart.show', ['userId' => $userId])->with('success', 'Xóa thành công!');
    }

    public function destroyall($userId)
    {
        $userId = session('userId');
        // Sử dụng phương thức where() để lấy tất cả các cart của $userId
        $carts = Cart::where('MaTaiKhoan', $userId)->get();

        // Duyệt qua từng cart và xóa
        foreach ($carts as $cart) {
            $cart->delete();
        }

        return redirect()->route('cart.show', ['userId' => $userId])->with('success', 'Thanh toán và xóa thành công!');
    }


    public function detail($id)
    {
        // Lấy danh sách tên các bảng
        $tableNames = $this->getTablenames();

        // Lấy thông tin chi tiết của sản phẩm trong giỏ hàng với ID tương ứng
        $cart = DB::table('giadungplus.Cart as c')
            ->select(
                'c.CartID',
                'dg.HinhAnh',
                'ldg.TenLoai',
                'dg.TenSanPham',
                'kh.TenKhachHang',
                'tk.TenTaiKhoan',
                'c.SoLuong',
                'dg.Gia'
            )
            ->join('giadungplus.DoGiaDung as dg', 'c.MaSanPham', '=', 'dg.MaSanPham')
            ->join('giadungplus.LoaiDoGiaDung as ldg', 'dg.MaLoai', '=', 'ldg.MaLoai')
            ->leftJoin('giadungplus.TaiKhoan as tk', 'c.MaTaiKhoan', '=', 'tk.MaTaiKhoan')
            ->leftJoin('giadungplus.KhachHang as kh', 'tk.MaTaiKhoan', '=', 'kh.MaTaiKhoan')
            ->where('c.CartID', $id)
            ->first();

        // Kiểm tra nếu không tìm thấy giỏ hàng với ID tương ứng, chuyển hướng đến trang 404
        if (!$cart) {
            return redirect()->route('trang-404');
        }

        // Trả về view chi tiết giỏ hàng với thông tin sản phẩm và tên bảng
        return view('Pages\cart\detail', compact('cart', 'tableNames'));
    }
}
