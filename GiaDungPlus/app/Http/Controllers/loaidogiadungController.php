<?php

namespace App\Http\Controllers;

use App\Models\dogiadung;
use Illuminate\Http\Request;
use App\Models\loaidogiadung;
use Illuminate\Support\Facades\DB;

class loaidogiadungController extends Controller
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
        // Lấy danh sách các loaidogiadung từ model
        $loaidogiadungs = loaidogiadung::paginate(4);

        // Trả về view 'loaidogiadung' và truyền biến 'loaidogiadungs' vào view
        return view('Pages\loaidogiadung\show', compact('tableNames', 'loaidogiadungs'));
    }

    public function indexHome($id)
    {   
        $userId = session('userId');

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

        $dogiadungs = dogiadung::where('MaLoai', $id)->get();

        $tenloai = DB::table('giadungplus.loaidogiadung')
                ->select('loaidogiadung.TenLoai')
                ->where('loaidogiadung.MaLoai', '=', $id)
                ->first();
        if ($tenloai) {
            $tenLoaiValue = $tenloai->TenLoai; // Lấy giá trị của thuộc tính TenLoai
        } else {
            $tenLoaiValue = ''; // Nếu không có kết quả, gán giá trị mặc định
        }       
        // Trả về view 'loaidogiadung' và truyền biến 'loaidogiadungs' vào view
        return view('Layout\loaidogiadung', compact('loaidogiadungs', 'dogiadungs', 'totalQuantity', 'totalPrice', 'tenLoaiValue'));
    }

    public function create()
    {
        $tableNames = $this->getTableNames();
        return view('Pages/loaidogiadung/create', compact('tableNames'));
    }

    public function store(Request $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->all();

        // Thực hiện câu truy vấn INSERT
        DB::table('loaidogiadung')->insert([
            'HinhAnh' => $data['HinhAnh'],
            'TenLoai' => $data['TenLoai'],
        ]);
        // Chuyển hướng về trang hiển thị danh sách loại đồ gia dụng
        return redirect()->route('loaidogiadung.index')->with('success', 'Loại đồ gia dụng đã được thêm thành công!');
    }


    public function edit($id)
    {
        $tableNames = $this->getTableNames();
        $loaidogiadung = loaidogiadung::findOrFail($id);
        return view('Pages\loaidogiadung\edit', compact('loaidogiadung', 'tableNames'));
    }


    public function update(Request $request, $id)
    {
        // Tìm đến đối tượng muốn update
        $loaidogiadung = loaidogiadung::findOrFail($id);

        // gán dữ liệu gửi lên vào biến data
        $data = $request->all();
        $loaidogiadung->update($data);
        return redirect()->route('loaidogiadung.index')->with('success', 'Sửa loại đồ gia dụng thành công!');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        DB::table('giadungplus.dogiadung')->where('MaLoai', $id)->delete();
        DB::table('giadungplus.loaidogiadung')->where('MaLoai', $id)->delete();
        DB::commit();
        return redirect()->route('loaidogiadung.index')->with('success', 'Xóa loại đồ gia dụng thành công!');
    }

    public function detail($id)
    {
        $tableNames = $this->getTableNames();
        $loaidogiadung = loaidogiadung::findOrFail($id);
        return view('Pages\loaidogiadung\detail', compact('tableNames', 'loaidogiadung'));
    }
}
