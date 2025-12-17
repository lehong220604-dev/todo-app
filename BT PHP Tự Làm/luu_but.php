<?php
$filename = "data_luubut.txt";

if (isset($_POST['gui_loi_nhan'])) {
    $ten = htmlspecialchars($_POST['ten']); // Chống mã độc
    $loi_nhan = htmlspecialchars($_POST['loi_nhan']);
    $thoi_gian = date("d/m/Y H:i:s");

    // Định dạng dòng chữ sẽ lưu: Tên | Lời nhắn | Thời gian
    $noi_dung = "$ten | $loi_nhan | $thoi_gian\n";


    $file = fopen($filename, "a");
    fwrite($file, $noi_dung);
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Sổ Lưu Bút Online</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; }
        .list { border: 1px solid #ddd; padding: 10px; margin-top: 20px; background: #fff; }
        .item { border-bottom: 1px dashed #ccc; padding: 10px 0; }
    </style>
</head>
<body>
    <h2>📝 Sổ Lưu Bút</h2>
    <form method="post">
        <input type="text" name="ten" placeholder="Tên của bạn" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
        <textarea name="loi_nhan" placeholder="Viết gì đó đi..." required style="width: 100%; height: 80px; padding: 8px;"></textarea>
        <button type="submit" name="gui_loi_nhan" style="margin-top: 10px; padding: 10px 20px;">Gửi lưu bút</button>
    </form>

    <h3>Danh sách lời nhắn:</h3>
    <div class="list">
        <?php
        if (file_exists($filename)) {
            $lines = file($filename);
            $lines = array_reverse($lines); 
            
            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $parts = explode("|", $line);
                    if (count($parts) == 3) {
                        echo "<div class='item'>
                                <strong>$parts[0]</strong>: $parts[1] 
                                <br><small style='color:gray'>$parts[2]</small>
                              </div>";
                    }
                }
            }
        } else {
            echo "Chưa có lời nhắn nào. Bạn hãy là người đầu tiên!";
        }
        ?>
    </div>
</body>
</html>