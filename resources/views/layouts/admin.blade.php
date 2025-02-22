@props(['breadcrumb' => []])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/path/to/your/icon.ico" type="image/x-icon">

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:200,300,400,800" rel="stylesheet" />

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">


        @include('layouts.partials.admin.navigation')

        @include('layouts.partials.admin.sidebar')


          <div class="p-4 sm:ml-64 ">
            <div class="mt-14">
                @include('layouts.partials.admin.breadcrumb')
                <div class="p-4 rounded-lg dark:border-gray-700">
                        {{ $slot }}
                 </div>
            </div>


          </div>




        @stack('modals')



        @livewireScripts


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
           Livewire.on('swal', (data) => {
                const Toast = Swal.mixin({
                toast: true,
                position: data[0].position,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon:data[0].icon,
                title: data[0].title,
            })
            })

        </script>

        @stack('scripts')
    </body>
</html>
