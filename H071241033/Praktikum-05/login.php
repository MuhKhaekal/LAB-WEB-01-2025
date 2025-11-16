<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">
    <section class="bg-white flex flex-col justify-start h-2xl w-xl  border border-gray-300 rounded-lg p-10 shadow-xl">
        <div class="mb-4">
            <img src="assets/sikola-pict.png" alt="SIKOLA pict"> 
        </div>
        <div class="flex flex-col justify-start">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="bg-red-200 text-gray-700 px-4 py-3 rounded-xl relative mb-4" role="alert">';
                echo htmlspecialchars($_SESSION['error']);
                echo '</div>';
                
                unset($_SESSION['error']);
            }
            ?>
            <form action="proses_login.php" method="POST">
                <div class="flex flex-col justify-start gap-2">
                    <input type="text" placeholder="Username" name="username" id="username"
                    class="border border-gray-400 text-gray-600 rounded-xl p-2 mb-2 focus:ring-4 focus:ring-blue-500 focus:text-gray-600 focus:outline-none transition duration-300">
                    <input type="password" placeholder="Password" name="password" id="password"
                    class="border border-gray-400 text-gray-600 rounded-xl p-2 mb-2 focus:ring-4 focus:ring-blue-500 focus:text-gray-600 focus:outline-none transition duration-300">
                    <div class="flex justify-start">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Log in</button>
                    </div>
                </div>
            </form>

            <a href="" class="text-blue-600 hover:underline pt-2">Lost password?</a>
            <hr class="border border-gray-300 my-4">
            <p class="font-bold text-xl">Some courses may allow guest access</p>
            <div class="flex justify-start pt-2">
                <button type="" class="bg-gray-300 hover:bg-gray-400 text-black font-normal py-2 px-4 rounded-lg">Access as a guest</button>
            </div>
        </div>
    </section>
</body>
</html>