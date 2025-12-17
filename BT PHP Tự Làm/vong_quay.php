<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thử vận may</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; background-color: #f0f2f5; }
        .box { background: white; width: 400px; margin: 50px auto; padding: 30px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .qua { font-size: 24px; color: #d63384; font-weight: bold; margin: 20px 0; }
        button { background: #4c6ef5; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #364fc7; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🎉 Vòng Quay May Mắn</h2>
        <?php
        $qua_tang = [
            "Chúc bạn may mắn lần sau 😭",
            "Voucher giảm giá 10%",
            "Một tràng pháo tay 👏",
            "Thẻ cào 50.000đ",
            "Cái nịt (Nothing) 🤣",
            "Đặc biệt: iPhone 15 Pro Max 📱"
        ];

        if (isset($_POST['quay'])) {
            $index = array_rand($qua_tang); // Lấy vị trí ngẫu nhiên
            $ket_qua = $qua_tang[$index];
            echo "<div class='qua'>$ket_qua</div>";
        } else {
            echo "<div class='qua'>???</div>";
        }
        ?>
        
        <form method="post">
            <button type="submit" name="quay">Quay ngay!</button>
        </form>
    </div>
</body>
</html>