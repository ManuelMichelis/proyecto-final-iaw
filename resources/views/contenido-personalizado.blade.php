<x-app-layout>

    <x-slot name="header">
    </x-slot>

    <style>

        .estado-suscripto {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .estado-sin-suscripcion {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

    </style>

    <div class="p-5">
        <div class="m-5">
            <div class="container">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="card-deck">


                        <!--div class="p-2">
                            <a
                                href="#"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                style="text-decoration: none"
                            >
                                <div class="card mb-4">
                                    <div class="m-2">
                                        <div class="d-flex justify-content-center">
                                            <span class="material-icons" style="font-size: 6rem">
                                                star_border
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="card-title">
                                            <b>
                                                Por tópicos seguidos
                                            </b>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </!--div-->
                        <div class="p-2">
                            <a
                                href="{{ route('recomendacionesPosteos') }}"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                style="text-decoration: none"
                            >
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
                            </a>
                        </div>
                        <div class="p-2">
                            <a
                                href="{{ route('recomendacionesUsuarios') }}"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                style="text-decoration: none"
                            >
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
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
