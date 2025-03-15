<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Asignación de personal',
        'url' => 'admin.teachers.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:teacher.editar-profesor :teacher="$teacher" />


</x-admin-layout>

