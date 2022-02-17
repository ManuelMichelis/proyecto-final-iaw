    <x-borderline/>

    <div class="p-2" style="font-size: 0.92rem">
        {{ $posteo->created_at->format('H:i') }}
        &nbsp; <b>·</b> &nbsp;
        {{ $posteo->created_at->format('d/m/Y') }}
    </div>

    <x-borderline/>

    <div class="m-1">
        <div class="d-flex" style="font-size: 0.96rem">
<!-- BOTON DE 'ME GUSTA' -->
            <div class="p-1">
                <div class="ml-2">
                    <a class="btn"
                            onclick="actualizarLike(
                                            {{ $posteo->id }},
                                            '{{ csrf_token() }}',
                                            '{{ route('actualizarLike', ['id' => $posteo->id]) }}'
                            )"
                            type="submit">

                        <div class="d-flex align-content-center">
                            @if ($posteo->estaInteresado(Auth::user()))
                                <div id="btn-like-skin-{{ $posteo->id }}" class="d-flex like">
                                    <span class="material-icons">
                                        thumb_up
                                    </span>
                                    &nbsp;
                                    <div id="likes_posteo_{{ $posteo->id }}">
                                        <b>
                                            {{ $posteo->likes }}
                                            me gusta
                                        </b>
                                    </div>
                                </div>
                            @else
                                <div id="btn-like-skin-{{ $posteo->id }}" class="d-flex neutro">
                                    <span class="material-icons">
                                        thumb_up
                                    </span>
                                    &nbsp;
                                    <div id="likes_posteo_{{ $posteo->id }}">
                                        {{ $posteo->likes }}
                                        me gusta
                                    </div>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            <!-- BOTON DE 'NO ME GUSTA' -->
            <div class="p-1">
                <div class="ml-2">
                    <a class="btn"
                            onclick="actualizarDislike(
                                            {{ $posteo->id }},
                                            '{{ csrf_token() }}',
                                            '{{ route('actualizarDislike', ['id' => $posteo->id]) }}'
                            )"
                            type="submit">

                        <div class="d-flex align-content-center">
                            @if ($posteo->estaDesinteresado(Auth::user()))
                                <div id="btn-dislike-skin-{{ $posteo->id }}" class="d-flex dislike">
                                    <span class="material-icons">
                                        thumb_down_alt
                                    </span>
                                    &nbsp;
                                    <div id="dislikes_posteo_{{ $posteo->id }}">
                                        <b>
                                            {{ $posteo->dislikes }}
                                            no me gusta
                                        </b>
                                    </div>
                                </div>
                            @else
                                <div id="btn-dislike-skin-{{ $posteo->id }}" class="d-flex neutro">
                                    <span class="material-icons">
                                        thumb_down_alt
                                    </span>
                                    &nbsp;
                                    <div id="dislikes_posteo_{{ $posteo->id }}">
                                        {{ $posteo->dislikes }}
                                        no me gusta
                                    </div>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
