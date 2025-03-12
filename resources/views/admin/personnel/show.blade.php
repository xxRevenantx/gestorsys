<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Personal',
        'url' => 'admin.personnels.index',
    ],
    [
        'name' => 'Visualizar Personal',
        'url' => '#',
    ],

]">


<livewire:personnel.mostrar-personal :personnel="$personnel" />

</x-admin-layout>

