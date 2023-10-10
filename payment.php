<?php
session_start();

if (isset($_SESSION['username'])) {
    // Logout functionality
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // Retrieve selected courses and total amount from the session
    $selectedCourses = $_SESSION['selected_courses'];
    $totalAmount = $_SESSION['total_amount'];

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
    <title>Payment</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/0059d2346d.js" crossorigin="anonymous"></script>
    <script>
        function showConfirmation() {
            var upiId = document.getElementById("cardNumber").value;
            if (upiId) {
                if (confirm("Request for payment has been sent to UPI ID: " + upiId + ". Proceed to Exam Form?")) {
                    window.location.href = "examform.php";
                }
            } else {
                alert("Please enter UPI ID to proceed with payment.");
            }
        }
    </script>
</head>

<body>
    <a href="https://bmsce.ac.in/" target="_blank"><img src="img/header.png" alt="logo"></a>
    <div class="blue"><TT>EXAM RE-EVALUATION AND FAST-TRACK</TT></div>
    <h1 style="color: white; text-align: center;">Payment Details</h1>
    <div style="color: white; text-align: center;">
        <h2>Selected Courses:</h2>
        <ul>
            <?php
            foreach ($selectedCourses as $course) {
                echo "<li>$course</li>";
            }
            ?>
        </ul>
        <h2>Total Amount to be Paid: &#8377;<?php echo $totalAmount; ?></h2>
        <br>
        <h2>Proceed with Payment:</h2>
        <form>
            <label for="cardNumber">UPI ID:</label>
            <input type="email" id="cardNumber" name="cardNumber" required><br><br>
            <button type="button" onclick="showConfirmation()">Pay Now</button>
        </form>
    </div>

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
