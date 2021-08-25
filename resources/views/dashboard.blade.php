<x-app-layout>

    <x-slot name="header">
            <form class="form-inline">
                <span class="material-icons">
                    search
                </span>
                &nbsp;
                <input
                    class="form-control mr-sm-2"
                    type="search"
                    placeholder="Usuario"
                    aria-label="Search"
                    style="border-radius: 25px;"
                >
            </form>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/estilos-floating-btn.css') }}">

    <div class="m-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button type="button"
                class="roundbtn"
                data-toggle="modal"
                data-target="#modal-nuevo-posteo"
            >
                <i class="fas fa-pencil-alt fa-2x"></i>
                &nbsp;
            </button>
            @foreach ($posteos as $posteo)
                @include('components/posteo/posteo-presentacion', $posteo)
            @endforeach
        </div>
    </div>

    @include('components/md-nuevo-posteo', $topicos);

</x-app-layout>


