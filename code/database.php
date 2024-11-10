<?php
session_start();

function connectToDatabase() {
    $config = [
        'hostname' => "localhost",
        'username' => "root",
        'password' => "",
        'database' => "login/register",
        'charset'  => "latin1"
    ];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);
        mysqli_set_charset($conn, $config['charset']);
        return $conn;
    } catch (mysqli_sql_exception $e) {
        echo "<h2>Database not found</h2>";
        die();
    }
}

function checkEmailAvailability($email, $db) {
    $stmt = $db->prepare("SELECT 1 FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return !$stmt->get_result()->num_rows;
}

function checkUsernameAvailability($username, $db) {
    $stmt = $db->prepare("SELECT 1 FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return !$stmt->get_result()->num_rows;
}

function getUserByID($id, $db) {
    $stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
