<?php
include "database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="main">
        <?php
        $db = connectToDatabase();
        try {
            $user = getUserByID($_SESSION['user_id'], $db);
            echo "<h1>Hello, {$user['username']}</h1>";
            echo "<p><b>User ID:</b> {$user['user_id']}</p>";
            echo "<p><b>Email:</b> {$user['email']}</p>";
            echo "<p><b>Password:</b> {$user['hashed_password']}</p>";
        } catch (Exception $e) {
            echo "<h1>Hello, N/A</h1><p>Database error</p>";
        }
        ?>

        <form method="post">
            <input type="submit" value="Log-out" name="log-out" id="submit-button">
        </form>

        <?php
        if (isset($_POST['log-out'])) {
            session_unset();
            session_destroy();
            header("Refresh:0");
        }
        ?>
    </div>
</div>
</body>
</html>