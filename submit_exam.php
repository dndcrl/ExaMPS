<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if needed (e.g., to retrieve user ID)
session_start();

// Include database connection
include 'db.php'; // Ensure 'db.php' correctly sets up the $conn variable

// Retrieve exam ID and user name from POST data
$exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

// Validate name and exam_id
if (empty($name)) {
    die("No name provided.");
}

if ($exam_id <= 0) {
    die("Invalid exam ID.");
}

// Initialize score and correct answers total
$score = 0;
$correct_answers_total = 0;

// Retrieve the total number of questions for the exam
$stmt = $conn->prepare("SELECT COUNT(*) AS total_questions FROM questions WHERE exam_id = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $exam_id);
if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}
$stmt->bind_result($total_questions);
if (!$stmt->fetch()) {
    die("Fetching total questions failed.");
}
$stmt->close();

// Check if the user submitted answers to questions
if (isset($_POST['questions']) && is_array($_POST['questions'])) {
    // Begin transaction to ensure data integrity
    $conn->begin_transaction();

    try {
        // Insert the exam submission first (without score, to get submission ID)
        $stmt = $conn->prepare("INSERT INTO exam_submissions (exam_id, name, submission_time, score, correct_answers_total) VALUES (?, ?, NOW(), ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $submission_score = 0; // Start with 0 score
        $submission_correct_answers = 0; // Initialize correct answers total
        $stmt->bind_param("isii", $exam_id, $name, $submission_score, $submission_correct_answers);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }
        $exam_submission_id = $stmt->insert_id; // Get the ID of the new submission
        $stmt->close(); // Close the statement after getting submission ID

        // Prepare statement for user_answers
        $insert_answer_stmt = $conn->prepare("INSERT INTO user_answers (exam_submission_id, question_id, selected_choice_id) VALUES (?, ?, ?)");
        if (!$insert_answer_stmt) {
            throw new Exception("Prepare failed for user_answers insert: (" . $conn->errno . ") " . $conn->error);
        }

        // Loop through each question and insert the answer
        foreach ($_POST['questions'] as $question_id => $answer_data) {
            // Validate question_id
            $question_id = intval($question_id);
            if ($question_id <= 0) {
                throw new Exception("Invalid question ID: " . htmlspecialchars($question_id));
            }

            // Get the selected choice ID from the user's response
            $selected_choice_id = isset($answer_data['choice']) ? intval($answer_data['choice']) : 0;

            // Validate selected_choice_id
            if ($selected_choice_id <= 0) {
                continue; // Skip if no valid choice is selected
            }

            // Check if the selected choice is correct
            $stmt = $conn->prepare("SELECT is_correct FROM choices WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed for choices select: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("i", $selected_choice_id);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed for choices select: (" . $stmt->errno . ") " . $stmt->error);
            }
            $stmt->bind_result($is_correct);
            if (!$stmt->fetch()) {
                $is_correct = 0; // Invalid choice ID
            }
            $stmt->close();

            // Increment the score if the selected choice is correct
            if ($is_correct) {
                $score++;
                $correct_answers_total++;
            }

            // Insert user's answer into the user_answers table
            $insert_answer_stmt->bind_param("iii", $exam_submission_id, $question_id, $selected_choice_id);
            if (!$insert_answer_stmt->execute()) {
                throw new Exception("Execute failed for user_answers insert: (" . $insert_answer_stmt->errno . ") " . $insert_answer_stmt->error);
            }
        }
        $insert_answer_stmt->close();

        // Update the score and correct answers total in the exam_submissions table
        $update_submission_stmt = $conn->prepare("UPDATE exam_submissions SET score = ?, correct_answers_total = ? WHERE id = ?");
        if (!$update_submission_stmt) {
            throw new Exception("Prepare failed for exam_submissions update: (" . $conn->errno . ") " . $conn->error);
        }
        $update_submission_stmt->bind_param("iii", $score, $correct_answers_total, $exam_submission_id);
        if (!$update_submission_stmt->execute()) {
            throw new Exception("Execute failed for exam_submissions update: (" . $update_submission_stmt->errno . ") " . $update_submission_stmt->error);
        }
        $update_submission_stmt->close();

        // Commit the transaction
        $conn->commit();
    } catch (Exception $e) {
        // An error occurred, rollback the transaction
        $conn->rollback();
        die("Error during exam submission: " . $e->getMessage());
    }

} else {
    die("No answers provided.");
}
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ensure vertical centering */
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #28a745;
        }

        p {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Exam Submitted</h1>
        <p>Thank you for taking the exam, <?php echo htmlspecialchars($name); ?>!</p>
        <p>Your score: <?php echo $score; ?> out of <?php echo $total_questions; ?></p>
    </div>
</body>
</html>
