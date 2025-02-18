<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Directores',
        'url' => '#',
    ],

]">



@livewire('director.crear-director')
@livewire('director.mostrar-directores')

</x-admin-layout>
