<?php
include "database.php";
$database = connectToDatabase();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); //only able to access page when your logged in -> when user id isset
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="main">
        <h1>Hello, <?php
            try {
                $user = getUserByID($_SESSION['user_id'], $database); //get user info and print it
                print($user['username'] . "</h1>");
                print("<p> <b>User ID: </b>" . $user['user_id'] . "</p>");
                print("<p> <b>E-mail: </b>" . $user['email'] . "</p>");
                print("<p> <b>Password: </b> " . $user['password'] . "</p>");
            } catch (mysqli_sql_exception) {
                print("N/A </h1>");
                print("<p>Database error</p>");
            }
            ?>
            <form method="post">
                <input type="submit" value="Log-out" name="log-out" id="submit-button">
            </form>
            <?php //logout -> unset user id in session
            if(isset($_POST['log-out'])){
                unset($_SESSION['user_id']);
                echo "<meta http-equiv='refresh' content='0'";
            }
            ?>
    </div>
</div>
</body>
