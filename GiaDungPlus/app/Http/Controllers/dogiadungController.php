<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dogiadung;
use App\Models\loaidogiadung;
use App\Models\mausoluong;
use Illuminate\Support\Facades\DB;

class dogiadungController extends Controller
{
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
    public function detaildogiadung($id)
    {

        $dogiadung = dogiadung::findOrFail($id);
        $mausoluong = MauSoLuong::where('MaSanPham', $id)->get();

        $id = session('userId');
        // Thực hiện truy vấn tổng số lượng
        $totalQuantity = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(SoLuong) AS TongSoLuong'))
            ->where('MaTaiKhoan', $id)
            ->first();

        // Thực hiện truy vấn tổng giá
        $totalPrice = DB::table('giadungplus.Cart')
            ->select(DB::raw('SUM(Gia) AS TongGia'))
            ->where('MaTaiKhoan', $id)
            ->first();

        return view('Layout\detaildogiadung', compact('dogiadung', 'totalQuantity', 'totalPrice', 'mausoluong'));
    }
    public function index()
    {
        // Lấy danh sách tên các bảng
        $tableNames = $this->getTablenames();

        $dogiadungs = DB::table('giadungplus.DoGiaDung')
            ->select(
                'DoGiaDung.MaLoai',
                'DoGiaDung.MaSanPham',
                'LoaiDoGiaDung.TenLoai AS TenLoai',
                'DoGiaDung.TenSanPham',
                'DoGiaDung.Gia',
                'DoGiaDung.MoTa',
                'DoGiaDung.HinhAnh',
                'DoGiaDung.TrongLuong',
            )
            ->join('LoaiDoGiaDung', 'DoGiaDung.MaLoai', '=', 'LoaiDoGiaDung.MaLoai')
            ->paginate(10);
        return view('Pages\dogiadung\show', compact('tableNames', 'dogiadungs'));
    }
    // public function edit1($userId)
    // {

    //     $userId = session('userId');

    //     // Thực hiện truy vấn tổng số lượng
    //     $totalQuantity = DB::table('giadungplus.Cart')
    //         ->select(DB::raw('SUM(SoLuong) AS TongSoLuong'))
    //         ->where('MaTaiKhoan', $userId)
    //         ->first();

    //     // Thực hiện truy vấn tổng giá

    //     $totalPrice = DB::table('giadungplus.Cart')
    //         ->select(DB::raw('SUM(Gia) AS TongGia'))
    //         ->where('MaTaiKhoan', $userId)
    //         ->first();

    //     $user = DB::table('giadungplus.taikhoan as tk')
    //         ->select(
    //             'tk.TenTaiKhoan',
    //             'tk.password',
    //             'tk.LoaiTaiKhoan',
    //             'kh.TenKhachHang',
    //             'kh.DiaChi',
    //             'kh.SoDienThoai'
    //         )
    //         ->join('giadungplus.khachhang as kh', 'tk.MaTaiKhoan', '=', 'kh.MaTaiKhoan')
    //         ->where('tk.MaTaiKhoan', $userId)
    //         ->first();

    //     // Kiểm tra xem dữ liệu có tồn tại không
    //     if ($user) {
    //         // Nếu tồn tại, bạn có thể sử dụng biến $data như sau
    //         return view('Layout\thongtinnguoidung', compact('totalQuantity', 'totalPrice', 'user'));
    //     } else {
    //         // Nếu không tìm thấy dữ liệu, bạn có thể xử lý tương ứng ở đây
    //         return view('Layout\login');
    //     }
    // }

    public function create()
    {
        $tableNames = $this->getTableNames();
        $loaidogiadungs = loaidogiadung::all();
        return view('\Pages\dogiadung\create', compact('tableNames', 'loaidogiadungs'));
    }

    public function store(Request $request)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();

