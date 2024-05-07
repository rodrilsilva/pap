<x-app-layout>
    <div class="grid items-center justify-center w-full h-full overflow-hidden">
        <div class="grid p-6 space-y-4 place-content-center">
            <div class="space-y-1 text-center">
                <h4 class="text-2xl text-neutral-900">Realizar Marcação</h4>
                <p class="text-neutral-500">Deseja realizar uma marcação? Vamos a isso!</p>
            </div>
                <form id="form-marcacao" class="space-y-2" method="POST" action="{{ route('cliente.create')}}">
                    @csrf
                    <div class="flex flex-col gap-4 lg:flex-row">
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-96">
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="servico">Serviço</x-input-label>
                            <x-select name="servico" id="servico">
                                <option value="" disabled selected>Escolha um serviço</option>
                                @foreach($servicos as $servico)
                                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="data">Data da Marcação</x-input-label>
                            <input id="data" name="data" type="date" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500" />
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="hora">Horário da Marcação</x-input-label>
                            <select name="hora" id="hora" required class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:border-violet-500">
                                <option value="" disabled selected>Escolha um horário</option>
                            </select>
                        </div>
                    </div>
                    <div id="horarios-disponiveis" class="p-4 space-y-4 bg-white border rounded-2xl lg:w-[512px]">
                        <!-- Aqui serão exibidos os horários disponíveis -->
                    </div>
                </div>
                <button type="submit" class="p-2.5 py-2 rounded-lg bg-violet-500 text-white">Submeter</button>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('data').addEventListener('change', function() {
        let dataSelecionada = this.value;
        let servicoSelecionado = document.getElementById('servico').value;

        axios.get('/horarios-disponiveis', {
            params: {
                data: dataSelecionada,
                servico: servicoSelecionado
            }
        })
        .then(function (response) {
            let horariosDisponiveisSelect = document.getElementById('hora');
            horariosDisponiveisSelect.innerHTML = '<option value="" disabled selected>Escolha um horário</option>';

            if (response.data.length > 0) {
                response.data.forEach(function(horario) {
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
    });
</script>
