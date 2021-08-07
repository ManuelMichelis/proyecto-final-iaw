<link rel="stylesheet" href="{{ asset('css/estilos-posteo.css') }}">

<div id="espacio_posteo_{{ $posteo->id }}" class="py-4 max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div id="tarjeta_{{ $posteo->id }}" class="tarjeta-font bg-white overflow-hidden shadow-md container">
        <div class="m-2">
            @include('components/posteo/elementos/header-posteo', $posteo)
            <div class="p-4 bg-white border-gray-200">
                <div class="bg-white overflow-hidden">
                    <div class="m-3">
                        <div class="p-1 bg-white grey">
                            {{ $posteo->titulo }}
                        </div>
                    </div>
                    @include('components/posteo/elementos/footer-presentacion', $posteo)
                </div>
            </div>
        </div>
    </div>
</div>
