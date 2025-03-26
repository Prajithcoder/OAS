<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Assignment Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">

    <div class="bg-white shadow-2xl rounded-xl p-10 max-w-md w-full text-center transform hover:scale-105 transition duration-300">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6">📝 Register</h2>

        <form action="register_process.php" method="POST" class="space-y-4">
            <input type="text" name="name" placeholder="Full Name" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            <input type="email" name="email" placeholder="Email" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700 hover:shadow-xl transition duration-300">Register</button>
        </form>

        <p class="text-gray-600 mt-4">Already have an account? <a href="login.php" class="text-blue-600 font-semibold hover:underline">Login</a></p>
    </div>

</body>
</html>
