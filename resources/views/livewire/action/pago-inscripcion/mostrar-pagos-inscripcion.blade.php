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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Matrícula
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CURP
                </th>

                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Total
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fecha de Pago
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Recibimos de
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                </th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($recibos as $recibo)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->folio }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->student->matricula }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->student->nombre }} {{ $recibo->student->apellido_paterno }} {{ $recibo->student->apellido_materno }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->student->CURP }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${{ $recibo->total }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->fecha_pago }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $recibo->nombre_pago}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <a target="_blank" href="{{ route('admin.recibo.inscripcion', $recibo->student_id) }}" class="text-white bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded">Ver Recibo</a>
                </td>



            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
