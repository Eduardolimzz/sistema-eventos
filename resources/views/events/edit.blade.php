<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-xl mx-auto p-6 bg-white mt-10 rounded shadow">

        <h1 class="text-xl font-bold mb-4">Editar evento</h1>

        <form action="{{ route('events.update', ['event' => $evento->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ $evento->title }}" class="w-full mb-3 px-3 py-2 border rounded">

            <input type="text" name="location" value="{{ $evento->location }}"
                class="w-full mb-3 px-3 py-2 border rounded">

            <input type="datetime-local" name="data_evento"
                value="{{ \Carbon\Carbon::parse($evento->data_evento)->format('Y-m-d\TH:i') }}"
                class="w-full mb-3 px-3 py-2 border rounded">

            <input type="number" name="max_participantes" value="{{ $evento->max_participantes }}"
                class="w-full mb-3 px-3 py-2 border rounded">

            <textarea name="description" class="w-full mb-3 px-3 py-2 border rounded">{{ $evento->description }}</textarea>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Atualizar
            </button>
        </form>

    </div>

</body>

</html>
