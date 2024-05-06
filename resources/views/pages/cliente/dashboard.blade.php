<x-app-layout>
    <x-slot name="header" class="hidden">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('includes.dashboard-cliente')
</x-app-layout>