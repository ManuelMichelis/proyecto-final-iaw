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
            {{ __('¿Olvidó su contraseña? No hay problema. Ingrese su dirección de mail y le enviaremos un enlace que le permitirá elegir una nueva contraseña.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Enviar enlace de reseteo') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
