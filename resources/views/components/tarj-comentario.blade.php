

<style>
    .margen-sup-simple {
        padding-top: 6px;
    }

    .unliked {
        color: #222222
    }

    .liked {
        color: #ac2e2e
    }


    button:focus {
        outline: none;
    }

    .tarjeta-font {
        font-size: 1.03rem;
    }

    .botones-font {
        font-size: 0.93rem;
    }

</style>

<div id="espacio_posteo_{{ $posteo->id }}" class="py-2 max-w-5xl mx-auto sm:px-5 lg:px-8">
    <div id="tarjeta_{{ $posteo->id }}" class="tarjeta-font bg-white overflow-hidden shadow-md container">
        <div class="m-2">

            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                    <span class="material-icons">
                        account_circle
                    </span>
                    &nbsp;
                    <b>
                        {{ $posteo->aliasUsuario() }}
                    </b>
                </div>
                <div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <span class="material-icons color-icono-default">
                                    more_horiz
                                </span>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if (Auth::user()->haPublicado($posteo))
                                <x-dropdown-link
                                        onclick="requestEliminar(
                                                        {{ $posteo->id }},
                                                        '{{ csrf_token() }}',
                                                        '{{ route('borrarPosteo', ['id' => $posteo->id]) }}'
                                        )">
                                        <div class="d-flex justify-content-start">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons">
                                                    delete
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                &nbsp;
                                                {{ __('Eliminar') }}
                                            </div>
                                        </div>
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                    <div class="d-flex justify-content-start">
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons color-icono-default">
                                                outlined_flag
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            &nbsp;
                                            {{ __('Denunciar') }}
                                        </div>
                                    </div>
                                </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <div class="p-2 bg-white border-gray-200">
                <div class="bg-white overflow-hidden">
                    <div class="m-1">
                        <div class="p-2 bg-white grey">
                            {{ $posteo->contenido }}
                        </div>
                    </div>

                    <x-borderline/>

                    <div class="p-2" style="font-size: 0.92rem">
                        {{ $posteo->created_at->format('H:i') }}
                        &nbsp;
                        {{ $posteo->created_at->format('d F Y') }}
                    </div>

                    <x-borderline/>
                    <div class="m-1">
                        <div class="d-flex" style="font-size: 0.96rem">

                            <div class="p-1">
                                <div class="ml-2">
                                    <a class="btn"
                                            onclick="requestVotar(
                                                            {{ $posteo->id }},
                                                            '{{ csrf_token() }}',
                                                            '{{ route('nuevoLike', ['id' => $posteo->id]) }}'
                                            )"
                                            type="submit">

                                        <div class="d-flex align-content-center">
                                            @if ($posteo->esVotante(Auth::user()))
                                                <div id="skin_mg_{{ $posteo->id }}" class="d-flex liked">
                                                    <span class="material-icons">
                                                        favorite
                                                    </span>
                                                    &nbsp;
                                                    <div id="votos_p_{{ $posteo->id }}">
                                                        <b>
                                                            {{ $posteo->votos }}
                                                            me gusta
                                                        </b>
                                                    </div>
                                                </div>
                                            @else
                                                <div id="skin_mg_{{ $posteo->id }}" class="d-flex unliked">
                                                    <span class="material-icons">
                                                        favorite
                                                    </span>
                                                    &nbsp;
                                                    <div id="votos_p_{{ $posteo->id }}">
                                                        {{ $posteo->votos }}
                                                        me gusta
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
