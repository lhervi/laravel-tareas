<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT') <!-- Directiva para usar el método HTTP PUT -->

                        <div>
                            <label for="title">Título</label>
                            <input type="text" id="title" name="title" value="{{ $task->title }}" required>
                        </div>
                        <div>
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description">{{ $task->description }}</textarea>
                        </div>
                        <button type="submit">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
