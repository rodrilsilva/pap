<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições - Colaboradores') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
        <div class="flex flex-col w-full gap-4">
            @if(isset($colaboradores))
            @foreach($colaboradores as $colaborador)
            <div class="flex items-center justify-between px-4 py-3 border border-gray-300 shadow rounded-xl">
                <div class="flex flex-col">
                    <h6 class="font-medium">{{ $colaborador->nome }}</h6>
                    <p class="text-gray-600">
                        {{ $colaborador->gen === 1 ? 'Masculino' : ($colaborador->gen === 2 ? 'Feminino' : 'Outro') }}
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 cursor-pointer" onclick="abrir_janela_editar_colaborador(event, {{ $colaborador->id }})">                    
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/>
                </svg>
            </div>
            @endforeach
            @else
            <p>Nenhum colaborador encontrado.</p>
            @endif
        </div>
        <x-primary-button id="novo_colaborador" class="w-full md:w-min" onclick="mostrar_janela_novo_colaborador()">Novo Colaborador</x-primary-button>
    </div>
</x-app-layout>

<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id="janela_novo_colaborador">
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="text-2xl font-medium text-violet-600 whitespace-nowrap">Novo Colaborador</h2>
            <p id="novo_colaborador" class="text-xl font-bold cursor-pointer" onclick="fechar_janela_novo_colaborador()">X</p>
        </div>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('equipa.store')}}">
            @csrf
            {{-- Nome do colaborador --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="nome_colaborador">Nome do Colaborador</x-input-label>
                <x-text-input type="text" name="nome" id="nome" placeholder="Nome do Colaborador" required/>
            </div>
            {{-- Género --}}
            <div class="flex flex-col w-full gap-1">
                <x-input-label for="gen">Género</x-input-label>
                <select name="gen" id="gen" required>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button onclick="fechar_janela_novo_colaborador()">Fechar</x-secondary-button>
                <x-primary-button>Criar Colaborador</x-primary-button>
            </div>
        </form>
    </div>
</div>

@foreach ($colaboradores as $colaborador)
<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id={{"janela_editar_colaborador_".$colaborador->id}}>
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="flex items-center text-2xl font-medium text-violet-600 whitespace-nowrap">Editar Serviço <a href="#" class="ml-2 text-sm text-neutral-600" onclick="apagar_colaborador(event, {{ $colaborador->id }})">Apagar</a></h2>
            <p class="text-xl font-bold cursor-pointer" onclick="mostrar_janela_editar_colaborador({{ $colaborador->id }})">X</p>
        </div>        
        <form class="flex flex-col gap-4" method="POST" action="{{ route('equipa.update', $colaborador->id) }}">
            @csrf
            @method('PUT')
            {{-- Conteúdo --}}
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="nome_colaborador">Nome do Colaborador</x-input-label>
                    <x-text-input type="text" name="nome" id="nome" placeholder="Nome do Colaborador" value="{{ $colaborador->nome }}" required/>
                </div>

                <select name="gen" id="gen" required>
                    <option value="masculino" {{ $colaborador->gen === 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ $colaborador->gen === 2 ? 'selected' : '' }}>Feminino</option>
                    <option value="outro" {{ $colaborador->gen === 0 ? 'selected' : '' }}>Outro</option>
                </select>
                
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button onclick="fechar_janela_editar_colaborador()">Cancelar</x-secondary-button>
                <x-primary-button type="submit">Atualizar Serviço</x-primary-button>
            </div>
        </form>
    </div>
</div>    
@endforeach

<script>
    function mostrar_janela_editar_colaborador(id) {
        const janela = document.getElementById("janela_editar_colaborador_" + id);
        janela.classList.toggle("hidden");
    }

    function abrir_janela_editar_colaborador(event, id) {
        event.stopPropagation(); // Evita que o evento de clique propague para os elementos pai
        mostrar_janela_editar_colaborador(id);
    }
    
    function mostrar_janela_novo_colaborador() {
        const janela = document.getElementById("janela_novo_colaborador");
        if (janela.style.display === "none") {
            janela.style.display = "block";
        } else {
            janela.style.display = "none";
        }
        console.log(janela.style.display === "none");
    }

    function fechar_janela_novo_colaborador() {
        document.getElementById("janela_novo_colaborador").style.display = "none";
    }
</script>