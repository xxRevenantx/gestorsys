<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Supervisores',
        'url' => '#',
    ],

]">



@livewire('supervisor.crear-supervisor')
@livewire('supervisor.mostrar-supervisores')

</x-admin-layout>

