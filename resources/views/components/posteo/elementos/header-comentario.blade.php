<div class="d-flex justify-content-between">
    <div class="d-flex justify-content-start">

        <span class="material-icons">
            account_circle
        </span>
        &nbsp;
        <a class="label-alias" href="{{ route('verUsuario', $posteo->aliasPublicador()) }}">
            <b>
                {{ $posteo->aliasPublicador() }}
            </b>
        </a>
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
                            onclick="eliminarPosteo(
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
                                {{ __('Reportar') }}
                            </div>
                        </div>
                    </x-dropdown-link>
                @endif
            </x-slot>
        </x-dropdown>
    </div>
</div>
