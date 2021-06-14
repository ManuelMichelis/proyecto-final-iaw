<x-app-layout>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- My JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <x-slot name="header">
    </x-slot>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <style>
            .roundbtn-big {
                background-color: #007bff;
                position: fixed;
                height: 70px;
                padding: 10px 16px;
                border-radius: 35px;
                font-size: 24px;
                line-height: 1.33;
            }
            .roundbtn {
                background-color: #007bff;
                position: fixed;
                width: 50px;
                height: 50px;
                padding: 7px 10px;
                border-radius: 25px;
                font-size: 10px;
                text-align: center;
            }
        </style>
        <button type="button" class="btn btn-info roundbtn" data-toggle="modal" data-target="#modal-crear-posteo">
            <span class="material-icons">
                create
            </span>
        </button>
        @foreach ($posteos as $posteo)
            <div class="py-4">
                @include('components.tarjeta-posteo', $posteo)
            </div>
        @endforeach
    </div>
</x-app-layout>
@include('nuevo-posteo', $topicos);
