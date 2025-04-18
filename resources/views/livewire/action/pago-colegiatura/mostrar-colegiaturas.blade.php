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
            placeholder="Buscar por Nombre, CURP, Matrícula, Folio, Tipo de pago, Fecha de pago, Mes de pago"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        />


</div>



</div>
<h3 class="text-lg font-semibold text-slate-800 text-center my-3">
    Total:  {{ $totalRegistros }} {{ $totalRegistros == 1 ? 'registro' : 'registros' }} |
     <span class="text-indigo-700">  {{ $contar }} {{ $contar == 1 ? 'Registro' : 'Registros' }} filtrados</span>
 </h3>

@include('admin.partials.loader')
<table class="min-w-full divide-y divide-gray-200">
<thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
           Folio
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Matrícula
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            CURP
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nombre
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Descuento
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Total
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
           Tipo de pago
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Mes de Pago
        </th>



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
            {{ $colegiatura->student->CURP }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->student->nombre }} {{ $colegiatura->student->apellido_paterno }} {{ $colegiatura->student->apellido_materno }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            ${{ $colegiatura->descuento }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            ${{ $colegiatura->total }}
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ \Carbon\Carbon::parse($colegiatura->fecha_pago)->format('d/m/Y') }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $colegiatura->tipo_pago }}

        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

            <a target="_blank" href="{{route('admin.recibo.colegiatura', ['alumno' => $colegiatura->student->id, 'mes' => $colegiatura->month_id])}}"  class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">  {{ $colegiatura->month->mes }}</a>
        </td>




    </tr>
    @endforeach
</tbody>
</table>

<div class="mt-4">
    {{ $colegiaturas->links() }}
 </div>

</div>


</div>
