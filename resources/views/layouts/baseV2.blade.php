<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url(asset('mdrrmo-bulan.ico')) }}">

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('./css/style.css')}}">

        @livewireStyles
        @livewireScripts

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="bg-gray-100">
    @include('./layouts/partials/navbar')
        <!-- strat wrapper -->
        <div class="h-screen flex flex-row flex-wrap">

            @include('./layouts/partials/sidebar')

            @yield('body')
        </div>
    </body>

     <!-- script -->
     <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
     <script src="{{asset('./js/script.js')}}"></script>
    <!-- end script -->
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get all option buttons
    const optionButtons = document.querySelectorAll('.options-button');

    optionButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent click from bubbling up to document
            
            const menuId = `options-menu-${this.dataset.userId}`; // Get the menu ID using data attribute
            const optionsMenu = document.getElementById(menuId);
            
            // Hide all menus
            document.querySelectorAll('.options-menu').forEach(item => {
                if (item !== optionsMenu) {
                    item.classList.add('hidden');
                }
            });

            // Toggle the clicked options menu
            optionsMenu.classList.toggle('hidden');
        });
    });

    // Hide all dropdowns when clicking outside
    document.addEventListener('click', function () {
        document.querySelectorAll('.options-menu').forEach(item => {
            item.classList.add('hidden');
        });
    });
});
</script>