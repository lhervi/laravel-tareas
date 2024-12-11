<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller; // Clase base del controlador
use App\Models\Task;               // Modelo asociado
use Illuminate\Http\Request;       // Para manejar solicitudes HTTP
use Illuminate\Support\Facades\Auth; // Para manejar la autenticación
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Para políticas de autorización




class TaskController extends Controller
{
    /**
     * Muestra una lista de tareas del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         // Obtenemos todas las tareas desde la base de datos
        $tasks = Task::where('user_id', auth()->id())->get();

        // Pasamos las tareas a la vista
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validación de datos
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // Creación de la tarea
        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');

    }

    /**
     * Muestra una tarea específica.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        // Validamos que la tarea pertenezca al usuario autenticado
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    /**
     * Muestra el formulario para editar una tarea.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualiza una tarea en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Elimina una tarea de la base de datos.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */


     public function destroy(Task $task)
    {

        //$this->authorize('delete', $task);
        if (auth()->id() !== $task->user_id) {
            abort(403, 'Unauthorized');
        }

        $task->delete();

        return response()->json(['message' => 'La tarea fue eliminada']);

        //return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }



}
