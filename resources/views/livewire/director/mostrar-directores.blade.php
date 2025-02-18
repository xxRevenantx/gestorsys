<div>
    @if (session('mensaje'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 my-2 shadow-md" role="alert">
        <div class="flex">                      <div>
            <p class="font-bold">¡Ok!</p>
            <p class="text-sm">{{session('mensaje')}}</p>
          </div>
        </div>
      </div>
@endif
    <div class="bg-gray-100 lg:px-8">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl md:text-4xl text-gray-600 text-center font-extrabold my-5">Buscar y Filtrar Directores</h2>
            </div>

        </div>

        <div class="mx-auto ">
            <div class="relative overflow-x-auto">
                @livewire('director-table')
            </div>
        </div>

    </div>




