<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <!--link rel="stylesheet" href="{{ asset('css/tarjeta-posteo.css') }}"-->

    <div class="m-10">
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
                    position: fixed;
                    bottom: 10vh;
                    right: 5vh;
                    width: 50px;
                    height: 50px;
                    padding: 7px 10px;
                    border-radius: 25px;
                    font-size: 10px;
                    text-align: center;
                }
            </style>
            <button type="button" class="btn btn-dark roundbtn" data-toggle="modal" data-target="#modal-nuevo-comentario">
                <i class="fas fa-comment-dots fa-2x"></i>
            </button>

            @include('components.md-nuevo-comentario', $posteo)

            @include('components.tarj-principal-posteo', ['posteo' => $posteo])

            @foreach ($comentarios as $comentario)

                @include('components.tarj-comentario', ['posteo' => $comentario])

            @endforeach

        </div>
    </div>

</x-app-layout>
