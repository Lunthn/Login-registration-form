<?php include "database.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h1>Register</h1>
            
            <?php
            $db = connectToDatabase();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];
                $repeatPassword = $_POST['password2'];
                $errors = [];

                if (!$username || strlen($username) < 2 || strlen($username) > 24 || !checkUsernameAvailability($username, $db)) {
                    $errors[] = "Invalid or taken username (2-24 characters).";
                }

                if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50 || !checkEmailAvailability($email, $db)) {
                    $errors[] = "Invalid or taken email.";
                }

                if (!$password || strlen($password) < 8 || strlen($password) > 50 || $password !== $repeatPassword) {
                    $errors[] = "Invalid or mismatched passwords (8-50 characters).";
                }

                if (empty($_POST['checkbox'])) {
                    $errors[] = "You must agree to the Terms of Service.";
                }

                foreach ($errors as $error) echo "<em>$error</em>";

                if (empty($errors)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = mysqli_prepare($db, "INSERT INTO users (username, email, hashed_password) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                    $stmt->execute();
                    header("Location: register-success.php");
                }
            }
            ?>

            <label>Username</label>
            <input type="text" name="username" placeholder="Choose a username">
            
            <label>Email</label>
            <input type="text" name="email" placeholder="Enter your email">
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Choose a password">
            
            <label>Repeat Password</label>
            <input type="password" name="password2" placeholder="Repeat previous password">
            
            <div class="terms-of-service">
                <input type="checkbox" name="checkbox">
                <label>I agree with the <a href="#">Terms of Service</a></label>
            </div>
            
            <input type="submit" value="Submit" name="submit">
        </form>
        <p>Already have an account? <a href="index.php">Log-in</a></p>
    </div>
</div>
</body>
</html>