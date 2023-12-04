<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarked Files</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom styles -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            background: linear-gradient(to top, rgba(74, 128, 210, 0), #4A80D2);
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header img {
            margin-right: 10px;
            width: 60px;
            height: 60px;
        }

        .container {
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .btn-link {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .btn-link:hover {
            color: #0056b3;
        }

        .form-inline {
            justify-content: center;
        }
        
        .bookmark-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>


<header>
        <h1><img src="../assets/logo.png" alt="Logo">Lawang Bato Research Archive</h1>
    </header>

    <div class="container">
        <?php
        // Include your database connection code here
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "file_storage";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Handle the bookmarking action
        if (
            isset($_POST['action']) && 
            $_POST['action'] == 'bookmark' && 
            isset($_POST['file_id']) && 
            isset($_SESSION['user_id'])
        ) {
            $bookmarkFileId = $_POST['file_id'];
            $userId = $_SESSION['user_id'];
        
            // Retrieve file information
            $getFileSql = "SELECT file_name, file_type FROM files WHERE id = $bookmarkFileId";
            $fileResult = $conn->query($getFileSql);
        
            if ($fileResult->num_rows > 0) {
                $fileRow = $fileResult->fetch_assoc();
                $file_name = $fileRow['file_name'];
                $file_type = $fileRow['file_type'];
        
                // Insert the bookmark into the bookmarks table
                $insertBookmarkSql = "INSERT INTO bookmarks (user_id, file_id, file_name, file_type) VALUES ('$userId', '$bookmarkFileId', '$file_name', '$file_type')";
                $conn->query($insertBookmarkSql);
                
                echo "Bookmark added successfully!";
            } else {
                echo "File not found!";
            }
        } else {
            echo "Invalid bookmark request!";
        }
        
        // Display bookmarked files
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        
            // Retrieve bookmarked files for the current user
            $getBookmarksSql = "SELECT files.file_name, files.file_type FROM bookmarks
                                JOIN files ON bookmarks.file_id = files.id
                                WHERE bookmarks.user_id = '$userId'";
        
            $result = $conn->query($getBookmarksSql);
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fileName = $row['file_name'];
                    $fileType = $row['file_type'];
        
                    // Display a card with bookmarked file details
                    echo "<div class='card mb-4'>
                            <div class='card-body'>
                                <h5 class='card-title'>$fileName</h5>
                                <p class='card-text'>File Type: $fileType</p>
                            </div>
                          </div>";
                }
            } else {
                echo "<p class='alert alert-warning'>No bookmarked files found.</p>";
            }
        } else {
            echo "User not authenticated";
        }
        
        // Close the database connection
        $conn->close();
        ?>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
