<div class="flex flex-row w-full gap-2 overflow-auto md:w-64 md:flex-col">
    <x-btn-nav-definicoes
        :href="route('definicoes.update')"
        :active="request()->routeIs('definicoes.update')">
        Definições
    </x-btn-nav-definicoes>
    <x-btn-nav-definicoes
        :href="route('servicos.index')"
        :active="request()->routeIs('servicos.index')">
        Serviços
    </x-btn-nav-definicoes>
    <x-btn-nav-definicoes
        :href="route('equipa.index')"
        :active="request()->routeIs('equipa.index')">
        Equipa
    </x-btn-nav-definicoes>
    <x-btn-nav-definicoes
        :href="route('horario.index')"
        :active="request()->routeIs('horario.index')">
        Horário
    </x-btn-nav-definicoes>
    <x-btn-nav-definicoes
        :href="route('notificacoes.index')"
        :active="request()->routeIs('notificacoes.index')">
        Notificações
    </x-btn-nav-definicoes>
</div>

