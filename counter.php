<?php
$cookie_name = 'user_access_log'; 
$expiry_time = time() + (86400 * 1); // 86400 = 1 ngày

if (!isset($_COOKIE[$cookie_name])) {
    $current_view = 1;
    $message = "Chào mừng! Đây là lần đầu bạn ghé thăm website.";
} else {
 
    $current_view = (int)$_COOKIE[$cookie_name] + 1;
    $message = "Chào mừng trở lại! Bạn đã truy cập trang này <b>" . htmlspecialchars($current_view) . "</b> lần.";
}

setcookie($cookie_name, $current_view, [
    'expires' => $expiry_time,
    'path' => "/",
    'secure' => true,    
    'httponly' => true, 
    'samesite' => 'Strict'
]);

//  Hiển thị kết quả
echo "<h3>Theo dõi lượt truy cập (Cookie)</h3>";
echo $message;
?>