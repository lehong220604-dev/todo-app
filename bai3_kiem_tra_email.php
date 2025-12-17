<!DOCTYPE html>
<html>
<body>
    <h2>Đăng ký nhận tin</h2>
    <form method="post" action="">
        Email của bạn: <input type="text" name="email">
        <input type="submit" value="Gửi">
    </form>

    <?php
    // Kiểm tra xem người dùng đã bấm nút Gửi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];

        // Sử dụng bộ lọc filter_var để kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red'>Lỗi: Email '$email' không hợp lệ!</p>";
        } else {
            echo "<p style='color:green'>Thành công: Email '$email' hợp lệ.</p>";
        }
    }
    ?>
</body>
</html>