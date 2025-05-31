<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Task list content -->
                    @if ($tasks->isEmpty())
                        <p>No task found. Create a new one!</p>
                    @else
                        <ul id="task-list" class="space-y-4 space-x-4">
                            @foreach ($tasks as $task)
                                <li id="task-{{ $task->id }}"
                                    class="p-4 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">

                                    <h4 esTitulo class="text-lg font-semibold">{{ $task->title }}</h4>

                                    <x-interfaz.info esFecha etiqueta="Vence: ">
                                        {{ $task->due_date ?? 'none' }}
                                    </x-interfaz.info>


                                    <x-interfaz.info esStatus etiqueta="Estatus: ">
                                        {{ $task->status ?? 'none' }}
                                    </x-interfaz.info>

                                    <div class="flex space-x-2">
                                        <x-interfaz.edit data-edit-task="{{ $task->id }}">
                                        </x-interfaz.edit>

                                        <button data-delete-task="{{ $task->id }}"
                                            class="text-red-500 hover:underline">
                                            Delete
                                        </button>

                                    </div>


                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg">
            <h2 class="text-xl font-semibold dark: text-gray-400">Edit Task</h2>
            <form id="edit-form" onsubmit="submitEdit(event)">
                <input type="hidden" id="edit-task-id">
                <label for="edit-title" class="block text-sm  dark: text-gray-300 bg-gray-800">Title</label>
                <input type="text" id="edit-title"
                    class="w-full p-2 border rounded mb-4  dark: text-gray-100 bg-gray-800">

                <label for="edit-description" class="block text-sm  dark: text-gray-300 bg-gray-800">Descripción</label>
                <textarea id="edit-description" class="w-full p-2 border rounded mb-4  dark: text-gray-100 bg-gray-800">
                </textarea>

                <label for="edit-due-date" class="block text-sm  dark: text-gray-300 bg-gray-800">Fecha</label>
                <input type="date" id="edit-due-date"
                    class="w-full p-2 border rounded mb-4  dark: text-gray-100 bg-gray-800">

                <label for="edit-status" class="block text-sm  dark: text-gray-300 bg-gray-800">Status</label>
                <select id="edit-status" class="w-full p-2 border rounded mb-4  dark: text-gray-100 bg-gray-800">

                </select id="edit-status">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>
                <button type="button" onclick="closeEditModal()"
                    class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->

    @vite('resources/js/tasks/edit.js')
    @vite('resources/js/tasks/delete.js')


</x-app-layout>
