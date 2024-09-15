<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include 'db.php';

// Handle exam deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_exam'])) {
    $exam_id = $_POST['exam_id'];

    // Delete the exam and its related questions and choices from the database
    $stmt = $conn->prepare("DELETE FROM exams WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $exam_id, $user_id);
    $stmt->execute();

    // Also delete related questions and choices
    $stmt = $conn->prepare("DELETE FROM questions WHERE exam_id = ?");
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM choices WHERE question_id IN (SELECT id FROM questions WHERE exam_id = ?)");
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();

    $stmt->close();
}

// Fetch user's exams
$stmt = $conn->prepare("SELECT id, exam_name FROM exams WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$exams_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
            max-width: 800px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        h1 {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .exam-list ul {
            list-style-type: none;
            padding: 0;
        }

        .exam-list ul li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .exam-list ul li a {
            color: #007bff;
            text-decoration: none;
        }

        .exam-list ul li a:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .logout-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            margin-top: 20px;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <a href="manage_exam.php" class="button">Create New Exam</a>

        <div class="exam-list">
            <h2>Your Exams</h2>
            <ul>
                <?php while ($row = $exams_result->fetch_assoc()): ?>
                    <li>
                        <div>
                            <a href="manage_exam.php?exam_id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['exam_name']); ?></a>
                        </div>
                        <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete this exam?');">
                            <input type="hidden" name="exam_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_exam" class="delete-button">Delete</button>
                        </form>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
