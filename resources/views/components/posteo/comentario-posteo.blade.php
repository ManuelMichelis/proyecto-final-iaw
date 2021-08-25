
<div id="espacio_posteo_{{ $posteo->id }}" class="py-2 max-w-5xl mx-auto sm:px-5 lg:px-8">
    <div id="tarjeta_{{ $posteo->id }}" class="tarjeta-font bg-white overflow-hidden shadow-md container">
        <div class="m-2">
            @include('components/posteo/elementos/header-comentario', $posteo)
            <div class="p-2 bg-white border-gray-200">
                <div class="bg-white overflow-hidden">
                    <div class="m-1">
                        <div class="p-2 bg-white grey">
                            {{ $posteo->contenido }}
                        </div>
                    </div>
                    @include('components/posteo/elementos/footer-comentario', $posteo)
                </div>
            </div>
        </div>
    </div>
</div>
