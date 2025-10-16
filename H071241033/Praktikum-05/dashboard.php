<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$loggedInUser = $_SESSION['user'];

require_once 'data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <header class="flex flex-row justify-between items-center h-15 px-4 border-b border-gray-300">
            <div class="flex gap-4 items-center">
                <img class="h-13" src="assets/sikola-pict.png" alt="SIKOLA pict">
                <nav class="flex flex-row gap-4 px-4">
                    <a href="">Home</a>
                    <a href="" class="border-b-2 border-blue-600">dashboard</a>
                    <a href="">My Courses</a>
                </nav>
            </div>
            <div class="flex items-center gap-3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    class="w-6 h-6 fill-gray-500 p-1">
                    <path d="M224 0c-17.7 0-32 14.3-32 32l0 3.2C119 50 64 114.6 64 192l0 21.7c0 48.1-16.4 94.8-46.4 132.4L7.8 358.3C2.7 364.6 0 372.4 0 380.5 0 400.1 15.9 416 35.5 416l376.9 0c19.6 0 35.5-15.9 35.5-35.5 0-8.1-2.7-15.9-7.8-22.2l-9.8-12.2C400.4 308.5 384 261.8 384 213.7l0-21.7c0-77.4-55-142-128-156.8l0-3.2c0-17.7-14.3-32-32-32zM162 464c7.1 27.6 32.2 48 62 48s54.9-20.4 62-48l-124 0z"/></svg>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    class="w-6 h-6 fill-gray-500 p-1">
                    <path d="M512 240c0 132.5-114.6 240-256 240-37.1 0-72.3-7.4-104.1-20.7L33.5 510.1c-9.4 4-20.2 1.7-27.1-5.8S-2 485.8 2.8 476.8l48.8-92.2C19.2 344.3 0 294.3 0 240 0 107.5 114.6 0 256 0S512 107.5 512 240z"/></svg>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    class="w-6 h-6 fill-gray-500 p-1">
                    <path d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"/></svg>
                </div>
                <div class="border-l border-gray-300 h-11"></div>
                <a href="logout.php">Log out</a>
            </div>
        </header>
        <main class="flex-grow p-6">
            <?php if ($loggedInUser['username'] === "adminxxx"): ?>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-2xl font-bold mb-4">Selamat Datang, Staff Akademik!</h2>
                    <h3 class="text-xl font-semibold mb-4 text-gray-700">Data Mahasiswa Terdaftar</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Nama</th>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Username</th>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Angkatan</th>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Fakultas</th>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Jenis Kelamin</th>
                                    <th class="border p-3 text-left font-semibold text-gray-700">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <?php if ($user['username'] === "adminxxx"): continue; endif; ?>
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="border p-3"><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td class="border p-3"><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td class="border p-3"><?php echo htmlspecialchars($user['batch'] ?? '-'); ?></td>
                                        <td class="border p-3"><?php echo htmlspecialchars($user['faculty'] ?? '-'); ?></td>
                                        <td class="border p-3"><?php echo htmlspecialchars($user['gender'] ?? '-'); ?></td>
                                        <td class="border p-3"><?php echo htmlspecialchars($user['email']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <div class="bg-white p-3 rounded-lg shadow max-w-2xl mx-auto">
                    <div class="flex justify-center">
                        <h2 class="font-bold text-2xl pb-4">Selamat Datang, <?php echo htmlspecialchars($loggedInUser['name']); ?>!</h2>
                    </div>
                    <div class="border border-gray-300 rounded-lg p-4">
                        <h2 class="text-xl font-bold mb-4 text-gray-700 border-b-2 pb-2">Profil Mahasiswa</h2>
                        <div class="mx-auto px-6">
                            <table class="w-full text-sm text-gray-700">
                                <tr class="border-b">
                                    <td class="font-semibold py-2 w-1/3">Nama</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['name']); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="font-semibold py-2">Username</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['username']); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="font-semibold py-2">Email</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['email']); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="font-semibold py-2">Jenis Kelamin</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['gender'] ?? '-'); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="font-semibold py-2">Fakultas</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['faculty'] ?? '-'); ?></td>
                                </tr>
                                <tr class="border-b">
                                    <td class="font-semibold py-2">Angkatan</td>
                                    <td class="py-2 pl-6"><?php echo htmlspecialchars($loggedInUser['batch'] ?? '-'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </main>
    </div>
</body>
</html>