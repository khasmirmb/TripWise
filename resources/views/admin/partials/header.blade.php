<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('logo/tripwise.png') }}">
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <script type="text/javascript" src=".../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>

        <!-- CSS / JS -->
        <link rel="stylesheet" href="{{asset('build/assets/app-74823d77.css')}}">
        
        <script type="module" src="{{ asset('build/assets/admin-5bb25eaa.js') }}" defer></script>
        <!-- Dark Mode Script -->
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>

    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <div class="antialiased">