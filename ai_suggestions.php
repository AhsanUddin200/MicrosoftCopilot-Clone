    <?php
    session_start();  // Start the session to track the logged-in user
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

        // Get AI suggestions for the task
        $suggestion = getAIGeneratedSuggestions($task_name); // Call the AI function
    }

    // Function to get AI-generated suggestions from Hugging Face API
    function getAIGeneratedSuggestions($taskName) {
        $apiKey = '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';  // Replace with your Hugging Face API key
        $apiUrl = 'https://api-inference.huggingface.co/models/gpt2';  // Use GPT-2 or other model

        // Prepare data to send to Hugging Face API
        $data = json_encode(array(
            "inputs" => "Task: $taskName. Suggest some related actions for this task."
        ));

        // Set up cURL options
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute the API call
        $response = curl_exec($ch);
        
        // Check for cURL error
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);  // Print out any cURL error for debugging
            return null;
        }

        curl_close($ch);

        // Decode the response
        $result = json_decode($response, true);

        // Check if the result is valid and return the suggestion
        if (isset($result[0]['generated_text'])) {
            return $result[0]['generated_text'];  // Return the generated text
        } else {
            return "No suggestion available.";  // Default message if no valid response
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Task Dashboard</h1>

        <!-- Task Input Form -->
        <form method="post" action="dashboard.php">
            <label for="task_name">Enter a task:</label>
            <input type="text" id="task_name" name="task_name" required>
            <button type="submit">Add Task</button>
        </form>

        <?php
        // If there is an AI suggestion, display it
        if (isset($suggestion)) {
            echo "<h3>AI Suggestions:</h3>";
            echo "<p>" . nl2br($suggestion) . "</p>";  // Display the suggestion text
        }
        ?>

        <h3>Your Tasks</h3>

        <!-- Display tasks -->
        <?php
        // Fetch tasks from the database
        $sql = "SELECT * FROM microsoft_task WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $tasks = $stmt->fetchAll();

        if (count($tasks) > 0) {
            echo "<ul>";
            foreach ($tasks as $task) {
                echo "<li>{$task['task_name']} - Status: {$task['status']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No tasks found.</p>";
        }
        ?>
    </body>
    </html>
