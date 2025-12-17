<?php
$staff_list = [];

$ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Vũ'];
$ten = ['Văn An', 'Thị Bình', 'Quốc Cường', 'Minh Dung', 'Thanh Tuyền', 'Ngọc Mai'];

for ($k = 1; $k <= 10; $k++) {
    $random_name = $ho[array_rand($ho)] . ' ' . $ten[array_rand($ten)];
    
    $staff_code = "NV-" . str_pad($k, 3, '0', STR_PAD_LEFT);

    $staff_list[] = [
        'code'      => $staff_code,
        'fullname'  => $random_name,
        'age'       => rand(22, 55), 
        'email'     => strtolower(str_replace(' ', '', $random_name)) . rand(10,99) . '@hongmoc.com' // Email theo tên miền cty
    ];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý nhân sự</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table-staff { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-staff th { background-color: #4CAF50; color: white; padding: 12px; text-align: left; }
        .table-staff td { border: 1px solid #ddd; padding: 10px; }
        .table-staff tr:nth-child(even) { background-color: #f2f2f2; } /* Tô màu xen kẽ các dòng */
        .table-staff tr:hover { background-color: #ddd; }
        h2 { color: #333; border-bottom: 2px solid #4CAF50; display: inline-block; padding-bottom: 5px; }
    </style>
</head>
<body>

    <h2>Danh sách nhân viên công ty</h2>

    <table class="table-staff">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Họ và Tên</th>
                <th>Tuổi</th>
                <th>Email liên hệ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staff_list as $staff): ?>
                <tr>
                    <td><strong><?= $staff['code'] ?></strong></td>
                    <td><?= $staff['fullname'] ?></td>
                    <td><?= $staff['age'] ?></td>
                    <td><a href="mailto:<?= $staff['email'] ?>"><?= $staff['email'] ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>