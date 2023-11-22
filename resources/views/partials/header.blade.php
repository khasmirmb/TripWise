<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('logo/tripwise.png') }}">
        <!-- Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700&display=swap">

        <!-- Slick JS -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

        <!-- CSS / JS -->
        <!-- CSS / JS -->
        <link rel="stylesheet" href="{{asset('build/assets/app-74823d77.css')}}">
        
        <script type="module" src="{{ asset('build/assets/app-75895fca.js') }}" defer></script>

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
    <body class="bg-white dark:bg-gray-800 min-h-screen m-0 flex flex-col">