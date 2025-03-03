<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Vista del tutor',
        'url' => '#',
    ],

]">



<livewire:tutor.mostrar-tutor :tutor="$tutor" lazy  />

</x-admin-layout>
