<?php

include 'db.php';


$exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';

if (empty($name)) {
    die("No name provided.");
}


$stmt = $conn->prepare("INSERT INTO exam_submissions (exam_id, name) VALUES (?, ?)");
$stmt->bind_param("is", $exam_id, $name);
$stmt->execute();
$stmt->close();

session_start();
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user_id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Submitted</title>
    <style>
        body {
            font-family: 'Segoe UI';
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            margin-top: 13rem;
            justify-content: center;
            align-items: center;
        }


        h1 {
            color: black;
            text-align: center;
        }

        p {
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>
    
        <?php
        $exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : 0;
        $questions = isset($_POST['questions']) ? $_POST['questions'] : [];

        if ($exam_id > 0) {
            
            echo "<h1>Exam Submitted</h1>";
            echo "<p>Thank you for taking the exam!</p>";
        } else {
            echo "<h1>Invalid Exam ID</h1>";
            echo "<p>The exam ID provided is invalid. Please try again.</p>";
        }
        ?>
   
</body>
</html>
