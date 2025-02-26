<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Acciones',
        'url' => 'admin.actions.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:action.editar-accion :accion="$accion" />


</x-admin-layout>

