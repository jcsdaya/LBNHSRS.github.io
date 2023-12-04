<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Storage Homepage</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        color: black;
        /* Change this to your desired color */
        text-decoration: none;
        transition: color 0.3s;
    }

    .btn-link:hover {
        color: black;
        /* Change this to your desired hover color */
    }

    .form-inline {
        justify-content: center;
    }

    .fixed-bottom-right {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .generated-button {
        margin-bottom: 5px;
    }

    .generated-buttons-container {
        position: fixed;
        bottom: 70px; /* Adjust this value based on your layout */
        right: 20px;
        display: none;
    }
    #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        #citationContainer {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
</style>

<body>

    <header>
        <h1><img src="../assets/logo.png" alt="Logo">Lawang Bato Research Archive</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Add your navigation links here -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book_process.php">Bookmark</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
    </nav>


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
            $sql = "SELECT file_name, file_type, file_content FROM files WHERE file_id = $fileId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fileName = $row['file_name'];
                $fileType = $row['file_type'];
                $fileContent = $row['file_content'];
            
                // Display file preview based on file type
                if (strpos($fileType, 'image') !== false) {
                    // Display image preview
                    echo "<img src='data:$fileType;base64," . base64_encode($fileContent) . "' alt='$fileName'>";
                } elseif ($fileType === 'application/pdf') {
                    // Display PDF preview using an embed tag with Bootstrap alignment classes
                    echo "<div class='d-flex justify-content-center'>
                            <embed src='data:$fileType;base64," . base64_encode($fileContent) . "' type='$fileType' width='80%' height='900px'>
                          </div>";
                } else {
                    echo "Unsupported file type for preview.";
                }
            } else {
                echo "File not found.";
            }
            
        }
        $conn->close();
        ?>
    </div>
    <div class="fixed-bottom-right">

    <button id="generateCitationButton">Generate Citation</button>

    <!-- Overlay container -->
    <div id="overlay">
        <!-- Citation container -->
        <div id="citationContainer"></div>
    </div>

    <script>

jQuery(document).ready(function () {
    jQuery('#generateCitationButton').click(function () {
        generateAPACitation();
    });

    jQuery('#overlay').click(function (event) {
        if (event.target.id === 'overlay') {
            jQuery('#overlay').hide();
        }
    });
});

function generateAPACitation($fileId) {
    jQuery.ajax({
        url: 'citationcatch.php?',
        type: 'GET',
        success: function (data) {
            jQuery('#overlay').show();
            jQuery('#citationContainer').html(data);
        },
        error: function () {
            alert('Error generating citation.');
        }
    });
}

        // Close the overlay when clicking outside the citation container
        $('#overlay').click(function (event) {
            if (event.target.id === 'overlay') {
                $('#overlay').hide();
            }
        });
    </script>
    </div>
 
    <!-- Bootstrap JS (optional) -->
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- ... (existing HTML code) ... -->

</body>
    <!-- Bootstrap JS (optional) -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>


