<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Get submission ID from the URL
if (isset($_GET['submission_id'])) {
    $submission_id = $_GET['submission_id'];

    // Query to retrieve the score based on submission_id
    $sql = "SELECT exam_submissions.name, exam_submissions.score, exams.exam_name, exam_submissions.exam_id 
            FROM exam_submissions 
            JOIN exams ON exam_submissions.exam_id = exams.id 
            WHERE exam_submissions.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $submission_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $exam_id = $row['exam_id'];

        // Query to get the total number of questions for this exam
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = ?");
        $stmt->bind_param("i", $exam_id);
        $stmt->execute();
        $stmt->bind_result($total_questions);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "No score found.";
        exit();
    }
} else {
    echo "Invalid submission ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Score</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
        }


        .main-content {
            padding: 20px;
            width: 100%;
        }

        .main-content h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #28a745;
        }

        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard-card h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: #555;
            font-size: 18px;
        }

        .dashboard-card .score {
            font-size: 48px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    

    <div class="main-content">
        <h1>Exam Result</h1>
        <div class="dashboard-card">
            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
            <p>Exam Name: <?php echo htmlspecialchars($row['exam_name']); ?></p>
            <p>Total Score:</p>
            <br>
            <!-- Display the score along with total questions -->
            <p class="score"><?php echo $row['score']; ?> / <?php echo $total_questions; ?></p>
        </div>
    </div>
</body>
</html>