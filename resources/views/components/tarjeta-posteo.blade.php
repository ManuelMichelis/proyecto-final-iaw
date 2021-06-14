<link rel="stylesheet" href="{{ asset('css/tarjeta-posteo.css') }}">

<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg container">
        <div class="d-flex justify-content-between" style="padding-top: 5px">
        <div>
            <b> {{ $posteo->aliasUsuario() }} </b> - <i>{{ $posteo->topico()->first()->nombre }}</i>
        </div>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <span class="material-icons" style="color: #141414">
                        more_vert
                    </span>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('borrarPosteo',['id'=> $posteo->id]) }}">
                    @csrf
                    <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
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
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <div class="d-flex justify-content-start">
                            <div class="d-flex align-items-center">
                                <span class="material-icons">
                                    outlined_flag
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                &nbsp;
                                {{ __('Reportar') }}
                            </div>
                        </div>
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        </div>
        <div class="p-4 bg-white border-b border-gray-200">

            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-2 bg-white" style="color: rgb(92, 92, 92)">
                    {{ $posteo->titulo }}
                    &nbsp;
                    <!--{{ $posteo->contenido }}-->
                </div>
                <div style="padding:8px; border-top:1px solid #ddd" class="col-md-12"></div>
                <div class="row container">
                    <form method="POST" action="{{ route('nuevoLike',['id' => $posteo->id]) }}">
                        @csrf
                        <button type="submit">
                            @if ($posteo->esVotante(Auth::user()))
                                <span id="spanLike" class="material-icons" style="padding-right: 20px; color: firebrick">
                                    favorite
                                </span>
                            @else
                                <span id="spanLike" class="material-icons" style="padding-right: 20px; color: darkslategray">
                                    favorite
                                </span>
                            @endif
                        </button>
                    </form>
                    <form method="POST">
                        @csrf
                        <button type="submit">
                            <span class="material-icons" style='padding-right: 20px;'>
                                sms
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
