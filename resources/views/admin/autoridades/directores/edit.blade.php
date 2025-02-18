<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Directores',
        'url' => 'admin.directores.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:director.editar-director :director="$director" />


</x-admin-layout>

