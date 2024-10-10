
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include 'db.php';

$exam_id = $_GET['exam_id']; 

$sql = "SELECT exam_submissions.id AS submission_id, exam_submissions.name, exam_submissions.submission_time, exams.exam_name 
        FROM exam_submissions 
        JOIN exams ON exam_submissions.exam_id = exams.id
        WHERE exams.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
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

        a {
            color: #28a745;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .view-mps {
            margin-top: 20px;
            text-align: center;
        }

        .view-mps a {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .view-mps a:hover {
            background-color: #218838;
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
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><a href='view_score.php?submission_id=<?php echo $row['submission_id']; ?>'><?php echo htmlspecialchars($row['name']); ?></a></td>
                        <td><?php echo htmlspecialchars($row['exam_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['submission_time']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

  
        <div class="view-mps">
         <a href="view_mps.php?exam_id=<?php echo $exam_id; ?>">View MPS</a>
        </div>


    <?php else: ?>
        <p style="text-align: center; color: #999;">No submissions found.</p>
    <?php endif; ?>

    <?php $stmt->close(); ?>
    <?php $conn->close(); ?>
</body>
</html>
