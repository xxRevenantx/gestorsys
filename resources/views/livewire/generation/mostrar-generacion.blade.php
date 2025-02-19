<div>
    @if (session('mensaje'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 my-2 shadow-md" role="alert">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-bold">¡Ok!</p>
                <p class="text-sm">{{ session('mensaje') }}</p>
            </div>
            <button type="button" class="text-teal-900" onclick="this.parentElement.parentElement.style.display='none';">
                &times;
            </button>
        </div>
    </div>
@endif
    <div class="bg-gray-100 lg:px-8">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl md:text-4xl text-gray-500 text-center font-extrabold my-5">Buscar y Filtrar Generaciones</h2>
            </div>

            <div class="flex flex-col items-center justify-center">
                    <dt class="mb-1 text-3xl font-extrabold">{{$contarGeneracion}}</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Generaciones</dd>
            </div>


        </div>



        <div class="mx-auto ">
            <div class="relative overflow-x-auto">
                @livewire('generation-table')
            </div>
        </div>

    </div>

