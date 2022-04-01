@extends('../shared')
@section('body')
    <div class="pageInfo gradient1">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/login.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/login">Login</a></li>
                <li>Register </li>
            </ul>
        </div>
    </div>




    <form method="POST" action="{{ route('register') }}" class="registerForm">
        @csrf

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="cmInputContainer">
            <input id="name" type="text" name="name" :value="old('name')" required class="cmInput" placeholder=" ">
            <label class="cmLabel"> Name</label>
        </div>


        <div class="cmInputContainer">
            <input id="email" type="text" name="email" :value="old('email')" required class="cmInput"
                placeholder=" ">
            <label class="cmLabel"> Email</label>
        </div>



        <div class="cmInputContainer">
            <input id="password" type="password" name="password" :value="old('password')" required class="cmInput"
                placeholder=" ">
            <label class="cmLabel"> Password</label>
        </div>

        <div class="cmInputContainer">
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder=" "
                :value="old('password_confirmation')" required class="cmInput">
            <label class="cmLabel"> Confirm Password</label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <button class="cmButton" type="submit">
                <span> Signup</span>
                &nbsp;
                <i class="fas fa-sign-in-alt"></i>
            </button>

        </div>
    </form>

    <script>
        scrollDown();
    </script>
@endsection
