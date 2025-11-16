<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-900 to-orange-500 flex justify-center items-center h-screen">
  <form method="post" class="bg-yellow-50 p-8 rounded-xl shadow-lg w-96 flex flex-col gap-4">
    <h2 class="text-2xl font-bold text-center text-indigo-900">Login</h2>
    <?php if (isset($error)) echo "<p class='text-red-500 text-center'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required class="border border-orange-500 p-3 rounded-lg">
    <input type="password" name="password" placeholder="Password" required class="border border-orange-500 p-3 rounded-lg">
    <button type="submit" class="bg-indigo-900 hover:bg-indigo-600 text-white font-semibold p-3 rounded-lg">Masuk</button>
  </form>
</body>
</html>
