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
        'name' => 'Editar Estudiante',
        'url' => '#',
    ],

]">


<livewire:student.editar-estudiante :student="$student" />

</x-admin-layout>

