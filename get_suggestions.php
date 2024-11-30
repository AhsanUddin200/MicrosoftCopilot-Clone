<?php
if (isset($_POST['task_name'])) {
    $task_name = htmlspecialchars($_POST['task_name']);

    // Simulate AI suggestions with a more diverse set of responses
    $suggestions = [
        "Consider breaking down '$task_name' into smaller tasks.",
        "You might want to prioritize '$task_name'.",
        "Don't forget to set a deadline for '$task_name'.",
        "Make sure to allocate enough time for '$task_name'.",
        "Consider delegating parts of '$task_name' if possible.",
        "Review the requirements for '$task_name' before starting.",
        "Think about potential obstacles for '$task_name' and plan accordingly.",
        "Set reminders for '$task_name' to stay on track.",
        "Reflect on past experiences with similar tasks to improve your approach.",
        "Collaborate with others if '$task_name' requires teamwork."
    ];

    echo json_encode($suggestions);
}
?>