        try {
            // Lấy dữ liệu từ request
            $data = $request->all();

            // Thực hiện câu truy vấn INSERT vào bảng DoGiaDung và lấy ID vừa tạo
            $maSanPham = DB::table('DoGiaDung')->insertGetId([
                'MaLoai' => $data['MaLoai'],
                'TenSanPham' => $data['TenSanPham'],
                'Gia' => $data['Gia'],
                'MoTa' => $data['MoTa'],
                'HinhAnh' => $data['HinhAnh'],
                'TrongLuong' => $data['TrongLuong'],
            ]);

            // Thực hiện câu truy vấn INSERT vào bảng MauSoLuong với MaSanPham vừa tạo
            DB::table('MauSoLuong')->insert([
                'MaSanPham' => $maSanPham,
                'MauSac' => $data['MauSac'],
                'SoLuong' => $data['SoLuong'],
            ]);

            // Commit transaction nếu tất cả các bước đều thành công
            DB::commit();

            // Trả về thông báo hoặc chuyển hướng tùy vào yêu cầu
            return redirect()->route('dogiadung.index')->with('success', 'Thêm đồ gia dụng thành công!');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi xảy ra
            DB::rollBack();

            // Xử lý lỗi (ví dụ: ghi log lỗi, hiển thị thông báo lỗi)
            return redirect()->route('dogiadung.index')->with('error', 'Đã xảy ra lỗi khi thêm đồ gia dụng!');
        }
    }

    public function edit($id)
    {
        $tableNames = $this->getTablenames();
        $dogiadung = DB::table('giadungplus.DoGiaDung')
            ->where('MaSanPham', $id)
            ->first();
        $mausoluongs = DB::table('giadungplus.MauSoLuong')
            ->where('MaSanPham', $id)
            ->get();
        $loaidogiadungs = loaidogiadung::all();
        return view('Pages\dogiadung\edit', compact('dogiadung', 'tableNames', 'loaidogiadungs', 'mausoluongs'));
    }

    public function update(Request $request, $id)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();
    
        try {
            // Lấy dữ liệu từ request
            $data = $request->all();
    
            // Cập nhật bảng DoGiaDung
            $dogiadung = DoGiaDung::findOrFail($id);
            $dogiadung->update([
                'MaLoai' => $data['MaLoai'],
                'TenSanPham' => $data['TenSanPham'],
                'Gia' => $data['Gia'],
                'MoTa' => $data['MoTa'],
                'HinhAnh' => $data['HinhAnh'],
                'TrongLuong' => $data['TrongLuong'],
            ]);
    
            // Lấy danh sách các MaMSL và thông tin cập nhật cho MauSoLuong
            $ids = [];
            $mauSoluongs = [];
    
            foreach ($data['MauSoLuong'] as $mauSoLuong) {
                $ids[] = $mauSoLuong['MaMSL'];
                $mauSoluongs[] = [
                    'MauSac' => $mauSoLuong['MauSac'],
                    'SoLuong' => $mauSoLuong['SoLuong']
                ];
            }
    
            // Gọi hàm updateMauSoLuong trong model MauSoLuong để cập nhật dữ liệu
            MauSoLuong::updateMauSoLuong($ids, $mauSoluongs);
    
            // Commit transaction nếu tất cả các bước đều thành công
            DB::commit();
    
            return redirect()->route('dogiadung.edit', ['id' => $dogiadung->MaSanPham])->with('success', 'Sửa đồ gia dụng thành công!');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi xảy ra
            DB::rollBack();
    
            // Xử lý lỗi (ví dụ: ghi log lỗi, hiển thị thông báo lỗi)
            return redirect()->route('dogiadung.index')->with('error', 'Đã xảy ra lỗi khi sửa đồ gia dụng!');
        }
    }    

    public function createMSL($id)
    {
        $tableNames = $this->getTablenames();
        $dogiadung = DB::table('giadungplus.DoGiaDung')
            ->where('MaSanPham', $id)
            ->first();
        return view('Pages\dogiadung\createMSL', compact('tableNames', 'dogiadung'));
    }

    public function storeMSL(request $request, $id)
    {
        // Thực hiện câu truy vấn INSERT vào bảng MauSoLuong với MaSanPham vừa tạo
        DB::table('MauSoLuong')->insert([
            'MaSanPham' => $id,
            'MauSac' => $request->input('MauSac'),
            'SoLuong' => $request->input('SoLuong'),
        ]);
        return redirect()->route('dogiadung.detail', ['id' => $id])->with('error', 'Thêm màu và số lượng thất bại!');
    }
    public function destroyMSL($id)
    {
        $results = DB::table('giadungplus.mausoluong')
            ->where('MaMSL', $id)
            ->first();

        DB::table('MauSoLuong')->where('MaMSL', $id)->delete();
        // Chuyển hướng đến trang nào đó và thông báo thành công
        return redirect()->route('dogiadung.detail', ['id' => $results->MaSanPham])->with('success', 'Xóa đồ gia dụng thành công!');
    }
    public function destroy($id)
    {
        // Bắt đầu một giao dịch
        DB::beginTransaction();
        // Xóa các mục liên quan trong bảng Cart
        DB::table('Cart')->where('MaSanPham', $id)->delete();
        // Xóa sản phẩm từ bảng DoGiaDung
        DB::table('MauSoLuong')->where('MaSanPham', $id)->delete();
        // Xóa sản phẩm từ bảng DoGiaDung
        DB::table('DoGiaDung')->where('MaSanPham', $id)->delete();
        // Hoàn tất giao dịch
        DB::commit();
        // Chuyển hướng đến trang nào đó và thông báo thành công
        return redirect()->route('dogiadung.index')->with('success', 'Xóa đồ gia dụng thành công!');
    }


    public function detail($id)
    {
        $tableNames = $this->getTablenames();
        $dogiadung = DB::table('giadungplus.DoGiaDung')
            ->where('MaSanPham', $id)
            ->first();
        $mausoluongs = DB::table('giadungplus.MauSoLuong')
            ->where('MaSanPham', $id)
            ->get();
        // Truyền dữ liệu sang view
        return view('Pages.dogiadung.detail', compact('tableNames', 'dogiadung', 'mausoluongs'));
    }
}
