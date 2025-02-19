<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Generaciones',
        'url' => '#',
    ],

]">



@livewire('generation.crear-generacion')
@livewire('generation.mostrar-generacion')

</x-admin-layout>
