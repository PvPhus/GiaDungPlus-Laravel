<?php

namespace App\Http\Controllers;

use App\Models\chitiethoadonban;
use Illuminate\Database\Eloquent\Model;
use App\Models\hoadonban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hoadonbanController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách tên các bảng
        $tableNames = $this->getTablenames();

        // Thực hiện truy vấn để lấy tất cả các hóa đơn bán từ bảng 'hoadonban'
        $hoadonbans = DB::table('giadungplus.hoadonban')->get();

        // Trả về view và truyền dữ liệu hóa đơn bán vào view
        return view('Pages\hoadonban\show', compact('hoadonbans', 'tableNames'));
    }

    public function indexandupdate(Request $request)
    {
        $MaHoaDons = (array)$request->input('MaHoaDon');
        $newTrangThais = $request->input('TrangThai');

        // Gọi hàm updateTrangThai với danh sách các ID hóa đơn và danh sách các trạng thái tương ứng
        hoadonban::updateTrangThai($MaHoaDons, $newTrangThais);

        return redirect()->route('hoadonban.index')->with('success', 'Cập nhật trạng thái thành công!');
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
        //
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
    public function edit($id)
    {
        $tableNames = $this->getTablenames();
        // Tìm mã hoá đơn bán
        $hoadonban = hoadonban::findOrFail($id);

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
            ->where('cthdb.MaHoaDon', $hoadonban->MaHoaDon)
            ->get();

        // Trả về view với dữ liệu của chi tiết hoá đơn
        return view('Pages\hoadonban\edit', compact('chiTietHoaDon', 'hoadonban', 'tableNames'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $chiTietHoaDon = (array)$request->input('MaChiTietHDB');
        $newTrangThais = $request->input('TrangThai');

        // Gọi hàm updateTrangThai với danh sách các ID hóa đơn và danh sách các trạng thái tương ứng
        chitiethoadonban::updateTrangThai($chiTietHoaDon, $newTrangThais);

        return redirect()->route('hoadonban.index')->with('success', 'Cập nhật trạng thái thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        DB::beginTransaction();
        DB::table('chitiethoadonban')->where('MaHoaDon', $id)->delete();
        DB::table('hoadonban')->where('MaHoaDon', $id)->delete();
        DB::commit();
        return redirect()->route('hoadonban.index')->with('success', 'Xóa đồ gia dụng thành công!');
    }
}
