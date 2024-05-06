<div class="overflow-hidden border rounded-lg">
    <table class="w-full h-full">
        <tr class="mb-2 border-b first:rounded-l-xl last:rounded-r-xl">
            <th class="p-3 font-medium text-start bg-neutral-50 text-neutral-500 whitespace-nowrap">Colaborador</th>
            <th class="p-3 font-medium text-start bg-neutral-50 text-neutral-500 whitespace-nowrap">Serviço</th>
            <th class="p-3 font-medium text-start bg-neutral-50 text-neutral-500 whitespace-nowrap">Data Hora</th>
            <th class="p-3 font-medium text-start bg-neutral-50 text-neutral-500 whitespace-nowrap">Estado</th>
        </tr>
        @foreach($marcacoes as $marcacao)
        <tr>
            <td class="px-3 py-2 text-sm font-medium text-neutral-900">
                @if(isset($marcacao->colaborador))
                    {{ $marcacao->colaborador->nome }}
                @else
                    Não definido
                @endif
            </td>
            <td class="px-3 py-2 text-sm font-medium text-neutral-900">{{ $marcacao->tipoServico->nome }}</td>
            <td class="px-3 py-2 text-sm font-medium text-neutral-900">{{ $marcacao->data_hora}}</td>
            <td class="px-3 py-2 text-sm font-medium text-neutral-900">
                @if($marcacao->data_hora < now())
                    <x-pill class="text-white bg-green-600">Realizada</x-pill>
                @else
                    <x-pill class="text-white bg-yellow-600">Próxima</x-pill>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
