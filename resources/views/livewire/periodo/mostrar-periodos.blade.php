<div>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">#</th>
                <th class="px-4 py-2 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Número de Periodo</th>
                <th class="px-4 py-2 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-600">Fechas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periodos as $index => $periodo)
            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">{{ $index + 1 }}</td>
                <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">{{$periodo->num_periodo }}</td>
                <td class="px-4 py-2 border-b border-gray-200 text-sm text-gray-700">{{ $periodo->fechas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
