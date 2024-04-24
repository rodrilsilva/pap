<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Definições - Horário') }}
        </h2>
    </x-slot>
    <div class="flex flex-col m-auto md:flex-row md:space-x-32 max-w-7xl">
        <x-definicoes-menu/>
        <form class="flex flex-col w-full gap-4" method="POST" action="{{ route('definicoes.save') }}">
            @csrf
            <div class="space-y-2">
                <h4 class="text-lg font-medium">Segunda-feira</h4>
                <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="hora_inicio_manha">Ínicio Manhã</x-input-label>
                        {{-- Pegas através da base de dados --}}
                        <x-text-input type="time" id="hora_inicio_manha" name="hora_inicio_manha" :value="$registro->hora_inicio_manha ?? null"/>
                    </div>
                    
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="fim_manha">Fim Manhã</x-input-label>
                        {{-- Pegas através da base de ddos  --}}
                        <x-text-input type="time" id="fim_manha" name="fim_manha" value=""/>
                    </div>
                </div>
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="inic_tarde">Ínicio Tarde</x-input-label>
                        {{-- Pegas através da base de ddos  --}}
                        <x-text-input type="time" id="inic_tarde" name="inic_tarde" value=""/>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <x-input-label for="fim_tarde">Fim Tarde</x-input-label>
                        {{-- Pegas através da base de ddos  --}}
                        <x-text-input type="time" id="fim_tarde" name="fim_tarde" value=""/>
                    </div>
                </div>
                </div>
            </div>
            <hr>
            <div class="space-y-2">
                <h4 class="text-lg font-medium">Terça-feira</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_manha">Ínicio Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_manha" name="inic_manha" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_manha">Fim Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_manha" name="fim_manha" value=""/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_tarde">Ínicio Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_tarde" name="inic_tarde" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_tarde">Fim Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_tarde" name="fim_tarde" value=""/>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="space-y-2">
                <h4 class="text-lg font-medium">Quarta-feira</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_manha">Ínicio Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_manha" name="inic_manha" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_manha">Fim Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_manha" name="fim_manha" value=""/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_tarde">Ínicio Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_tarde" name="inic_tarde" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_tarde">Fim Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_tarde" name="fim_tarde" value=""/>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="space-y-2">
                <h4 class="text-lg font-medium">Quinta-feira</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_manha">Ínicio Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_manha" name="inic_manha" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_manha">Fim Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_manha" name="fim_manha" value=""/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_tarde">Ínicio Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_tarde" name="inic_tarde" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_tarde">Fim Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_tarde" name="fim_tarde" value=""/>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="space-y-2">
                <h4 class="text-lg font-medium">Sexta-feira</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_manha">Ínicio Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_manha" name="inic_manha" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_manha">Fim Manhã</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_manha" name="fim_manha" value=""/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="inic_tarde">Ínicio Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="inic_tarde" name="inic_tarde" value=""/>
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <x-input-label for="fim_tarde">Fim Tarde</x-input-label>
                            {{-- Pegas através da base de ddos  --}}
                            <x-text-input type="time" id="fim_tarde" name="fim_tarde" value=""/>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="flex gap-4 pt-4 mb-4">
                <x-primary-button type="submit">Guardar</x-primary-button>
            </div>
        </form>
    </div>
    </div>
</x-app-layout>
