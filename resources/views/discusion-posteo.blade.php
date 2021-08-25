<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/estilos-floating-btn.css') }}">

    <div class="m-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <button
                type="button"
                class="roundbtn"
                data-toggle="modal"
                data-target="#modal-nuevo-comentario"
            >
                <div class="d-flex justify-content-center">
                    <span class="material-icons">
                        textsms
                    </span>
                </div>
            </button>

            <!-- Modal para la creacion de un nuevo comentario -->
            @include('components.md-nuevo-comentario', ['posteo' => $posteo])

            <!-- Tarjeta del posteo que inicia la discusion -->
            @include('components/posteo/posteo-dedicado', ['posteo' => $posteo])

            <br>
            <x-borderline/>
            <br>

            <!-- Comentarios que posee la discusion -->
            <div class="m-2">
                @foreach ($comentarios as $comentario)
                    @include('components/posteo/comentario-posteo', ['posteo' => $comentario])
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
