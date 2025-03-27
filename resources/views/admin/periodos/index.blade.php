<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Periodos',
        'url' => '#',
    ],

]">



@livewire('periodo.crear-periodo')
@livewire('periodo.mostrar-periodos', ['lazy' => true])

</x-admin-layout>
