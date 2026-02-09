<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC - Gestão de Produtos Químicos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight">SGPC</h1>
            <div class="space-x-4">
                <a href="{{ route('requests.index') }}" class="hover:underline">Dashboard</a>
                <span class="text-blue-300">|</span>
                <span class="text-sm">Olá, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>