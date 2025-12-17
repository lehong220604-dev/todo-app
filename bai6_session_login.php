<?php
session_start(); // Bắt buộc phải có dòng này đầu tiên để dùng Session

// Xử lý đăng xuất
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: bai6_session_login.php");
}

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    if ($_POST['username'] == 'admin' && $_POST['password'] == '123456') {
        $_SESSION['user'] = $_POST['username']; // Lưu session
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h2>Chào mừng, <?php echo $_SESSION['user']; ?>!</h2>
        <p>Bạn đã đăng nhập thành công.</p>
        <a href="?action=logout">Đăng xuất</a>
    <?php else: ?>
        <h2>Đăng nhập hệ thống</h2>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        
        <form method="post">
            User: <input type="text" name="username" placeholder="admin"><br><br>
            Pass: <input type="password" name="password" placeholder="123456"><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    <?php endif; ?>
</body>
</html>