<x-guest-layout>
    <x-slot name="header">
        <h2 class="absolute bottom-1/4 hidden sm:inline-block font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Login') }}
        </h2>
        <h1 class="absolute left-2/4 font-semibold text-3xl bg-white p-8 px-32 text-gray-800 text-center 
        border-green-300 border-b-4 border-r-4 border-l-4 rounded-xl" 
        style="left: calc(50% - 218.135px);">
            Care Of Yore
        </h1>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class='border-b-2 border-gray-600' src='https://i.imgur.com/2gv7ibV.png' style='width: 120px; height: 160px'>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <input type='hidden' id='approval' name='approval' value='1'>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex justify-evenly items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <form class='flex justify-evenly mt-3' method='GET' action='register'>
            <p class="text-sm text-gray-600">Not logged in yet?</p>
            <x-button class="ml-3">
                Register
            </x-button>
        </form>
    </x-auth-card>
    <x-slot name="footer">
        <x-feature-footer></x-feature-footer>
    </x-slot>
</x-guest-layout>
