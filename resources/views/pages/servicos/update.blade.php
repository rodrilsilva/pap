<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições - Serviços') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
        <div class="flex flex-col w-full gap-4">
            <h4 class="text-xl font-medium">Serviços</h4>
            <div class="flex items-center justify-between px-2 py-1 border rounded-lg border-neutral-200">
                <div class="flex flex-col">
                    <h6>Corte Cabelo Mulher</h6>
                    <p>60 minutos</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/>
                </svg>
            </div>
        </form>
    </div>
</x-app-layout>
