<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="p-6 max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">
            Bem-vindo, {{ Auth::user()->name ?? 'Visitante' }}
        </h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded">
                Sair
            </button>
        </form>
    </div>

    <!-- BOTÃO CRIAR EVENTO -->
    <div class="mb-6">
        <a href="#formEvento" class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-4 py-2 rounded">
            + Criar Novo Evento
        </a>
    </div>

    <!-- FORM CRIAR EVENTO -->
    <div id="formEvento" class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-semibold mb-4">Novo Evento</h2>

        <form action="/events" method="POST">
            @csrf

            <input type="text" name="title" placeholder="Título"
                class="w-full mb-3 px-3 py-2 border rounded">

            <input type="text" name="location" placeholder="Local"
                class="w-full mb-3 px-3 py-2 border rounded">

            <input type="date" name="data_evento"
                class="w-full mb-3 px-3 py-2 border rounded">

            <textarea name="description" placeholder="Descrição"
                class="w-full mb-3 px-3 py-2 border rounded"></textarea>

            <button class="bg-green-500 hover:bg-green-600 transition text-white px-4 py-2 rounded">
                Salvar Evento
            </button>
        </form>
    </div>

    <!-- MEUS EVENTOS -->
    <div class="mb-10">
        <h2 class="text-xl font-bold mb-4">📌 Meus Eventos</h2>

        @isset($meusEventos)
            @forelse ($meusEventos as $evento)
                <div class="bg-white p-4 rounded shadow mb-3">
                    <h3 class="font-bold text-lg">{{ $evento->title }}</h3>
                    <p>{{ $evento->description }}</p>
                    <p class="text-sm text-gray-600">
                        📍 {{ $evento->location }} | 📅 {{ $evento->data_evento }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Você ainda não criou eventos.</p>
            @endforelse
        @else
            <p class="text-gray-400">Eventos ainda não carregados.</p>
        @endisset
    </div>

    <!-- OUTROS EVENTOS -->
    <div>
        <h2 class="text-xl font-bold mb-4">🌍 Outros Eventos</h2>

        @isset($outrosEventos)
            @forelse ($outrosEventos as $evento)
                <div class="bg-white p-4 rounded shadow mb-3">
                    <h3 class="font-bold text-lg">{{ $evento->title }}</h3>
                    <p>{{ $evento->description }}</p>

                    <p class="text-sm text-gray-600">
                        📍 {{ $evento->location }} | 📅 {{ $evento->data_evento }}
                    </p>

                    <p class="text-sm text-indigo-600">
                        Criado por: {{ $evento->user->name ?? 'Desconhecido' }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Nenhum evento disponível.</p>
            @endforelse
        @else
            <p class="text-gray-400">Eventos ainda não carregados.</p>
        @endisset
    </div>

</div>

</body>
</html>
