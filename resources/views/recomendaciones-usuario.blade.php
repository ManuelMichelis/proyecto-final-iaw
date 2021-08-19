<x-app-layout>

    <style>

        .estado-siguiendo {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .estado-sin-seguir {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

    </style>

    <x-slot name="header">
    </x-slot>

    <div class="m-5">
        @if (count($usuarios) > 0)
            <div class="container">
                <div class="m-4">
                    @foreach ($usuarios as $usuario)
                        <div class="card mb-4">
                            <div class="m-2">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2">
                                        <div class="d-flex justify-content-start">
                                            <div class="d-flex">
                                                <span class="material-icons" style="font-size: 100px">
                                                    account_circle
                                                </span>
                                            </div>
                                            <div class="flex-column align-self-center">
                                                <div class="m-3">
                                                    <div class="d-flex">
                                                        <h5 class="card-title">
                                                            <b>
                                                                {{ $usuario->alias }}
                                                            </b>
                                                        </h5>
                                                    </div>
                                                    <div class="d-flex">
                                                        <p id="contenedor_seguidores_{{ $usuario->id }}" class="card-text">
                                                            <b>
                                                                {{ count($usuario->seguidores) }}
                                                            </b>
                                                            seguidores
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-self-center">
                                        <div class="m-3">
                                            <div class="d-flex justify-content-center">
                                                @if (Auth::user()->sigue($usuario))
                                                    <button
                                                        id="btn_seguimiento_{{ $usuario->id }}"
                                                        class="btn estado-siguiendo"
                                                        onclick="requestActualizarSeguimiento(
                                                                {{ $usuario->id }},
                                                                '{{ csrf_token() }}',
                                                                '{{ route('actualizarSeguimiento',['id'=> $usuario->id]) }}'
                                                        )">
                                                        Dejar de seguir
                                                    </button>
                                                @else
                                                    <button
                                                        id="btn_seguimiento_{{ $usuario->id }}"
                                                        class="btn estado-sin-seguir"
                                                        onclick="requestActualizarSeguimiento(
                                                                {{ $usuario->id }},
                                                                '{{ csrf_token() }}',
                                                                '{{ route('actualizarSeguimiento',['id'=> $usuario->id]) }}'
                                                        )">
                                                        Seguir
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-5">
                <div class="d-flex justify-content-center">
                    <div class="alert alert-info" role="alert">
                        <b>¡Ups!</b> No hay nuevos usuarios para recomendarte.
                        ¡Seguí interactuando con <b>Argument</b> para que conozca mejor tus gustos!
                    </div>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
