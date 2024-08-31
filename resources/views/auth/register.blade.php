

<x-guest-layout>
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 dark:bg-gray-800">
          <!-- Breadcrumb Start -->
          <div
            class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
          >
            <a href="{{route('register')}}" class="text-title-md2 font-bold text-black dark:text-white">
              Sign up
            </a>
    
            <nav>
              <ol class="flex items-center gap-2">
                <li>
                  <a class="font-medium text-white" href="{{route('login')}}">sign in </a>
                </li>
              </ol>
            </nav>
          </div>

          <div
            class="w-[500px] border-gray-700 "
          >
            <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
              <h2
                class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2"
              >
                Sign Up     
              </h2>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!--User Name-->
        <div>
            <x-input-label for="username" :value="__('User Name')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" placeholder="Username" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            placeholder="Confirm Password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            

            <x-primary-button class="ms-4 bg-gray-900">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

    </form>
</x-guest-layout>
