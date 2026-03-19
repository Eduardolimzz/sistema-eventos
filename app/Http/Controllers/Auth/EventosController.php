<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventosController extends Controller
{

    public function index()
{
    $eventos = Evento::with('usuario')->latest()->get();
    $registros = Registro::where('user_id', Auth::id())
        ->pluck('evento_id')
        ->toArray();

    return view('events.dashboard', compact('eventos', 'registros'));
}
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'data_evento' => 'required|date',
        ]);

        Evento::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'data_evento' => $request->data_evento,
            'max_participantes' => $request->max_participantes,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('events.index');
    }
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);

        return view('events.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $evento->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'data_evento' => $request->data_evento,
            'max_participantes' => $request->max_participantes,
        ]);

        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        $evento->delete();

        return redirect()->route('events.index');
    }

    public function confirmarPresenca(Request $request, $id)
    {
        $userId = Auth::id();
        $eventoId = $id;

        // Verifica se já existe registro
        $jaExiste = Registro::where('user_id', $userId)
            ->where('evento_id', $eventoId)
            ->exists();

        if ($jaExiste) {
            return redirect()->route('dashboard')
                ->with('error', 'Você já está inscrito neste evento.');
        }

        // Cria o registro
        Registro::create([
            'user_id' => $userId,
            'evento_id' => $eventoId,
            'status' => 'confirmado',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Inscrição realizada com sucesso!');
    }
}
