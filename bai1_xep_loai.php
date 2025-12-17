<?php
// Mảng danh sách sinh viên và điểm số
$sinh_vien = [
    "Nguyen Van Hai" => 8.5,
    "Tran Minh Thu" => 6.0,
    "Le Van Cuong" => 4.5,
    "Phan Thu Huyen" => 9.0
];

echo "<h2>Danh sách xếp loại học sinh</h2>";
echo "<ul>";

// Vòng lặp duyệt mảng
foreach ($sinh_vien as $ten => $diem) {
    // Cấu trúc If...Else để xếp loại
    if ($diem >= 8.0) {
        $loai = "Giỏi";
        $mau = "green";
    } elseif ($diem >= 6.5) {
        $loai = "Khá";
        $mau = "blue";
    } elseif ($diem >= 5.0) {
        $loai = "Trung bình";
        $mau = "orange";
    } else {
        $loai = "Yếu";
        $mau = "red";
    }

    echo "<li>Sinh viên: <b>$ten</b> - Điểm: $diem - Xếp loại: <span style='color:$mau'>$loai</span></li>";
}
echo "</ul>";
?>