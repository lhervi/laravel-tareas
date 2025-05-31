<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller; // Clase base del controlador
use App\Models\Task;               // Modelo asociado
use Illuminate\Http\Request;       // Para manejar solicitudes HTTP
use Illuminate\Support\Facades\Auth; // Para manejar la autenticación
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Para políticas de autorización
use App\Rules\ValidStatus;


class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Muestra una lista de tareas del usuario autenticado .
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
        $statuses = Task::STATUSES;
        return view('tasks.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos

        $validated = $request->validate([
            'title' =>  'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => ['required', new ValidStatus],
        ]);

        // Creación de la tarea
        $task = new Task;
        $task->fill($validated);
        $task->user_id = Auth::id(); // Asignación manual
        $task->save();

        return redirect()->route('tasks.index', )->with('success', 'Task created successfully.');

    }

    /**
     * Muestra una tarea específica.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */


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


    // *********************************************************

    public function show(Task $task)
    {

        $taskInfo = [
            'edit-task-id' => $task->id,
            'edit-title' => $task->title,
            'edit-description' => $task->description,
            'edit-status' => $task->status,
            'edit-due-date' => $task->due_date,
            'statuses' => $statuses = Task::STATUSES
        ];

        return response()->json($taskInfo);

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

        $a=5;

        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' =>  'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => ['required', new ValidStatus],
        ]);

        $task->update($validated);

        //return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        //return redirect()->route('tasks.index')->with(['success'=> 'Task updated successfully.']);
        return response()->json(['success' => 'Task updated successfully.']);
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

        return response()->json(['success' => 'Task updated successfully.', 'ok'=> true]);

        //return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');

        //return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function statuses()
    {
        return response()->json(['statuses' => Task::STATUSES]);
    }

}
