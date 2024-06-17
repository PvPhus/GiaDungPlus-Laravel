<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chartController extends Controller
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
    public function index()
    {
        $tableNames = $this->getTableNames();
    
        // Tính trung bình tổng tiền cả năm 2024
        $sumTienYear = DB::table('giadungplus.HoaDonBan')
            ->select(DB::raw('SUM(HoaDonBan.TongTien) AS SumYear'))
            ->whereYear('NgayBan', 2024)
            ->first();
    
        // Tính trung bình tổng tiền mỗi tháng trong năm 2024
        $avgTienMonth = DB::table('giadungplus.HoaDonBan')
            ->select(DB::raw('AVG(HoaDonBan.TongTien) AS AvgMonth'))
            ->whereYear('NgayBan', 2024)
            ->first();
    
        return view('Pages.thongke.chart', compact('tableNames', 'sumTienYear', 'avgTienMonth'));
    }
    
}
