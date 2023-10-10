<?php
session_start();

if (isset($_SESSION['username'])) {
    // Logout functionality
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // Retrieve the subject names entered by the user from the session
    $subjectNames = $_SESSION['subject_names'];

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedCourses = $_POST['courses'];

        // Validate the selected courses
        if (!empty($selectedCourses)) {
            // Calculate the total amount to be paid
            $registrationFee = 1000;
            $totalAmount = $registrationFee * count($selectedCourses);

            // Store the selected courses and total amount in the session
            $_SESSION['selected_courses'] = $selectedCourses;
            $_SESSION['total_amount'] = $totalAmount;

            // Redirect to the payment page
            header("Location: payment.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            background-image: url('img/study.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
    <style>
        a:link,
        a:visited {
            background-color: #b3aead;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        a:hover,
        a:active {
            background-color: red;
        }
    </style>
    <meta charset="UTF-8">
    <title>Re-Evaluation Form</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/0059d2346d.js" crossorigin="anonymous"></script>
</head>

<body>
    <a href="https://bmsce.ac.in/" target="_blank"><img src="img/header.png" alt="logo"></a>
    <div class="blue"><TT>EXAM RE-EVALUATION AND FAST-TRACK</TT></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="imgcontainer">
            <img src="img/student.svg" alt="Avatar" class="avatar">
        </div>
        <h1 style="color: white">Courses to be Re-Evaluated</h1>
        <p style="color: white">Select the courses</p>
        <label style="color: white" for="courses">Choose the courses</label>
        <select name="courses[]" id="courses" multiple required>
            <?php
            foreach ($subjectNames as $subjectName) {
                echo "<option value=\"$subjectName\">$subjectName</option>";
            }
            ?>
        </select>
        <br><br>
        <button type="submit">Submit</button>
        <h3 style="color: white">Subject Names</h3>
        <table>
            <thead>
                <tr>
                    <th>Subject Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($subjectNames as $subjectName) {
                    echo "<tr><td>$subjectName</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>

    <footer id="footer">
        <p class="about">B.M.S. College of Engineering (BMSCE) was Founded in the year 1946 by Late Sri. B. M.
            Sreenivasaiah a great visionary and philanthropist and nurtured by his illustrious son Late Sri. B. S.
            Narayan. BMSCE is the first private sector initiative in engineering education in India. BMSCE has completed
            70+ years of dedicated service in the field of Engineering Education. <a href="https://bmsce.ac.in/home/About-BMSCE">Know More</a></p>
        <h3>Contact Us</h3>
        <ul class="contact-us">
            <li><strong>Address:</strong>
                <br /> P.O. Box No.: 1908, Bull Temple Road,
                <br /> Bangalore - 560 019
                <br />Karnataka, India.
            </li>
            <li><strong>Fax:</strong>
                <br />+91-80-26614357
            </li>
            <li><strong>Email:</strong>
                <br /><a href="mailto:mail@example.com">info@bmsce.ac.in</a>
            </li>
        </ul>

        <div class="Copyright">
            <p>&copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
