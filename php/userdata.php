<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href = "../index.php">Index</a>
<form action="#" method="post" enctype="multipart/form-data">
        Select image to upload:<br>
        <input type="file" placeholder="Bild" name="Bild">
        <input type="text" placeholder="Namn" name="Namn">
        <input type="text" placeholder="Bankkonto" name="Bankkonto">
        <input type="text" placeholder="Saldo" name="Saldo">
        <input type="submit" value="Save" name="Save">
    </form>
    
    <?php
        // For Database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user_bank";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // User info for DB-table
        if (isset($_POST["Save"]))
        {        
            $target_dir = "../Images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            // if($check !== false) {
            //     echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = 1;
            // } 
            // else {
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }

            
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";

            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
            }

            $name = $_POST["Namn"];
            $bank = $_POST["Bankkonto"];
            $saldo = $_POST["Saldo"];
            echo "$name, $bank, $saldo";
        
            $sql = "INSERT INTO user_info (Bild, Namn, Bankkonto, Saldo)
            VALUES ($target_file, $name, $bank, $saldo)";
            mysqli_query($conn, $sql);

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
    ?>
</body>
</html>