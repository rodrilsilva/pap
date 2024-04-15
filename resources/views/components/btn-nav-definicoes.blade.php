@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'bg-violet-500 px-4 py-2 rounded-md font-medium text-white border border-transparent hover:bg-violet-500/90 duration-100'
        : 'bg-white px-4 py-2 rounded-md font-medium border hover:bg-gray-50 duration-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
