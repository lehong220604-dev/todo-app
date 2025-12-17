<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Máy Tính Cá Nhân - Bài Tự Luyện</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        .box { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: #f9f9f9; }
        input, select, button { padding: 10px; margin: 5px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🧮 Máy Tính PHP</h2>
        <form method="post">
            <input type="number" name="so1" placeholder="Số thứ nhất" required>
            <select name="pheptinh">
                <option value="+">Cộng (+)</option>
                <option value="-">Trừ (-)</option>
                <option value="*">Nhân (x)</option>
                <option value="/">Chia (:)</option>
            </select>
            <input type="number" name="so2" placeholder="Số thứ hai" required>
            <br>
            <button type="submit" name="tinh">Tính Kết Quả</button>
        </form>

        <?php
        if (isset($_POST['tinh'])) {
            $so1 = $_POST['so1'];
            $so2 = $_POST['so2'];
            $pheptinh = $_POST['pheptinh'];
            $ketqua = "";

            switch ($pheptinh) {
                case '+': $ketqua = $so1 + $so2; break;
                case '-': $ketqua = $so1 - $so2; break;
                case '*': $ketqua = $so1 * $so2; break;
                case '/': 
                    if ($so2 == 0) $ketqua = "Không thể chia cho 0";
                    else $ketqua = $so1 / $so2; 
                    break;
            }
            echo "<h3>Kết quả: <span style='color:blue'>$ketqua</span></h3>";
        }
        ?>
    </div>
</body>
</html>