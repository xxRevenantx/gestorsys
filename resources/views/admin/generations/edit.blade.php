<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Grupos',
        'url' => 'admin.groups.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:group.editar-grupo :grupo="$grupo" />


</x-admin-layout>

