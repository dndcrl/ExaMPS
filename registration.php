<?php
include 'db.php';

// Initialize message variable
$message = "";

// Registration process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email']; // Retrieve email from the form
    $password = $_POST['password']; // Plain text password
    $is_teacher = isset($_POST['is_teacher']) ? 1 : 0;

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username already exists
        $message = "<p class='error-message'>Username already used.</p>";
    } else {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, is_teacher, approved) VALUES (?, ?, ?, ?, 0)");
        $stmt->bind_param("sssi", $username, $email, $password, $is_teacher);

        if ($stmt->execute()) {
            $message = "<p class='success-message'>Registration successful. Please wait for approval.</p>";
        } else {
            $message = "<p class='error-message'>Error: " . htmlspecialchars($stmt->error) . "</p>";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
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

        .success-message {
            color: #28a745;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .error-message {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <p>Have your own ExaMPS Account.</p>
        <?php
        // Display message if set
        if ($message != "") {
            echo $message;
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="is_teacher">
                    <input type="checkbox" id="is_teacher" name="is_teacher">
                    Are you a teacher?
                </label>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
