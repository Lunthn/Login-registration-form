<?php
include "db.php";
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
        <form method="post" action="register-handling.php">
            <h1>Register</h1>
            <label>Username</label>
            <input type="text" name="username" id="username">
            <label>E-mail</label>
            <input type="text" name="email" id="email">
            <label>Password</label>
            <input type="password" name="password" id="password">
            <label>Repeat password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Submit" id="submit-button">
        </form>
        <p id="switch-page">Already have an account? <a href="index.php">Login</a> </p>
    </div>
</div>
</body>
</html>
