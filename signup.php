<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    $sql = "SELECT * FROM microsoft_user WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $error = "User with this email already exists.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO microsoft_user (name, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $password]);
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e1f0ff; /* Light blue background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .signup-container h2 {
            color: #0078d4; /* Microsoft blue */
            margin-bottom: 20px;
        }

        .signup-container img {
            width: 120px; /* Adjust logo size */
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #0078d4;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0078d4; /* Microsoft blue */
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005fa3; /* Darker blue on hover */
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .signup-container p {
            font-size: 14px;
            margin-top: 20px;
        }

        .signup-container a {
            color: #0078d4;
            text-decoration: none;
        }

        .signup-container a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="signup-container">
    <img src="data:image/jpeg;base64,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" alt="Microsoft Logo"> <!-- Add the Microsoft logo here -->
    <h2>Sign Up</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign Up</button>
    </form>
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
