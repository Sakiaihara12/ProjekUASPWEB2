<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-orange-400 to-blue-500 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-orange-600 mb-6 text-center">Register Admin</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/admin/register">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input name="name" type="text" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input name="email" type="email" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input name="password" type="password" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input name="password_confirmation" type="password" class="w-full p-2 border rounded" required>
            </div>

            <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded w-full">
                Register
            </button>
        </form>
    </div>
</body>
</html>
