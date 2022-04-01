@extends('../shared')
@section('body')
    <div class="pageInfo gradient2">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/login.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li>Login </li>
            </ul>
        </div>
    </div>



    <form method="POST" action="{{ route('login') }}" class="registerForm">
        @csrf

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->

        <div class="cmInputContainer">
            <input id="email" type="email" name="email" :value="old('email')" required class="cmInput"
                placeholder=" ">
            <label class="cmLabel"> Email</label>
        </div>



        <!-- Password -->


        <div class="cmInputContainer">
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder=" "
                class="cmInput">
            <label class="cmLabel"> Password</label>
        </div>


        <!-- Remember Me -->


        <div class="cmInputContainer" style="justify-content:flex-start">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </div>




        <div class="flexRowCenter ">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <div class="seperator"></div>
            <a href="/register">
                Create account
            </a>
        </div>
        <button class="cmButton" type="submit">
            <span> Login</span>
            &nbsp;
            <i class="fas fa-sign-in-alt"></i>
        </button>


    </form>

    <script>
        scrollDown();
    </script>
@endsection
