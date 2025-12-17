<?php
$thue_vat = 0.1; // 10% - Đây là biến toàn cục

// Khai báo hàm tính tổng tiền
function tinh_tong_bill($so_luong, $don_gia) {
    global $thue_vat; // Gọi biến toàn cục vào trong hàm
    
    $tong = $so_luong * $don_gia;
    $tien_thue = $tong * $thue_vat;
    $thanh_tien = $tong + $tien_thue;
    
    return [
        "tong" => $tong,
        "thue" => $tien_thue,
        "thanh_tien" => $thanh_tien
    ];
}

// Gọi hàm
$ket_qua = tinh_tong_bill(5, 100000);

echo "<h3>Hóa đơn bán hàng</h3>";
echo "Số lượng: 5 - Đơn giá: 100.000đ<br>";
echo "Tổng chưa thuế: " . number_format($ket_qua['tong']) . " VNĐ<br>";
echo "Thuế VAT (10%): " . number_format($ket_qua['thue']) . " VNĐ<br>";
echo "<b>Thành tiền: " . number_format($ket_qua['thanh_tien']) . " VNĐ</b>";
?>