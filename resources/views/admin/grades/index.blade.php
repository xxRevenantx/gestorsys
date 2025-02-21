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


@if (session('mensaje'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 my-2 shadow-md" role="alert">
    <div class="flex justify-between items-center">
        <div>
            <p class="font-bold">¡Ok!</p>
            <p class="text-sm">{{ session('mensaje') }}</p>
        </div>
        <button type="button" class="text-teal-900" onclick="this.parentElement.parentElement.style.display='none';">
            <span class="text-xl">&times;</span>
        </button>
    </div>
</div>
@endif
@livewire('grade.crear-grado', ['lazy' => true])
@livewire('grade.mostrar-grados', ['lazy' => true])

</x-admin-layout>
