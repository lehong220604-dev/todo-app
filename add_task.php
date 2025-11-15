<?php

require 'check_auth.php';

require 'config/database.php';

$user_id = $_SESSION['user_id'];

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : NULL;

    try {
     
        $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$user_id, $title, $description, $due_date]);

        header("Location: index.php");
        exit;

    } catch (PDOException $e) {
        $message = "Lỗi khi thêm công việc: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm công việc mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <div class="p-4 bg-white rounded shadow-sm">
            <h2 class="mb-4">Thêm công việc mới</h2>

            <?php if (!empty($message)): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="add_task.php" method="POST">

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề công việc:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả (tùy chọn):</label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Ngày hết hạn (tùy chọn):</label>
                    <input type="date" id="due_date" name="due_date" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Lưu công việc</button>
                <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
            </form>

        </div>
    </div>

</body>
</html>