<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include 'db.php';


$sql = "SELECT exam_submissions.name, exam_submissions.submission_time, exams.exam_name 
        FROM exam_submissions 
        JOIN exams ON exam_submissions.exam_id = exams.id";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Exam Results</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Exam Name</th><th>Submission Time</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['exam_name']) . "</td><td>" . htmlspecialchars($row['submission_time']) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No submissions found.</p>";
    }
    ?>
</body>
</html>

<?php
$conn->close();
?>
