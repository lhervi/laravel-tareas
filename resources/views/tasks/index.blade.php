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
                                    <h4 class="text-lg font-semibold">{{ $task->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Due date: {{ $task->due_date ?? 'none' }}
                                    </p>
                                    <!-- Buttons for edit and delete -->
                                    <button onclick="openEditModal({{ $task->id }}, '{{ $task->title }}')"
                                        class="text-blue-500 hover:underline">Edit</button>
                                    <button onclick="deleteTask({{ $task->id }})"
                                        class="text-red-500 hover:underline">Delete</button>
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
            <h2 class="text-xl font-semibold">Edit Task</h2>
            <form id="edit-form" onsubmit="submitEdit(event)">
                <input type="hidden" id="edit-task-id">
                <label for="edit-title" class="block text-sm">Title</label>
                <input type="text" id="edit-title" class="w-full p-2 border rounded mb-4">
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
