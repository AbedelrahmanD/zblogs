<!DOCTYPE html>
<html lang="en">
@php
$webVersion = 'version=2';
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ URL::asset('css/aos.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/fontawesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/shared.css') }}?<?= $webVersion ?>">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}?<?= $webVersion ?>">
    <link rel="stylesheet" href="{{ URL::asset('css/blog_post_info.css') }}?<?= $webVersion ?>">
    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo.png') }}?<?= $webVersion ?>">
    <link href="{{ URL::asset('css/dashboard.css') }}?<?= $webVersion ?>" rel="stylesheet">
    <link href="{{ URL::asset('css/quil.css') }}?<?= $webVersion ?>" rel="stylesheet">
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/shared.js') }}?<?= $webVersion ?>"></script>

    <title>Blogs</title>
</head>

<body>
    <div class="bodyContainer">
        <div class="bodyContainer">
            <div class="loadingScreen">
                <div>
                    <i class="fas fa-blog"></i>
                </div>
            </div>

            <nav class="applicationNav">
                <div class="menuContainer">
                    <a href="/" class="logoImage">
                        <img src="{{ URL::asset('images/logo.png') }}" alt="">
                        @if (Illuminate\Support\Facades\Auth::check())
                            <span>
                                {{ Illuminate\Support\Facades\Auth::user()->name }}
                            </span>
                        @endif
                    </a>



                    <ul class="menuTitlesContainer menuTitlesContainerHide">
                        <div class="menuTitleContainerStyle">

                            <a href="/" id="homeMenu">
                                <i class="fas fa-home"></i>
                                &nbsp;
                                <span>Home</span>
                            </a>
                            <a href="/posts" id="postMenu">
                                <i class="fas fa-blog"></i>
                                &nbsp;
                                <span>Posts</span>
                            </a>
                            <a href="/categories" id="categoryMenu">
                                <i class="fas fa-certificate"></i>
                                &nbsp;
                                <span>Categories</span>
                            </a>
                            @if (Illuminate\Support\Facades\Auth::check())
                                <span class="userDropDownContainer">

                                    <img class="mainIcon"
                                        src="https://avatars.dicebear.com/api/initials/{{ Illuminate\Support\Facades\Auth::user()->name }}.svg">
                                    <div class="userDropDownOptions">

                                        <a href="/post_add">
                                            <span>Add Posts</span>
                                            &nbsp;
                                            <i class="fas fa-blog"></i>
                                        </a>
                                        <a href="/my_posts">
                                            <span>My Posts</span>
                                            &nbsp;
                                            <i class="fas fa-blog"></i>
                                        </a>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <button class="cmButton" type="submit" style="padding:10px">
                                                <span>Logout</span>
                                                &nbsp;
                                                <i class="fas fa-sign-out-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </span>


                            @else
                                <a href="/login">
                                    <i class="fas fa-user"></i>
                                    &nbsp;
                                    <span>Login</span>
                                </a>

                            @endif
                            &nbsp; &nbsp; &nbsp; &nbsp;

                        </div>
                    </ul>
                    <div class="menuToggle">
                        <i class="fas fa-stream"></i>
                    </div>
                </div>
            </nav>


            <div class="contentContaoner">
                @yield('body')

            </div>


            <div class="goTop fillBg">
                <i class="fas fa-sort-up"></i>
            </div>


            <footer>
                <div class="footerContainer">
                    <div class="footerLogoContainer">
                        <img src="{{ URL::asset('images/logo.png') }}" alt="">
                    </div>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                    <div class="footerMenuContainer">

                        @php
                            foreach (App\Models\BlogCategory::getCategories(5) as $category) {
                                echo "<a href='/posts/" . $category->blog_category_id . " ' class='ridItemforCategory'>$category->blog_category_name</a>";
                            }
                        @endphp

                    </div>
                    <div class="socialMediaContainer">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </footer>
        </div>

</body>
<script src="{{ URL::asset('js/quil.js') }}"></script>
<script src="{{ URL::asset('js/aos.js') }}"></script>
<script src="{{ URL::asset('js/packages.js') }}?<?= $webVersion ?>"></script>
<script src="{{ URL::asset('js/blogs_posts.js') }}?<?= $webVersion ?>"></script>
<script src="{{ URL::asset('js/home.js') }}?<?= $webVersion ?>"></script>
<script src="{{ URL::asset('js/app_blogs_categories.js') }}?<?= $webVersion ?>"></script>
<script src="{{ URL::asset('js/app_blogs_posts.js') }}?<?= $webVersion ?>"></script>

</html>
