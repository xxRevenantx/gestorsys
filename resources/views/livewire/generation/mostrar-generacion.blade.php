<div>

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

