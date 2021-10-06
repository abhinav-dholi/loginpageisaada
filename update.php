<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
.container,
.form__input,
.form__button {
    font: 500 1rem 'Quicksand', sans-serif;
}
.form__title {
    margin-bottom: 2rem;
    text-align: center;
}

.form__message {
    text-align: center;
    margin-bottom: 1rem;
}

.form__message--success {
    color: var(--color-success);
}

.form__message--error {
    color: var(--color-error);
}

.form__input-group {
    margin-bottom: 1rem;
}
.form__input {
    display: block;
    width: 100%;
    padding: 0.75rem;
    box-sizing: border-box;
    border-radius: var(--border-radius);
    border: 1px solid #e4c7c7;
    outline: none;
    background: #eeeeee;
    transition: background 0.2s, border-color 0.2s;
}

.form__input:focus {
    border-color: var(--color-primary);
    background: #ffffff;
}
.frmbtn{
    display: flex;
}
.form__button {
    width: 50%;
    padding: 1rem 2rem;
    font-weight: bold;
    font-size: 1.1rem;
    color: #ffffff;
    border: none;
    border-radius: var(--border-radius);
    outline: none;
    cursor: pointer;
    background: var(--color-primary);
    margin: 0.4rem;
}

.form__button:hover {
    background: var(--color-primary-dark);
}

.form__button:active {
    transform: scale(0.98);
}

.form__text {
    text-align: center;
}

.form__link {
    color: var(--color-secondary);
    text-decoration: none;
    cursor: pointer;
}

.form__link:hover {
    text-decoration: underline;
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
    ?>
     <form class="form" id="login" method = "post">
            <h1 class="form__title">Update your password </h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" name = "username" autofocus placeholder="Username" value = "<?php echo "$username"; ?>" readonly> 
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name = "new_password" autofocus placeholder="Enter New Password"> 
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="new_pass_confirm" autofocus placeholder="Password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit" formaction = "updatepass.php">Update</button>
            
            <!-- <p class="form__text">
                <a class="form__link" href="./createaccount.html" id="linkCreateAccount">Don't have an account? Create account</a>
            </p> -->
            <!-- <p class="form__text">
                <a class="form__link" href="./landingpage.html" id="linkHomePage">Go to Home</a>
            </p> -->
        </form>
    <?php
    }
    else
    {
        echo "enter correct password";
    }
    ?>
    
</div>
</body>
</html>