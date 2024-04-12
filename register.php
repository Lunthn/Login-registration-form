<?php
include "database.php";
$database = connectToDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h1>Register</h1>
            <?php

            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                if (empty($username)) {
                    print("<em>Username is required</em>");
                } else {
                    if (checkUsernameAvailability($username, $database)) {
                        $finalUsername = $username;
                    } else {
                        print("<em>Username is already taken");
                    }
                }
            }
            ?>
            <label>Username</label>
            <input type="text" name="username" id="username">
            <?php

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                if (empty($email)) {
                    print("<em>Email is required</em>");
                } else
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (checkEmailAvailability($email, connectToDatabase())) {
                            $finalEmail = $email;
                        } else {
                            print("<em>This e-mail already has an account </em>");
                        }
                    }
                    else{
                        print("<em>Invalid email</em>");
                    }

            }
            ?>
            <label>E-mail</label>
            <input type="text" name="email" id="email">
            <?php
            if (isset($_POST['submit'])) {
                $password = $_POST['password'];
                $finalPassword = null;
                if(empty($password)){
                    print("<em>Password is required</em>");
                }
                else{
                    if(strlen($password) < 8){
                        print("<em>Password must be 8 characters long</em>");
                    }
                    else if(strlen($password) > 16){
                        print("<em>Password cant be longer then 8 characters</em>");
                    }
                    else{
                        $finalPassword = $password;
                    }
                }
            }
            ?>
            <label>Password</label>
            <input type="password" name="password" id="password">
            <?php
            if (isset($_POST['submit'])) {
                $repeatPassword = $_POST['password2'];
                if($repeatPassword != $finalPassword || $finalPassword == null){
                    print("<em>Passwords do not match</em>");
                }

            }
            ?>
            <label>Repeat password</label>
            <input type="password" name="password2" id="password">
            <input type="submit" value="Submit" id="submit-button" name="submit">
        </form>
        <p id="switch-page">Already have an account? <a href="index.php">Log-in</a></p>
    </div>
</div>
</body>
</html>
