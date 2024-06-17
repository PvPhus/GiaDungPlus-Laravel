
document.addEventListener('DOMContentLoaded', function () {
    // Lấy thẻ input password
    var passwordInput = document.getElementById('password');
    var repeatPasswordInput = document.getElementById('repassword');

    // Lấy thông báo
    var message = document.getElementById('message');

    // Thêm sự kiện khi người dùng nhập vào input repeat password
    repeatPasswordInput.addEventListener('input', function () {
        // Kiểm tra xem hai mật khẩu có khớp nhau không
        if (passwordInput.value !== repeatPasswordInput.value) {
            // Nếu không khớp, hiển thị thông báo
            message.textContent = 'X';
        } else {
            // Nếu khớp, xóa thông báo
            message.textContent = '';
        }
    });
});

