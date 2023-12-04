<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $studentname = ($_POST['studentname']);
    $studentpass = ($_POST['studentpass']);


// Include your database connection file or define the connection details here
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "accdb";




// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);






// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo"success";
}

$sql = "SELECT * FROM student WHERE  studentname = '$studentname' AND  studentpass = '$studentpass'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        header("Location: home.php");
        exit();
    }
        else{
            header("Location: retry.php");
            exit();
        }
    }

     
    $conn->close();

?>
