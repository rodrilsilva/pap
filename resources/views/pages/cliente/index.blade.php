<x-app-layout>
    <div class="grid items-center justify-center w-full h-full overflow-hidden">
        <div class="grid p-6 space-y-4 place-content-center">
            <div class="space-y-1 text-center">
                <h4 class="text-2xl text-neutral-900">Realizar Marcação</h2>
                <p class="text-neutral-500">Deseja realizar uma marcação? Vamos a isso!</p>
            </div>
            <form class="space-y-2">
                <div class="flex flex-col gap-4 lg:flex-row">
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-96">
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="colaborador">Colaborador</x-input-label>
                            <x-select>
                                <option value="" disabled selected>Escolha um Colaborador</option>
                                <option value="">op2</option>
                                <option value="">op3</option>
                                <option value="">op4</option>
                            </x-select>
                        </div>
                        <div class="flex flex-col gap-0.5 font-medium">
                            <x-input-label for="servico">Serviço</x-input-label>
                            <x-select>
                                <option value="" disabled selected>Escolha um serviço</option>
                                <option value="">op2</option>
                                <option value="">op3</option>
                                <option value="">op4</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 bg-white border rounded-2xl lg:w-[512px]">
                        [Colocar aqui de alguma maneira os horários disponiveis.
                        Talvez ajax para fazer em tempo real, ficava fixe]
                    </div>
                </div>
                <button type="submit" class="p-2.5 py-2 rounded-lg bg-violet-500 text-white">Submeter</button>
            </div>
        </div>
    </div>
</x-app-layout>
