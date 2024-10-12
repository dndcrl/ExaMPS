<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include 'db.php';

$exam_id = isset($_GET['exam_id']) ? intval($_GET['exam_id']) : 0;

if ($exam_id <= 0) {
    die("Invalid exam ID.");
}

// Query to get submissions for the specified exam
$sql = "SELECT exam_submissions.id AS submission_id, exam_submissions.name, exam_submissions.submission_time, exams.exam_name, exam_submissions.score 
        FROM exam_submissions 
        JOIN exams ON exam_submissions.exam_id = exams.id
        WHERE exams.id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $exam_id);
if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}
$result = $stmt->get_result();
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
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:last-child {
            border-bottom: none;
        }

        td {
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ffe9;
        }
    </style>
</head>
<body>
    <h1>Exam Results</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Exam Name</th>
                    <th>Submission Time</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><a href='view_score.php?submission_id=<?php echo $row['submission_id']; ?>'><?php echo htmlspecialchars($row['name']); ?></a></td>
                        <td><?php echo htmlspecialchars($row['exam_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['submission_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['score']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Statistics of Correct Answers</h2>
        <table>
            <thead>
                <tr>
                    <th>Item No.</th>
                    <th>No. of Correct Responses</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all questions for this exam
                $questions_sql = "SELECT id, question_number FROM questions WHERE exam_id = ? ORDER BY question_number"; // Order by question_number
                $questions_stmt = $conn->prepare($questions_sql);
                if (!$questions_stmt) {
                    die("Prepare failed for questions: (" . $conn->errno . ") " . $conn->error);
                }
                $questions_stmt->bind_param("i", $exam_id);
                if (!$questions_stmt->execute()) {
                    die("Execute failed for questions: (" . $questions_stmt->errno . ") " . $questions_stmt->error);
                }
                $questions_result = $questions_stmt->get_result();

                // Initialize an array to store correct counts per question
                $correct_counts = array();

                while ($question_row = $questions_result->fetch_assoc()) {
                    $question_id = $question_row['id'];
                    $question_number = $question_row['question_number'];

                    // Get count of correct responses for this question
                    $correct_count_sql = "SELECT COUNT(*) AS correct_count 
                                          FROM user_answers 
                                          JOIN choices ON user_answers.selected_choice_id = choices.id 
                                          WHERE user_answers.question_id = ? AND choices.is_correct = 1";
                    $correct_count_stmt = $conn->prepare($correct_count_sql);
                    if (!$correct_count_stmt) {
                        die("Prepare failed for correct_count: (" . $conn->errno . ") " . $conn->error);
                    }
                    $correct_count_stmt->bind_param("i", $question_id);
                    if (!$correct_count_stmt->execute()) {
                        die("Execute failed for correct_count: (" . $correct_count_stmt->errno . ") " . $correct_count_stmt->error);
                    }
                    $correct_count_stmt->bind_result($correct_count);
                    $correct_count_stmt->fetch(); // Fetch the count
                    $correct_count_stmt->close(); // Close the correct count statement

                    // Store the correct count in the array
                    $correct_counts[$question_number] = $correct_count;
                }

                $questions_stmt->close(); // Close the questions statement

                // Display the correct counts in the table
                $item_number = 1; // Initialize item number counter
                foreach ($correct_counts as $question_number => $correct_count) {
                    echo "<tr>
                            <td>" . htmlspecialchars($item_number) . "</td>
                            <td>" . htmlspecialchars($correct_count) . "</td>
                          </tr>";
                    $item_number++; // Increment for the next question
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #999;">No submissions found for this exam.</p>
    <?php endif; ?>

    <?php 
    $stmt->close(); 
    $conn->close(); 
    ?>
</body>
</html>
