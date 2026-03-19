<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="w-96 mb-4">
    <a href="/" class="text-sm text-gray-500 hover:text-gray-800">← Voltar ao início</a>
</div>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-6 text-center">Login</h2>

        <!-- ERROS -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="/login" method="POST">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100"
                    placeholder="seuemail@exemplo.com"
                    required
                >
            </div>

            <!-- SENHA -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Senha</label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100"
                    placeholder="••••••••"
                    required
                >
            </div>

            <!-- BOTÃO -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white rounded-md py-2 px-4 hover:bg-indigo-700"
                >
                    Entrar
                </button>
            </div>

        </form>
        <p class="text-center text-sm text-gray-600 mt-4">
            Não tem conta? <a href="/register" class="text-indigo-600 hover:underline">Cadastrar</a>
        </p>
    </div>

</body>
</html>
