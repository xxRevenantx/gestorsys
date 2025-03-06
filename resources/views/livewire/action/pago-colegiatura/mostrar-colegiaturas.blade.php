<div>

    <div class="p-4 md:p-5">
        <!-- Modal body -->
    <div class="mb-5">

        <label
            class="block mb-1 text-sm text-gray-700 uppercase font-bold "
            for="termino">Término de Búsqueda
        </label>

        <div class="flex justify-between items-center">
            <input
            wire:model.live="termino"
            id="termino"
            type="text"
            placeholder="Buscar por Nombre, CURP, Matrícula, Folio, Tipo de pago"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        />


</div>



</div>
<p class="text-sm font-normal text-gray-500 dark:text-gray-400">Recibos de pago</p>

@include('admin.partials.loader')
<table class="min-w-full divide-y divide-gray-200">
<thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
           Folio
        </th>

        {{-- @foreach ($meses as $mes)
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            {{$mes->mes}}
         </th>
        @endforeach --}}




        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

        </th>

    </tr>
</thead>
<tbody class="bg-white divide-y divide-gray-200">
    @foreach($colegiaturas as $colegiatura)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->folio }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->student->matricula }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->student->nombre }} {{ $colegiatura->student->apellido_paterno }} {{ $colegiatura->student->apellido_materno }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->student->CURP }}
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

            <button class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">  {{ $colegiatura->month->mes }}</button>
        </td>




    </tr>
    @endforeach
</tbody>
</table>
</div>
</div>
