<div>

    <div class='w-full py-8 mx-auto bg-white rounded-lg shadow-xl'>


        <details class="w-full bg-white border border-blue-500 cursor-pointer mb-3">
            <summary class="w-full bg-white text-dark flex justify-between px-4 py-3  after:content-['+']">
                    PERSONAL ASIGNADO ({{ $personal->count() }})
            </summary>

            <div class="p-4">
                <livewire:teacher-table />
            </div>


            {{-- <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Teléfono
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($nivel->teachers as $teacher)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $teacher->personnel->nombre }} {{ $teacher->personnel->apellido_paterno }} {{ $teacher->personnel->apellido_materno }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $teacher->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $teacher->telefono }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}

        </details>





        <!-- THE CSS -->
        <style>
                details summary::-webkit-details-marker {
                display: none;
            }


            details[open] summary {
                background: #1d4ed8;
                color: white
            }

            details[open] summary::after {
                content: "-";
            }

            details[open] summary ~ * {
                animation: slideDown 0.3s ease-in-out;
            }

            details[open] summary p {
                opacity: 0;
                animation-name: showContent;
                animation-duration: 0.6s;
                animation-delay: 0.2s;
                animation-fill-mode: forwards;
                margin: 0;
            }

            @keyframes showContent {
                from {
                opacity: 0;
                height: 0;
                }
                to {
                opacity: 1;
                height: auto;
                }
            }
            @keyframes slideDown {
                from {
                opacity: 0;
                height: 0;
                padding: 0;
                }

                to {
                opacity: 1;
                height: auto;
                }
            }
        </style>

    </div>

</div>
