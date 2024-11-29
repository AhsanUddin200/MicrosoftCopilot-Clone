<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = htmlspecialchars($_POST['task_name']);
    $user_id = $_SESSION['user_id'];

    // Insert task into the database
    $sql = "INSERT INTO microsoft_task (user_id, task_name) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $task_name]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>
    <h2>Add New Task</h2>
    <form method="POST">
        <input type="text" name="task_name" placeholder="Enter task" required><br><br>
        <button type="submit">Add Task</button>
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
