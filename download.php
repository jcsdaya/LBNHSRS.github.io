<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Retrieve file metadata from the database
    $sql = "SELECT file_name, file_type, file_content FROM files WHERE id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fileName = $row['file_name'];
        $fileType = $row['file_type'];
        $fileContent = $row['file_content'];

        // Set appropriate headers for the file type
        header('Content-Type: application/pdf' . $fileType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Output the file content
        echo $fileContent;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
