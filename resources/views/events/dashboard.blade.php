<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="p-6">

        @php
            $user = \App\Models\Usuario::find(session('usuario_id'));
        @endphp

        <h1 class="text-2xl font-bold mb-4">
            Bem-vindo, {{ $user->name }}
        </h1>

        <p class="mb-6">Você está logado no sistema </p>

        <a href="/logout" class="bg-red-500 text-white px-4 py-2 rounded">
            Sair
        </a>

    </div>

</body>
</html>
