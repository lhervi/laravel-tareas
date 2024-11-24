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
                    @if (@task->isEmpty())
                        <p>No task found. Create a new one!</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($tasks as $task)
                                <li class="p-4 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                                    <h4 class="text-lg font-semibold">{{ task->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Due date: {{ $task->due_date->format('M d, Y') }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
