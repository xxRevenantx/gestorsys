<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Tutores',
        'url' => 'admin.tutors.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:tutor.editar-tutor :tutor="$tutor" />


</x-admin-layout>

