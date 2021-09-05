@extends('shared')
@section('body')
    <!-- home slider -->
    <div class="homeImageContainer" data-aos="zoom-out" data-aos-duration="2000">
        <div class="homeContent">
            <h3 class="homeTitle">
                Welcom To <i class="fas fa-blog"></i>logs!
            </h3>
            <p class="homeDescription">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi, et modi facere odit reiciendis libero.
            </p>
            <a href="/posts">
                <button class="cmButton">
                    Discover
                    &nbsp;
                    <i class="fas fa-angle-right"></i>
                </button>
            </a>
        </div>
        <img src="{{ URL::asset('images/home.jfif') }}" alt="">
        <div class="overlay"></div>
    </div>
    <!-- blogs posts -->

    @if (isset($posts) && count($posts) > 0)
        <div class="cmSection">
            <h3>
                <i class="fas fa-blog"></i>
                &nbsp;
                Posts
            </h3>
            <div class="gridItems">
                @foreach ($posts as $post)

                    <div class="gridItem" data-aos="fade-up" data-aos-duration="2000">
                        <div class="gridItemImageContainer">
                            @if (count($post->images) > 0)
                                <img src="{{ $post->images[0] }}" alt="" loading="lazy">
                            @else
                                <img src="{{ URL::asset('images/post.png') }}" alt="">
                            @endif


                            <div class="gridItemCategory">
                                <img src="{{ $post->category->getImage() }}" alt="">
                            </div>
                        </div>
                        <div class="gridItemDetails">
                            <h3 class="gridItemDetailsTitle">
                                {{ $post->blog_post_title }}
                            </h3>
                            <p class="gridItemDetailsDescription">
                                {{ $post->stripDesc() }}
                            </p>

                            <div class="flexRowEnd">
                                <a href="/post/{{ $post->blog_post_id }}">
                                    <button class="cmButton">
                                        <span>
                                            Read More
                                        </span>
                                        &nbsp;
                                        <i class="fas fa-angle-double-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="gridItemDetailsDate">
                            {{ $post->blog_post_date }}
                        </div>

                    </div>


                @endforeach
            </div>

            <a href="/posts">
                <button class="cmButton">
                    <span>
                        More
                    </span>
                    &nbsp;
                    <i class="fas fa-angle-double-right"></i>
                </button>
            </a>
        </div>
    @else
        <div class="cmMessageContainer">
            <i class="far fa-frown"></i>
            <h3>
                No Posts Available
            </h3>
        </div>
    @endif








    <!-- blogs categories-->

    @if (isset($categories))
        <div class="cmSection">
            <h3>
                <i class="fas fa-certificate"></i>
                &nbsp;
                Categories
            </h3>
            <div class="gridItems">

                @foreach ($categories as $category)
                    <a href="/posts/{{ $category->blog_category_id }}" class="gridItemforCategory" data-aos="zoom-in"
                        data-aos-duration="2000">
                        <div class="gridItemImageContainer">
                            @if ($category->getImage() != '')
                                <img src="{{ $category->getImage() }}" alt="" loading="lazy">
                            @else
                                <img src="{{ URL::asset('images/post.png') }}" alt="">
                            @endif
                        </div>
                        <div class="gridItemDetails">
                            <h3 class="gridItemDetailsTitle">
                                {{ $category->blog_category_name }}
                            </h3>
                        </div>
                    </a>


                @endforeach
            </div>
            <a href="/categories">
                <button class="cmButton">
                    <span>
                        More
                    </span>
                    &nbsp;
                    <i class="fas fa-angle-double-right"></i>
                </button>
            </a>
        </div>
    @else
        <div class="cmMessageContainer">
            <i class="far fa-frown"></i>
            <h3>
                No Categories Available
            </h3>
        </div>
    @endif
    <script>
        activeMenuItem("#homeMenu");
    </script>

@endsection
