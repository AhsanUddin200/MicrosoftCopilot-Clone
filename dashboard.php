<?php
session_start();
include 'db.php';

// Assuming a logged-in user has a valid session and user_id is stored in session
$user_id = $_SESSION['user_id']; // Get the user ID from session (replace this with actual session data)

// Handle adding a task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_name'])) {
    $task_name = htmlspecialchars($_POST['task_name']);

    // Insert the new task into the microsoft_task table
    $sql = "INSERT INTO microsoft_task (user_id, task_name, status) VALUES (?, ?, 'incomplete')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $task_name]);
}

// Handle marking task as complete
if (isset($_GET['complete_task_id'])) {
    $task_id = $_GET['complete_task_id'];
    $sql = "UPDATE microsoft_task SET status = 'complete' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task_id]);
}

// Handle editing task (Redirect to edit page)
if (isset($_GET['edit_task_id'])) {
    header('Location: edit.php?id=' . $_GET['edit_task_id']);
    exit;
}

// Fetch tasks for the logged-in user
$sql = "SELECT * FROM microsoft_task WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();

// Simulate AI-driven suggestions based on task keywords
function get_task_suggestions($task_name) {
    $suggestions = [];
    // Simple logic based on task keywords
    if (stripos($task_name, 'meeting') !== false) {
        $suggestions[] = 'Schedule the meeting';
        $suggestions[] = 'Send meeting invitations';
        $suggestions[] = 'Prepare the agenda';
    } elseif (stripos($task_name, 'email') !== false) {
        $suggestions[] = 'Write the email';
        $suggestions[] = 'Send the email';
    } elseif (stripos($task_name, 'report') !== false) {
        $suggestions[] = 'Create the report';
        $suggestions[] = 'Send the report to the team';
    } else {
        $suggestions[] = 'Try breaking down the task into smaller steps.';
    }
    return $suggestions;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Dashboard</title>
</head>
<body>

<h1>Welcome to Your Dashboard</h1>

<form method="POST" action="">
    <input type="text" name="task_name" placeholder="Enter task" required>
    <button type="submit">Add Task</button>
</form>

<h2>Your Tasks:</h2>
<?php foreach ($tasks as $task): ?>
    <div>
        <p><?php echo htmlspecialchars($task['task_name']); ?> 
        (Status: <?php echo $task['status']; ?>) 
        <a href="?complete_task_id=<?php echo $task['id']; ?>">Complete</a> | 
        <a href="?edit_task_id=<?php echo $task['id']; ?>">Edit</a></p>

        <?php
        // Display AI suggestions based on task name
        $suggestions = get_task_suggestions($task['task_name']);
        echo "<strong>AI Suggestions:</strong><ul>";
        foreach ($suggestions as $suggestion) {
            echo "<li>" . htmlspecialchars($suggestion) . "</li>";
        }
        echo "</ul>";
        ?>
    </div>
<?php endforeach; ?>

</body>
</html>
