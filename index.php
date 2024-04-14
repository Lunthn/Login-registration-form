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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h1>Log-in</h1>
            <?php
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $database->real_escape_string($_POST['email']));
                $result = $database->query($sql);
                $user = $result->fetch_assoc();
                if (!empty($user)){
                    if ($_POST['password'] == $user['password']) {
                        $_SESSION['user_id'] = $user['user_id']; //your logged in when user id isset in session
                        header("Location: home.php");
                    }
                    else{
                        print("<em>Invalid login</em>");
                    }
                } else {
                    print("<em>Invalid login</em>");
                }
            }
            ?>
            <label>E-mail</label>
            <input type="text" name="email" id="email">
            <label>Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Submit" id="submit-button" name="submit">
        </form>
        <p id="switch-page">Don't have an account yet? <a href="register.php">Sign up here!</a></p>
    </div>
</div>
</body>
</html>