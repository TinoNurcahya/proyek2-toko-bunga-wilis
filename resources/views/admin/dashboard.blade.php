<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <img src="{{ $user->avatar ?? '/default-avatar.png' }}" alt="Avatar" class="w-8 h-8 rounded-full">
                    <span>{{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="container mx-auto p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Orders</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_orders'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Revenue</h3>
                    <p class="text-3xl font-bold text-purple-600">Rp
                        {{ number_format($stats['revenue'] ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ $user->name }}!</h2>
                <p class="text-gray-600">Anda login sebagai <span
                        class="font-semibold text-blue-600">Administrator</span></p>

                <div class="mt-6 p-4 bg-gray-50 rounded">
                    <h3 class="font-semibold mb-2">Informasi Akun:</h3>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> <span
                            class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $user->role }}</span></p>
                    <p><strong>Login Method:</strong> {{ $user->google_id ? 'Google OAuth' : 'Email' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
