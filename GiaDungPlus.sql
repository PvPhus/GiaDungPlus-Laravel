CREATE TABLE NhaCungCap (
    MaNhaCungCap INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    MaLoai INT DEFAULT NULL,
    TenNhaCungCap NVARCHAR(255) DEFAULT NULL,
    DiaChi NVARCHAR(255) DEFAULT NULL,
    SoDienThoai NVARCHAR(20) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE LoaiDoGiaDung (
    MaLoai INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    HinhAnh NVARCHAR(250) DEFAULT NULL,
    TenLoai NVARCHAR(50) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE taikhoan (
    MaTaiKhoan INT PRIMARY KEY AUTO_INCREMENT,
    TenTaiKhoan NVARCHAR(50) UNIQUE NOT NULL,
    password NVARCHAR(255) NOT NULL,
    LoaiTaiKhoan ENUM('NhanVien', 'KhachHang') NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE Slide(
	MaAnh INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	TieuDe NVARCHAR(250) DEFAULT NULL,
	MoTa NVARCHAR(250) DEFAULT NULL,
	LinkAnh NVARCHAR(500) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE khachhang (
    MaKhachHang INT PRIMARY KEY AUTO_INCREMENT,
    MaTaiKhoan INT UNIQUE NOT NULL,
    TenKhachHang NVARCHAR(255) DEFAULT NULL,
    DiaChi NVARCHAR(255) DEFAULT NULL,
    SoDienThoai NVARCHAR(20) DEFAULT NULL,
    FOREIGN KEY (MaTaiKhoan) REFERENCES taikhoan(MaTaiKhoan)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE nhanvien (
    MaNhanVien INT PRIMARY KEY AUTO_INCREMENT,
    MaTaiKhoan INT UNIQUE NOT NULL,
    TenNhanVien NVARCHAR(255) DEFAULT NULL,
    ChucVu NVARCHAR(50) DEFAULT NULL,
    NgaySinh DATE DEFAULT NULL,
    DiaChi NVARCHAR(255) DEFAULT NULL,
    SoDienThoai NVARCHAR(20) DEFAULT NULL,
    FOREIGN KEY (MaTaiKhoan) REFERENCES taikhoan(MaTaiKhoan)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE DoGiaDung (
    MaSanPham INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	MaLoai INT,
    TenSanPham NVARCHAR(255) DEFAULT NULL,
    Gia DECIMAL(18, 0) DEFAULT NULL,
    MoTa NVARCHAR(500) DEFAULT NULL,
    HinhAnh NVARCHAR(250) DEFAULT NULL,
    TrongLuong Float DEFAULT NULL,
    FOREIGN KEY (MaLoai) REFERENCES LoaiDoGiaDung(MaLoai)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE MauSoLuong (
    MaMSL INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    MaSanPham INT,
    MauSac NVARCHAR(250) DEFAULT NULL,
    SoLuong INT DEFAULT NULL,
	FOREIGN KEY (MaSanPham) REFERENCES DoGiaDung(MaSanPham)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE giadungplus.Cart(
	ChonMua BIT,
	CartID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    MaSanPham INT DEFAULT NULL,
    MaTaiKhoan INT DEFAULT NULL,
    SoLuong INT DEFAULT NULL,
    Gia FLOAT DEFAULT NULL,
	MauSac NVARCHAR(250) DEFAULT NULL,
    FOREIGN KEY (MaSanPham) REFERENCES DoGiaDung(MaSanPham),
    FOREIGN KEY (MaTaiKhoan) REFERENCES TaiKhoan(MaTaiKhoan)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE HoaDonNhap (
    MaHoaDonNhap INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	MaNhanVien INT DEFAULT NULL,
    MaNhaCungCap INT DEFAULT NULL,
    NgayNhap DATE DEFAULT NULL,
    TongTien DECIMAL(18, 0) DEFAULT NULL,
    FOREIGN KEY (MaNhaCungCap) REFERENCES NhaCungCap(MaNhaCungCap),
	FOREIGN KEY (MaNhanVien) REFERENCES NhanVien(MaNhanVien)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE ChiTietHoaDonNhap (
    MaHoaDonNhap INT NOT NULL AUTO_INCREMENT,
    MaSanPham INT NOT NULL,
    SoLuong INT DEFAULT NULL,
    DonGia DECIMAL(18, 0) DEFAULT NULL,
    ThanhTien DECIMAL(18, 0) DEFAULT NULL,
    FOREIGN KEY (MaHoaDonNhap) REFERENCES HoaDonNhap(MaHoaDonNhap),
    FOREIGN KEY (MaSanPham) REFERENCES DoGiaDung(MaSanPham)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE giadungplus.HoaDonBan (
    MaHoaDon INT PRIMARY KEY AUTO_INCREMENT,
    NgayBan DATE NOT NULL,
    TongTien FLOAT NOT NULL,
    MaTaiKhoan INT NOT NULL,
    GhiChu NVARCHAR(500) DEFAULT NULL,
    KieuThanhToan INT NOT NULL,
    TrangThai ENUM('ChuaGiaoHang', 'DangGiaoHang') NOT NULL DEFAULT 'ChuaGiaoHang',
    FOREIGN KEY (MaTaiKhoan) REFERENCES TaiKhoan(MaTaiKhoan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE giadungplus.ChiTietHoaDonBan (
    MaChiTietHDB INT PRIMARY KEY AUTO_INCREMENT,
    MaHoaDon INT NOT NULL,
    MaSanPham INT NOT NULL,
    SoLuong INT NOT NULL,
    Gia FLOAT NOT NULL,
	MauSac NVARCHAR(250) DEFAULT NULL,
    TrangThai ENUM('ChuaChuanBi', 'DangChuanBi') NOT NULL DEFAULT 'ChuaChuanBi',
    FOREIGN KEY (MaHoaDon) REFERENCES HoaDonBan(MaHoaDon),
    FOREIGN KEY (MaSanPham) REFERENCES DoGiaDung(MaSanPham)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO giadungplus.NhaCungCap (MaLoai, TenNhaCungCap, DiaChi, SoDienThoai)
VALUES
    (1, N'Phạm Hồng Đức', N'Yên Bái', '0172983712'),
    (2, N'Nguyễn Văn Hưng', N'Hưng Yên', '0901231231'),
    (3, N'Trần Đình Dù', N'Hà Nội', '0091231262');


INSERT INTO giadungplus.LoaiDoGiaDung (MaLoai, HinhAnh, TenLoai)
VALUES
    (1, 'anhnhabep.jpg', N'Nhà bếp'),
    (2, 'Phòng ngủ & phòng tắm.jpg', N'Phòng ngủ & phòng tắm'),
    (3, 'Lau dọn vệ sinh.jpg', N'Lau dọn vệ sinh'),
    (4, 'Đồ điện tử.jpg', N'Đồ điện tử'),
    (5, 'Gia đình dân dụng.jpg', N'Gia đình dân dụng'),
    (6, 'Ngoài trời.jpg', N'Ngoài trời'),
    (7, 'Đồ thông minh(smart).jpg', N'Đồ thông minh(smart)');
    
INSERT INTO giadungplus.DoGiaDung (MaSanPham, MaLoai, TenSanPham, Gia, MoTa, HinhAnh, TrongLuong) 
VALUES
    (1, 6, 'Trang trí nhà cửa thông minh', 100000, 'Mô tả chi tiết cho sản phẩm Trang trí nhà cửa thông minh', 'trangtrinhacua.webp', 1.5),
    (2, 1, 'Thùng rác treo kệ bàn bếp thông minh', 120000, 'Mô tả chi tiết cho sản phẩm Thùng rác treo kệ bàn bếp thông minh', 'thungractreocanhtubep.webp', 1.8),
    (3, 3, 'Thùng rác đa năng 2 tầng 3 tầng thông minh', 150000, 'Mô tả chi tiết cho sản phẩm Thùng rác đa năng 2 tầng 3 tầng thông minh', 'thungracdanang2tang3tang.webp', 2.0),
    (4, 1, 'Thùng gạo thông minh', 80000, 'Mô tả chi tiết cho sản phẩm Thùng gạo thông minh', 'thunggaothongminh.webp', 1.2), 
    (5, 7, 'Thùng đựng Lego thông minh', 90000, 'Mô tả chi tiết cho sản phẩm Thùng đựng Lego thông minh', 'thungdunglego.webp', 1.0), 
    (6, 1, 'Thùng đựng gạo thông minh', 100000, 'Mô tả chi tiết cho sản phẩm Thùng đựng gạo thông minh', 'thungdunggaothongminh.webp', 1.2), 
    (7, 2, 'Thùng đựng đồ đa năng thông minh', 110000, 'Mô tả chi tiết cho sản phẩm Thùng đựng đồ đa năng thông minh', 'thungdungdodanang.webp', 1.5), 
    (8, 2, 'Thùng đựng đồ đa năng & gấp gọn thông minh', 95000, 'Mô tả chi tiết cho sản phẩm Thùng đựng đồ đa năng & gấp gọn thông minh', 'thungdungdodanang&gapgon.webp', 1.8),
    (9, 1, 'Thớt hai mặt thông minh', 85000, 'Mô tả chi tiết cho sản phẩm Thớt hai mặt thông minh', 'thothaimat.webp', 1.0),
    (11, 3, 'Tấm chắn mặt bếp ga thông minh', 70000, 'Mô tả chi tiết cho sản phẩm Tấm chắn mặt bếp ga thông minh', 'tamchanmatbepgas.webp', 0.8), 
    (12, 3, 'Tấm chắn dầu chắn gió thông minh', 75000, 'Mô tả chi tiết cho sản phẩm Tấm chắn dầu chắn gió thông minh', 'tamchandauchangio.webp', 0.9),
    (13, 1, 'Phụ kiện phòng bếp thông minh', 50000, 'Mô tả chi tiết cho sản phẩm Phụ kiện phòng bếp thông minh', 'phukienphongbep.webp', 0.5),
    (14, 2, 'Phòng tắm & wc thông minh', 300000, 'Mô tả chi tiết cho sản phẩm Phòng tắm & wc thông minh', 'phongtam&wc.webp', 3.0), 
    (15, 1, 'Ống đựng đũa thìa thông minh', 35000, 'Mô tả chi tiết cho sản phẩm Ống đựng đũa thìa thông minh', 'ongdungduathia.webp', 0.3),
    (16, 5, 'Lọ thủy tinh đựng nước thông minh', 40000, 'Mô tả chi tiết cho sản phẩm Lọ thủy tinh đựng nước thông minh', 'lothuytinhdungnuoc.webp', 0.4), 
    (17, 1, 'Lồng bán đa năng thông minh', 60000, 'Mô tả chi tiết cho sản phẩm Lồng bán đa năng thông minh', 'longbandanang.webp', 0.6), 
    (18, 1, 'Kệ chén trên bồn rửa thông minh', 90000, 'Mô tả chi tiết cho sản phẩm Kệ chén trên bồn rửa thông minh', 'kechentrenbonrua.webp', 1.0), 
    (19, 1, 'Kệ up chén đa năng thông minh', 80000, 'Mô tả chi tiết cho sản phẩm Kệ up chén đa năng thông minh', 'keupchendanang.webp', 1.2), 
    (20, 2, 'Kệ phòng tắm thông minh', 110000, 'Mô tả chi tiết cho sản phẩm Kệ phòng tắm thông minh', 'kephongtamgiamgia.webp', 1.5), 
    (21, 1, 'Kệ giá phòng bếp thông minh', 130000, 'Mô tả chi tiết cho sản phẩm Kệ giá phòng bếp thông minh', 'kegiaphongbep.webp', 1.8),
    (22, 2, 'Kệ đựng xà phòng thông minh', 40000, 'Mô tả chi tiết cho sản phẩm Kệ đựng xà phòng thông minh', 'kedungxaphong.webp', 0.5), 
    (23, 5, 'Kệ để máy sấy tóc dán tường thông minh', 60000, 'Mô tả chi tiết cho sản phẩm Kệ để máy sấy tóc dán tường thông minh', 'kedemaysaytocdantuong.webp', 0.7), 
    (24, 1, 'Kệ để lò vi sóng thông minh', 150000, 'Mô tả chi tiết cho sản phẩm Kệ để lò vi sóng thông minh', 'kedelovisongthongminh.webp', 1.2), 
    (25, 5, 'Kệ để dao thìa dĩa thông minh', 45000, 'Mô tả chi tiết cho sản phẩm Kệ để dao thìa dĩa thông minh', 'kededaothiadua.webp', 0.5),
    (26, 1, 'Kệ để cốc nước thông minh', 50000, 'Mô tả chi tiết cho sản phẩm Kệ để cốc nước thông minh', 'kedecocnuoc.webp', 0.5), 
    (27, 2, 'Kệ để ấm trà thông minh', 55000, 'Mô tả chi tiết cho sản phẩm Kệ để ấm trà thông minh', 'kedeamtra.webp', 0.6),
    (28, 3, 'Kệ đa năng dán tường thông minh', 70000, 'Mô tả chi tiết cho sản phẩm Kệ đa năng dán tường thông minh', 'kedanangdantuong.webp', 0.8), 
    (29, 4, 'Kệ chữ nhật nhôm dán tường thông minh', 500000, 'Mô tả chi tiết cho sản phẩm Kệ chữ nhật nhôm dán tường thông minh', 'kechunhatnhomdantuong.webp', 3.5),
    (30, 5, 'Kệ chân nhật dán tường thông minh', 500000, 'Mô tả chi tiết cho sản phẩm Kệ chân nhật dán tường thông minh', 'kechunhatdantuong.webp', 3.5); 

UPDATE giadungplus.DoGiaDung
SET MoTa = CASE 
    WHEN MaSanPham = 1 THEN 'Trang trí nhà cửa đẹp mắt và sang trọng.'
    WHEN MaSanPham = 2 THEN 'Thùng rác treo kệ bàn bếp tiện lợi và dễ dàng sử dụng.'
    WHEN MaSanPham = 3 THEN 'Thùng rác đa năng với thiết kế 2 tầng hoặc 3 tầng.'
    WHEN MaSanPham = 4 THEN 'Thùng gạo thông minh giữ gạo luôn khô ráo và sạch sẽ.'
    WHEN MaSanPham = 5 THEN 'Thùng đựng Lego với thiết kế chắc chắn và tiện lợi.'
    WHEN MaSanPham = 6 THEN 'Thùng đựng gạo thông minh giữ gạo luôn khô ráo và sạch sẽ.'
    WHEN MaSanPham = 7 THEN 'Thùng đựng đồ đa năng với nhiều ngăn và tiện ích.'
    WHEN MaSanPham = 8 THEN 'Thùng đựng đồ đa năng và gấp gọn khi không sử dụng.'
    WHEN MaSanPham = 9 THEN 'Thớt hai mặt với chất liệu chống trượt và an toàn.'
    WHEN MaSanPham = 11 THEN 'Tấm chắn mặt bếp ga giữ bếp luôn sạch sẽ.'
    WHEN MaSanPham = 12 THEN 'Tấm chắn dầu chắn gió giữ bếp luôn sạch sẽ và thoáng mát.'
    WHEN MaSanPham = 13 THEN 'Phụ kiện phòng bếp tiện ích và dễ dàng sử dụng.'
    WHEN MaSanPham = 14 THEN 'Phòng tắm & wc với thiết kế hiện đại và sang trọng.'
    WHEN MaSanPham = 15 THEN 'Ống đựng đũa thìa nhỏ gọn và tiện lợi.'
    WHEN MaSanPham = 16 THEN 'Lọ thủy tinh đựng nước với chất liệu an toàn và bền bỉ.'
    WHEN MaSanPham = 17 THEN 'Lồng bán đa năng dùng để chứa đồ trong nhà.'
    WHEN MaSanPham = 18 THEN 'Kệ chén trên bồn rửa giữ bếp luôn gọn gàng.'
    WHEN MaSanPham = 19 THEN 'Kệ up chén đa năng với thiết kế thông minh.'
    WHEN MaSanPham = 20 THEN 'Kệ phòng tắm với thiết kế hiện đại và tiện ích.'
    WHEN MaSanPham = 21 THEN 'Kệ giá phòng bếp với thiết kế chắc chắn và đẹp mắt.'
    WHEN MaSanPham = 22 THEN 'Kệ đựng xà phòng với chất liệu an toàn và tiện lợi.'
    WHEN MaSanPham = 23 THEN 'Kệ để máy sấy tóc dán tường tiện lợi và dễ dàng sử dụng.'
    WHEN MaSanPham = 24 THEN 'Kệ để lò vi sóng thông minh với thiết kế hiện đại và sang trọng.'
    WHEN MaSanPham = 25 THEN 'Kệ để dao thìa dĩa với chất liệu chống trượt và an toàn.'
    WHEN MaSanPham = 26 THEN 'Kệ để cốc nước với thiết kế đẹp mắt và tiện ích.'
    WHEN MaSanPham = 27 THEN 'Kệ để ấm trà với chất liệu an toàn và bền bỉ.'
    WHEN MaSanPham = 28 THEN 'Kệ đa năng dán tường tiện lợi và dễ dàng lắp đặt.'
    WHEN MaSanPham = 29 THEN 'Kệ chữ nhật nhôm dán tường chắc chắn và bền bỉ.'
    WHEN MaSanPham = 30 THEN 'Kệ chân nhật dán tường với thiết kế đẹp mắt và tiện ích.'
END;

INSERT INTO GiaDungPlus.MauSoLuong (MaMSL, MaSanPham, MauSac, SoLuong) 
VALUES
    (1, 1, '#FF5733', 12),
    (2, 1, '#33FF57', 34),
    (3, 1, '#3357FF', 56),
    (4, 2, '#FF33A8', 78),
    (5, 2, '#A833FF', 90),
    (6, 2, '#33FFA8', 22),
    (7, 3, '#FF8C33', 44),
    (8, 3, '#33FF8C', 66),
    (9, 3, '#8C33FF', 88),
    (10, 4, '#FF33B5', 100),
    (11, 4, '#B533FF', 32),
    (12, 4, '#33FFB5', 54),
    (13, 5, '#FF33FF', 76),
    (14, 5, '#FF338C', 98),
    (15, 5, '#338CFF', 20),
    (16, 6, '#FFC733', 42),
    (17, 6, '#C733FF', 64),
    (18, 6, '#33FFC7', 86),
    (19, 7, '#FF5733', 18),
    (20, 7, '#33FF57', 30),
    (21, 7, '#3357FF', 52),
    (22, 8, '#FF33A8', 74),
    (23, 8, '#A833FF', 96),
    (24, 8, '#33FFA8', 28),
    (25, 9, '#FF8C33', 50),
    (26, 9, '#33FF8C', 72),
    (27, 9, '#8C33FF', 94),
    (31, 11, '#FF33FF', 82),
    (32, 11, '#FF338C', 4),
    (33, 11, '#338CFF', 26),
    (34, 12, '#FFC733', 48),
    (35, 12, '#C733FF', 70),
    (36, 12, '#33FFC7', 92),
    (37, 13, '#FF5733', 14),
    (38, 13, '#33FF57', 36),
    (39, 13, '#3357FF', 58),
    (40, 14, '#FF33A8', 80),
    (41, 14, '#A833FF', 2),
    (42, 14, '#33FFA8', 24),
    (43, 15, '#FF8C33', 46),
    (44, 15, '#33FF8C', 68),
    (45, 15, '#8C33FF', 90),
    (46, 16, '#FF33B5', 12),
    (47, 16, '#B533FF', 34),
    (48, 16, '#33FFB5', 56),
    (49, 17, '#FF33FF', 78),
    (50, 17, '#FF338C', 90),
    (51, 17, '#338CFF', 22),
    (52, 18, '#FFC733', 44),
    (53, 18, '#C733FF', 66),
    (54, 18, '#33FFC7', 88),
    (55, 19, '#FF5733', 100),
    (56, 19, '#33FF57', 32),
    (57, 19, '#3357FF', 54),
    (58, 20, '#FF33A8', 76),
    (59, 20, '#A833FF', 98),
    (60, 20, '#33FFA8', 20),
    (61, 21, '#FF8C33', 42),
    (62, 21, '#33FF8C', 64),
    (63, 21, '#8C33FF', 86),
    (64, 22, '#FF33B5', 18),
    (65, 22, '#B533FF', 30),
    (66, 22, '#33FFB5', 52),
    (67, 23, '#FF33FF', 74),
    (68, 23, '#FF338C', 96),
    (69, 23, '#338CFF', 28),
    (70, 24, '#FFC733', 50),
    (71, 24, '#C733FF', 72),
    (72, 24, '#33FFC7', 94),
    (73, 25, '#FF5733', 16),
    (74, 25, '#33FF57', 38),
    (75, 25, '#3357FF', 60),
    (76, 26, '#FF33A8', 82),
    (77, 26, '#A833FF', 4),
    (78, 26, '#33FFA8', 26),
    (79, 27, '#FF8C33', 48),
    (80, 27, '#33FF8C', 70),
    (81, 27, '#8C33FF', 92),
    (82, 28, '#FF33B5', 14),
    (83, 28, '#B533FF', 36),
    (84, 28, '#33FFB5', 58),
    (85, 29, '#FF33FF', 80),
    (86, 29, '#FF338C', 2),
    (87, 29, '#338CFF', 24),
    (88, 30, '#FFC733', 46),
    (89, 30, '#C733FF', 68),
    (90, 30, '#33FFC7', 90);






