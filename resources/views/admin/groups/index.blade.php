<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Grupos',
        'url' => '#',
    ],

]">




@livewire('group.crear-grupo')
@livewire('group.mostrar-grupos' , ['lazy' => true])

</x-admin-layout>
