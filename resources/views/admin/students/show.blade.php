<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Estudiantes',
        'url' => 'admin.students.index',
    ],
    [
        'name' => 'Vista del estudiante',
        'url' => '#',
    ],

]">


<livewire:student.mostrar-estudiante :student="$student" />

</x-admin-layout>

