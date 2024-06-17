<?php

namespace App\Http\Controllers;

use App\Models\khachhang;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class khachhangController extends Controller
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
        $tableNames = $this->getTableNames();

        $khachhangs = DB::select('
        SELECT 
            tk.MaTaiKhoan,
            tk.TenTaiKhoan,
            tk.password,
            tk.LoaiTaiKhoan,
            kh.TenKhachHang,
            kh.DiaChi,
            kh.SoDienThoai
        FROM 
            taikhoan tk
        JOIN 
            khachhang kh ON tk.MaTaiKhoan = kh.MaTaiKhoan
        WHERE
            tk.LoaiTaiKhoan = "KhachHang"
    ');
        return view('Pages\khachhang\show', compact('khachhangs', 'tableNames'));
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
    public function show($id)
    {
        $tableNames = $this->getTableNames();
        $khachhang = khachhang::findOrFail($id);
        $taikhoan = user::findOrFail($id);

        return view('Pages\khachhang\detail', compact('tableNames', 'taikhoan', 'khachhang'));
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
        // Xóa khách hàng
        khachhang::where('MaTaiKhoan', $id)->delete();

        // Xóa tài khoản
        user::where('MaTaiKhoan', $id)->delete();

        return redirect()->Route('khachhang.index')->with('success', 'Xóa thành công');
    }
}
