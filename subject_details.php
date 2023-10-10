<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the selected semester from the session
$selectedSemester = $_SESSION['semester'] ?? null;

// Define subject data for each semester
$semesterSubjects = array(
    // Define subjects for other semesters as needed
    1 => array(
        "cla" => "3 credits",
        "chem" => "3 credits",
        "chem lab" => "1 credit",
        "bec" => "3 credits",
        "eme" => "3 credits",
        "psp" => "3 credits",
        "psp lab" => "1 credit",
        "sfh" => "1 credit",
        "eng" => "1 credit"
    )
);

// Check if the selected semester is Semester 1
if ($selectedSemester == 1) {
    // Display subject details for Semester 1
    echo "<h1>Subject Details for Semester 1</h1>";
    echo "<table>";
    echo "<tr><th>Subject Name</th><th>Credits</th><th>Grade</th></tr>";
    foreach ($semesterSubjects[1] as $subjectName => $subjectCredits) {
        echo "<tr><td>$subjectName</td><td>$subjectCredits</td><td></td></tr>";
    }
    echo "</table>";
} else {
    // Display a message for other semesters
    echo "<h1>No subject details available for the selected semester.</h1>";
}
?>
