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
        <div class="py-3">

        </div>
    </x-slot>

    <div class="container-fluid">
        <div style="border-bottom: 1px solid rgb(202, 202, 202); background-color: #f0f0f0; height: 30vh">
            <div class="d-flex justify-content-center">
                <div class="flex-column">
                    <div class="d-flex">
                        <span class="material-icons" style="font-size: 140px">
                            account_circle
                        </span>
                    </div>
                    <div class="text-center" style="font-size: 25px">
                        <b>
                            {{ $usuario->alias }}
                        </b>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex flex-column">
                @if (Auth::id() != $usuario->id)
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
                @endif
                <div class="text-center" style="font-size: 1.1rem">
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <div id="contenedor_seguidores_{{ $usuario->id }}">
                                <b>
                                    {{ count($usuario->seguidores) }}
                                </b>
                                seguidores
                            </div>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <div>
                                <b>
                                    {{ count($usuario->seguidos) }}
                                </b>
                                seguidos
                            </div>
                        </div>

                    </div>
                    <div></div>
                    <div class="mt-4">
                        <b>
                            {{ count($usuario->discusionesGeneradas()) }}
                            posteos realizados
                        </b>
                    </div>
                </div>
            </div>
            <div class="m-5">
                @foreach ($posteos as $posteo)
                    @include('components/posteo/posteo-presentacion', $posteo)
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
