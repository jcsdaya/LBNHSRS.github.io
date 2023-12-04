<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Storage Homepage</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

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

    .bookmark-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
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
                <a class="nav-link" href="#">Home</a>
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
                    <option value="pdf">PDF</option>
                    <option value="doc">DOC</option>
                    <option value="txt">TXT</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </form>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "file_storage";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT file_id, file_name, file_type FROM files";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fileId = $row['file_id'];
                $fileName = $row['file_name'];
                $fileType = $row['file_type'];

                // Display a card with both "View Details" and "Bookmark" buttons
                echo "<div class='card mb-4'>
                        <div class='card-body'>
                            <h5 class='card-title'>$fileName</h5>
                            <p class='card-text'>File Type: $fileType</p>
                            <a class='btn btn-secondary btn-block btn-link' href='view.php?id=$fileId'>View Details</a>
                            <a class='btn btn-info btn-block btn-bookmark' data-file-id ='$fileId' id='bookmarkButton'>Bookmark</a>
                        </div>
                      </div>";
            }
        } else {
            echo "<p class='alert alert-warning'>No files found.</p>";
        }
        include 'citationcatch.php';
        $conn->close();
        
        ?>
    </div>
    

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
       var bookmarkButtons = document.querySelectorAll('.btn-bookmark');

        bookmarkButtons.forEach(function(button) {
            button.addEventListener("click", function () {
                var fileId = this.getAttribute('data-file-id');
                
                // Create and send an AJAX request
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response if needed
                        console.log(xhr.responseText);
                    }
                };

                var bookmarkUrl = "insert.php?fileId=" + fileId;
                xhr.open("GET", bookmarkUrl, true);
                xhr.send();
            });
        });
        // Add an event listener to the bookmark button
        function filterFiles() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var filterSelect = document.getElementById('filterSelect').value.toLowerCase();

            var cards = document.querySelectorAll('.card');

            cards.forEach(function (card) {
                var title = card.querySelector('.card-title').textContent.toLowerCase();
                var fileType = card.querySelector('.card-text').textContent.toLowerCase();

                if ((title.includes(searchInput) || fileType.includes(searchInput)) && (filterSelect === 'all' || fileType.includes(filterSelect))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>
