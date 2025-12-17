<?php
// Kiểm tra nếu người dùng bấm nút đổi màu
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    // Tạo cookie lưu trong 1 giờ (3600 giây)
    setcookie("giao_dien", $theme, time() + 3600, "/");
    header("Location: bai5_cookie_theme.php"); // Load lại trang
}

// Lấy giá trị cookie (mặc định là light)
$current_theme = isset($_COOKIE['giao_dien']) ? $_COOKIE['giao_dien'] : 'light';

// Đổi màu nền dựa trên cookie
$bg_color = ($current_theme == 'dark') ? '#333' : '#fff';
$text_color = ($current_theme == 'dark') ? '#fff' : '#000';
?>

<!DOCTYPE html>
<html style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>">
<body>
    <h1>Chế độ hiện tại: <?php echo ucfirst($current_theme); ?></h1>
    <p>Hãy chọn giao diện bạn thích, sau đó thử F5 lại trang để xem Cookie hoạt động.</p>
    
    <a href="?theme=light"><button>Giao diện Sáng</button></a>
    <a href="?theme=dark"><button>Giao diện Tối</button></a>
</body>
</html>