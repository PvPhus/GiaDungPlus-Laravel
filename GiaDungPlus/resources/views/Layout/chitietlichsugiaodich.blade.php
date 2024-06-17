<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css')}}">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">

    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body>
    <header>
        <div class="fixed-menu">
            <div class="help">
                <div class="left-help">
                    <li>
                        <a href=""><b>>>> Miễn Phí Ship</b> với đơn hàng trên 500.000đ</a>
                    </li>
                </div>
                <div class="right-help">
                    <li style="border-right: 1px solid  777;"><a href="">Trung Tâm Hỗ Trợ</a></li>
                    <li style="border-right: 1px solid  777;"><a href="">HotLine: 0973297734</a></li>
                    <li style="border-right: 1px solid  777;"><a href="">Liên Hệ</a></li>
                    @if(session('userId') && session('userName'))
                    <li><a href="{{route('taikhoan.edit',['userId' => (session('userId'))])}}">{{ session('userName') }}</a></li>
                    <li><a href="{{ route('logout.index') }}">LogOut</a></li>
                    @else
                    <li><a href="{{ route('login.index') }}">Tài Khoản</a></li>
                    @endif
                </div>
            </div>
            <div class="function">
                <div class="logo">
                    <a href="/index">
                        <img src="/images/logo-web.webp" alt="Trang Chu">
                    </a>
                </div>
                <div class="search-box">
                    <li>
                        <input type="text" class="search-input" placeholder="Bạn muốn tìm gì, gõ vào đây...">
                        <button class="fa fa-search search-button"></button>
                    </li>
                </div>
                <div class="refund">
                    <a href="../ProductDetails/ProductDetails.html">
                        <img src="/images/BaoHanh.jpg" alt="">
                    </a>
                </div>
                <div class="cart">
                    <div class="cart-content">
                        <a style="color:aliceblue">Giỏ Hàng</a>
                        <p>{{ number_format($totalPrice->TongGia) }} đ</p>
                    </div>
                    <div class="cart-icon">
                        <a href="{{ route('cart.show', ['userId' => session('userId')]) }}">
                            <span class="icon">
                                <img class="img-product" src="/images/giohang.webp" alt="">
                            </span>
                            <span class="count-products">{{ number_format($totalQuantity->TongSoLuong) }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu">
                <li><a>ĐỒ DÙNG BẾP & PHÒNG ĂN</a>
                    <ul class="sub-menu">
                        <li><a href="../Giao diện chính/kebepthongminh/menu.html">Kệ Bếp Thông Minh</a></li>
                        <li><a href="../Giao diện chính/kegiavithongminh/menu.html">Kệ Gia Vị Thông Minh</a></li>
                        <li><a href="../Giao diện chính/kechendanang/menu.html">Kệ Chén Đa Năng</a></li>
                        <li><a href="../Giao diện chính/kelovisongdanang/menu.html">Kệ Lò Vi Sóng Đa Năng</a></li>
                        <li><a href="../Giao diện chính/hopdunggongangtuquanao/menu.html">Hộp & Ống Đựng Đũa Thông
                                Minh</a>
                        </li>
                        <li><a href="../Giao diện chính/hopdungtreogiayvesinh/menu.html">Phụ Kiện Nhà Bếp Thông Minh</a>
                        </li>
                        <li><a href="../Giao diện chính/hopkedung/menu.html">Hũ Gạo Thông Minh</a></li>
                        <li><a href="../Giao diện chính/kebepthongminh/menu.html">Bộ Chén Bát Sứ</a></li>
                    </ul>
                </li>
                <li><a>GIA DỤNG PHÒNG TẮM</a>
                    <ul class="sub-menu">
                        <li><a href="../Giao diện chính/kechendanang/menu.html">Kệ Nhà Tắm Đa Năng, Thông Minh</a></li>
                        <li><a href="../Giao diện chính/hopdungtreogiayvesinh/menu.html">Hộp Đựng Giấy Vệ Sinh</a></li>
                        <li><a href="../Giao diện chính/kechendanang/menu.html">Đồ Dùng Nhà Vệ Sinh(WC)</a></li>
                        <li><a href="../Giao diện chính/kechendanang/menu.html">Kệ Treo Khăn Tắm</a></li>
                        <li><a href="../Giao diện chính/hopdunggongangtuquanao/menu.html">Móc Treo Quần Áo</a></li>
                    </ul>
                </li>
                <li><a>ĐỒ DÙNG GỌN GÀNG NHÀ CỬA</a>
                    <ul class="sub-menu">
                        <li><a href="../Giao diện chính/hopkedung/menu.html">Hộp & Kệ Đựng </a></li>
                        <li><a href="../Giao diện chính/hopdunggongangtuquanao/menu.html">Đồ Dùng Gọn Gàng Tủ Quần
                                Áo</a>
                        </li>
                        <li><a href="../Giao diện chính/kechendanang/menu.html">Kệ Đưng Máy Sấy Tóc</a></li>
                        <li><a href="../Giao diện chính/kelovisongdanang/menu.html">Đồ Dùng Vệ Sinh Nhà Cửa</a></li>
                        <li><a href="../Giao diện chính/kenhatamdanang/menu.html">Tháp Khói Trầm Hương</a></li>
                    </ul>
                </li>
                <li style="border-right: 2px solid  777;"> <a href="https://www.facebook.com/giadungplus/">FANPAGE</a>
                </li>
                <li style="border-right: 2px solid  777;"> <a href="https://shopee.vn/giadungplus_official?af_click_lookback=7d&af_reengagement_window=7d&af_siteid=an_17171860000&af_sub_siteid=sellervn-241961702&af_viewthrough_lookback=1d&c=-&is_retargeting=true&pid=affiliates&utm_campaign=-&utm_content=sellervn-241961702&utm_medium=affiliates&utm_source=an_17171860000&utm_term=abdc8brcfioh">SHOPEE</a>
                </li>
                <li><a href="https://giadungplus.com/kien-thuc">BLOG KIẾN THỨC</a></li>
            </div>
        </div>
    </header>

    <div style="background-color: white; height: 150px; width: auto;"></div>
    <main>
        <h1 style="text-align: center;padding: 20px;">Chi tiết hóa đơn của bạn</h1>
        <h5 style="text-align: center;">Mã hóa đơn: {{$hoadons -> MaHoaDon}}</h5>
        <div class="cart-content-content">
            <div class="left-cart-content">
                <table id="cart-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Trọng lượng</th>                                      
                                        <th>Số lượng</th>
                                        <th>Màu Sắc</th>
                                        <th>Giá</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chiTietHoaDon as $index => $chitiethoadonn)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $chitiethoadonn->TenSanPham}}</td>
                                        <td><img src="/images/{{$chitiethoadonn->HinhAnh}}" style="height:100px; width:100px;"><input readonly hidden name="HinhAnh" value="{{$chitiethoadonn->HinhAnh}}"></td>
                                        <td>{{ $chitiethoadonn->TrongLuong }}</td>
                                        <td>{{ $chitiethoadonn->SoLuong }}</td>
                                        <td><input type="color" readonly value="{{$chitiethoadonn->MauSac}}" style="pointer-events: none; height: 40px;"></td>
                                        <td>{{ number_format($chitiethoadonn->Gia) }} vnđ</td>                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <div class="NoiDung">
            <div class="NoiDung-Trai">
                <div class="BanQuyenWeb">
                    <h5>
                        © 2021. Công ty cổ phần TMDV <b>Gia Dụng Plus</b>. GPDKKD: 0109514772 do sở KH và ĐT TP.HN cấp
                        ngày
                        09/01/2021.<br>
                        Địa chỉ: 143 Đại Mỗ, P. Đại Mỗ, Q.Nam Từ Liêm, HN.<br>
                        Điện thoại: 0979 856 374. Email: cskh@giadungplus.com<br>
                    </h5>
                </div>

            </div>
            <div class="NoiDung-Phai">
                <h4 style="font-weight: normal;">Kênh mạng xã hội của <b>Gia Dụng Plus</b></h4> <br>
                <div class="KenhXaHoi">
                    <div class="icon">
                        <a href="">
                            <img src="/images/icon-facebook.png" alt="Facebook">
                        </a>
                    </div>
                    <div class="icon">
                        <a href="">
                            <img src="/images/icon-zalo.png" alt="Zalo">
                        </a>
                    </div>
                    <div class="icon">
                        <a href="">
                            <img src="/images/icon-tiktok.png" alt="TikTok">
                        </a>
                    </div>
                    <div class="icon">
                        <a href="">
                            <img src="/images/icon-instagram.png" alt="Instagram">
                        </a>
                    </div>
                    <div class="icon">
                        <a href="">
                            <img src="/images/icon-telegram.png" alt="Telegram">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
<script type="text/javascript" src="{{asset('/js/cart.js')}}"></script>
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