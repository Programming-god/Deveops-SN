<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success Page</title>
    <!-- Your CSS and other code here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
<?php include 'header.php'; ?>

    <div class="container">
        <h1>Success Page</h1>

        <?php
        echo "<h2>Marksheet</h2>";
        echo "<h3>Name: " . $_SESSION['name'] . "</h3>";
        echo "<table>";
        echo "<tr><th>Subject</th><th>Credit</th><th>Grade</th></tr>";
        for ($i = 0; $i < count($subjects); $i++) {
            echo "<tr>";
            echo "<td>" . $subjects[$i] . "</td>";
            echo "<td>" . $credits[$i] . "</td>";
            echo "<td>" . $grades[$i] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h3>CGPA: " . number_format($cgpa, 2) . "</h3>";
        ?>

        <a href="examform.php">Go Back</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
