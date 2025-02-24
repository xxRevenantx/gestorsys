<div>

    <div class="bg-gray-100 lg:px-8">

        <div class="flex justify-between items-center">
            <div>

                <h2 class="text-2xl md:text-4xl text-gray-600 text-center font-extrabold my-5">Buscar y Filtrar Estudiantes</h2>
            </div>

            <div>
                <a href="{{ route('admin.students.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Inscribir Estudiante</a>

            </div>

        </div>

        <div class="mx-auto ">
            <div class="relative overflow-x-auto">
                @livewire('student-table')
            </div>
        </div>

    </div>

