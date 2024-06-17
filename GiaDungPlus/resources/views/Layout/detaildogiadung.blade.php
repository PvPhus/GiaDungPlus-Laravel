<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/css/ProductDetails.css')}}">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript Bootstrap Bundle with Popper -->

    <!-- Custom fonts for this template-->
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
                        <li><a href="../Giao diện chính/hopdunggongangtuquanao/menu.html">Hộp & Ống Đựng Đũa Thông Minh</a>
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
                        <li><a href="../Giao diện chính/hopdunggongangtuquanao/menu.html">Đồ Dùng Gọn Gàng Tủ Quần Áo</a>
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
        <div style="background-color: white; height: 200px; width: auto;"></div>
    </header>
    <main style="justify-content: center; align-items: center;">
        <form method="POST" action="{{route('detaildogiadung.store')}}">
            @csrf

            <div class="Main-ProductDetails">
                <div class="left-ProductDetails">
                    <a>
                        <img class="img-ProductDetail" src="/images/{{ $dogiadung->HinhAnh}}">
                    </a>
                </div>
                <div class="right-ProductDetails">
                    <div class="vote">
                        <input style="border:none; outline:none" readonly name="MaSanPham" value="{{$dogiadung->MaSanPham}}"></input>
                        <h1 class="name-Product">{{ $dogiadung->TenSanPham }}</h1>
                        <div class="vote-stars">
                            <div class="stars">
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                                <i class="votestar stars"></i>
                            </div>
                            <div class="count-vote">
                                <h5>| 2 Đánh giá </h5>
                            </div>
                            <div class="priced">
                                <h5>| 25 Đã Bán |</h5>
                            </div>
                            <div class="commit">
                                <img src="/images/chinhhang.webp" alt="">
                                <h5>Chính Hãng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="background-price">
                        <div class="price">
                            <div class="old-price">
                                @php
                                $oldPrice = $dogiadung->Gia * 0.2;
                                $totalPrice = $oldPrice + $dogiadung->Gia;
                                @endphp
                                <h5>{{ number_format($totalPrice) }}</h5>
                            </div>
                            <div class="product-price">
                                <input style="border: none; background-color: #fafafafa; text-align: center; width: 100px; outline: none" readonly class="priceProduct" name="Gia" value="{{ number_format($dogiadung->Gia) }} vnđ ">
                            </div>
                            <div class="discount-price">
                                <h5>20% GIẢM GIÁ</h5>
                            </div>
                        </div>
                        <div class="details">
                            <img src="/images/freeship.jpg" alt="">
                            <span>
                                <h5>Gì Cũng Rẻ</h5>
                                <h6>Giá tốt nhất so với sản phẩm cùng loại trên Shopee, Lazada....</h6>
                            </span>
                        </div>
                    </div>
                    <div class="type">

                    </div>
                    <div class="ship">
                        <div class="container-ship">
                            <img src="/images/xetai.webp" alt="Xe Tải">
                            <h3>MIỄN PHÍ GIAO HÀNG TOÀN QUỐC </h3>
                        </div>
                        <h5>>> Miễn phí vận chuyển cho đơn hàng từ 500.000đ</h5>
                        <h5>>> Chỉ đồng giá 20.000đ / đơn hàng toàn quốc (Shop hỗ trợ phần còn lại)</h5>
                    </div>
                    <div class="sl-ms">
                        <h5>Màu sắc và số lượng còn:</h5>
                        @if ($mausoluong->count())
                        <select name="MauSac" id="mauSacSelect">
                            @foreach ($mausoluong as $mausoluong1)
                            <option style="background-color: {{ $mausoluong1->MauSac }};" value="{{ $mausoluong1->MauSac }}">
                                {{ $mausoluong1->SoLuong }}
                            </option>
                            @endforeach
                        </select>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const selectElement = document.getElementById('mauSacSelect');
                                selectElement.style.backgroundColor = selectElement.options[selectElement.selectedIndex].style.backgroundColor;

                                selectElement.addEventListener('change', function() {
                                    selectElement.style.backgroundColor = selectElement.options[selectElement.selectedIndex].style.backgroundColor;
                                });
                            });
                        </script>
                        @endif


                    </div>


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                        </div>
                        <input type="number" class="form-control" name="SoLuong" id="quantity" value="1" min="1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <div class="functions-button">
                        <button id="add-products-cart" type="submit" class="btn btn-primary">
                            <h4>Thêm Vào Giỏ Hàng<br></h4>
                        </button>
                        <h5>Gọi đặt mua <c style="color:blue">0973.297.734</c> (7:30-22:00)</h5>
                    </div>
                </div>
            </div>
        </form>
    </main>
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

                <b>Gia Dụng Plus (giadungplus.com)</b> là cửa hàng online chuyên cung cấp các đồ gia dụng thông
                minh, đồ dùng tiện ích với những mẫu mã, thiết kế và công nghệ tiên tiến nhất trên thế giới. Đa
                phần, sản phẩm của chúng tôi là đồ nội địa Trung Quốc - công xưởng của thế giới.

                Với phương châm làm việc của Gia Dụng Plus là cung ứng sản phẩm chất lượng nhất, mẫu mã mới nhất
                với công năng thông minh nhất cho người dùng với giá rẻ nhất. <br><br>
            </h5>

            <h3>ĐỒ GIA DỤNG THÔNG MINH, ĐỒ DÙNG TIỆN ÍCH SẼ GIÚP BẠN TIẾT KIỆM ĐẾN 80% CÔNG SỨC, THỜI GIAN VÀ
                TIỀN BẠC</h3>
            <h5>"Đừng làm việc chăm chỉ mà hãy làm việc thông minh" với sự trợ giúp của công cụ thông minh. Khi
                làm đúng cách, nó sẽ giúp bạn tiết kiệm được rất rất nhiều công sức, thời gian, tiền bạc cũng như
                mang lại những trải nghiệm tuyệt vời trong công việc nội trợ trong gia đình.

                Với cuộc sống ngày càng bộn bề và nhiều công việc phải làm trong không gian nhà cửa, nhà bếp,
                phòng tắm hạn chế thì sự khôn ngoan trong việc sắp xếp - phân bố và giải phóng không gian sẽ giúp
                căn nhà của bạn trở nên hiện đại và tiện ích hơn.

                Với sự nghiên cứu vượt bậc về công nghệ, luôn đi đầu trên thế giới về việc sản xuất đồ gia dụng
                thông minh với chất lượng và giá cả phải chăng thì đồ nội địa Trung Quốc (chỉ cung cấp nội địa
                cho dân trong nước) là sự lựa chọn tối ưu cho gia đình bạn.

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

                Sự thông minh & tiện lợi không phải là thứ để các nhà bán hàng đội giá sản phẩm với lỗ hổng mà
                khách hàng chưa bao giờ trải nghiệm và biết giá của nó. Mà nó dùng để nâng cao trải nghiệm / cuộc sống
                và giúp đỡ mọi người & chị em trong công việc nhà ngày càng vất vả & không gian dần chật hẹp.<br><br>

                Thay vì việc bán sản phẩm với x3 x4 lần giá vốn thì chúng tôi cam kết giữ nguyên cố định là x1.5
                - x1.8 lần để có phần lời nhất định. Tất nhiên, với sự giúp sức của quý khách để giảm chi phí quảng
                cáo, marketing để có chi phí hoạt động doanh nghiệp thấp nhất nữa.<br><br>

                Gia Dụng Plus nhập khẩu chính hãng 100% toàn bộ sản phẩm đồ gia dụng với số lượng lớn để giảm
                giá vốn, chúng tôi đang làm việc miệt mài để giúp anh/chị có những trải nghiệm về dịch vụ & sản phẩm
                chất
                lượng nhất. Trở thành DOANH NGHIỆP TRÁCH NHIỆM bằng cách kinh doanh bài bản có lợi nhuận cũng như mang
                lại những giá trị thiết thực cho xã hội, khách hàng, nhân viên & đối tác.
            </h5>
            <br><br><br><br>
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

</html>
<script src="{{asset('/js/ProductDetails.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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