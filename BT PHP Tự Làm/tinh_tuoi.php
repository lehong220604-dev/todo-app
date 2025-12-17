<!DOCTYPE html>
<html lang="vi">
<body>
    <h2>🎂 Công cụ tính tuổi</h2>
    <form method="post">
        Chọn ngày sinh của bạn: <input type="date" name="ngaysinh" required>
        <button type="submit">Xem chi tiết</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ngay_sinh = new DateTime($_POST['ngaysinh']);
        $hien_tai = new DateTime();
        
        // Tính tuổi
        $tuoi = $hien_tai->diff($ngay_sinh);
        
        echo "<hr>";
        echo "<h3>Kết quả phân tích:</h3>";
        echo "<ul>";
        echo "<li>Bạn đã sống được: <b>" . $tuoi->y . " tuổi, " . $tuoi->m . " tháng, " . $tuoi->d . " ngày.</b></li>";
        echo "<li>Năm sinh: " . $ngay_sinh->format('d/m/Y') . "</li>";
        
        $sinh_nhat_toi = new DateTime(date('Y') . '-' . $ngay_sinh->format('m-d'));
        if ($sinh_nhat_toi < $hien_tai) {
            $sinh_nhat_toi->modify('+1 year');
        }
        $con_lai = $hien_tai->diff($sinh_nhat_toi);
        
        echo "<li>Chỉ còn <b>" . $con_lai->days . " ngày</b> nữa là đến sinh nhật bạn! 🎉</li>";
        echo "</ul>";
    }
    ?>
</body>
</html>