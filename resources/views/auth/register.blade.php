<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-rault-500">Register</h2>
        
        <form method="POST" action="{{ route('register') }}" class="mt-6">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" required 
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-rault-500 focus:border-rault-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required 
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-rault-500 focus:border-rault-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required 
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-rault-500 focus:border-rault-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required 
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-rault-500 focus:border-rault-500">
            </div>

            <button type="submit" 
                class="w-full bg-rault-500 text-white py-3 rounded-lg hover:bg-opacity-90">
                Register
            </button>

            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-rault-500 hover:underline">Login</a>
            </p>
        </form>
    </div>

</body>
</html>
