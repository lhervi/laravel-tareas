<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create new task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:bg-gray-800">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mt-15">
                            <x-input-label for="title" :value="__('Titulo')" />
                            <x-text-input id="title" name="title" type="text"
                                class="mt-2 mb-2  block w-full" />
                            <x-input-error class="mt-2 " :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" class="mt-4" />
                            <x-text-input id="description" name="description" type="textarea"
                                class="mt-2 mb-2 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="due" :value="__('Fecha límite')" class="mt-4" />
                            <x-text-input id="due" name="due" type="date" class="mt-2 mb-2 block w-full"
                                value="{{ date('Y-m-d') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('due')" />
                        </div>

                        <!------------------>

                        <div>
                            <x-input-label for="status" :value="__('Status')" class="mt-4" />
                            <x-select-input id="status" name="status" class="mt-2 mb-2 block w-full"
                                :opciones="json_encode($statuses)" />
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <!-------------------->

                        <input type="hidden" id="due_date" name="due_date" value="{{ date('Y-m-d') }}">

                        <!--
                        <div>
                            <label for="title">Título</label>
                            <input type="text" id="title" name="title" required>
                        </div>

                        <div>
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description"></textarea>
                        </div>

                    -->
                        <div class="mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                        <!--
                        <button type="submit">Guardar</button>
                        -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
