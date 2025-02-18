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

        @stack('scripts')



        @livewireScripts
    </body>
</html>
