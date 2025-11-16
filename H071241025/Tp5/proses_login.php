<?php 
session_start();
include "data.php";

$username = $_POST['username'];
$password = $_POST['password'];

$found = false;

foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $found = true;
        break;
    }
}

if ($found) {
    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['error'] = "Username atau password yang anda masukkan salah!";
    header("Location: login.php");
    exit;
}
?>