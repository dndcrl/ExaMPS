<?php
include 'db.php';

$exam_id = 0;
$exam_name = '';
$questions_data = [];

// Check if exam ID is provided
if (isset($_POST['exam_id'])) {
    $exam_id = intval($_POST['exam_id']);
    $stmt = $conn->prepare("SELECT exam_name FROM exams WHERE id = ?");
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();
    $stmt->bind_result($exam_name);
    $stmt->fetch();
    $stmt->close();

    $questions_result = $conn->query("SELECT * FROM questions WHERE exam_id = $exam_id");
    while ($question = $questions_result->fetch_assoc()) {
        $question_id = $question['id'];
        $choices_result = $conn->query("SELECT * FROM choices WHERE question_id = $question_id");
        $choices_data = $choices_result->fetch_all(MYSQLI_ASSOC);
        $questions_data[] = [
            'id' => $question_id,
            'question_text' => $question['question_text'],
            'choices' => $choices_data
        ];
    }
} else {
    echo "No exam ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Exam</title>
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

        .question-container {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .choice-container {
            margin: 10px 0;
        }

        .choice-label {
            font-weight: bold;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Exam: <?php echo htmlspecialchars($exam_name); ?></h1>
        
        <form method="post" action="submit_exam.php">
            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">

            <?php foreach ($questions_data as $index => $question): ?>
                <div class="question-container">
                    <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                    <?php foreach ($question['choices'] as $key => $choice): ?>
                        <div class="choice-container">
                            <input type="radio" id="choice_<?php echo $index; ?>_<?php echo $key; ?>" name="questions[<?php echo $index; ?>][choice]" value="<?php echo $choice['id']; ?>">
                            <label for="choice_<?php echo $index; ?>_<?php echo $key; ?>" class="choice-label"><?php echo chr(65 + $key); ?>: <?php echo htmlspecialchars($choice['choice_text']); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit">Submit Exam</button>
        </form>
    </div>
</body>
</html>
