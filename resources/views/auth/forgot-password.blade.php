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


    <form method="POST" action="{{ route('password.email') }}" class="registerForm">
        @csrf
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

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
