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

    // Redirect to the confirmation.php page
    header("Location: confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        nav {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        main {
            max-width: 800px;
            margin: 0 auto; /* Center horizontally */
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        
            align-items: center; /* Center vertically */
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select, input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
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
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        @media screen and (max-width: 600px) {
            select, input, button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Exam Form</h1>
        <h1> hi</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="examform.php">Exam Form</a>
    </nav>
    <main>
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
</body>
</html>
