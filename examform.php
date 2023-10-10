<?php
session_start();

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $semester = $_POST['semester'];

    // Initialize an empty array to store subject data
    $subject_data = array();
    $subject_names = array(); // Array to store subject names

    // Loop through the submitted subject details
    if (
        isset($_POST['subject_name']) &&
        isset($_POST['subject_credit']) &&
        isset($_POST['subject_grade'])
    ) {
        $subject_names = $_POST['subject_name'];
        $subject_credits = $_POST['subject_credit'];
        $subject_grades = $_POST['subject_grade'];

        // Ensure that all arrays have the same length
        $num_subjects = count($subject_names);

        for ($i = 0; $i < $num_subjects; $i++) {
            // Create an associative array for each subject
            $subject_data[] = array(
                'name' => $subject_names[$i],
                'credit' => $subject_credits[$i],
                'grade' => $subject_grades[$i]
            );
        }
    }

    // Store the subject data and subject names in the session
    $_SESSION['subject_data'] = $subject_data;
    $_SESSION['subject_names'] = $subject_names; // Store subject names

    // Store the semester data in the session
    $_SESSION['semester'] = $semester;

    // Redirect to the reval.php page
    header("Location: confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Form</title>
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

        button {
            margin-top: 10px;
        }
    </style>

    <script>
    function createSubjectTable() {
        var semester = document.getElementById("semester").value;
        var numSubjects = parseInt(prompt("Enter the number of subjects for Semester " + semester));

        if (isNaN(numSubjects) || numSubjects <= 0) {
            alert("Please enter a valid number of subjects.");
            return;
        }

        var subjectTable = document.createElement("table");
        subjectTable.setAttribute("id", "subject_table");
        subjectTable.innerHTML = `
            <tr>
                <th>Subject Name</th>
                <th>Credit</th>
                <th>Grade</th>
            </tr>
        `;

        for (var i = 0; i < numSubjects; i++) {
            var row = document.createElement("tr");
            row.innerHTML = `
                <td><input type="text" name="subject_name[]" placeholder="Subject Name"></td>
                <td><input type="number" name="subject_credit[]" placeholder="Credit"></td>
                <td>
                    <select name="subject_grade[]">
                        <option value="O">O</option>
                        <option value="A+">A+</option>
                        <option value="A">A</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="P">P</option>
                        <option value="F">F</option>
                    </select>
                </td>
            `;
            subjectTable.appendChild(row);
        }

        var existingTable = document.getElementById("subject_table");
        if (existingTable) {
            existingTable.parentNode.replaceChild(subjectTable, existingTable);
        } else {
            document.getElementById("form").appendChild(subjectTable);
        }
    }
    </script>
</head>
<body>
<?php include 'header.php'; ?>
<nav>
    <a href="index.php">Home</a>
    <a href="examform.php">Exam Form</a>
</nav>
<main>
    <h1>Exam Form</h1>
    <a style="color:red" href="index.php">Logout</a>
    <form method="POST" action="" id="form">
        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
            <option value="">Select Semester</option>
            <?php
            // Generate semester options dynamically
            for ($i = 1; $i <= 8; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <button type="button" onclick="createSubjectTable()">Create Table</button>
        <br><br>
        <button type="submit">Submit</button>
    </form>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
