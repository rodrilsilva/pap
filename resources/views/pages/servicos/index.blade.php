<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições - Serviços') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
        <div class="flex flex-col w-full gap-4">

            @forelse ($servicos as $servico)
            <div class="flex items-center justify-between px-4 py-3 border border-gray-300 shadow rounded-xl">
                <div class="flex flex-col">
                    <h6 class="font-medium">{{ $servico->nome }}</h6>
                    <p class="text-gray-600">{{ $servico->duracao }} minutos</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 cursor-pointer" onclick="abrir_janela_editar_servico(event, {{ $servico->id }})">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/>
                </svg>
            </div>
            @empty
                <p>Nenhum serviço encontrado.</p>
            @endforelse
        </div>
        <x-primary-button class="w-full md:w-min" onclick="janela_novo_servico_mostrar_janela_criar_servico()">Novo Serviço</x-primary-button>
    </div>
</x-app-layout>

@foreach ($servicos as $servico)
<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id={{"janela_editar_servico_".$servico->id}}>
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="flex items-center text-2xl font-medium text-violet-600 whitespace-nowrap">Editar Serviço <a href="#" class="ml-2 text-sm text-neutral-600" onclick="apagar_servico(event, {{ $servico->id }})">Apagar</a></h2>
            <p class="text-xl font-bold cursor-pointer" onclick="mostrar_janela_editar_servico({{ $servico->id }})">X</p>
        </div>        
        <form class="flex flex-col gap-4" method="POST" action="{{ route('servicos.update', $servico->id) }}">
            @csrf
            @method('PUT')
            {{-- Conteúdo --}}
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="nome_servico">Nome do Serviço</x-input-label>
                    <x-text-input type="text" name="nome" id="nome" placeholder="Nome do Serviço" value="{{ $servico->nome }}" required/>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="duracao">Duração (minutos)</x-input-label>
                    <x-text-input type="number" name="duracao" id="duracao" placeholder="Duração em minutos" value="{{ $servico->duracao }}" required/>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="preco">Preço</x-input-label>
                    <x-text-input type="number" name="preco" id="preco" placeholder="Preço do Serviço" value="{{ $servico->preco }}" required/>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="cor">Cor</x-input-label>
                    <input type="color" name="cor" id="cor" value="{{ $servico->cor }}"/>
                </div>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button onclick="fechar_janela_editar_servico()">Cancelar</x-secondary-button>
                <x-primary-button type="submit">Atualizar Serviço</x-primary-button>
            </div>
        </form>
    </div>
</div>    
@endforeach

<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id="janela_novo_servico">
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="text-2xl font-medium text-violet-600 whitespace-nowrap">Novo Serviço</h2>
            <p id="nova_marcacao" class="text-xl font-bold cursor-pointer" onclick="fechar_janela_novo_servico()">X</p>
        </div>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('servicos.store')}}">
            @csrf
            {{-- Nome do serviço --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="nome_servico">Nome do Serviço</x-input-label>
                <x-text-input type="text" name="nome" id="nome" placeholder="Nome do Serviço" required/>
            </div>
            {{-- Duração --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="duracao">Duração (minutos)</x-input-label>
                <x-text-input type="number" name="duracao" id="duracao" placeholder="Duração em minutos" required/>
            </div>
            {{-- Preço --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="preco">Preço</x-input-label>
                <x-text-input type="number" name="preco" id="preco" placeholder="Preço do Serviço" required/>
            </div>
            {{-- Cor --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="cor">Cor</x-input-label>
                <input type="color" name="cor" id="cor"/>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button onclick="fechar_janela_novo_servico()">Fechar</x-secondary-button>
                <x-primary-button>Criar Serviço</x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
    function mostrar_janela_editar_servico(id) {
        const janela = document.getElementById("janela_editar_servico_" + id);
        janela.classList.toggle("hidden");
    }

    function abrir_janela_editar_servico(event, id) {
        event.stopPropagation(); // Evita que o evento de clique propague para os elementos pai
        mostrar_janela_editar_servico(id);
    }

    function janela_novo_servico_mostrar_janela_criar_servico() {
        const janela = document.getElementById("janela_novo_servico");
        janela.classList.toggle("hidden");
    }

    function fechar_janela_novo_servico() {
        const janela = document.getElementById("janela_novo_servico");
        janela.classList.add("hidden");
    }
</script>
