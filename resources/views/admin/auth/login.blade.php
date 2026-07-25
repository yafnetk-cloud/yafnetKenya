<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — YAFNET</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B2545] min-h-screen flex items-center justify-center">
    <form method="POST" action="{{ route('admin.login') }}" class="bg-white rounded-2xl p-10 w-full max-w-sm">
        @csrf
        <h1 class="text-xl font-bold mb-1">YAFNET Admin</h1>
        <p class="text-sm text-gray-500 mb-6">Sign in to manage site content.</p>
        @if($errors->any())
            <div class="bg-red-50 text-red-700 text-sm rounded-lg px-3 py-2 mb-4">{{ $errors->first() }}</div>
        @endif
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2 mb-4 text-sm">
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 mb-4 text-sm">
        <label class="flex items-center gap-2 text-sm mb-6"><input type="checkbox" name="remember"> Remember me</label>
        <button class="w-full bg-[#0B2545] text-white font-semibold py-2.5 rounded-lg">Sign In</button>
    </form>
</body>
</html>
