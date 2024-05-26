<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href = "php\userdata.php">userdata</a>

    <?php 
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
        
        // Create database
        // $sql = "CREATE DATABASE user_bank";
        // if (mysqli_query($conn, $sql)) {
        //   echo "Database created successfully";
        // } else {
        //   echo "Error creating database: " . mysqli_error($conn);
        // }
        
        // sql to create table  
        // $sql = "CREATE TABLE user_info (
        // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // Bild VARCHAR(30) NOT NULL,
        // Namn VARCHAR(30) NOT NULL,
        // Bankkonto Int(50),
        // Saldo INT(50),
        // reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        // )";
        // if ($conn->query($sql) === TRUE) {
        // echo "Table user_info created successfully";
        // } else {
        // echo "Error creating table: " . $conn->error;
        // }

        // Getting data from Database
        $sql = "SELECT * FROM user_info";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Namn: " . $row["Namn"]. "  " . $row["lastname"]. "<br>";
            }
        } 
        
        else {
            echo "0 results";
        }

        mysqli_close($conn);


    ?>
</body>
</html>