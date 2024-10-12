<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include 'db.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$message = "";



// deletion of exam section
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_exam'])) {
    $exam_id = $_POST['exam_id'];

    $check_stmt = $conn->prepare("SELECT * FROM exams WHERE id = ? AND user_id = ?");
    $check_stmt->bind_param("ii", $exam_id, $user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {

        $stmt = $conn->prepare("DELETE FROM choices WHERE question_id IN (SELECT id FROM questions WHERE exam_id = ?)");
        $stmt->bind_param("i", $exam_id);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM questions WHERE exam_id = ?");
        $stmt->bind_param("i", $exam_id);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM exams WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $exam_id, $user_id);
        $stmt->execute();

        $message = $stmt->affected_rows > 0 ? "Exam deleted successfully." : "No exam was deleted. Please check if you have permission.";
    } else {
        $message = "Exam not found or you do not have permission to delete it.";
    }

    
}

// getting exams from users
$stmt = $conn->prepare("SELECT id, exam_name FROM exams WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$exams_result = $stmt->get_result();

$conn->close();
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
    background-color: #28a745;
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
    background: #ddd;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

h1, h2 {
    color: #000;
    margin-bottom: 20px;
}

.message {
    color: #28a745;
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

.actions {
    display: flex;
    align-items: center;
    gap: 5px; 
}

.button, .logout-button, .delete-button, .results-button {
    background-color: #28a745;
    color: #ddd;
    padding: 10px 15px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.5; 
}

.logout-button {
    background-color: #dc3545;
}

.delete-button {
    background-color: #dc3545;
    border: none;
}

.delete-button:hover {
    background-color: #c82333;
}

.results-button {
    text-decoration: none !important;
    color: #ddd !important;
    padding: 10px 15px;
    line-height: 1.5; 
}

.results-button:hover {
    background-color: #1c7a32;
}

</style>
</head>
<body>
    <div class="container">
        <h1>Hi, Welcome to Your Dashboard.</h1>
        
        <a href="manage_exam.php" class="button">Create New Exam</a>

        <div class="exam-list">
            <h2>Your Exams</h2>
            <?php if (!empty($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <ul>
                <?php while ($row = $exams_result->fetch_assoc()): ?>
                    <li>
                        <div>
                        <a href="manage_exam.php?exam_id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['exam_name']); ?></a>
                        </div>
                        <div class="actions">
                            <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete this exam? This cannot be undone.');">
                            <input type="hidden" name="exam_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_exam" class="delete-button">Delete</button>
                            </form>
                            <a href="results.php?exam_id=<?php echo urlencode($row['id']); ?>" class="results-button">Results</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>