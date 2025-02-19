<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Generaciones',
        'url' => 'admin.generations.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:generation.editar-generacion :generacion="$generacion" />


</x-admin-layout>

