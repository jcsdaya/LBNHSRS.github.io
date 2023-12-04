<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO bookmark (id) VALUES (?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Error in preparing statement.";
    exit();
}

if (isset($_GET['fileId'])) {
    $fileId = $_GET['fileId'];

    $stmt->bind_param("i", $fileId);
    $stmt->execute();

    echo "Bookmark added successfully.";
} else {
    echo "No file ID provided.";
}

$stmt->close();
$conn->close();
?>
