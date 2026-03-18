<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Criar Evento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-xl mx-auto p-6 bg-white mt-10 rounded shadow">

        <h1 class="text-xl font-bold mb-4">Criar Evento</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <input type="text" name="title" placeholder="Título" class="w-full mb-3 px-3 py-2 border rounded">

            <input type="text" name="location" placeholder="Local" class="w-full mb-3 px-3 py-2 border rounded">

            <input type="datetime-local" name="data_evento" class="w-full mb-3 px-3 py-2 border rounded">

            <input type="number" name="max_participantes" placeholder="Máx participantes"
                class="w-full mb-3 px-3 py-2 border rounded">

            <textarea name="description" placeholder="Descrição" class="w-full mb-3 px-3 py-2 border rounded"></textarea>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Salvar
            </button>
        </form>

    </div>

</body>

</html>
