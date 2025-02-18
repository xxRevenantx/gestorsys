<x-guest-layout>
<div class="bg-gray-100 flex justify-center items-center h-screen">
    <!-- Left: Image -->
<div class="w-1/2 h-screen hidden lg:block">
  <img src="https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Placeholder Image" class="object-cover w-full h-full">
</div>
<!-- Right: Login Form -->
<div class= "lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">


    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession




  <h1 class="text-4xl text-center my-5">Gestor<span class="font-bold">SYS</span></h1>
  <h1 class="text-2xl font-semibold mb-4">Iniciar sesión</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Username Input -->
    <div class="mb-4">
        <x-label for="email">Correo</x-label>
        <x-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
        @error('email')
        <span class="text-red-500">{{ $message }}</span>
        @enderror


    </div>
    <!-- Password Input -->
    <div class="mb-4">
        <x-label for="password">Password</x-label>
        <x-input id="password" placeholder="Contraseña" class="block mt-1 w-full" type="password" name="password"  autocomplete="current-password" />
        @error('email')
        <span class="text-red-500">{{ $message }}</span>
        @enderror

    </div>
    <!-- Remember Me Checkbox -->
    <div class="mb-4 flex items-center">
      <input type="checkbox" id="remember" name="remember" class="text-orange-500">
      <label for="remember" class="text-gray-900 ml-2">{{ __('Remember me') }}</label>
    </div>

    <!-- Login Button -->
    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md py-2 px-4 w-full">Iniciar sesión</button>
  </form>

</div>
</div>
</x-guest-layout>


{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
