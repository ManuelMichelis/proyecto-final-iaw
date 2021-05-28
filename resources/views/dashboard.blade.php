<x-app-layout>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <x-slot name="header">
    </x-slot>
    <br>
    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createPosteo">
        Nuevo posteo
    </a>

    @foreach ($posteos as $posteo)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 bg-white border-b border-gray-200">
                        {{ $posteo->alias_usuario }} - {{ $posteo->topicos()->first()->nombre }}
                        <div class="bg-white overflow-hidden sm:rounded-lg">
                            <div class="p-2 bg-white">
                                {{ $posteo->contenido }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
@include('createPosteo')
