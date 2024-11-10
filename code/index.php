<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h1>Log-in</h1>
            
            <?php
            $db = connectToDatabase();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $db->real_escape_string(trim($_POST['email']));
                $password = $_POST['password'];
                
                $query = $db->prepare("SELECT * FROM users WHERE email = ?");
                $query->bind_param("s", $email);
                $query->execute();
                $user = $query->get_result()->fetch_assoc();

                if ($user && password_verify($password, $user['hashed_password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    header("Location: home.php");
                    exit;
                } else {
                    echo "<em>Invalid login</em>";
                }
            }
            ?>
            
            <label>E-mail</label>
            <input type="text" name="email" placeholder="Enter your e-mail">
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password">
            
            <input type="submit" value="Submit" name="submit">
        </form>
        
        <p>Don't have an account yet? <a href="register.php">Sign up here!</a></p>
    </div>
</div>
</body>
</html>