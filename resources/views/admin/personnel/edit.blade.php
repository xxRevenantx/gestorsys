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
        'name' => 'Editar Personal',
        'url' => '#',
    ],

]">


<livewire:personnel.editar-personal :personnel="$personnel" />

</x-admin-layout>

