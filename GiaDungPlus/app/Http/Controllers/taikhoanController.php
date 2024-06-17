<?php

namespace App\Http\Controllers;

use App\Models\khachhang;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class taikhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('Layout\login');
    }

    public function register()
    {
        return view('Layout\register');
    }

    public function checklogin(Request $request)
    {

        // Validate dữ liệu đầu vào từ form
        $request->validate([
            'TenTaiKhoan' => 'required',
            'password' => 'required',
        ]);

        // Lấy thông tin từ form
        $tenTaiKhoan = $request->input('TenTaiKhoan');
        $matKhau = $request->input('password');

        // Kiểm tra xác thực
        if (Auth::attempt(['TenTaiKhoan' => $tenTaiKhoan, 'password' => $matKhau])) {
            // Người dùng đăng nhập thành công, lưu tên người dùng vào session
            $user = Auth::user();
            session(['userId' => $user->MaTaiKhoan, 'userName' => $user->TenTaiKhoan, 'loaiTaiKhoan' => $user->LoaiTaiKhoan ]);

            // Kiểm tra vai trò của người dùng và chuyển hướng tới trang tương ứng
            if ($user->LoaiTaiKhoan === 'KhachHang') {
                return redirect()->route('giadungplus.home');
            } elseif ($user->LoaiTaiKhoan === 'NhanVien') {
                return redirect()->route('chart.index');
            }
        }

        // Nếu thông tin đăng nhập không chính xác, quay lại trang đăng nhập với thông báo lỗi
        return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();

        try {
            // Băm mật khẩu
            $hashedPassword = Hash::make($request->input('password'));
            // Thêm dữ liệu vào bảng taikhoan
            $maTaiKhoan = DB::table('giadungplus.taikhoan')->insertGetId([
                'TenTaiKhoan' => $request->input('TenTaiKhoan'),
                'password' => $hashedPassword,
                'LoaiTaiKhoan' => 'KhachHang', // Giá trị mặc định cho LoaiTaiKhoan
            ]);

            // Thêm dữ liệu vào bảng khachhang với MaTaiKhoan mới được tạo
            DB::table('giadungplus.khachhang')->insert([
                'MaTaiKhoan' => $maTaiKhoan,
                'TenKhachHang' => $request->input('TenKhachHang'),
                'DiaChi' => $request->input('DiaChi'),
                'SoDienThoai' => $request->input('SoDienThoai'),
            ]);

            // Commit transaction nếu không có lỗi
            DB::commit();

            // Trả về thông báo thành công
            return redirect()->route('login.index')->with('success', 'Tạo tài khoản thành công!');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();

            // Trả về thông báo lỗi
            echo 'Tạo tài khoản thất bại!';
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($userId)
    {

        $userId = session('userId');

        // Thực hiện truy vấn tổng số lượng
        $totalQuantity = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(SoLuong) AS TongSoLuong'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        // Thực hiện truy vấn tổng giá
        $totalPrice = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(SoLuong * Gia) AS TongGia'))
            ->where('MaTaiKhoan', $userId)
            ->first();

        $user = DB::table('giadungplus.taikhoan as tk')
            ->select(
                'tk.TenTaiKhoan',
                'tk.password',
                'tk.LoaiTaiKhoan',
                'kh.TenKhachHang',
                'kh.DiaChi',
                'kh.SoDienThoai'
            )
            ->join('giadungplus.khachhang as kh', 'tk.MaTaiKhoan', '=', 'kh.MaTaiKhoan')
            ->where('tk.MaTaiKhoan', $userId)
            ->first();

        // Kiểm tra xem dữ liệu có tồn tại không
        if ($user) {
            // Nếu tồn tại, bạn có thể sử dụng biến $data như sau
            return view('Layout\thongtinnguoidung', compact('totalQuantity', 'totalPrice', 'user'));
        } else {
            // Nếu không tìm thấy dữ liệu, bạn có thể xử lý tương ứng ở đây
            return view('Layout\login');
        }
    }

    public function update(Request $request, $userId)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();
        //Lấy userId từ session
        $userId = session('userId');
        try {
            

            // Cập nhật thông tin khách hàng
            $khachhang = KhachHang::findOrFail($userId);
            $khachhang->TenKhachHang = $request->input('TenKhachHang');
            $khachhang->DiaChi = $request->input('DiaChi');
            $khachhang->SoDienThoai = $request->input('SoDienThoai');
            $khachhang->save();

            
            // Băm mật khẩu
            $hashedPassword = Hash::make($request->input('password'));
            // Cập nhật thông tin tài khoản
            $user = User::findOrFail($userId);
            $user->TenTaiKhoan = $request->input('TenTaiKhoan');
            $user->password = $hashedPassword; // Lưu mật khẩu đã băm
            $user->LoaiTaiKhoan = $request->input('LoaiTaiKhoan');
            $user->save();

            // Commit transaction nếu không có lỗi
            DB::commit();

            // Chuyển hướng về trang chính với thông báo thành công
            return redirect()->route('taikhoan.update')->with('success', 'Sửa thông tin tài khoản thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback transaction
            DB::rollback();

            // Chuyển hướng về trang chính với thông báo lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin tài khoản!');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
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
    public function index()
    {
        $tableNames = $this->getTablenames();

        $taikhoans = DB::table('giadungplus.taikhoan as tk')
            ->select(
                'tk.MaTaiKhoan',
                'tk.TenTaiKhoan',
                'tk.password',
                'tk.LoaiTaiKhoan',
                'kh.TenKhachHang',
                'kh.DiaChi',
                'kh.SoDienThoai'
            )
            ->join('giadungplus.khachhang as kh', 'tk.MaTaiKhoan', '=', 'kh.MaTaiKhoan')
            ->where('tk.LoaiTaiKhoan', 'KhachHang')
            ->get();
        return view('Pages\taikhoan\show', compact('taikhoans', 'tableNames'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        DB::table('cart')->where('MaTaiKhoan', $id)->delete();
        DB::table('khachhang')->where('MaTaiKhoan', $id)->delete();
        DB::table('taikhoan')->where('MaTaiKhoan', $id)->delete();
        DB::commit();
        // $taikhoan = User::findOrFail($id);
        // $taikhoan->delete();
        return redirect()->route('taikhoan.index')->with('success', 'Xóa tài khoản thành công!');
    }
}
