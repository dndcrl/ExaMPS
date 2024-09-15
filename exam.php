<!DOCTYPE html>
<html>
<head>
    <title>Enter Exam ID</title>

    <style>
        body {
            font-family: 'Segoe UI';
            text-align: center;
            margin-top: 15rem;
        }
    </style>
</head>
<body>
    <h1>Enter Exam ID</h1>
    <form method="post" action="take_exam.php">
        <label for="exam_id">Exam ID:</label>
        <input type="text" id="exam_id" name="exam_id" required>
        <button type="submit">Start Exam</button>
    </form>
</body>
</html>
