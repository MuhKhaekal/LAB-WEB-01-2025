<?php
session_start();
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_found = null;
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $user_found = $user;
            break;
        }
    }

    if ($user_found && password_verify($password, $user_found['password'])) {
        $_SESSION['user'] = $user_found;
        header('location: dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>