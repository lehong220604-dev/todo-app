<?php
require 'check_auth.php'; 
require 'config/database.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$sort_option = $_GET['sort'] ?? 'created_at_desc'; 
$status_filter = $_GET['status'] ?? ''; 

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$params = [$user_id]; 

if (!empty($status_filter)) {
    $sql .= " AND status = ?"; 
    $params[] = $status_filter; 
}

$order_by_sql = "";
if ($sort_option == 'due_date_asc') {
    $order_by_sql = " ORDER BY due_date ASC";
} elseif ($sort_option == 'due_date_desc') {
    $order_by_sql = " ORDER BY due_date DESC";
} else {
    $order_by_sql = " ORDER BY created_at DESC"; 
}

$sql .= $order_by_sql; 

$stmt = $pdo->prepare($sql);
$stmt->execute($params); 

$tasks = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản lý công việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white shadow-sm rounded">
            <h3>Chào mừng, <?php echo htmlspecialchars($username); ?>!</h3>
            <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
        </div>

        <div class="p-4 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Công việc của bạn</h2>
                <a href="add_task.php" class="btn btn-primary">Thêm công việc mới</a>
            </div>

            <div class="row g-3 mb-3 p-3 bg-light rounded border">
                <form action="index.php" method="GET" class="col-md-8">
                    <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort_option); ?>">

                    <div class="input-group">
                        <label class="input-group-text" for="status">Lọc theo trạng thái:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" <?php if ($status_filter == 'pending') echo 'selected'; ?>>
                                Đang chờ
                            </option>
                            <option value="in_progress" <?php if ($status_filter == 'in_progress') echo 'selected'; ?>>
                                Đang làm
                            </option>
                            <option value="completed" <?php if ($status_filter == 'completed') echo 'selected'; ?>>
                                Hoàn thành
                            </option>
                        </select>
                        <button class="btn btn-outline-primary" type="submit">Lọc</button>
                    </div>
                </form>

                <div class="col-md-4 text-md-end">
                    <span class="align-middle me-2">Sắp xếp theo hạn chót:</span>
                    <a href="index.php?sort=due_date_asc&status=<?php echo htmlspecialchars($status_filter); ?>" class="btn btn-sm btn-outline-secondary">
                        Tăng dần
                    </a>
                    <a href="index.php?sort=due_date_desc&status=<?php echo htmlspecialchars($status_filter); ?>" class="btn btn-sm btn-outline-secondary">
                        Giảm dần
                    </a>
                </div>
            </div>
            <ul class="list-group">
                <?php if (empty($tasks)): ?>
                    <li class="list-group-item text-center text-muted">
                        Không tìm thấy công việc nào phù hợp.
                    </li>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo htmlspecialchars($task['title']); ?></strong>

                                <?php
                                    $status_class = 'bg-secondary'; // pending
                                    if ($task['status'] == 'in_progress') {
                                        $status_class = 'bg-info text-dark';
                                    } elseif ($task['status'] == 'completed') {
                                        $status_class = 'bg-success';
                                    }
                                ?>
                                <span class="badge <?php echo $status_class; ?>">
                                    <?php echo $task['status']; ?>
                                </span>

                                <p class="mb-0"><?php echo htmlspecialchars($task['description']); ?></p>

                                <?php if (!empty($task['due_date'])): ?>
                                    <small class="text-muted">Hạn chót: <?php echo $task['due_date']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div>
                                <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div> 
    </div>
</body>
</html>