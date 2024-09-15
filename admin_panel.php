<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Access denied.");
}

include 'db.php';

// Admin panel to approve users
$pending_users_query = "SELECT id, username FROM users WHERE approved = 0";
$result = $conn->query($pending_users_query);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        .user-item {
            margin-bottom: 10px;
        }

        .approve-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .approve-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Approve Users</h1>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user-item'>{$row['username']} <a href='approve_user.php?id={$row['id']}' class='approve-button'>Approve</a></div>";
            }
        } else {
            echo "<p>No pending users to approve.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
