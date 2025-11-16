<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-900 to-orange-500">
  <div class="w-max mx-auto mt-20 bg-yellow-50 p-8 rounded-xl shadow-lg text-center">
    <h1 class="text-2xl font-bold">Selamat datang, <?= $user['username'] ?>!</h1>
    <p class="text-sm mb-4">(role: <?= $user['role'] ?>)</p>
    <div class="space-y-3">
      <?php if ($user['role'] == 'super_admin'): ?>
        <a href="app.php?page=users" class="block bg-indigo-900 text-yellow-50 py-2 rounded-lg hover:bg-orange-500">Kelola User</a>
        <a href="app.php?page=projects" class="block bg-indigo-900 text-yellow-50 py-2 rounded-lg hover:bg-orange-500">Lihat Semua Proyek</a>
      <?php elseif ($user['role'] == 'project_manager'): ?>
        <a href="app.php?page=projects" class="block bg-indigo-900 text-yellow-50 py-2 rounded-lg hover:bg-orange-500">Kelola Proyek Saya</a>
        <a href="app.php?page=tasks" class="block bg-indigo-900 text-yellow-50 py-2 rounded-lg hover:bg-orange-500">Kelola Tugas</a>
      <?php else: ?>
        <a href="app.php?page=mytasks" class="block bg-indigo-900 text-yellow-50 py-2 rounded-lg hover:bg-orange-500">Tugas Saya</a>
      <?php endif; ?>
      <a href="logout.php" class="block bg-red-900 text-yellow-50 py-2 rounded-lg hover:bg-red-600">Logout</a>
    </div>
  </div>
</body>
</html>
