<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agenda') }}
        </h2>
    </x-slot>
    <div class="m-auto max-w-7xl">
        <x-primary-button id="nova_marcacao" class="md:absolute m-2 md:m-0 w-full md:w-min left-[28%]" onclick="mostrar_janela()">Nova Marcação</x-primary-button>
        <div id="calendar" class="w-full h-[632px]"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                nowIndicator: true,
                initialView: 'timeGridDay',
                timeZone: 'GMT+1',
                events: '/events',
                editable: true,
                eventColor: 'color',
                slotDuration: '00:30:00',
                slotLabelInterval: '01:00:00',
                slotEventOverlap: false,
                slotMinTime: '08:30:00',
                slotMaxTime: '19:00:00',
                slotLabelInterval: '00:30:00',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventContent: function (info) {
                    var eventTitle = info.event.title;
                    var eventElement = document.createElement('div');
                    eventElement.innerHTML = '<span style="cursor:pointer;">❌</span>' + eventTitle;

                    eventElement.querySelector('span').addEventListener('click', function () {
                        if (confirm("Você tem certeza que deseja apagar este evento?")) {
                            var eventId = info.event.id;
                            $.ajax({
                                method: 'DELETE',
                                url: '/agenda/' + eventId,
                                success: function (response) {
                                    console.log('Evento apagado');
                                    calendar.refetchEvents();
                                },
                                error: function (error) {
                                    console.log('Erro ao apagar o evento', error);
                                }
                            });
                        }
                    });
                    return {
                        domNodes: [eventElement]
                    };
                },
                eventDrop: function(info) {
                    var eventId = info.event.id;
                    var newStartDate = info.event.start;
                    var newEndDate = info.event.end || newStartDate;
                    
                    var newStartDateUTC = newStartDate.toISOString();
                    var newEndDateUTC = newEndDate.toISOString();

                    $.ajax({
                        method: 'PUT',
                        url: '/agenda/' + eventId,
                        data: {
                            start_date: newStartDateUTC,
                            end_date: newEndDateUTC
                        },
                        success: function() {
                            console.log('Marcação movida com sucesso');
                        },
                        error: function(error) {
                            console.log('Erro ao mover a marcação', error);
                        }
                    });
                }
            });

            calendar.render();

            const janela = document.getElementById("janela");

            const mostrar_janela = () => {
                console.log("Clicou no botão Nova Marcação");
                janela.classList.toggle("hidden");
            };
        });
    </script>
</x-app-layout>

<div class="absolute inset-0 z-50 hidden w-full h-screen p-4 bg-zinc-600/50 backdrop-blur-sm" id="janela">
    <div class="relative max-w-2xl p-6 -translate-x-1/2 -translate-y-1/2 bg-white top-1/2 left-1/2 border-neutral-200 rounded-2xl">
        <div class="flex justify-between">
            <h2 class="text-2xl font-medium text-violet-600">Nova Marcação</h2>
            <p id="nova_marcacao" class="text-xl font-bold cursor-pointer" onclick="mostrar_janela()">X</p>
        </div>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('agenda.store')}}">
            @csrf
            {{-- Conteúdo --}}
            <div class="flex gap-6">
                <div class="flex flex-col w-full gap-2">
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="data_hora">Dia da marcação</x-input-label>
                            <x-text-input type="datetime-local" id="data_hora" name="data_hora"/>
                        </div>
                    </div>
                    <div class="flex w-full gap-4">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="servico">Serviço</x-input-label>
                            <x-select name="servico_id" id="servico">
                                <option value="">Selecione um serviço</option>
                                @foreach($servicos as $servico)
                                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="colaborador">Colaborador</x-input-label>
                        <x-select name="colaborador_id" id="colaborador">
                            <option value="" disabled>Selecione um colaborador</option>
                            @foreach($colaboradores as $colaborador)
                                <option value="{{ $colaborador->id }}">{{ $colaborador->nome }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="cliente">Cliente</x-input-label>
                        <input type="hidden" name="cliente_id" id="cliente_id" value="" />
                        <x-text-input id="cliente" type="text" placeholder="Nome do Cliente" />
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


<script>
    const clientes = {!! json_encode($clientes) !!}; // Converte os clientes do PHP para JavaScript
    const inputCliente = document.getElementById('cliente');
    const clienteIdInput = document.getElementById('cliente_id'); // Adicionado para armazenar o ID do cliente
    const listaClientes = document.createElement('ul');
    listaClientes.classList.add('hidden', 'absolute', 'z-60', 'w-auto', 'border', 'border-gray-300', 'bg-white', 'rounded-md', 'shadow-lg', 'overflow-y-auto', 'max-h-40', 'text-sm');

    inputCliente.addEventListener('input', (event) => {
        const termo = event.target.value.toLowerCase();
        const clientesFiltrados = clientes.filter(cliente => cliente.nome.toLowerCase().includes(termo));

        // Limpar lista anterior
        listaClientes.innerHTML = '';

        // Adicionar clientes filtrados à lista
        clientesFiltrados.forEach(cliente => {
            const item = document.createElement('li');
            item.textContent = cliente.nome;
            item.classList.add('px-3', 'py-1', 'hover:bg-gray-100', 'cursor-pointer');

            item.addEventListener('click', () => {
                inputCliente.value = cliente.nome;
                clienteIdInput.value = cliente.id; // Armazena o ID do cliente
                listaClientes.classList.add('hidden');
            });

            listaClientes.appendChild(item);
        });

        // Mostrar lista de clientes filtrados
        if (clientesFiltrados.length > 0) {
            listaClientes.classList.remove('hidden');
        } else {
            listaClientes.classList.add('hidden');
        }
    });

    // Adicionar lista de clientes filtrados ao DOM
    inputCliente.parentNode.appendChild(listaClientes);
</script>
