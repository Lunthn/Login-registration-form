<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h1>Log-in</h1>
            <label>E-mail</label>
            <input type="text" name="email" id="email">
            <label>Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Submit" id="submit-button">
        </form>
        <p id="switch-page">Don't have an account yet? <a href="register.php">Sign up here!</a> </p>
    </div>
</div>
</body>
</html>