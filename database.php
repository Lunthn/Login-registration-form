<?php
function connectToDatabase() //connecting to database
{
    $hostname = "localhost"; //change these to connect to your own database
    $username = "root";
    $password = "";
    $database = "login/register";


    $connection = null;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $connection = mysqli_connect($hostname, $username, $password, $database);
        mysqli_set_charset($connection, 'latin1');
        $databaseAvailable = true;
    } catch (mysqli_sql_exception $e) {
        $databaseAvailable = false;
    }
    if (!$databaseAvailable) {
        ?><h2>Error: database not found</h2><?php
        die();
    }
    return $connection;
}

//doesnt work
function checkEmailAvailability($email, $database) //checking if email is unique
{
    $sql = $database->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $result = $sql->execute();
    $result = $result->fetch_assoc();
    if (!empty($result)) {
        return false;
    } else {
        return true;
    }
}

//doesnt work
function checkUsernameAvailability($username, $database) // checking if username is unique
{
    $sql = $database->prepare("SELECT * FROM users WHERE username = ?");
    $sql->bind_param("s", $username);
    $result = $sql->execute();
    $result = $result->fetch_assoc();
    if (!empty($result)) {
        return false;
    } else {
        return true;
    }
}
function getUser($email, $database) //get info of the user with unique email
{
    $sql = $database->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $result = $sql->execute();
    return $result->fetch_assoc();
}

?>
