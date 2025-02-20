<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Turores',
        'url' => '#',
    ],

]">



@livewire('tutor.crear-tutor', ['lazy' => true])
@livewire('tutor.mostrar-tutor', ['lazy' => true])

</x-admin-layout>
