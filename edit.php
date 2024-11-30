<?php
session_start();
include 'db.php';

// Get task ID from URL
if (!isset($_GET['id'])) {
    echo "Task not found.";
    exit;
}

$task_id = intval($_GET['id']);

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
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8; /* Soft background color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Task</h2>
        <form action="" method="post">
            <input type="text" name="task_name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
            <input type="submit" value="Update Task">
        </form>
        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
