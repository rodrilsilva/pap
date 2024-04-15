<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <div class="m-auto space-y-6 max-w-7xl">
        <div class="flex justify-between">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-medium text-violet-600">Nº de clientes</h2>
                    <x-pill>{{ $numeroClientes }} clientes</x-pill>
                </div>
            </div>
            <x-primary-button id="nova_marcacao" class="w-full md:w-min" onclick="mostrar_janela_criar_cliente()">Novo cliente</x-primary-button>
        </div>
        <table class="w-full">
            <thead class="border-b">
                <tr>
                    <th class="pb-2 text-start">Nome</th>
                    <th class="pb-2 text-start">Telefone</th>
                    <th class="pb-2 text-start">Email</th>
                    <th class="pb-2 text-start">Proxima Visita</th>
                    <th class="pb-2 text-start">Marcações</th>
                    
                </tr>
            </thead>
            
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr class="border-b">
                        <td class="py-2">{{ $cliente->nome }}</td>
                        <td class="py-2">{{ $cliente->tlm }}</td>
                        <td class="py-2">{{ $cliente->email }}</td>
                        <td class="py-2">{{ $proximasMarcacoes[$cliente->id] ?? '-' }}</td>
                        <td class="py-2">{{ $numeroMarcacoes[$cliente->id] ?? 0 }}</td>
                        <td class="py-2">
                            <a onclick="showEditModal(@php(Print($cliente->id)))" class="editar-cliente bg-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13" height="13" class="editar-cliente">
                                    <path fill="#8A2BE2" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                </svg> 
                            </a>                             
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            
        </table>
    </div>
</x-app-layout>

<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id="janela_novo_cliente">
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="text-2xl font-medium text-violet-600 whitespace-nowrap">Novo Cliente</h2>
            <p id="nova_marcacao" class="text-xl font-bold cursor-pointer" onclick="mostrar_janela_criar_cliente()">X</p>
        </div>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('clientes.store')}}">
            @csrf
            {{-- Conteúdo --}}
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="cliente">Nome</x-input-label>
                    <x-text-input type="text" name="nome" id="nome" placeholder="Primeiro e ultimo nome" required/>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="email">Email</x-input-label>
                    <x-text-input type="email" name="email" id="email" placeholder="Email"/>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="telefone">Telefone</x-input-label>
                        <x-text-input type="text" name="tlm" id="tlm" placeholder="Numero de Telefone"/>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="nif">NIF</x-input-label>
                        <x-text-input type="text" name="nif" id="nif" placeholder="PT123456789"/>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="data_nascimento">Data de Nascimento</x-input-label>
                        <x-text-input type="date" name="dh" id="dh"/>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="obs">Observações</x-input-label>
                    <x-textarea class="resize-none" name="observacoes" id="observacoes" placeholder="Observações"></x-textarea>
                </div>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button>Voltar</x-secondary-button>
                <x-primary-button>Criar Cliente</x-primary-button>
            </div>
        </form>
    </div>
</div>

@forelse ($clientes as $item)
<div class="absolute inset-0 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id={{"janela_editar_cliente_".$item->id}}>
    <div class="relative p-6 -translate-x-1/2 -translate-y-1/2 bg-white w-[500px] top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between pb-2 mb-2 border-b">
            <h2 class="flex items-center text-2xl font-medium text-violet-600 whitespace-nowrap">Editar Cliente <a href="#" class="ml-2 text-sm text-neutral-600" onclick="apagar_cliente(event, {{ $item->id }})">Apagar</a></h2>
            <p class="text-xl font-bold cursor-pointer" onclick="showEditModal(@php(Print($item->id)))">X</p>
        </div>        
        <form class="flex flex-col gap-4" method="POST" action="{{ route('clientes.update', $item->id) }}">
            @csrf
            @method('PUT')
            {{-- Conteúdo --}}
            <div class="flex flex-col gap-4">
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="cliente">Nome</x-input-label>
                    <x-text-input type="text" name="nome" id="nome" placeholder="Primeiro e último nome" value="{{ $item->nome }}" required/>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="email">Email</x-input-label>
                    <x-text-input type="email" name="email" id="email" placeholder="Email" value="{{ $item->email }}" required/>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="telefone">Telefone</x-input-label>
                        <x-text-input type="text" name="tlm" id="tlm" placeholder="Número de Telefone" value="{{ $item->tlm }}"/>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="nif">NIF</x-input-label>
                        <x-text-input type="text" name="nif" id="nif" placeholder="Número de identificação fiscal" value="{{ $item->nif }}"/>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="data_nascimento">Data de Nascimento</x-input-label>
                        <x-text-input type="date" name="dh" id="dh" value="{{ $item->dh }}"/>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <x-input-label for="obs">Observações</x-input-label>
                    <x-textarea class="resize-none" name="observacoes" id="observacoes" placeholder="Observações">{{ $item->observacoes }}</x-textarea>
                </div>
            </div>
            {{-- Footer --}}
            <div class="flex gap-4 pt-4 border-t">
                <x-secondary-button onclick="fechar_janela_editar_cliente()">Cancelar</x-secondary-button>
                <x-primary-button type="submit">Atualizar Cliente</x-primary-button>
            </div>
        </form>
    </div>
</div>    
@empty
    nope!
@endforelse




<script>
    const janela = document.getElementById("janela_novo_cliente");

  function mostrar_janela(id) {
    if(document.getElementById("janela_editar_cliente_"+id).style.display == "none"){
         document.getElementById("janela_editar_cliente_"+id).style.display = "block"
        }else{ 
         document.getElementById("janela_editar_cliente_"+id).style.display = "none"
        }
        console.log(document.getElementById("janela_editar_cliente_"+id).style.display == "none")
 };
 
 function mostrar_janela_criar_cliente(){

    if(document.getElementById("janela_novo_cliente").style.display == "none"){
         document.getElementById("janela_novo_cliente").style.display = "block"
        }else{ 
         document.getElementById("janela_novo_cliente").style.display = "none"
        }    
        console.log(document.getElementById("janela_editar_cliente_"+id).style.display == "none")

 }
 </script>

<script>
    function fechar_janela_editar_cliente() {
        document.getElementById("janela_editar_cliente").style.display = "hidden";
    }
</script>

<script>
// Seletor para os ícones de lápis
const iconesEditarCliente = document.querySelectorAll('.editar-cliente');


function showEditModal(id) {
    mostrar_janela(id)
    console.log(id);

    
}

// Adiciona um evento de clique a cada ícone de lápis

</script>



<script>
    function apagar_cliente(event, id) {
    event.preventDefault(); // Para evitar o comportamento padrão do link
    if (confirm('Tem certeza que deseja apagar este cliente?')) {
        // Envie uma requisição AJAX para o endpoint de exclusão do cliente
        fetch(`/clientes/${id}`, {  // Use o ID passado como parâmetro
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // Se a exclusão foi bem-sucedida, recarregue a página para atualizar a lista de clientes
                window.location.reload();
            } else {
                // Se houve um erro ao excluir o cliente, mostre uma mensagem de erro
                alert('Erro ao apagar o cliente. Por favor, tente novamente.');
            }
        })
        .catch(error => {
            console.error('Ocorreu um erro:', error);
            alert('Ocorreu um erro ao processar a sua solicitação. Por favor, tente novamente.');
        });
    }
}

</script>
