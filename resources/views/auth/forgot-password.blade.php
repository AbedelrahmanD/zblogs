<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
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

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>


@extends('../shared')
@section('body')
    <div class="pageInfo gradient2">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/login.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/">Login</a></li>
                <li>Foregt Password </li>
            </ul>
        </div>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('password.email') }}" class="registerForm">

        @csrf





        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <h3>
            Enter your email to recive a link to reset your password
        </h3>

        <div class="cmInputContainer">
            <input id="email" type="email" name="email" :value="old('email')" required class="cmInput"
                placeholder=" ">
            <label class="cmLabel"> Email</label>
        </div>




        <button class="cmButton" type="submit">
            <span> Send</span>
            &nbsp;
            <i class="fas fa-paper-plane"></i>
        </button>


    </form>

    <script>
        scrollDown();
    </script>
@endsection
