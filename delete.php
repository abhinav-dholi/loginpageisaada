<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
    <style>
         body {
    --color-primary: #f3a44a;
    --color-primary-dark: #804d00;
    --color-secondary: #d86732;
    --color-error: #cc3333;
    --color-success: #f77700;
    --color-bg: #f5d4a3;
    --border-radius: 4px;

    margin: 0;
    height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    background: var(--color-bg);
    background-size: cover;
}    
        .container {
    /* margin-top: 3rem;         */
    width: 700px;
    max-width: 1000px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #ffffff;
    text-align: center;
}

.container
 {
    margin-top: 15rem;
    font: 500 1rem 'Quicksand', sans-serif;
}
.connection{
    text-align: center;
}
.container {
    font: 500 1rem 'Quicksand', sans-serif;
}
.datastored{
    text-align: center;
}
#linktologin{
    text-decoration: none;
    border: solid 2px red;
    border-radius: 30px;
    margin: 2px;
    padding: 9px;
    display: inline-block;
    /* text-align: center; */
    background: var(--color-primary);
    color: white;
}
    </style>
</head>
<body>
    <div class="container">

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
        die("<h3 class='connection'>Connection Failed. :( </h3><br>". mysqli_connect_error());
    }
    else{
        echo "<h3 class='connection'>Connection successful! </h3> <br>";
    }
    
    $username = $_REQUEST['username'];
    $pass = $_REQUEST['pass'];
    // echo "$username";
    // echo "$pass";
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
    
    $sql = "SELECT username, password FROM login where username = '$encryption_usrname'";
    $result = $conn->query($sql);
    
    $row = $result->fetch_assoc();
    
    if($row["password"] == $encryption_pass)
    {
        $sql = "delete from login where username = '$encryption_usrname' ";
        
        if(mysqli_query($conn, $sql)){
            echo "<h3 class = 'datastored'>Profile Deleted Successfully!</h3>"; 
            
            
        } else{
            echo "<h3 class = 'datastored'>ERROR: Hush! Sorry $sql.</h3> " 
            . mysqli_error($conn);
        }
    }
    else
    {
        echo"Enter the correct password!";
    }    
    ?>
     <a href="index.php" id = 'linktologin'>Go back to the Main form</a>
    </div>
</body>
</html>