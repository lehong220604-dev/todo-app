<?php
require 'check_auth.php'; 
require 'config/database.php'; 

$user_id = $_SESSION['user_id'];
$message = '';

$task_id = $_GET['id'] ?? 0;

if ($task_id <= 0) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : NULL;
    $status = $_POST['status'];

    try {
       
        $sql = "UPDATE tasks SET 
                    title = ?, 
                    description = ?, 
                    due_date = ?, 
                    status = ? 
                WHERE id = ? AND user_id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $due_date, $status, $task_id, $user_id]);

     
        header("Location: index.php");
        exit;

    } catch (PDOException $e) {
        $message = "Lỗi khi cập nhật: " . $e->getMessage();
    }
}


try {
    $sql = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task_id, $user_id]);
    $task = $stmt->fetch();

    if (!$task) {
        header("Location: index.php");
        exit;
    }

} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa công việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <div class="p-4 bg-white rounded shadow-sm">
            <h2 class="mb-4">Chỉnh sửa công việc</h2>

            <?php if (!empty($message)): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="edit_task.php?id=<?php echo $task_id; ?>" method="POST">

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề:</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?php echo htmlspecialchars($task['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Ngày hết hạn:</label>
                    <input type="date" id="due_date" name="due_date" class="form-control" 
                           value="<?php echo htmlspecialchars($task['due_date']); ?>">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái:</label>
                    <select id="status" name="status" class="form-select">
                        <option value="pending" <?php if ($task['status'] == 'pending') echo 'selected'; ?>>
                            Đang chờ (Pending)
                        </option>
                        <option value="in_progress" <?php if ($task['status'] == 'in_progress') echo 'selected'; ?>>
                            Đang làm (In Progress)
                        </option>
                        <option value="completed" <?php if ($task['status'] == 'completed') echo 'selected'; ?>>
                            Hoàn thành (Completed)
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
            </form>

        </div>
    </div>

</body>
</html>