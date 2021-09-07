@extends('shared')
@section('body')

    <div class="pageInfo gradient2">
        <div class="pageInfoImage">
            @if ($post->category->getImage() == '')
                <img src="{{ URL::asset('images/category.png') }}" alt="">
            @else
                <img src="{{ $post->category->getImage() }}" alt="">
            @endif
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/posts">Posts</a></li>
                <li><a
                        href="/posts/{{ $post->category->blog_category_id }}">{{ $post->category->blog_category_name }}</a>
                </li>
                <li>{{ $post->blog_post_title }}</li>
            </ul>
        </div>

    </div>



    <div class="bodyLimiter">
        <a class="autherName cmButton" href="/posts_by_user/{{ $post->user->id }}">
            By {{ $post->user->name }}
            &nbsp;
            <img class="userProfileImage" src="https://avatars.dicebear.com/api/initials/{{ $post->user->name }}.svg">
        </a>
        @if ($post->blog_post_is_horizontal == 1)
            <div class="blogInfoHorisontal">
            @else
                <div class="blogInfoVertical">
        @endif

        <div class="blogPostInfoImage ">

            @if (count($post->images) > 0)
                <img src="{{ $post->images[0] }}" alt="">
            @else
                <img src="{{ URL::asset('images/post.png') }}" alt="">
            @endif
        </div>
        <div class="blogPostInfoDescription">
            {!! $post->blog_post_description !!}
        </div>
    </div>
    </div>
    </div>
    <script>
        scrollDown();
    </script>
@endsection
