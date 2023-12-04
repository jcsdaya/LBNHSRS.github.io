<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
</head>
<body>

<h2>List of Files</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, file_name, file_type FROM files";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $fileId = $row['id'];
        $fileName = $row['file_name'];
        $fileType = $row['file_type'];

        // Display a list item with a link to preview the file
        echo "<li><a href='preview.php?id=$fileId'>$fileName</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No files found.</p>";
}

$conn->close();
?>

</body>
</html>