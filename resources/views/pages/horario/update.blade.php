<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições - Horário') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
    </div>
</x-app-layout>
