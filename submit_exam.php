<?php
include 'db.php'; // Database connection

$exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';

if (empty($name)) {
    die("No name provided.");
}

// Initialize the score
$score = 0;

// Retrieve the total number of questions for the exam
$stmt = $conn->prepare("SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$stmt->bind_result($total_questions);
$stmt->fetch();
$stmt->close();

// Check if the user submitted answers to questions
if (isset($_POST['questions']) && is_array($_POST['questions'])) {
    foreach ($_POST['questions'] as $question_id => $answer_data) {
        // Get the selected choice ID from the user's response
        $selected_choice_id = isset($answer_data['choice']) ? intval($answer_data['choice']) : 0;

        // Check if the selected choice is correct
        if ($selected_choice_id > 0) {
            $stmt = $conn->prepare("SELECT is_correct FROM choices WHERE id = ?");
            $stmt->bind_param("i", $selected_choice_id);
            $stmt->execute();
            $stmt->bind_result($is_correct);
            $stmt->fetch();
            $stmt->close();

            // Increment the score if the selected choice is correct
            if ($is_correct) {
                $score++;
            }
        }
    }
}

// Insert the exam submission with the score into the database
$stmt = $conn->prepare("INSERT INTO exam_submissions (exam_id, name, score) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $exam_id, $name, $score);
$stmt->execute();
$stmt->close();

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
    if ($exam_id > 0) {
        echo "<h1>Exam Submitted</h1>";
        echo "<p>Thank you for taking the exam, $name!</p>";
        echo "<p>Your score: $score out of $total_questions</p>"; // Display the score and total items
    } else {
        echo "<h1>Invalid Exam ID</h1>";
        echo "<p>The exam ID provided is invalid. Please try again.</p>";
    }
    ?>
   
</body>
</html>
