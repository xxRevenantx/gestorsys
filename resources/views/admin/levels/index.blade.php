<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Niveles',
        'url' => '#',
    ],

]">




@livewire('level.crear-nivel')
@livewire('level.mostrar-niveles')

</x-admin-layout>
