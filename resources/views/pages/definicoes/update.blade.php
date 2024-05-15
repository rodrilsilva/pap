<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
        <form class="flex flex-col w-full gap-4" method="POST" action="{{ route('definicoes.save') }}">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="nome">Nome</x-input-label>
                    <x-text-input type="text" id="nome" name="nome" value="{{ $configuracoes->nome ?? '' }}"/>
                </div>
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="telefone">Telemovel</x-input-label>
                        <x-text-input type="text" id="telefone" name="telefone" value="{{ $configuracoes->telefone ?? '' }}"/>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="telemovel">Telemovel</x-input-label>
                        <x-text-input type="text" id="telemovel" name="telemovel" value="{{ $configuracoes->telemovel ?? '' }}"/>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="morada">Morada</x-input-label>
                    <x-text-input type="text" id="morada" name="morada" value="{{ $configuracoes->morada ?? '' }}"/>
                </div>
            </div>
            <div class="flex gap-4 pt-4">
                <x-primary-button type="submit">Guardar</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>



