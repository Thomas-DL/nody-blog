@props([
    'type' => 'button',
    'color' => '',
    'text' => '',
    'size' => '',
    'icon' => '',
    'iconRight' => false,
    'iconLeft' => false,
])

@php
    $color = match ($color) {
        'primary' => 'bg-indigo-600 text-indigo-100 ring-indigo-500/10 hover:bg-indigo-700',
        'gray' => 'bg-gray-600 text-gray-100 ring-gray-500/10 hover:bg-gray-700',
        'info' => 'bg-blue-600 text-blue-100 ring-blue-500/10 hover:bg-blue-700',
        'success' => 'bg-green-600 text-green-100 ring-green-500/10 hover:bg-green-700',
        'warning' => 'bg-yellow-600 text-yellow-100 ring-yellow-500/10 hover:bg-yellow-700',
        'danger' => 'bg-red-600 text-red-100 ring-red-500/10 hover:bg-red-700',
        default => '',
    };
@endphp

@php
    $size = match ($size) {
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base',
        default => 'px-3 py-2 text-sm',
    };
@endphp

<button type="{{ $type }}"
    class="inline-flex items-center rounded-md ring-1 ring-inset hover:shadow-lg transition ease-in-out font-medium {{ $color }} {{ $size }}">
    @if ($iconLeft)
        @svg($icon, 'h-5 w-5 mr-2')
    @endif

    {{ $text ?? $slot }}

    @if ($iconRight)
        @svg($icon, 'h-5 w-5 ml-2')
    @endif
</button>
