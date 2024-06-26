@if(session('success'))
    <div class="p-4 mb-4 text-white bg-green-600 rounded-md">
        <p>{{ session('success') }}</p>
    </div>
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carla Cabeleireiros</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen bg-neutral-50">
    <header class="fixed flex items-center justify-between w-full h-16 px-6 border-b z-100 lg:px-24">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo />
            <h4 class="text-xl font-medium whitespace-nowrap">Carla Lima</h4>
        </a>
        <div class="space-y-2">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-neutral-600 hover:text-neutral-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-violet-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-neutral-600 hover:text-neutral-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-violet-500">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-neutral-600 hover:text-neutral-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-violet-500">Registo</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
    <main class="grid items-center justify-center w-full h-full overflow-hidden">
        <section class="grid p-6 space-y-4 place-content-center">
            <div class="space-y-1 text-center">
                <h4 class="text-2xl text-neutral-900">Realizar Marcação</h4>
                <p class="text-neutral-500">Deseja realizar uma marcação? Vamos a isso!</p>
            </div>
            <form class="space-y-2" action="{{ route('marcacao.store') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-4 lg:flex-row">
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-96">
                        <div class="flex flex-col gap-0.5 font-medium">
                            <label for="nome">Nome <span class="text-red-500">*</span></label>
                            <input id="nome" name="nome" type="text" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500" />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <label for="tlm">Telemóvel <span class="text-red-500">*</span></label>
                            <input id="tlm" name="tlm" type="text" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500" />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <label for="email">Email <span class="text-red-500">*</span></label>
                            <input id="email" name="email" type="email" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500" />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <label for="data">Data da Marcação <span class="text-red-500">*</span></label>
                            <input id="data" name="data" type="date" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500" />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <label for="servico">Serviço <span class="text-red-500">*</span></label>
                            <select name="servico" id="servico" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500">
                                <option value="" disabled selected>Escolha um serviço</option>
                                @foreach($servicos as $servico)
                                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-[512px]" id="horarios-disponiveis">
                        <select id="horarioSelecionado" class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500">
                            <option value="" disabled selected>Escolha uma hora</option>
                            <input type="hidden" id="horaSelecionada" name="hora" />
                        </select>
                    </div>
                </div>
                <button type="submit" class="p-2.5 py-2 rounded-lg bg-violet-500 text-white">Submeter</button>
            </form>
        </section>
    </main>
    <div class="relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="650" height="650" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="absolute select-none -z-10 lucide lucide-scissors bottom-1 left-4 stroke-[#efefef]">
            <circle cx="6" cy="6" r="3"/>
            <path d="M8.12 8.12 12 12"/>
            <path d="M20 4 8.12 15.88"/>
            <circle cx="6" cy="18" r="3"/>
            <path d="M14.8 14.8 20 20"/>
        </svg>
    </div>
    <script>
        document.getElementById('data').addEventListener('change', function() {
            carregarHorariosDisponiveis();
        });

        document.getElementById('servico').addEventListener('change', function() {
            carregarHorariosDisponiveis();
        });

        function carregarHorariosDisponiveis() {
            let dataSelecionada = document.getElementById('data').value;
            let servicoSelecionado = document.getElementById('servico').value;

            if (dataSelecionada && servicoSelecionado) {
                fetch(`/horarios-disponiveis?data=${dataSelecionada}&servico=${servicoSelecionado}`)
                .then(response => response.json())
                .then(data => {
                    let horariosDisponiveisSelect = document.getElementById('horarioSelecionado');
                    horariosDisponiveisSelect.innerHTML = '<option value="" disabled selected>Escolha uma hora</option>';

                    if (data.length > 0) {
                        data.forEach(function(horario) {
                            let option = document.createElement('option');
                            option.text = horario;
                            option.value = horario;
                            horariosDisponiveisSelect.appendChild(option);
                        });
                    } else {
                        let mensagem = document.createElement('option');
                        mensagem.text = 'Não há horários disponíveis para este dia ou serviço.';
                        horariosDisponiveisSelect.appendChild(mensagem);
                    }
                })
                .catch(function (error) {
                    console.error('Erro ao buscar horários disponíveis:', error);
                });
            }
        }

        document.getElementById('horarioSelecionado').addEventListener('change', function() {
            document.getElementById('horaSelecionada').value = this.value;
        });
    </script>
</body>
</html>
