<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <div class="m-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (count($posteos) > 0)
                @foreach ($posteos as $posteo)
                    @include('components/posteo/posteo-presentacion', $posteo)
                @endforeach
            @else
                <div class="m-5">
                    <div class="p-5">
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-secondary" role="alert">
                                <b>¡Ups!</b> No hay nuevos posteos para recomendarte.
                                ¡Seguí interactuando con <b>Argument</b> para que conozca mejor tus gustos!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>


