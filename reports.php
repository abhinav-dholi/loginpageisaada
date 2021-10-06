<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Report</title>
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

.tablesdiv{
    display: inline-block;
    align-items: center;
}

.tables{
    margin: 10px;
    padding: 5px;
    /* border: solid 2px black; */
    /* border-spacing: 0px; */

}
table,th, td {
		border: 3px solid black;
        border-spacing: 0px;
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
    
    
    
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    // Store the encryption key
    $encryption_key = "Abhinavislove";
    
    // Use openssl_encrypt() function to encrypt the data
    
    
    
    $sql = "SELECT username, password FROM login";
    $result = $conn->query($sql);
    
    echo "<h1>Encrypted login credentials in backend</h1>";

    echo "<div class = 'tablesdiv'>
            <table class = 'tables'>
            <tr>
                <th>Username</th>
                <th>Password</th>
            <tr>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><th>" . $row["username"]. "</th> <th>" . $row["password"]. "</th></tr>";
                }
            } else {
                echo "0 results";
            }
            echo "</table></div>";
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "username: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
    //     }
    // } else {
    //     echo "0 results";
    // }
    
    $decryption_iv = '1234567891011121';
    
    // Store the decryption key
    $decryption_key = "Abhinavislove";
    
    $sql = "SELECT username, password FROM login";
    $result = $conn->query($sql);
    
    echo "<h1>Decrypted login credentials as follows <br></h1>";
    
    // if ($result->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         echo "username: " . openssl_decrypt ($row["username"], $ciphering, 
    //         $decryption_key, $options, $decryption_iv). " - Password: " . openssl_decrypt ($row["password"], $ciphering, 
    //         $decryption_key, $options, $decryption_iv). "<br>";
    //     }
    // } else {
    //     echo "0 results";
    // }
    echo "<div class = 'tablesdiv'>
    <table class = 'tables'>
    <tr>
        <th>Username</th>
        <th>Password</th>
    <tr>";

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo  "<tr><th>" . openssl_decrypt ($row["username"], $ciphering, 
            $decryption_key, $options, $decryption_iv). " </th> <th>" . openssl_decrypt ($row["password"], $ciphering, 
            $decryption_key, $options, $decryption_iv). "</th></tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</table></div>";
    
    $conn->close();
    
    
    ?>
    <br><br><br>
    
    <a href="reports.php" id = 'linktologin'>Refresh</a>
    
</div>
    
</body>
</html>