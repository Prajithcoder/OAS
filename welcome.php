<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Assignment Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">

    <div class="bg-white shadow-2xl rounded-xl p-10 max-w-md w-full text-center transform hover:scale-105 transition duration-300">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6">📚 Welcome to the Assignment Portal</h1>
        <p class="text-gray-600 mb-4">Please select your role to continue.</p>

        <form action="auth/login.php" method="GET">
            <select name="role" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="" disabled selected>Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            
            <button type="submit" class="w-full bg-green-600 text-white py-2 mt-4 rounded-lg shadow-md hover:bg-green-700 hover:shadow-xl transition duration-300">
                Proceed to Login
            </button>
        </form>
    </div>

</body>
</html>
