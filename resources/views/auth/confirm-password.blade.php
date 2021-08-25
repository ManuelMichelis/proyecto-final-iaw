<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a class="text-dark" href="/" style="text-decoration: none">
                <div class="logo-font" style="font-size: 3rem">
                    {{ config('app.name') }}
                </div>
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Este es un área segura de la aplicación. Confirme su contraseña antes de continuar.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirmar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
