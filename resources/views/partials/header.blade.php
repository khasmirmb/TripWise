<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700&display=swap">

        <script type="text/javascript" src=".../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>

        <!-- CSS / JS -->
        @vite(['resources/css/app.css','resources/js/app.js'])

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
    <body>