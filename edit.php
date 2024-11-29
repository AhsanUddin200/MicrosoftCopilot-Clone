<?php
session_start();
include 'db.php';

// Get task ID from URL
$task_id = $_GET['id'];

// Fetch task from database
$sql = "SELECT * FROM microsoft_task WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$task_id]);
$task = $stmt->fetch();

if (!$task) {
    echo "Task not found.";
    exit;
}

// Handle updating task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_name'])) {
    $task_name = htmlspecialchars($_POST['task_name']);

    // Update task in database
    $sql = "UPDATE microsoft_task SET task_name = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task_name, $task_id]);

    // Redirect back to dashboard
    header('Location: dashboard.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>

<h1>Edit Task</h1>

<form method="POST" action="">
    <input type="text" name="task_name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
    <button type="submit">Save Changes</button>
</form>

</body>
</html>
