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
        'name' => 'Inscribir Estudiante',
        'url' => '#',
    ],

]">


<livewire:student.crear-estudiante />

</x-admin-layout>

