<?php 
session_start();
include 'data.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-body">
  <div class="container">
    <h1>Selamat Datang, <?= htmlspecialchars($user['name']); ?>!</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
    <hr>

    <?php if ($user['username'] === 'adminxxx'): ?>
      <h2>Data Semua Pengguna</h2>
      <table class="user-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
            <tr>
              <td><?= htmlspecialchars($u['name']); ?></td>
              <td><?= htmlspecialchars($u['username']); ?></td>
              <td><?= htmlspecialchars($u['email']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <h2>Data Anda</h2>
      <table class="user-table single">
        <tr><th>Nama</th><td><?= htmlspecialchars($user['name']); ?></td></tr>
        <tr><th>Username</th><td><?= htmlspecialchars($user['username']); ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($user['email']); ?></td></tr>
        <tr><th>Gender</th><td><?= $user['gender'] ?? '-'; ?></td></tr>
        <tr><th>Fakultas</th><td><?= $user['faculty'] ?? '-'; ?></td></tr>
        <tr><th>Angkatan</th><td><?= $user['batch'] ?? '-'; ?></td></tr>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>
