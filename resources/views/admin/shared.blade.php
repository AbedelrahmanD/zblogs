<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo.png') }}">
    <link href="{{ URL::asset('css/datatable.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/quil.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/fontawesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/shared.css') }}">
    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/shared.js') }}"></script>
</head>

<body>
    <div class="bodyContainer">
        <div class="loadingScreen">
            <div>
                <i class="fas fa-blog"></i>
            </div>
        </div>
        <nav class="applicationNav">
            <div class="menuContainer">
                <div class="logoImage">
                    <img src="{{ URL::asset('images/logo.png') }}" alt="">
                </div>
                <ul class="menuTitlesContainer menuTitlesContainerHide">

                    <form action="/logout" method="post">
                        @csrf
                        <button class="cmButton" type="submit" style="margin: 0">
                            <span>Logout</span>
                            &nbsp;
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </ul>
                <div class="menuToggleForAdmin">
                    <i class="fas fa-stream"></i>
                </div>
            </div>
        </nav>

        <div class="dashboardContainer">
            <div class="dashboardNav dashboardNavHide">
                <a href="/admin/blogs_posts_list" class="navItem" id="blogsPostsNavItem">
                    <i class="fas fa-blog "></i>
                    &nbsp;
                    <span>Blogs Posts</span>
                </a>
                <a href="/admin/blogs_categories_list" class="navItem" id="blogsCategoriesNavItem">
                    <i class="fas fa-certificate"></i>
                    &nbsp;
                    <span>Blogs Categories</span>
                </a>
            </div>

            <div class="dashboardBody">
                @yield('body')
            </div>
        </div>














    </div>

    <script src="{{ URL::asset('js/quil.js') }}"></script>
    <script src="{{ URL::asset('js/datatable.js') }}"></script>
    <script src="{{ URL::asset('js/packages.js') }}"></script>
    <script src="{{ URL::asset('js/blogs_categories.js') }}"></script>
    <script src="{{ URL::asset('js/blogs_posts.js') }}"></script>
</body>

</html>
