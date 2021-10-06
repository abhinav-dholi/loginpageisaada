<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
    width: 400px;
    max-width: 400px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #ffffff;
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
#linktologin{
    text-decoration: none;
    /* border: solid 2px red; */
    border-radius: 30px;
    margin: 2px;
    padding: 9px;
    display: inline-block;
    /* text-align: center; */
    background: var(--color-primary);
    color: white;
}
    </style>
<body>
<div class="container">    
        <form class="form" id="login" method = "post">
            <h1 class="form__title">Modification and Deletion</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" name = "username" autofocus placeholder="Username"> 
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="pass" autofocus placeholder="Enter Password">
                <div class="form__input-error-message"></div>
            </div>
            <!-- <div class="form__input-group">
                <input type="password" class="form__input" name="pass" autofocus placeholder="Enter New Password">
                <div class="form__input-error-message"></div>
            </div> -->
            <div class="frmbtn">

                <button class="form__button" type="submit" formaction="update.php">Update Password</button>
                <button class="form__button" type="submit" formaction="delete.php">Delete</button>
            </div>
            <a href="index.php" id = 'linktologin'>Go back to the Main form</a>
           
        </form>
    </div>
</body>
</html>