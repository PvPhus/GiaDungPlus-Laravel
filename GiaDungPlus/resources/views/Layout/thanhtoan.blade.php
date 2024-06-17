<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="{{asset('/css/thanhtoan.css')}}">
    <!-- Custom styles for this template-->
    <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body>

    <header>
        @if(session('userId') && session('userName'))
        @endif
        <form method="POST" action="{{ route('thanhtoan.store') }}">
            @csrf
            <div class="left-pay">
                <div class="imglogo"><a href="{{route('giadungplus.home')}}"><img src="/images/logo-web.webp" alt=""></a></div>
                <h2 style="margin-top: 40px;">Thông tin nhận hàng</h2>
                <input type="text" name="TenKhachHang" id="" placeholder="Họ và tên" value="{{$khachhang -> TenKhachHang}}">
                <input type="number" name="SoDienThoai" id="" placeholder="Số điện thoại" value="{{$khachhang -> SoDienThoai}}">
                <input type="text" name="DiaChi" id="addressInput" placeholder="Địa chỉ" value="{{$khachhang -> DiaChi}}">
                <div class="borderbox">
                    <label for="province">Tỉnh/Thành phố:</label>
                    <select id="province" onchange="loadDistricts()">
                        <option value="province1">Hà Nội</option>
                        <option value="province2">Bắc Ninh</option>
                        <option value="province3">Bắc Giang</option>
                        <option value="province4">Hà Giang</option>
                        <option value="province5">Hưng Yên</option>
                        <option value="province6">Đà Nẵng</option>
                        <option value="province7">Quảng Ninh</option>
                        <option value="province8">Hải Phòng</option>
                        <option value="province9">Hải Dương</option>
                        <option value="province10">Thanh Hóa</option>
                    </select>
                </div>
                <div class="borderbox">
                    <label for="district">Quận/Huyện:</label>
                    <select id="district" onchange="loadWards()" disabled>
                        <!-- Hà nội -->
                        <option value="district1">Thị Xã Sơn Tây</option>
                        <option value="district2">Quận Ba Đình</option>
                        <option value="district3">Quận Cầu giấy</option>
                        <option value="district4">Quận Đống Đa</option>
                        <option value="district5">Quận Hà Đông</option>
                        <option value="district6">Quận Hai Bà Trưng</option>
                        <option value="district7">Huyện Ba Vì</option>
                        <option value="district8">Huyện Đông Anh</option>
                        <!-- Hưng Yên -->
                        <option value="district9">Thành Phố Hưng Yên</option>
                        <option value="district10">Huyện Ân Thi</option>
                        <option value="district11">Huyện Khoái Châu</option>
                        <option value="district12">Huyện Kim Động</option>
                        <option value="district13">Thị Xã Mỹ Hào</option>
                        <option value="district14">Huyện Phù Cừ</option>
                        <option value="district15">Huyện Tiên Lữ</option>
                        <option value="district16">Huyện Văn Giang</option>
                    </select>
                </div>
                <div class="borderbox">
                    <label for="ward">Phường/Xã:</label>
                    <select id="ward" disabled>
                        <!-- Hà nội-Sơn Tây -->
                        <option value="ward1">Phường Lê Lợi</option>
                        <option value="ward2">Phường Phú Thịnh</option>
                        <option value="ward3">Phường Ngô Quyền</option>
                        <option value="ward4">Phường Quang Trung</option>
                        <option value="ward5">Phường Sơn Lộc</option>
                        <!-- Hà nội-Ba đình -->
                        <option value="ward6">Phường Phúc Xá</option>
                        <option value="ward7">Phường Trúc Bạch</option>
                        <option value="ward8">Phường Cống Vị</option>
                        <option value="ward9">Phường Liễu Giai</option>
                        <option value="ward10">Phường Nguyễn Trung Trực</option>
                        <!-- Hưng Yên-Mỹ Hào -->
                        <option value="ward11">Phường Bần yên Nhân</option>
                        <option value="ward12">Xã Phan Đình Phùng</option>
                        <option value="ward13">Xã Cẩm Xá</option>
                        <option value="ward14">Xã Dương Quang</option>
                        <option value="ward15">Xã Hòa Phong</option>
                        <option value="ward16">Phường Dị Sử</option>
                        <option value="ward17">Phường Nhân Hòa</option>
                    </select>
                </div>
                <input type="text" name="GhiChu" id="" placeholder="Ghi chú (tùy chọn)">
                <h2 style="margin-top: 40px;">Hình Thức Thanh Toán</h2>
                <div class="borderbuy">
                    <div class="btnbuy">
                        <input name="typePrice" type="checkbox" value="1">
                        <h5>Thanh toán khi nhận hàng</h5>
                    </div>
                    <div class="btnbuy">
                        <input name="typePrice" type="checkbox" value="2">
                        <h5>Thanh toán online</h5>
                    </div>
                </div>
            </div>
            <div class="right-pay">
                <h2>Đơn Hàng</h2>
                <div class="products-card">
                    <table class="table table-bordered" id="cart-table" width="50%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Màu sắc</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- sản phẩm được thêm vào giỏ hàng -->
                            @foreach ($carts as $index => $cart)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img style="width:100px; height:100px" src="/images/{{$cart->HinhAnh}}"></td>
                                <td>{{ $cart->TenSanPham }}</td>
                                <td>{{ $cart->SoLuong }}</td>
                                <td><input type="color" readonly value="{{$cart->MauSac}}" style="pointer-events: none; height: 40px;"></td>
                                <td>{{ number_format($cart->Gia) }} vnđ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: center; margin-left: -10px;">
                    <input style="width: 95%;" type="text" placeholder="Nhập mã giảm giá!">
                    <button class="btnvoucher">Áp dụng</button>
                </div>
                <div class="money">
                    <div class="money-product">
                        <h4>Tạm tính</h4>
                        <input type="text" value="{{ number_format($totalPrice->TongGia) }} vnđ" readonly>
                    </div>
                    <div class="money-ship">
                        <h4>Phí ship </h4>
                        <h4> 0vnđ</h4>
                    </div>
                    <div style="border: 1px solid #444; margin: 10px;"></div>
                    <div class="total-money">
                        <h4>Tổng Tiền</h4>
                        <input name="TongTien" type="text" value="{{ number_format($totalPrice->TongGia) }} vnđ" readonly>
                    </div>
                </div>
                <button id="orderButton" class="btndathang" type="submit">ĐẶT HÀNG</button>
                <a href="{{ route('cart.show', ['userId' => session('userId')]) }}">
                    <span class="linkback"> ❮ Quay về giỏ hàng</span>
                </a>
            </div>
        </form>
    </header>
</body>
<footer>

</footer>

</html>
<script src="{{asset('js/thanhtoan.js')}}"></script>
<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>