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
                Bem-vindo, {{ Auth::user()->name }} !
            </h1>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Sair
                </button>
            </form>
        </div>

        <div class="mb-6 flex justify-end">
            <a href="{{ route('events.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                + Criar Novo Evento
            </a>
        </div>

        @php
            $meusEventos = $eventos->where('user_id', auth()->id());
            $outrosEventos = $eventos->where('user_id', '!=', auth()->id());
        @endphp

        {{-- {{ dd($eventos) }} --}}
        <!-- MEUS EVENTOS -->
        <div class="mb-10">
            <h2 class="text-xl font-bold mb-4">Meus Eventos</h2>

            @forelse ($meusEventos as $evento)

                <div class="bg-white p-4 rounded shadow mb-3">
                    <h3 class="font-bold text-lg">{{ $evento->title }}</h3>
                    <p>Descrição: {{ $evento->description }}</p>

                    <p class="text-sm text-gray-600">
                        Local: {{ $evento->location }} <br> Data e hora: {{ $evento->data_evento }}
                    </p>

                    <!-- AÇÕES -->
                    <div class="mt-3 flex gap-2">
                        <a href="/events/{{ $evento->id }}/edit" class="bg-yellow-400 px-3 py-1 rounded text-white">
                            Editar
                        </a>

                        <form action="/events/{{ $evento->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 px-3 py-1 rounded text-white">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Você ainda não criou eventos.</p>
            @endforelse
        </div>

        <!-- OUTROS EVENTOS -->
        <div>
            <h2 class="text-xl font-bold mb-4">Outros Eventos</h2>

            @forelse ($outrosEventos as $evento)
                <div class="bg-white p-4 rounded shadow mb-3">
                    <h3 class="font-bold text-lg">{{ $evento->title }}</h3>
                    <p>{{ $evento->description }}</p>

                    <p class="text-sm text-gray-600">
                        Local: {{ $evento->location }} <br> Data e hora: {{ $evento->data_evento }}
                    </p>

                    <p class="text-sm text-indigo-600">
                        Criado por: {{ $evento->usuario->name ?? 'Desconhecido' }}
                    </p>
                    <p>

                    @if (in_array($evento->id, $registros))
                        <span class="bg-gray-400 px-3 py-1 rounded text-white">
                            ✔ Confirmado
                        </span>
                    @else
                        <form action="/events/{{ $evento->id }}/confirm" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 px-3 py-1 rounded text-white">
                                Confirmar Presença
                            </button>
                        </form>
                    @endif
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Nenhum evento disponível.</p>
            @endforelse
        </div>

    </div>

</body>

</html>
