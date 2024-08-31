<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

  <main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 dark:bg-gray-800">
      <!-- Breadcrumb Start -->
      <div
        class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
      >
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
          Sign In
        </h2>

        <nav>
          <ol class="flex items-center gap-2">
            <li>
              <a class="font-medium text-white" href="register">sign up /</a>
            </li>
          </ol>
        </nav>
      </div>
      <!-- Breadcrumb End -->

      <!-- ====== Forms Section Start -->
      <div
        class="rounded-sm border border-gray-700 shadow-default dark:border-strokedark dark:bg-boxdark dark:bg-gray-800"
      >
        <div class="flex flex-wrap items-center">
          <div class="w-[500px] border-gray-700 dark:border-strokedark xl:border">
            <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
              <h2
                class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2"
              >
                Sign In     
              </h2>

              <form method="POST" action="{{ route('login') }}">
                
                @csrf
                
                <div class="mb-4">
                    <x-text-input id="username" type="text" name="username" placeholder="Enter your username" :value="old('username')" class="w-full text-white rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" />
        
                    <x-text-input id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" 
                                      placeholder="6+ Characters, 1 Capital letter"
                                    class="w-full text-white rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-5">
                  <input
                    type="submit"
                    value="Sign In"
                    class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90"
                  />
                </div>

                <button
                  class="flex text-white w-full items-center justify-center gap-3.5 rounded-lg border border-stroke bg-gray p-4 font-medium hover:bg-opacity-70 dark:border-strokedark dark:bg-meta-4 dark:hover:bg-opacity-70"
                >
                  <span>
                    <svg
                      width="20"
                      height="20"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_191_13499)">
                        <path
                          d="M19.999 10.2217C20.0111 9.53428 19.9387 8.84788 19.7834 8.17737H10.2031V11.8884H15.8266C15.7201 12.5391 15.4804 13.162 15.1219 13.7195C14.7634 14.2771 14.2935 14.7578 13.7405 15.1328L13.7209 15.2571L16.7502 17.5568L16.96 17.5774C18.8873 15.8329 19.9986 13.2661 19.9986 10.2217"
                          fill="#4285F4"
                        />
                        <path
                          d="M10.2055 19.9999C12.9605 19.9999 15.2734 19.111 16.9629 17.5777L13.7429 15.1331C12.8813 15.7221 11.7248 16.1333 10.2055 16.1333C8.91513 16.1259 7.65991 15.7205 6.61791 14.9745C5.57592 14.2286 4.80007 13.1801 4.40044 11.9777L4.28085 11.9877L1.13101 14.3765L1.08984 14.4887C1.93817 16.1456 3.24007 17.5386 4.84997 18.5118C6.45987 19.4851 8.31429 20.0004 10.2059 19.9999"
                          fill="#34A853"
                        />
                        <path
                          d="M4.39899 11.9777C4.1758 11.3411 4.06063 10.673 4.05807 9.99996C4.06218 9.32799 4.1731 8.66075 4.38684 8.02225L4.38115 7.88968L1.19269 5.4624L1.0884 5.51101C0.372763 6.90343 0 8.4408 0 9.99987C0 11.5589 0.372763 13.0963 1.0884 14.4887L4.39899 11.9777Z"
                          fill="#FBBC05"
                        />
                        <path
                          d="M10.2059 3.86663C11.668 3.84438 13.0822 4.37803 14.1515 5.35558L17.0313 2.59996C15.1843 0.901848 12.7383 -0.0298855 10.2059 -3.6784e-05C8.31431 -0.000477834 6.4599 0.514732 4.85001 1.48798C3.24011 2.46124 1.9382 3.85416 1.08984 5.51101L4.38946 8.02225C4.79303 6.82005 5.57145 5.77231 6.61498 5.02675C7.65851 4.28118 8.9145 3.87541 10.2059 3.86663Z"
                          fill="#EB4335"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_191_13499">
                          <rect width="20" height="20" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </span>
                  Sign in with Google
                </button>

                <div class="mt-6 text-center">
                  <p class="font-medium text-gray-500">
                    Don’t have any account?
                    <a href="register" class="text-primary">Sign Up</a>
                  </p>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
     
                </div><br/>
        
                @if ($errors->has('status'))
                
                        <div class="text-red-500 flex justify-center" >
                
                            {{ $errors->first('status') }}
                    
                        </div>
            
                @endif

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- ====== Forms Section End -->
    </div>
  </main>

</body>
</html>


</x-guest-layout>
