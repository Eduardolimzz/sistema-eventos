<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- NAV -->
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-lg font-bold text-gray-800">Eventos</a>
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
                <a href="{{ route('events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded">
                    + Criar evento
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Entrar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded">
                        Cadastrar
                    </a>
                @endif
            @endauth
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-10">

        <!-- HERO -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Próximos Eventos</h1>
            <p class="text-gray-500">Descubra eventos, confirme presença e conecte-se com outras pessoas.</p>
        </div>

        <!-- LISTA DE EVENTOS -->
        @forelse ($eventos as $evento)
            @php
                $data = \Carbon\Carbon::parse($evento->data_evento);
            @endphp

            <div class="bg-white rounded shadow-sm mb-4 p-5 flex items-center justify-between gap-4">

                <!-- Data -->
                <div class="text-center bg-gray-100 rounded px-4 py-2 min-w-[60px]">
                    <span class="block text-2xl font-bold text-gray-800 leading-none">{{ $data->format('d') }}</span>
                    <span class="block text-xs text-gray-500 uppercase mt-1">{{ $data->translatedFormat('M') }}</span>
                </div>

                <!-- Info -->
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $evento->title }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ $evento->location }} &middot; {{ $data->format('H:i') }}
                        @if($evento->usuario)
                            &middot; {{ $evento->usuario->name }}
                        @endif
                    </p>
                </div>

                <!-- Ação -->
                @auth
                    @if (in_array($evento->id, $registros ?? []))
                        <span class="bg-gray-200 text-gray-600 text-sm px-4 py-2 rounded">
                            ✔ Confirmado
                        </span>
                    @else
                        <form action="/events/{{ $evento->id }}/confirm" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded">
                                Confirmar
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded">
                        Participar
                    </a>
                @endauth

            </div>

        @empty
            <div class="bg-white rounded shadow-sm p-10 text-center text-gray-500">
                Nenhum evento disponível no momento.
            </div>
        @endforelse

    </div>

</body>
</html>
