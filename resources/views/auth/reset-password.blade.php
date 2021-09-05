@extends('../shared')
@section('body')
    <div class="pageInfo gradient2">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/login.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/forgot-password">Forget Password</a></li>
                <li>Reset Password </li>
            </ul>
        </div>
    </div>


    <form method="POST" action="{{ route('password.update') }}" class="registerForm">

        @csrf
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
            <label class="cmLabel"> New Password</label>
        </div>


        <div class="cmInputContainer">
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="current-password" placeholder=" " class="cmInput">
            <label class="cmLabel"> Confirm NewPassword</label>
        </div>


        <button class="cmButton" type="submit">
            <span> Reset Password</span>
            &nbsp;
            <i class="fas fa-sign-in-alt"></i>
        </button>


    </form>

    <script>
        scrollDown();
    </script>
@endsection
