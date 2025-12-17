<?php
$json_data = '[
    {"id": 1, "product": "iPhone 15", "price": 25000000},
    {"id": 2, "product": "Samsung S24", "price": 20000000},
    {"id": 3, "product": "Xiaomi 14", "price": 15000000}
]';

$products = json_decode($json_data, true);

echo "<h3>Danh sách sản phẩm từ JSON</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Tên SP</th><th>Giá</th></tr>";

foreach ($products as $item) {
    echo "<tr>";
    echo "<td>" . $item['id'] . "</td>";
    echo "<td>" . $item['product'] . "</td>";
    echo "<td>" . number_format($item['price']) . " VNĐ</td>";
    echo "</tr>";
}
echo "</table>";

echo "<br><b>Dữ liệu gốc (JSON):</b> " . json_encode($products);
?>