<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determina si el usuario puede eliminar la tarea.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function show(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function view(User $user, Task $task)
    {
        return $user->id === $task->user_id; // O cualquier lógica que aplique
    }


}

