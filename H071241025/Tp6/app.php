<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

$user = $_SESSION['user'];
$page = $_GET['page'] ?? '';
function e($s){ return htmlspecialchars($s ?? '', ENT_QUOTES); }

function to($p='') {
  $url = 'app.php' . ($p ? "?page={$p}" : '');
  header("Location: {$url}");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Aplikasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

  <!-- NAVBAR -->
  <nav class="bg-indigo-900 text-yellow-50 p-4 flex justify-between items-center shadow-md">
    <h1 class="font-bold text-xl">Sistem Manajemen Proyek</h1>
    <div class="flex items-center space-x-3">
      <span class="italic"><?= e($user['username']) ?> (<?= e($user['role']) ?>)</span>
      <a href="dashboard.php" class="bg-orange-500 px-3 py-1 rounded-md hover:bg-orange-400 transition">Dashboard</a>
      <a href="logout.php" class="bg-red-600 px-3 py-1 rounded-md hover:bg-red-500 transition">Logout</a>
    </div>
  </nav>

  <!-- KONTEN -->
  <main class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
  <?php


  if ($user['role'] == 'super_admin') {

    if ($page == 'users') {
      echo "<h2 class='text-2xl font-bold mb-4 text-indigo-700 border-b pb-2'>Kelola Pengguna</h2>";

      // proses tambah user
      if (isset($_POST['add_user'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $conn->real_escape_string($_POST['role']);
        $manager = !empty($_POST['manager_id']) ? (int)$_POST['manager_id'] : null;

        if ($manager === null) {
          $stmt = $conn->prepare("INSERT INTO users (username, password, role, project_manager_id) VALUES (?, ?, ?, NULL)");
          $stmt->bind_param("sss", $username, $password, $role);
        } else {
          $stmt = $conn->prepare("INSERT INTO users (username, password, role, project_manager_id) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("sssi", $username, $password, $role, $manager);
        }
        $stmt->execute();
        $stmt->close();

        echo "<p class='text-green-600 font-semibold mb-3'>User berhasil ditambahkan.</p>";
      }

      // form tambah user
      $mres = $conn->query("SELECT id, username FROM users WHERE role='project_manager'");
      ?>
      <form method="post" class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <input name="username" placeholder="Username" class="border border-gray-300 p-2 rounded-md" required>
        <input type="password" name="password" placeholder="Password" class="border border-gray-300 p-2 rounded-md" required>

        <select id="role" name="role" class="border border-gray-300 p-2 rounded-md">
          <option value="project_manager">Project Manager</option>
          <option value="team_member">Team Member</option>
        </select>

        <select id="manager_id" name="manager_id" class="border border-gray-300 p-2 rounded-md hidden">
          <option value="">-- Pilih Manager --</option>
          <?php while ($row = $mres->fetch_assoc()): ?>
            <option value="<?= (int)$row['id'] ?>"><?= e($row['username']) ?></option>
          <?php endwhile; ?>
        </select>

        <button name="add_user" class="col-span-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Tambah Pengguna</button>
      </form>

      <script>
        const roleSelect = document.getElementById('role');
        const managerSelect = document.getElementById('manager_id');
        function toggleManagerDropdown() {
          if (roleSelect.value === 'team_member') {
            managerSelect.classList.remove('hidden');
          } else {
            managerSelect.classList.add('hidden');
            managerSelect.value = '';
          }
        }
        toggleManagerDropdown();
        roleSelect.addEventListener('change', toggleManagerDropdown);
      </script>

      <?php
      // daftar user
      $users = $conn->query("SELECT id, username, role FROM users");
      echo "<div class='overflow-x-auto'><table class='w-full border border-gray-200 rounded-md text-left'>";
      echo "<tr class='bg-indigo-100 font-semibold'><th class='p-2'>Username</th><th>Role</th><th>Aksi</th></tr>";
      while ($u = $users->fetch_assoc()) {
        echo "<tr class='border-b hover:bg-indigo-50'>
          <td class='p-2'>".e($u['username'])."</td>
          <td>".e($u['role'])."</td>
          <td><a href='?page=users&del=".((int)$u['id'])."' class='text-red-600 hover:underline'>Hapus</a></td>
        </tr>";
      }
      echo "</table></div>";

      // hapus user - super_admin tidak boleh dihapus
      if (isset($_GET['del'])) {
          $did = (int) $_GET['del'];

          // cek role user yang akan dihapus
          $check = $conn->prepare("SELECT role FROM users WHERE id=?");
          $check->bind_param("i", $did);
          $check->execute();
          $result = $check->get_result();
          $target = $result->fetch_assoc();
          $check->close();

          if ($target && $target['role'] === 'super_admin') {
              echo "<p class='text-red-600 font-semibold mt-3'>Super Admin tidak bisa dihapus!</p>";
          } else {
              $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
              $stmt->bind_param("i", $did);
              $stmt->execute();
              $stmt->close();
              to('users');
          }
      }
      return;
    } // end page users

    // super admin lihat semua proyek
    if ($page == 'projects') {
      echo "<h2 class='text-2xl font-bold mb-4 text-indigo-700 border-b pb-2'>Semua Proyek</h2>";
      $projects = $conn->query("SELECT p.*, u.username AS manager FROM projects p LEFT JOIN users u ON p.manager_id=u.id");
      echo "<div class='overflow-x-auto'><table class='w-full border border-gray-200 rounded-md text-left'>";
      echo "<tr class='bg-indigo-100 font-semibold'><th class='p-2'>Nama Proyek</th><th>Manager</th><th>Aksi</th></tr>";
      while ($p = $projects->fetch_assoc()) {
        echo "<tr class='border-b hover:bg-indigo-50'>
          <td class='p-2'>".e($p['nama_proyek'])."</td>
          <td>".e($p['manager'])."</td>
          <td><a href='?page=projects&del=".((int)$p['id'])."' class='text-red-600 hover:underline'>Hapus</a></td>
        </tr>";
      }
      echo "</table></div>";

      if (isset($_GET['del'])) {
        $did = (int) $_GET['del'];
        $stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
        $stmt->bind_param("i", $did);
        $stmt->execute();
        $stmt->close();
        to('projects');
      }
      return;
    }

    // default super admin dashboard
    echo "<h2 class='text-2xl font-bold mb-4 text-indigo-700'>Selamat datang, Super Admin</h2>";
    echo "<p class='text-gray-600'>Gunakan menu untuk mengelola pengguna dan proyek. (Klik ?page=users atau ?page=projects)</p>";
    return;
  } // end super_admin

  // ---------------------------
  // PROJECT MANAGER
  // ---------------------------
  if ($user['role'] == 'project_manager') {
    $mid = (int)$user['id'];
    $m_page = $_GET['page'] ?? 'projects';

    echo "<div class='mb-6 flex gap-3'>
      <a href='app.php?page=projects' class='px-3 py-2 rounded ".($m_page=='projects'?'bg-green-600 text-white':'bg-gray-200')."'>Proyek Saya</a>
      <a href='app.php?page=tasks' class='px-3 py-2 rounded ".($m_page=='tasks'?'bg-green-600 text-white':'bg-gray-200')."'>Kelola Tugas</a>
    </div>";

    // MANAGE PROJECTS
    if ($m_page == 'projects') {
      echo "<h2 class='text-2xl font-bold mb-4 text-green-700 border-b pb-2'>Proyek Saya</h2>";

      if (isset($_POST['add_project'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $stmt = $conn->prepare("INSERT INTO projects (nama_proyek, manager_id) VALUES (?, ?)");
        $stmt->bind_param("si", $nama, $mid);
        $stmt->execute();
        $stmt->close();
        to('projects');
      }

      echo "<form method='post' class='flex gap-3 mb-4'>
        <input type='text' name='nama' placeholder='Nama Proyek' class='border p-2 rounded w-full' required>
        <button name='add_project' class='bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700'>Tambah</button>
      </form>";

      $projects = $conn->query("SELECT * FROM projects WHERE manager_id=$mid");
      echo "<ul class='space-y-2'>";
      while ($p = $projects->fetch_assoc()) {
        echo "<li class='border p-3 rounded flex justify-between items-center'>
          <div>".e($p['nama_proyek'])."</div>
          <div><a href='app.php?page=projects&del=".((int)$p['id'])."' class='text-red-600 hover:underline'>Hapus</a></div>
        </li>";
      }
      echo "</ul>";

      if (isset($_GET['del'])) {
        $did = (int) $_GET['del'];
        $stmt = $conn->prepare("DELETE FROM projects WHERE id=? AND manager_id=?");
        $stmt->bind_param("ii", $did, $mid);
        $stmt->execute();
        $stmt->close();
        to('projects');
      }
      return;
    }

    // MANAGE TASKS (PM)
    if ($m_page == 'tasks') {
      echo "<h2 class='text-2xl font-bold mb-4 text-green-700 border-b pb-2'>Kelola Tugas</h2>";

      // tambah tugas
      if (isset($_POST['add_task'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $desk = $conn->real_escape_string($_POST['deskripsi']);
        $pid  = (int) $_POST['project_id'];
        $assigned = !empty($_POST['assigned_to']) ? (int) $_POST['assigned_to'] : null;

        // cek project milik manager
        $chk = $conn->prepare("SELECT id FROM projects WHERE id=? AND manager_id=?");
        $chk->bind_param("ii", $pid, $mid);
        $chk->execute();
        $chk->store_result();
        if ($chk->num_rows === 0) {
          $chk->close();
          echo "<p class='text-red-600'>Proyek tidak valid atau bukan milik Anda.</p>";
        } else {
          $chk->close();
          // jika assigned diisi -> cek member valid
          if ($assigned !== null) {
            $chk2 = $conn->prepare("SELECT id FROM users WHERE id=? AND role='team_member' AND project_manager_id=?");
            $chk2->bind_param("ii", $assigned, $mid);
            $chk2->execute();
            $chk2->store_result();
            if ($chk2->num_rows === 0) {
              $chk2->close();
              echo "<p class='text-red-600'>Team member tidak valid atau bukan anggota Anda.</p>";
            } else {
              $chk2->close();
              $stmt = $conn->prepare("INSERT INTO tasks (nama_tugas, deskripsi, project_id, assigned_to, status) VALUES (?, ?, ?, ?, 'belum')");
              $stmt->bind_param("ssii", $nama, $desk, $pid, $assigned);
              $stmt->execute();
              $stmt->close();
              to('tasks');
            }
          } else {
            // insert dengan assigned NULL
            $stmt = $conn->prepare("INSERT INTO tasks (nama_tugas, deskripsi, project_id, assigned_to, status) VALUES (?, ?, ?, NULL, 'belum')");
            $stmt->bind_param("ssi", $nama, $desk, $pid);
            $stmt->execute();
            $stmt->close();
            to('tasks');
          }
        }
      } // end add_task

      // PM update assignment (tidak mengubah status)
      if (isset($_POST['update_assign'])) {
        $tid = (int) $_POST['tid'];
        $assigned = !empty($_POST['assigned_to']) ? (int) $_POST['assigned_to'] : null;

        // cek tugas milik manager
        $chk = $conn->prepare("SELECT t.id FROM tasks t JOIN projects p ON t.project_id=p.id WHERE t.id=? AND p.manager_id=?");
        $chk->bind_param("ii", $tid, $mid);
        $chk->execute();
        $chk->store_result();
        if ($chk->num_rows > 0) {
          $chk->close();
          if ($assigned === null) {
            $stmt = $conn->prepare("UPDATE tasks SET assigned_to=NULL WHERE id=?");
            $stmt->bind_param("i", $tid);
          } else {
            // pastikan assigned adalah anggota manager
            $chk2 = $conn->prepare("SELECT id FROM users WHERE id=? AND role='team_member' AND project_manager_id=?");
            $chk2->bind_param("ii", $assigned, $mid);
            $chk2->execute();
            $chk2->store_result();
            if ($chk2->num_rows > 0) {
              $chk2->close();
              $stmt = $conn->prepare("UPDATE tasks SET assigned_to=? WHERE id=?");
              $stmt->bind_param("ii", $assigned, $tid);
            } else {
              $chk2->close();
              // invalid assigned -> ignore
              $stmt = null;
            }
          }
          if (isset($stmt) && $stmt !== null) { $stmt->execute(); $stmt->close(); }
        } else {
          $chk->close();
        }
        to('tasks');
      } // end update_assign

      // delete task (only owner manager)
      if (isset($_GET['del'])) {
        $delid = (int) $_GET['del'];
        $stmt = $conn->prepare("DELETE t FROM tasks t JOIN projects p ON t.project_id=p.id WHERE t.id=? AND p.manager_id=?");
        $stmt->bind_param("ii", $delid, $mid);
        $stmt->execute();
        $stmt->close();
        to('tasks');
      }

      // ambil projects & team member milik manager
      $projects_res = $conn->query("SELECT id, nama_proyek FROM projects WHERE manager_id=$mid");
      $tm_res = $conn->query("SELECT id, username FROM users WHERE role='team_member' AND project_manager_id=$mid");

      // form tambah tugas
      ?>
      <form method="post" class="grid grid-cols-3 gap-3 mb-4">
        <input type="text" name="nama" placeholder="Nama Tugas" class="border p-2 rounded col-span-1" required>

        <select name="project_id" class="border p-2 rounded col-span-1" required>
          <?php
          $projects_res->data_seek(0);
          while ($r = $projects_res->fetch_assoc()) {
            echo "<option value='".(int)$r['id']."'>".e($r['nama_proyek'])."</option>";
          }
          ?>
        </select>

        <select name="assigned_to" class="border p-2 rounded col-span-1">
          <option value="">Pilih Team Member</option>
          <?php
          $tm_res->data_seek(0);
          while ($t = $tm_res->fetch_assoc()) {
            echo "<option value='".(int)$t['id']."'>".e($t['username'])."</option>";
          }
          ?>
        </select>

        <input type="text" name="deskripsi" placeholder="Deskripsi" class="border p-2 rounded col-span-3">
        <button name="add_task" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 col-span-3">Tambah Tugas</button>
      </form>
      <?php

      // list tugas manager (lihat progress tapi manager tidak ubah status)
      $tasks = $conn->query("
        SELECT t.*, p.nama_proyek, u.username AS assigned_user
        FROM tasks t
        JOIN projects p ON t.project_id=p.id
        LEFT JOIN users u ON t.assigned_to=u.id
        WHERE p.manager_id=$mid
        ORDER BY t.id DESC
      ");

      echo "<div class='space-y-3'>";
      while ($t = $tasks->fetch_assoc()) {
        ?>
        <form method="post" class="border p-3 rounded bg-white">
          <div class="flex justify-between items-start">
            <div>
              <strong class="text-lg"><?= e($t['nama_tugas']) ?></strong>
              <div class="text-sm text-gray-500"><?= "(".e($t['nama_proyek']).")" ?></div>
              <div class="text-sm text-indigo-600 mt-2">👤 Ditugaskan ke: <strong><?= e($t['assigned_user'] ?? '-') ?></strong></div>
            </div>

            <div class="text-right">
              <div class="text-sm text-gray-500 mb-1">Status saat ini:</div>
              <div class="px-3 py-1 rounded border"><?= e($t['status']) ?></div>
            </div>
          </div>

          <p class="text-sm mt-3 mb-2"><?= e($t['deskripsi']) ?></p>

          <!-- PM dapat mengubah penugasan (assigned_to) tetapi *tidak* mengubah status -->
          <div class="mt-2 flex items-center gap-3">
            <input type="hidden" name="tid" value="<?= (int)$t['id'] ?>">
            <select name="assigned_to" class="border p-2 rounded">
              <option value="">Kosongkan penugasan</option>
              <?php
              // re-query members for dropdown
              $members = $conn->query("SELECT id, username FROM users WHERE role='team_member' AND project_manager_id=$mid");
              while ($m = $members->fetch_assoc()) {
                $sel = ($t['assigned_to'] == $m['id']) ? 'selected' : '';
                echo "<option value='".(int)$m['id']."' {$sel}>".e($m['username'])."</option>";
              }
              ?>
            </select>
            <button name="update_assign" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Simpan Penugasan</button>

            <a href="app.php?page=tasks&del=<?= (int)$t['id'] ?>" class="text-red-600 ml-3">Hapus</a>
          </div>
        </form>
        <?php
      }
      echo "</div>";

      return;
    } // end tasks

    // fallback manager
    echo "<p class='text-gray-600'>Pilih menu Proyek Saya atau Kelola Tugas (gunakan ?page=projects atau ?page=tasks).</p>";
    return;
  } // end project_manager

  // ---------------------------
  // TEAM MEMBER
  // ---------------------------
  if ($user['role'] == 'team_member') {
    $uid = (int)$user['id'];

    // proses update status oleh team member (hanya jika assigned_to = user)
    if (isset($_POST['update_status'])) {
      $tid = (int)$_POST['task_id'];
      $status = $conn->real_escape_string($_POST['status']);

      $chk = $conn->prepare("SELECT id FROM tasks WHERE id=? AND assigned_to=?");
      $chk->bind_param("ii", $tid, $uid);
      $chk->execute();
      $chk->store_result();
      if ($chk->num_rows > 0) {
        $chk->close();
        $stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $tid);
        $stmt->execute();
        $stmt->close();
      } else {
        $chk->close();
      }
      to('mytasks');
    }

    // tampilkan tugas user
    echo "<h2 class='text-2xl font-bold mb-4 text-purple-700 border-b pb-2'>Tugas Saya</h2>";
    $tasks = $conn->query("SELECT t.*, p.nama_proyek FROM tasks t JOIN projects p ON t.project_id=p.id WHERE t.assigned_to=$uid ORDER BY t.id DESC");

    echo "<div class='grid gap-4'>";
    while ($t = $tasks->fetch_assoc()) {
      ?>
      <form method="post" class="border border-gray-300 p-4 rounded-md shadow-sm bg-white hover:shadow-md transition">
        <h3 class="font-semibold text-lg text-gray-800 mb-1"><?= e($t['nama_tugas']) ?></h3>
        <p class="text-gray-500 text-sm mb-2"><?= e($t['nama_proyek']) ?></p>
        <p class="mb-3 text-sm"><?= e($t['deskripsi']) ?></p>

        <div class="flex items-center space-x-2">
          <select name="status" class="border border-gray-300 p-2 rounded-md">
            <option value="belum" <?= $t['status']=='belum' ? 'selected' : '' ?>>Belum</option>
            <option value="proses" <?= $t['status']=='proses' ? 'selected' : '' ?>>Proses</option>
            <option value="selesai" <?= $t['status']=='selesai' ? 'selected' : '' ?>>Selesai</option>
          </select>

          <input type="hidden" name="task_id" value="<?= (int)$t['id'] ?>">
          <button name="update_status" class="bg-purple-500 text-white px-3 py-1 rounded-md hover:bg-purple-600 transition">Ubah</button>
        </div>
      </form>
      <?php
    }
    echo "</div>";
    return;
  } // end team_member

  // unknown role fallback
  echo "<p class='text-red-600'>Role tidak dikenali.</p>";
  ?>
  </main>
</body>
</html>
