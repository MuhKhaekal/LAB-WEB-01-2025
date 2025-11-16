<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="login-box">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
        }
        ?>
        <form action="proses_login.php" method="post">
            <label>Username: </label>
            <input type="text" name="username" required><br><br>
            <label>Password: </label>
            <input type="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>