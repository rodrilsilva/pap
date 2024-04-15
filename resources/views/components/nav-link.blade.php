@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 border-b-2 border-violet-500 font-medium text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-violet-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
