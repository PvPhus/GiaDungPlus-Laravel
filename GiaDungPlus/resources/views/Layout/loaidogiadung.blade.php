<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Gia Dụng Plus</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

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
                        <img class="img-product" src="/images/logo-web.webp" alt="Trang Chu">
                    </a>
                </div>
                <div class="search-box">
                    <li>
                        <input type="text" class="search-input" ng-model="searchQuery" placeholder="Bạn muốn tìm gì, gõ vào đây...">
                        <button class="fa fa-search search-button" ng-click="searchProducts()"></button>
                    </li>
                </div>
                <div class="refund">
                    <a href="../ProductDetails/ProductDetails.html">
                        <img class="img-product" src="/images/BaoHanh.jpg" alt="">
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
        <div style="background-color: white; height: 145px; width: auto;"></div>
        <div style="width: auto; height: 20px; background-color: white;"></div>
        <div class="featured-product">
            <div style="background-color: rgb(255, 94, 83); height: 20px; width: auto;"></div>
            <div class="category">
                <div class="smart-product">
                    <div class="title">
                        <span class="border"></span>
                        <div class="name-category">
                            <h2>LOẠI SẢN PHẨM</h2>
                        </div>
                    </div>
                    <div class="smart-products">
                        @foreach($loaidogiadungs as $ldgd)
                        <div class="smart-product-type-info">
                            <a href="{{route('loaidogiadung.show',['id' => $ldgd -> MaLoai])}}"><img class="img-zoom" src="/images/{{$ldgd->HinhAnh}}" alt="">
                                <h5>{{$ldgd->TenLoai}}</h5>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="smart-product">
                    <div class="title-2">
                        <span class="border"></span>
                        <div class="name-category">
                            <h2>{{$tenLoaiValue}}</h2>
                        </div>
                    </div>
                    <div class="smart-product-type2">
                        @foreach($dogiadungs as $row)
                        <div class="smart-products-info">
                            <a href="/index/detaildogiadung/{{$row->MaSanPham}}"><img class="img-product" src="/images/{{$row->HinhAnh}}" alt="">
                                <h4 class="name-Product">{{$row->TenSanPham}}</h4>
                            </a>
                            @php
                            $oldPrice = $row->Gia * 0.2;
                            $totalPrice = $oldPrice + $row->Gia;
                            @endphp
                            <h5 class="priceProduct">{{number_format($totalPrice)}} đ</h5>
                            <div class="vote">
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <span class="sold">Đã bán 15</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="background-color: rgb(255, 94, 83); height: 20px; width: auto;"></div>
            </div>
        </div>
    </header>
</body>
<footer>
    <div class="NoiDung">
        <div class="NoiDung-Trai">
            <h3>
                ĐỒ GIA DỤNG THÔNG MINH, ĐỒ DÙNG TIỆN ÍCH GIA ĐÌNH ONLINE CAO CẤP & CHẤT LƯỢNG TRÊN GIA DỤNG PLUS<br>
            </h3>
            <h5>Nếu bạn là người thông minh và hiện đại theo chủ trương <b>"làm việc thông minh"</b> thì luôn
                cần có những dụng cụ, đồ dùng chuyên dụng & thông minh để giúp bạn có thể hoàn thành mong muốn
                đó. Người chiến sĩ sẽ lợi hại hơn nếu cầm vũ khí, đúng không nào?

                Với phương châm làm việc của Gia Dụng Plus là cung ứng sản phẩm chất lượng nhất, mẫu mã mới nhất
                với công năng thông minh nhất cho người dùng với giá rẻ nhất. <br><br>
            </h5>

            <h3>ĐỒ GIA DỤNG THÔNG MINH, ĐỒ DÙNG TIỆN ÍCH SẼ GIÚP BẠN TIẾT KIỆM ĐẾN 80% CÔNG SỨC, THỜI GIAN VÀ
                TIỀN BẠC</h3>
            <h5>"Đừng làm việc chăm chỉ mà hãy làm việc thông minh" với sự trợ giúp của công cụ thông minh. Khi
                làm đúng cách, nó sẽ giúp bạn tiết kiệm được rất rất nhiều công sức, thời gian, tiền bạc cũng như
                mang lại những trải nghiệm tuyệt vời trong công việc nội trợ trong gia đình.

                Đồ gia dụng thông minh cho nhà bếp sẽ giúp đỡ trong việc chuẩn bị nguyên liệu nấu ăn, dọn dẹp
                nhà bếp, nấu ăn... đỡ nặng nhọc và khối lượng công việc cho nhà nội trợ. Nhất là bếp luôn là
                môi trường bốc mùi, nóng nực và liên quan trực tiếp đến sức khoẻ của gia đình thì cần phải được
                quan tâm nhất.
            </h5>
            <div class="ChamSocKhachHang">
                <div class="HuongDan">

                </div>
                <div class="VeWeb">

                </div>
                <div class="Pay">

                </div>

            </div>
            <div style="width: auto; height:200px; background-color: white;"></div>
            <div class="BanQuyenWeb">
                <h5>
                    © 2021. Công ty cổ phần TMDV <b>Gia Dụng Plus</b>. GPDKKD: 0109514772 do sở KH và ĐT TP.HN cấp ngày
                    09/01/2021.<br>
                    Địa chỉ: 143 Đại Mỗ, P. Đại Mỗ, Q.Nam Từ Liêm, HN.<br>
                    Điện thoại: 0979 856 374. Email: cskh@giadungplus.com<br>
                </h5>
            </div>

        </div>
        <div class="NoiDung-Phai">
            <h3><b>ĐÔI LỜI NHẮN GỬI CỦA GIA DỤNG PLUS</b></h3>
            <h5>Ngay từ những ngày thành lập với chỉ vọn vẹn căn phòng 20m2 » đến hôm nay gần 1000m2 kho và văn
                phòng thì chúng tôi - Gia Dụng Plus vẫn giữ nguyên mục tiêu:<br><br>

                "Cung cấp những sản phẩm đồ gia dụng thông minh & tiện lợi thật sự chất lượng với mức giá phải
                chăng để mọi người giống như tôi được trải nghiệm nó một cách tuyệt vời nhất"<br><br>
            </h5>
            <br><br><br><br>
            <h4 class="name-Product" style="font-weight: normal;">Kênh mạng xã hội của <b>Gia Dụng Plus</b></h4> <br>
            <div class="KenhXaHoi">
                <div class="icon">
                    <a href="https://www.facebook.com/giadungplus/">
                        <img class="img-ProductDetail" src="../images/icon-facebook.png" alt="Facebook">
                    </a>
                </div>
                <div class="icon">
                    <a href="">
                        <img class="img-ProductDetail" src="../images/icon-zalo.png" alt="Zalo">
                    </a>
                </div>
                <div class="icon">
                    <a href="">
                        <img class="img-ProductDetail" src="../images/icon-tiktok.png" alt="TikTok">
                    </a>
                </div>
                <div class="icon">
                    <a href="https://www.instagram.com/giadungplus/">
                        <img class="img-ProductDetail" src="../images/icon-instagram.png" alt="Instagram">
                    </a>
                </div>
                <div class="icon">
                    <a href="">
                        <img class="img-ProductDetail" src="../images/icon-telegram.png" alt="Telegram">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>

<script src="{{asset('../js/home.js')}}"></script>
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