<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Report</title>
</head>
<body>

<?php
    // Get krne ka code neeche
    //    echo $_POST['pass'];
    //    echo "<br><br>";
    //    print_r($_POST); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "isaada";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn)
    {
        die("Connection Failed. :( <br>". mysqli_connect_error());
    }
    else{
        echo "Connection successful! <br>";
    }

    $username = $_REQUEST['username'];
    $pass = $_REQUEST['pass'];

    $ciphering = "AES-128-CTR";
  
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
  
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
  
    // Store the encryption key
    $encryption_key = "Abhinavislove";
  
    // Use openssl_encrypt() function to encrypt the data
    $encryption_usrname = openssl_encrypt($username, $ciphering,
            $encryption_key, $options, $encryption_iv);

    $encryption_pass = openssl_encrypt($pass, $ciphering,
            $encryption_key, $options, $encryption_iv);


    $sql = "INSERT INTO login values ('$encryption_usrname','$encryption_pass')";

    
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully.<h3>"; 
  
            
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        // mysqli_close($conn);

        $sql = "SELECT username, password FROM login";
        $result = $conn->query($sql);

        echo "<h1>Encrypted login credentials in backend</h1>";

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "username: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
            }
        } else {
            echo "0 results";
        }

        $decryption_iv = '1234567891011121';
  
        // Store the decryption key
        $decryption_key = "Abhinavislove";

        $sql = "SELECT username, password FROM login";
        $result = $conn->query($sql);
       
        echo "<h1>Decrypted login credentials as follows <br></h1>";

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "username: " . openssl_decrypt ($row["username"], $ciphering, 
                $decryption_key, $options, $decryption_iv). " - Password: " . openssl_decrypt ($row["password"], $ciphering, 
                $decryption_key, $options, $decryption_iv). "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();


    ?>
    <br><br><br>

    <a href="index.php">Go back to the form</a>


</body>
</html>
