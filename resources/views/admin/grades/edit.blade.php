<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Grados',
        'url' => 'admin.grades.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:generation.editar-grado :grado="$grado" />


</x-admin-layout>

