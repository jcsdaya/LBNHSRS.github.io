<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_storage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Your SQL query with JOIN to retrieve data from multiple tables
$sql = "SELECT files.file_id, files.file_name, files.file_type, files.file_path, files.file_content, files.title, authors.author_name, datetb.date_value
FROM files
JOIN file_authors ON files.file_id = file_authors.file_id
JOIN authors ON file_authors.author_id = authors.author_id
JOIN datetb ON files.file_id = datetb.file_id
WHERE file_id = $fileId";

$result = $conn->query($sql);

if (!$result) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
 
        $title = $row["title"];
        $author = $row["author_name"];
        $publicationDate = $row["date_value"];

        // Add each APA citation to the array
        $apaCitations[] = "$author. ($publicationDate). $title. APA Citation Example.";
    

    // Display or use the APA citations as needed
    foreach ($apaCitations as $apaCitation) {
        echo $apaCitation . '<br>';
    }
} else {
    echo "No results found";
}
$conn->close();

?>
