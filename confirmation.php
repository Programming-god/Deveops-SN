<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the necessary session data is set
if (!isset($_SESSION['subject_data']) || !isset($_SESSION['semester'])) {
    header("Location: examform.php");
    exit;
}

// Calculate the CGPA
$totalCredits = 0;
$totalGradePoints = 0;

// Loop through the subject data and calculate the grade points
foreach ($_SESSION['subject_data'] as $subject) {
    $subjectCredit = $subject['credit'];
    $subjectGrade = $subject['grade'];

    $totalCredits += $subjectCredit;
    $gradePoint = getGradePoint($subjectGrade);
    $totalGradePoints += ($subjectCredit * $gradePoint);
}

// Calculate the CGPA
$cgpa = 0;
if ($totalCredits > 0) {
    $cgpa = $totalGradePoints / $totalCredits;
    $cgpa = round($cgpa, 2);
}

// Function to get the grade point based on the grade
function getGradePoint($grade)
{
    switch ($grade) {
        case "O":
            return 10;
        case "A+":
            return 9;
        case "A":
            return 8;
        case "B+":
            return 7;
        case "B":
            return 6;
        case "C":
            return 5;
        case "P":
            return 4;
        case "F":
            return 0;
        default:
            return 0;
    }
}

// Check if the "Apply for Revaluation" button is clicked
if (isset($_POST['reval'])) {
    // Redirect to reval.php
    header("Location: reval.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <nav>
        <!-- Add your navigation links here -->
        <a href="index.php">Home</a>
        <a href="examform.php">Exam Form</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
        <a style="color:red" href="logout.php">Logout</a>
        <h1>Confirmation Page</h1>
        <h2>Marksheet</h2>
        <table>
            <tr>
                <th>Subject Name</th>
                <th>Credit</th>
                <th>Grade</th>
            </tr>
            <?php
            // Loop through the subject data and display it
            foreach ($_SESSION['subject_data'] as $subject) {
                echo "<tr>";
                echo "<td>{$subject['name']}</td>";
                echo "<td>{$subject['credit']}</td>";
                echo "<td>{$subject['grade']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h2>CGPA: <?php echo $cgpa; ?></h2>
        <form method="POST" action="">
            <button type="submit" name="reval">Apply for Revaluation</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
