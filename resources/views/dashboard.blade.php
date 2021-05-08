<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>
    <br>
    @foreach ($posteos as $posteo)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 bg-white border-b border-gray-200">
                        {{ $posteo->alias_usuario }} - {{ $posteo->topicos()->first()->nombre }}
                        <div class="bg-white overflow-hidden sm:rounded-lg">
                            <div class="p-2 bg-white"></div>
                                {{ $posteo->contenido }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
