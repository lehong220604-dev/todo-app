<?php
require 'check_auth.php';
require 'config/database.php';

$user_id = $_SESSION['user_id'];

$task_id = $_GET['id'] ?? 0;

if ($task_id > 0) {
    try {
        
        $sql = "DELETE FROM tasks WHERE id = ? AND user_id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$task_id, $user_id]);

    } catch (PDOException $e) {
        
    }
}

header("Location: index.php");
exit;

?>