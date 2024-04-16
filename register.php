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
                    if (strlen($username) >= 24 || strlen($username < 2)){ //cant be larger than 24 because of database (can be changed in database)
                        print("<em>Must be between 2 and 24 characters </em>");
                    } else {
                        if (checkUsernameAvailability($username, $database)){ //username must be unique
                            $finalUsername = $username;
                        } else {
                            print("<em>Username is already taken</em>");
                        }
                    }
                }
            }
            ?>

            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Choose an username">

            <?php
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                if (empty($email)) {
                    print("<em>Email is required</em>");
                } else
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 50) { //checking if email is in email format
                        if (checkEmailAvailability($email, $database)) { //email must be unique
                            $finalEmail = $email;
                        } else {
                            print("<em>This e-mail already has an account </em>");
                        }
                    } else {
                        print("<em>Invalid email</em>");
                    }
            }
            ?>

            <label>E-mail</label>
            <input type="text" name="email" id="email" placeholder="Enter your e-mail">

            <?php
            if (isset($_POST['submit'])) {
                $password = $_POST['password'];
                $finalPassword = null;
                if (empty($password)) {
                    print("<em>Password is required</em>");
                } else {
                    if (strlen($password) < 8 || strlen($password) > 50){ //cant be larger than 50 because of database (can be changed in database)
                        print("<em>Must be between 8 and 50 characters</em>");
                    }
                    else {
                        $finalPassword = $password;
                    }
                }
            }
            ?>

            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Choose a password">

            <?php
            if (isset($_POST['submit'])) {
                $repeatPassword = $_POST['password2'];
                if ($repeatPassword != $finalPassword || $finalPassword == null) {
                    print("<em>Passwords do not match</em>");
                }
                else{
                    $match = true;
                }
            }
            ?>

            <label>Repeat password</label>
            <input type="password" name="password2" id="password" placeholder="Repeat previous password">

            <?php
            if(isset($_POST['submit'])){
                if(!isset($_POST['checkbox'])){
                    print("<em>Must agree to make an account</em>");
                }
                else{
                    $checked = true;
                }
            }
            ?>

            <div class="terms-of-service">
                <input type="checkbox" id="checkbox-input" name="checkbox">
                <label>I agree with the <a href="#">Terms of Service</a> </label>
            </div>
            <input type="submit" value="Submit" id="submit-button" name="submit">
        </form>
        <p id="switch-page">Already have an account? <a href="index.php">Log-in</a></p>

        <?php
        if(isset($finalUsername) && isset($finalEmail) && isset($finalPassword) && $match && $checked){
            $finalPassword = password_hash($finalPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, hashed_password) VALUES(?, ?, ?)";
            $stmt = mysqli_prepare($database, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $finalUsername, $finalEmail, $finalPassword);
            $stmt->execute();
            header("Location: register-success.php"); //send to confirmation page
        }
        ?>

    </div>
</div>

</body>
</html>
