<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <title>Boostrap Login | Ludiflex</title>
</head>
<body>
    <header class="header">
        <h4>Research Archive</h4>
        <div class="logo">
        <img src="../assets/logo.png" alt="Logo" height="40px">

        </div>
        
        <nav class="navbar-left">
            <a href="#" class="nav-link">Bookmark</a>
            <a href="#" class="nav-link">History</a>
            <a href="#" class="nav-link">Settings</a>
            <a href="#" class="nav-link">Feedback</a>
            <a href="#" class="nav-link">About</a>
        </nav>
    </header>
    
    <?php
    $server = "localhost";
    $username = "root";
    $pass = "";
    $dbname ="research hub db";

    $conn = new mysqli ($server,$username,$pass,$dbname);

    $sql ="select * from tb_files where ID = 1 ";
    $result = $conn->query($sql);

    if ($conn->connect_error){
        die("Connection Failed:" . $conn->connect_error);}
        else {
            echo "Connected Successfully";
        }
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $filedata =$row["Document"];}
        }
            else {
                ECHO "0 results";}
                base64_encode($filedata);
                
          $decoded = base64_decode($filedata);
          echo $decoded; 
               // Set the content type to 'application/pdf'
header('Content-Type: application/pdf');

// Output the PDF content
echo $filedata;
        $conn->close();
      
        
       
        
     ?>
   
    <iframe src="" frameborder="0"></iframe>
</body>

</html>

<script src="homepage.js"></script>