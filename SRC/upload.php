<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>File Storage Homepage</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

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
            color: black; /* Change this to your desired color */
            text-decoration: none;
            transition: color 0.3s;
        }

        .btn-link:hover {
            color: black; /* Change this to your desired hover color */
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
<body>

</head>
<body>

    <header>
        <h1><img src="../assets/logo.png" alt="Logo">Lawang Bato Research Archive</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Add your navigation links here -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="tc_homepage.html">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Upload</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
    </nav>

   <div class="container">
        <!-- Search and Filter Form -->
        <form class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="searchInput" class="sr-only">Search</label>
                <input type="text" class="form-control" id="searchInput" placeholder="Search" oninput="filterFiles()">
            </div>
            <div class="form-group mr-2">
                <label for="filterSelect" class="sr-only">Filter</label>
                <select class="form-control" id="filterSelect" onchange="filterFiles()">
                    <option value="all">All</option>
                    <option value="pdf">GAS 1</option>
                    <option value="doc">GAS 2</option>
                    <option value="txt">ABM 1</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </form>
    </div>

    <form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="container text-center">
        <div class="row">
          <div class="col">
            <div class="container text-left">
                <div class="row">
                  <div class="col">
                    <h4>Title:</h4>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="floatingInput" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Research Title</label>
                      </div>
                    <h4>Authors:</h4>
                    <!-- Example structure for author inputs -->
                    <div class="input-group" style="padding-bottom: 20px;">
                        <span class="input-group-text">Author 1</span>
                        <input type="text" name="author_name[0][surname]" aria-label="Surname 1" placeholder="Surname" class="form-control">
                        <input type="text" name="author_name[0][given_name]" aria-label="Given Name 1" placeholder="Given Name" class="form-control">
                        <input type="text" name="author_name[0][middle_name]" aria-label="Middle Name 1" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="input-group" style="padding-bottom: 20px;">
                        <span class="input-group-text">Author 2</span>
                        <input type="text" name="author_name[1][surname]" aria-label="Surname 2" placeholder="Surname" class="form-control">
                        <input type="text" name="author_name[1][given_name]" aria-label="Given Name 2" placeholder="Given Name" class="form-control">
                        <input type="text" name="author_name[1][middle_name]" aria-label="Middle Name 2" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="input-group" style="padding-bottom: 20px;">
                        <span class="input-group-text">Author 3</span>
                        <input type="text" name="author_name[2][surname]" aria-label="Surname 3" placeholder="Surname" class="form-control">
                        <input type="text" name="author_name[2][given_name]" aria-label="Given Name 3" placeholder="Given Name" class="form-control">
                        <input type="text" name="author_name[2][middle_name]" aria-label="Middle Name 3" placeholder="Last Name" class="form-control">
                    </div>
            
                   
                    <h3>Date Finished:</h3>
                    <form>
                        <div class="form-group">
                            <input type="date" class="form-control" id="nativeDate" name="nativeDate" >
                        </div>
                    </form>
                   
                    <h3>File:</h3>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control" id="inputGroupFile01" name="inputGroupFile01"> <!-- Added name attribute -->
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 1100px;">Submit</button>
                    
                    
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['floatingInput']; // Assuming this is the research title input
    $dateFinished = $_POST['nativeDate'];

    // Handle file upload
    $file = $_FILES['inputGroupFile01'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];

    // Check if file was uploaded successfully
    if ($fileTmpName != "") {
        // Read file content
        $fileContent = file_get_contents($fileTmpName);
    } else {
        echo "Error: File not uploaded or empty.";
        exit();
    }

    // Database connection details
    $servername = "localhost"; // Change as per your server
    $username = "root"; // Change as per your MySQL username
    $password = ""; // Change as per your MySQL password
    $dbname = "file_storage"; // Change as per your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement to insert file data into the database
    $stmtFile = $conn->prepare("INSERT INTO files (file_name, file_type, file_content, title) VALUES (?, ?, ?, ?)");
    $stmtFile->bind_param("ssss", $fileName, $fileType, $fileContent, $title);


    if ($stmtFile->execute()) {
        // File upload destination directory
        $destination = 'uploads/' . $fileName;
    
        // Move uploaded file to desired location
        if (move_uploaded_file($fileTmpName, $destination)) {
            echo "File uploaded successfully and data inserted into the database.";
    
            // Get the last inserted file_id from the files table
            $fileId = $stmtFile->insert_id; // Get the last inserted file_id
    
            // Prepare and bind SQL statement to insert date and file_id into datetb table
            $stmtDate = $conn->prepare("INSERT INTO datetb (date_value, file_id) VALUES (?, ?)");
            $stmtDate->bind_param("si", $dateFinished, $fileId); // Assuming 'fileId' is the ID of the file just inserted
            $stmtDate->execute();
    
            // Handle authors...
            // (Author handling logic remains unchanged)
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "Error: " . $stmtFile->error;
        exit();
    }

    // Handle authors
    $authorNames = isset($_POST['author_name']) ? $_POST['author_name'] : null;

    if (!empty($authorNames)) {
        foreach ($authorNames as $author) {
            $surname = $author['surname'];
            $givenName = $author['given_name'];
            $middleName = $author['middle_name'];

            // Insert author data into your author table
            $stmtAuthor = $conn->prepare("INSERT INTO authors (author_name) VALUES (?)");
            $fullName = $surname . ', ' . $givenName . ', ' . $middleName;
            $stmtAuthor->bind_param("s", $fullName);
            $stmtAuthor->execute();

            $authorId = $conn->insert_id; // Get the last inserted author_id

            // Get the last inserted file_id from the files table
            $fileIdQuery = "SELECT MAX(id) AS max_id FROM files"; // Adjust query based on your table structure
            $result = $conn->query($fileIdQuery);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fileId = $row['max_id']; // Get the last inserted file_id
            } else {
                echo "No file ID found.";
                exit();
            }

            // Insert into file_authors table
            $fileAuthorsQuery = "INSERT INTO file_authors (file_id, author_id) VALUES ('$fileId', '$authorId')";

            if ($conn->query($fileAuthorsQuery) === TRUE) {
                echo "Author linked to file successfully.";
            } else {
                echo "Error linking author to file: " . $conn->error;
                exit();
            }
        }
    } else {
        echo "No authors provided.";
        exit();
    }

    $stmtFile->close();
    $conn->close();
}
?>



</body>
</html>
