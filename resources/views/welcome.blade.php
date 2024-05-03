<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carla Cabeleireiros</title>
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen bg-neutral-50">
    <header class="fixed flex items-center justify-between w-full h-16 px-6 border-b z-100 lg:px-24">
        <a href="{{ route('dashboard') }}"  class="flex items-center gap-2">
            <x-application-logo />
            <h4 class="text-xl font-medium whitespace-nowrap">Carla Lima</h4>
        </a>
        <div class="space-y-2">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class=" text-neutral-600 hover:text-neutral-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-violet-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class=" text-neutral-600 hover:text-neutral-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-violet-500">Log in</a>
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
                            <x-input-label for="nome">Nome <span class="text-red-500">*</span></x-input-label>
                            <x-text-input id="nome" name="nome" required />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="tel">Telemóvel <span class="text-red-500">*</span></x-input-label>
                            <x-text-input type="tel" id="tel" name="tel" required />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="email">Email <span class="text-red-500">*</span></x-input-label>
                            <x-text-input type="email" id="email" name="email" required />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="data">Data da Marcação <span class="text-red-500">*</span></x-input-label>
                            <input type="date" id="data" name="data" required />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="servico">Serviço <span class="text-red-500">*</span></x-input-label>
                            <x-select name="servico" id="servico" required>
                                <option value="" disabled selected>Escolha um serviço</option>
                                @foreach($servicos as $servico)
                                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-[512px]" id="horarios-disponiveis">
                        <!-- Aqui serão exibidos os horários disponíveis -->
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
            let dataSelecionada = this.value;
            // Envie uma solicitação AJAX ao servidor para buscar os horários disponíveis para a data selecionada
            // Atualize o conteúdo da div "horarios-disponiveis" com os horários retornados
        });
    </script>
    
</body>
</html>
