<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-md text-indigo-400">
                            Inicio
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="ml-4 text-md text-indigo-400">
                            Ingresar
                        </a>
                        &nbsp;
                        &nbsp;
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-md text-indigo-400">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <div class="logo-font" style="font-size: 8rem">
                        {{ config('app.name') }}
                    </div>
                </div>
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

                </div>
            </div>
        </div>
    </body>
</html>
