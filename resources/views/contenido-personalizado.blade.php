<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <div class="p-5">
        <div class="m-5">
            <div class="container">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="card-deck">
                            <div class="p-2">
                                <x-link href="{{ route('recomendacionesPosteos') }}" style="text-decoration: none">
                                    <div class="card mb-4">
                                        <div class="m-2">
                                            <div class="d-flex justify-content-center">
                                                <span class="material-icons" style="font-size: 6rem">
                                                    recommend
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <h6 class="card-title">
                                                <b>
                                                    Posteos recomendados
                                                </b>
                                            </h6>
                                        </div>
                                    </div>
                                </x-link>
                            </div>
                            <div class="p-2">
                                <x-link href="{{ route('recomendacionesUsuarios') }}" style="text-decoration: none">
                                    <div class="card mb-4">
                                        <div class="m-2">
                                            <div class="d-flex justify-content-center">
                                                <span class="material-icons" style="font-size: 6rem">
                                                    people
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <h6 class="card-title">
                                                <b>
                                                    Usuarios recomendados
                                                </b>
                                            </h6>
                                        </div>
                                    </div>
                                </x-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
