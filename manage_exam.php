<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user_id'];

include 'db.php';

// Initialize variables
$exam_name = '';
$exam_id = '';
$success_message = '';

// Function to generate a unique 6-digit ID
function generateUniqueExamId($conn) {
    do {
        $exam_id = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Generate a 6-digit number
        $stmt = $conn->prepare("SELECT COUNT(*) FROM exams WHERE id = ?");
        $stmt->bind_param("s", $exam_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0); // Regenerate if ID already exists

    return $exam_id;
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_name = $_POST['exam_name'];
    $exam_id = isset($_POST['exam_id']) ? $_POST['exam_id'] : '';

    // Retrieve user ID from session
    $user_id = $_SESSION['user_id'];

    if (empty($exam_id)) {
        // Generate new exam ID
        $exam_id = generateUniqueExamId($conn);
    
        // Insert new exam with user ID
        $stmt = $conn->prepare("INSERT INTO exams (exam_id, exam_name, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $exam_id, $exam_name, $user_id);
        if (!$stmt->execute()) {
            die('Insert failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        $success_message = "Exam saved successfully! Exam ID: " . htmlspecialchars($exam_id);
    } else {
        // Update existing exam
        $stmt = $conn->prepare("UPDATE exams SET exam_name = ? WHERE exam_id = ?");
        $stmt->bind_param("ss", $exam_name, $exam_id);
        if (!$stmt->execute()) {
            die('Update failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        $success_message = "Exam updated successfully! Exam ID: " . htmlspecialchars($exam_id);
    }
    

    // Handle questions
    $questions = isset($_POST['questions']) ? $_POST['questions'] : [];

    foreach ($questions as $question) {
        $question_id = isset($question['id']) ? intval($question['id']) : 0;
        $question_text = $question['question_text'];

        if ($question_id == 0) {
            // Insert new question
            $stmt = $conn->prepare("INSERT INTO questions (question_text, exam_id) VALUES (?, ?)");
            $stmt->bind_param("ss", $question_text, $exam_id);
            $stmt->execute();
            $question_id = $stmt->insert_id;
            $stmt->close();
        } else {
            // Update existing question
            $stmt = $conn->prepare("UPDATE questions SET question_text = ? WHERE id = ?");
            $stmt->bind_param("si", $question_text, $question_id);
            $stmt->execute();
            $stmt->close();
        }

        // Handle choices
        $choices = $question['choices'] ?? [];
        foreach ($choices as $key => $choice) {
            $choice_id = isset($choice['id']) ? intval($choice['id']) : 0;
            $choice_text = $choice['choice_text'];
            $is_correct = isset($choice['is_correct']) ? 1 : 0;

            if ($choice_id == 0) {
                // Insert new choice
                $stmt = $conn->prepare("INSERT INTO choices (question_id, choice_text, is_correct) VALUES (?, ?, ?)");
                $stmt->bind_param("isi", $question_id, $choice_text, $is_correct);
                $stmt->execute();
                $choice_id = $stmt->insert_id;
                $stmt->close();
            } else {
                // Update existing choice
                $stmt = $conn->prepare("UPDATE choices SET choice_text = ?, is_correct = ? WHERE id = ?");
                $stmt->bind_param("sii", $choice_text, $is_correct, $choice_id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}

// Handle editing
if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];
    $stmt = $conn->prepare("SELECT exam_name FROM exams WHERE id = ?");
    $stmt->bind_param("s", $exam_id);
    $stmt->execute();
    $stmt->bind_result($exam_name);
    $stmt->fetch();
    $stmt->close();

    $questions_data = [];
    $questions_result = $conn->query("SELECT * FROM questions WHERE exam_id = '$exam_id'");
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
    $questions_data = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Exam</title>
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

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="hidden"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
            padding: 10px;
            background: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .choice-label {
            width: 20px;
            font-weight: bold;
            margin-right: 10px;
        }

        .remove-question-button, .add-question-button, .add-choice-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px;
        }

        .remove-question-button {
            background-color: #dc3545;
        }  

        .remove-question-button:hover, .add-question-button:hover, .add-choice-button:hover {
            opacity: 0.8;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create & Manage Exam</h1>

        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <!-- Go Back Button -->
        <a href="dashboard.php" class="back-button">Go Back to Dashboard</a>

        <form method="post" action="">
            <label for="exam_name">Exam Name:</label>
            <input type="text" id="exam_name" name="exam_name" value="<?php echo htmlspecialchars($exam_name); ?>" required>

            <input type="hidden" id="exam_id" name="exam_id" value="<?php echo htmlspecialchars($exam_id); ?>">

            <div id="questions-container">
                <?php foreach ($questions_data as $index => $question): ?>
                    <div class="question-container" data-index="<?php echo $index; ?>">
                        <label for="question_text_<?php echo $index; ?>">Question:</label>
                        <input type="text" id="question_text_<?php echo $index; ?>" name="questions[<?php echo $index; ?>][question_text]" value="<?php echo htmlspecialchars($question['question_text']); ?>" required>
                        <input type="hidden" name="questions[<?php echo $index; ?>][id]" value="<?php echo $question['id']; ?>">

                        <div class="choices-container" id="choices-container_<?php echo $index; ?>">
                            <?php foreach ($question['choices'] as $key => $choice): ?>
                                <div class="choice-container">
                                    <span class="choice-label"><?php echo chr(65 + $key); ?>:</span>
                                    <input type="text" name="questions[<?php echo $index; ?>][choices][<?php echo $key; ?>][choice_text]" value="<?php echo htmlspecialchars($choice['choice_text']); ?>">
                                    <input type="checkbox" name="questions[<?php echo $index; ?>][choices][<?php echo $key; ?>][is_correct]" <?php echo $choice['is_correct'] ? 'checked' : ''; ?>> Correct
                                    <input type="hidden" name="questions[<?php echo $index; ?>][choices][<?php echo $key; ?>][id]" value="<?php echo $choice['id']; ?>">
                                    <button type="button" class="remove-choice-button" onclick="removeChoice(this)">Remove Choice</button>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="add-choice-button" onclick="addChoice(<?php echo $index; ?>)">Add Choice</button>
                        <button type="button" class="remove-question-button" onclick="removeQuestion(this)">Remove Question</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="add-question-button" onclick="addQuestion()">Add Question</button>
            <button type="submit">Save Exam</button>
        </form>
    </div>

    <script>
    // JavaScript functions for adding and removing questions and choices
    function addQuestion() {
        const container = document.getElementById('questions-container');
        const index = container.children.length;
        const questionHtml = `
            <div class="question-container" data-index="${index}">
                <label for="question_text_${index}">Question:</label>
                <input type="text" id="question_text_${index}" name="questions[${index}][question_text]" required>
                <input type="hidden" name="questions[${index}][id]" value="">

                <div class="choices-container" id="choices-container_${index}">
                    <div class="choice-container">
                        <span class="choice-label">A:</span>
                        <input type="text" name="questions[${index}][choices][0][choice_text]">
                        <input type="checkbox" name="questions[${index}][choices][0][is_correct]"> Correct
                        <input type="hidden" name="questions[${index}][choices][0][id]" value="">
                    </div>
                </div>

                <button type="button" class="add-choice-button" onclick="addChoice(${index})">Add Choice</button>
                <button type="button" class="remove-question-button" onclick="removeQuestion(this)">Remove Question</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', questionHtml);
    }

    function removeQuestion(button) {
        button.parentElement.remove();
    }

    function addChoice(questionIndex) {
        const container = document.getElementById(`choices-container_${questionIndex}`);
        const choiceIndex = container.children.length;
        const choiceHtml = `
            <div class="choice-container">
                <span class="choice-label">${String.fromCharCode(65 + choiceIndex)}:</span>
                <input type="text" name="questions[${questionIndex}][choices][${choiceIndex}][choice_text]">
                <input type="checkbox" name="questions[${questionIndex}][choices][${choiceIndex}][is_correct]"> Correct
                <input type="hidden" name="questions[${questionIndex}][choices][${choiceIndex}][id]" value="">
                <button type="button" class="remove-choice-button" onclick="removeChoice(this)">Remove Choice</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', choiceHtml);
    }

    function removeChoice(button) {
        button.parentElement.remove();
    }
    </script>
</body>
</html>
