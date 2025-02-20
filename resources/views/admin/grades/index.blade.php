<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Grados',
        'url' => '#',
    ],

]">



@livewire('grade.crear-grado')
@livewire('grade.mostrar-grados', ['lazy' => true])

</x-admin-layout>
