<x-guest-layout>
    <div class="mb-4 text-sm text-center text-gray-600 dark:text-gray-400 text-balance">
        {{ __('Esqueceu-se da passowrd? Coloque o seu email para continuar!') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}"  class="flex flex-col gap-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <x-primary-button>
            {{ __('Enviar Email') }}
        </x-primary-button>
    </form>
</x-guest-layout>
