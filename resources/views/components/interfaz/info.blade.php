<div class="flex text-sm text-gray-600 dark:text-gray-400 space-x-1">
    <p>{{ $etiqueta }}</p>
    <p {{ $attributes->merge(['class' => 'text-sm text-gray-600 dark:text-gray-400 bg-gray-700 border-0']) }}>
        {{ $slot }}
    </p>
</div>
