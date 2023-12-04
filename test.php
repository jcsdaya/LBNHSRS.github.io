<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"];
} else {
    // File information
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_content = file_get_contents($_FILES["file"]["tmp_name"]);

    // Insert file information into the database
    $stmt = $conn->prepare("INSERT INTO files (file_name, file_type, file_content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $file_name, $file_type, $file_content);

    if ($stmt->execute()) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>