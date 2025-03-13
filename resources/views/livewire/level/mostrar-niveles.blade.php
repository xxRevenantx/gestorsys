<div>
    <div class="bg-gray-100 lg:px-8">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl md:text-4xl text-gray-600 text-center font-extrabold my-5">Buscar y Filtrar Niveles</h2>
            </div>
            {{-- <a href="{{route('admin.nivelespdf')}}" target="_blank" class="p-2 bg-gray-800 my-5 text-white rounded-lg">PDF Niveles</a> --}}

        </div>

        <div class="mx-auto ">
            <div class="relative overflow-x-auto">
                @livewire('level-table')
            </div>
        </div>

    </div>

