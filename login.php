<?php
session_start();
include 'db.php'; // Include your database connection

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT id, password, is_teacher, is_admin, approved FROM users WHERE username = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $username);

        // Execute the SQL statement
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->bind_result($user_id, $stored_password, $is_teacher, $is_admin, $approved);
        $stmt->fetch();
        $stmt->close();

        // Check if the account is approved first
        if (!$approved) {
            $error_message = "Your account is not approved.";
        } else if ($password === $stored_password) { // Compare passwords
            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username; // Optional: Store username
            $_SESSION['is_teacher'] = $is_teacher; // Store teacher status
            $_SESSION['is_admin'] = $is_admin; // Store admin status

            // Redirect to appropriate page
            if ($is_admin) {
                header("Location: admin_panel.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Please fill out all fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            color: #28a745;
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        .error-message {
            color: #dc3545;
            margin-bottom: 15px;
        }

        .no-account {
            margin-top: 20px;
            text-align: center;
        }

        .no-account a {
            color: #007bff;
            text-decoration: none;
        }

        .no-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
       
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div class="no-account">
            <p>Don't have an account? <a href="registration.php">Register here.</a></p>
        </div>
    </div>
</body>
</html>