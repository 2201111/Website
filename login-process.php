<?php

session_start();

require_once 'database.php';

$username = $_POST['uname'];
$password = $_POST['psw'];

$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);

$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['ID'];
    $_SESSION['username'] = $user['username'];

    header("Location: index.html");
    exit;

} else {

    echo "Incorrect username or password.";

}

?>