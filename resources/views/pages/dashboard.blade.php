<x-app-layout>
    <x-slot name="header" class="hidden">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex flex-col gap-6 m-auto lg:grid-rows-3 lg:grid-cols-3 lg:grid max-w-7xl">
            {{-- Dinheiro Faturado --}}
            <div class="flex flex-col w-full col-span-1 gap-4 p-4 bg-white border border-gray-200 shadow-sm rounded-xl">
                <div class="flex items-center justify-center p-2.5 rounded-full bg-gradient-to-b from-purple-500 to-violet-600 w-min">
                    <x-icons.dinheiro />
                </div>
                <div class="flex flex-col">
                    <p class="text-zinc-500 ">Dinheiro Faturado</p>
                    <h4 class="text-4xl font-black">{{ $dinheiroFaturado }}</h4>
                </div>
            </div>
            {{-- Clientes --}}
            <div class="flex flex-col w-full col-span-1 gap-4 p-4 bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-b from-purple-500 to-violet-600 w-min">
                    <x-icons.clientes />
                </div>
                <div class="flex flex-col">
                    <p class="text-zinc-500 ">Clientes</p>
                    <h4 class="text-4xl font-black">{{ $numeroClientes }}</h4>
                </div>
            </div>
            {{-- Marcações --}}
            <div class="flex flex-col w-full col-span-1 gap-4 p-4 bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-b from-purple-500 to-violet-600 w-min">
                    <x-icons.marcacoes />
                </div>
                <div class="flex flex-col">
                    <p class="text-zinc-500">Marcações</p>
                    <h4 class="text-4xl font-black">{{ $numeroMarcacoes }}</h4>
                </div>
            </div>
            {{-- TBD --}}
            <div class="flex flex-col w-full col-span-2 row-span-2 gap-4 p-4 bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-b from-purple-500 to-violet-600 w-min">
                    <x-icons.marcacoes />
                </div>
                <div class="flex flex-col">
                    <p class="text-zinc-500">ans</p>
                    <h4 class="text-4xl font-black">ans</h4>
                </div>
            </div>
            {{-- TBD --}}
<div class="flex flex-col w-full col-span-1 row-span-2 gap-4 p-4 mb-4 bg-white border border-gray-200 shadow-sm rounded-2xl md:mb-6 lg:mb-0">
    <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-b from-purple-500 to-violet-600 w-min">
        <x-icons.cliente />
    </div>
    <div class="flex flex-col gap-3.5">
        <div class="flex flex-col gap-1.5">
            <p class="text-zinc-500">Proximo Cliente</p>
            <div class="flex gap-2">
                <x-application-logo />
                    @if ($proximaMarcacao && $proximaMarcacao->tipoServico)
                        <p class="font-medium text-zinc-900">{{ $proximaMarcacao->tipoServico->nome }}</p>
                            @else
                            <p class="font-medium text-zinc-900">Sem próximo serviço agendado.
                        </p>
                    @endif            
                </div>
        </div>
        <div class="flex gap-2">
            
            <div class="flex flex-col w-full gap-1.5">
                <p class="text-zinc-500">Colaborador</p>
                <div class="flex items-center gap-2">
                    <!-- Substituído pelo seu SVG de usuário -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 text-zinc-900">
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                    </svg>
                    @if ($proximaMarcacao && $proximaMarcacao->tipoServico)
                        <p class="font-medium text-zinc-900">{{ $proximaMarcacao->colaborador->nome }}</p>
                            @else
                            <p class="font-medium text-zinc-900">
                        </p>
                    @endif  
                </div>
            </div>
            <div class="flex flex-col w-full gap-1.5">
                <p class="text-zinc-500">Cliente</p>
                <div class="flex items-center gap-2">
                    <!-- Substituído pelo seu SVG de usuário -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 text-zinc-900">
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                    </svg>
                    @if ($proximaMarcacao && $proximaMarcacao->tipoServico)
                        <p class="font-medium text-zinc-900">{{ $proximaMarcacao->cliente->nome }}</p>
                            @else
                            <p class="font-medium text-zinc-900">
                        </p>
                    @endif  
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <p class="text-zinc-500">Data e hora de marcação</p>
            <div class="flex gap-2">
                <x-icons.calendario />
                @if ($proximaMarcacao && $proximaMarcacao->tipoServico)
                        <p class="font-medium text-zinc-900">{{ $proximaMarcacao->data_hora }}</p>
                            @else
                            <p class="font-medium text-zinc-900">
                        </p>
                    @endif  
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <p class="text-zinc-500">Descrição</p>
            <div class="flex gap-2">
                <x-icons.lapis />
                @if ($proximaMarcacao && $proximaMarcacao->tipoServico)
                        <p class="font-medium text-zinc-900">{{ $proximaMarcacao->obs }}</p>
                            @else
                            <p class="font-medium text-zinc-900">
                        </p>
                    @endif  
            </div>
        </div>
    </div>
</div>

    </div>
</x-app-layout>
{{--
    <div class="flex flex-col">
        <p class="text-zinc-500">Próxima Marcação</p>
        <div class="flex items-center gap-2">
            <p class="text-sm text-zinc-900">Rodrigo Silva</p>
            {{-- Mudar cor conforme o género
            <x-pill class="text-white bg-blue-400 border-blue-400">Masculino</x-pill>
        </div>
    </div>
--}}
