<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/estilos-topico.css') }}">

    <div class="m-5">
        <div class="container">
            <div class="m-4">
                <div class="card-deck">
                    @foreach ($topicos as $topico)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card mb-4">
                                <div class="m-2">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{'data:image/png;base64, '.$topico->icono}}" width="96px">
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">
                                        <b>
                                            {{ $topico->nombre }}
                                        </b>
                                    </h5>
                                    <p id="contenedor_suscriptos_{{ $topico->id }}" class="card-text">
                                        <b>
                                            {{ count($topico->suscriptos) }}
                                        </b>
                                        suscriptos
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        @if (Auth::user()->suscripto($topico))
                                            <button
                                                id="btn_suscripcion_{{ $topico->id }}"
                                                class="btn estado-suscripto"
                                                onclick="requestActualizarSuscripcion(
                                                        {{ $topico->id }},
                                                        '{{ csrf_token() }}',
                                                        '{{ route('actualizarSuscripcion',['id' => $topico->id]) }}'
                                                )">
                                                Anular suscripci??n
                                            </button>
                                        @else
                                            <button
                                                id="btn_suscripcion_{{ $topico->id }}"
                                                class="btn estado-sin-suscripcion"
                                                onclick="requestActualizarSuscripcion(
                                                    {{ $topico->id }},
                                                    '{{ csrf_token() }}',
                                                    '{{ route('actualizarSuscripcion',['id' => $topico->id]) }}'
                                                )">
                                                Suscribirse
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>





