<?php
$server = "gpa-calculator-main2-db-1";
$username = "root";
$password = "1234";
$database = "nithin";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}

?>