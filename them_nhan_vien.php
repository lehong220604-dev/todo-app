<?php
$thong_bao = "";
$ho_ten = "";
$tuoi = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ho_ten = $_POST['fullname'];
    $tuoi = $_POST['age'];
    $email = $_POST['email'];

    if (empty($ho_ten) || empty($tuoi) || empty($email)) {
        $thong_bao = "<span style='color:red;'>Vui lòng nhập đầy đủ thông tin!</span>";
    } elseif (!is_numeric($tuoi) || $tuoi < 18 || $tuoi > 65) {
        $thong_bao = "<span style='color:red;'>Tuổi phải là số từ 18 đến 65!</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $thong_bao = "<span style='color:red;'>Email không đúng định dạng!</span>";
    } else {
        // Giả lập lưu thành công (Vì chưa có Database)
        $thong_bao = "<span style='color:green;'>Đã thêm nhân viên <b>$ho_ten</b> thành công!</span>";
        
        $ho_ten = ""; $tuoi = ""; $email = "";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Nhân Viên Mới</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="email"] {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            background-color: #4CAF50; color: white; padding: 10px 15px;
            border: none; border-radius: 4px; cursor: pointer; font-size: 16px;
        }
        button:hover { background-color: #45a049; }
        .back-link { margin-top: 20px; display: block; color: #555; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h2>Thêm Nhân Viên Mới</h2>
    
    <p><?= $thong_bao ?></p>

    <form method="post" action="">
        <div class="form-group">
            <label>Họ và Tên:</label>
            <input type="text" name="fullname" value="<?= $ho_ten ?>" placeholder="Nhập họ tên...">
        </div>

        <div class="form-group">
            <label>Tuổi:</label>
            <input type="number" name="age" value="<?= $tuoi ?>" placeholder="Nhập tuổi...">
        </div>

        <div class="form-group">
            <label>Email công ty:</label>
            <input type="text" name="email" value="<?= $email ?>" placeholder="... @hongmoc.com">
        </div>

        <button type="submit">Lưu nhân viên</button>
    </form>

    <a href="danh_sach_nhan_su.php" class="back-link">← Quay lại danh sách</a>

</body>
</html>