<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agenda') }}
        </h2>
    </x-slot>
    <div class="m-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-4 md:flex-row">
            <input type="date" class="border rounded-lg border-zinc-300">
            <x-primary-button id="nova_marcacao" class="w-full md:w-min" onclick="mostrar_janela()">Nova Marcação</x-primary-button>
        </div>
    </div>
</x-app-layout>

<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id="janela">
    <div class="relative max-w-2xl p-6 -translate-x-1/2 -translate-y-1/2 bg-white top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between">
            <h2 class="text-2xl font-medium text-violet-600">Nova Marcação</h2>
            <p id="nova_marcacao" class="text-xl font-bold cursor-pointer" onclick="mostrar_janela()">X</p>
        </div>
        <form class="flex flex-col gap-4" method="" action="">
            @csrf
            {{-- Header --}}
            <div class="pb-2 border-b">
                <p class="text-zinc-500">Data</p>
                {{-- Sacas a partir da base de dados e do que for colocado no input(em tempo real claro, se não conseguires, apaga da l. 22 à 26) --}}
                <h6 class="text-lg">Terça-Feira, 26 setembro de 2023</h6>
            </div>
            {{-- Conteúdo --}}
            <div class="flex gap-6">
                <div class="flex flex-col w-full gap-2">
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="dia_marcacao">Dia da marcação</x-input-label>
                            <x-text-input type="date" id="dia_marcacao"/>
                        </div>
                    </div>
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="duracao">Duração</x-input-label>
                            <x-text-input type="time" id="duracao"/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="horario">Horário</x-input-label>
                            <x-text-input type="time" id="horario"/>
                        </div>
                    </div>
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="servico">Serviço</x-input-label>
                            <x-select id="servico">
                                <option value="">Serviço A</option>
                                <option value="">Serviço B</option>
                                <option value="">Serviço C</option>
                                <option value="">Serviço D</option>
                                <option value="">Serviço E</option>
                                <option value="">Serviço F</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="colaborador">Colaborador</x-input-label>
                        <x-select id="colaborador">
                            <option value="">Colaborador A</option>
                            <option value="">Colaborador B</option>
                        </x-select>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-2">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="cliente">Cliente</x-input-label>
                        <x-text-input id="cliente" type="text" placeholder="Carla Lima" />
                        
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="telemovel">Telemovel</x-input-label>
                        <x-text-input id="telemovel" type="text" placeholder="910374391" />
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="email">Email</x-input-label>
                        <x-text-input id="email" type="email" placeholder="carlalima@cabeleireira.com" />
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="nif">NIF</x-input-label>
                        <x-text-input id="nif" type="email" placeholder="18426263" />
                    </div>
                </div>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button>Voltar</x-secondary-button>
                <x-primary-button>Criar Marcação</x-primary-button>
            </div>
        </form>
    </div>
</div>
<script>
   const janela = document.getElementById("janela");

const mostrar_janela = () => {
    janela.classList.toggle("hidden");
};
</script>
