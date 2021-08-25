    <x-borderline/>

    <div class="p-2" style="font-size: 0.92rem">
        {{ $posteo->created_at->format('H:i') }}
        &nbsp; <b>·</b> &nbsp;
        {{ $posteo->created_at->format('d/m/Y') }}
    </div>

    <x-borderline/>

    <div class="m-1">
        <div class="d-flex" style="font-size: 0.96rem">

            <div class="p-1">
                <div class="ml-2">

                    <a class="btn"
                        data-toggle="modal"
                        data-target="#modal-nuevo-comentario"
                    >
                        <div class="d-flex align-content-center">
                            @if ($posteo->haComentado(Auth::user()))
                                <b>
                                    <div id="btn-com-skin-{{ $posteo->id }}" class="d-flex">
                                        <span class="material-icons">
                                            chat_bubble
                                        </span>
                                        &nbsp;
                                        <div id="comentarios_posteo_{{ $posteo->id }}">
                                            {{ count($posteo->comentarios) }}
                                            comentarios
                                        </div>
                                    </div>
                                </b>
                            @else
                                <div id="btn-com-skin-{{ $posteo->id }}" class="d-flex">
                                    <span class="material-icons">
                                        chat_bubble
                                    </span>
                                    &nbsp;
                                    <div id="comentarios_posteo_{{ $posteo->id }}">
                                        {{ count($posteo->comentarios) }}
                                        comentarios
                                    </div>
                                </div>
                            @endif
                        </div>
                    </a>


                    <a class="btn"
                            onclick="requestVotar(
                                            {{ $posteo->id }},
                                            '{{ csrf_token() }}',
                                            '{{ route('actualizarGustado', ['id' => $posteo->id]) }}'
                            )"
                            type="submit">

                        <div class="d-flex align-content-center">
                            @if ($posteo->esVotante(Auth::user()))
                                <div id="btn-mg-skin-{{ $posteo->id }}" class="d-flex estado-gustado">
                                    <span class="material-icons">
                                        favorite
                                    </span>
                                    &nbsp;
                                    <div id="votos_posteo_{{ $posteo->id }}">
                                        <b>
                                            {{ $posteo->votos }}
                                            me gusta
                                        </b>
                                    </div>
                                </div>
                            @else
                                <div id="btn-mg-skin-{{ $posteo->id }}" class="d-flex estado-no-gustado">
                                    <span class="material-icons">
                                        favorite
                                    </span>
                                    &nbsp;
                                    <div id="votos_posteo_{{ $posteo->id }}">
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
