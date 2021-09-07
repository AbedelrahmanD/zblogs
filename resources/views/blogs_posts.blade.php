@extends('shared')
@section('body')
    <div class="pageInfo gradient2">
        <div class="pageInfoImage">
            @if ($category != null)
                @if ($category->getImage() != '')
                    <img src="{{ $category->getImage() }}" alt="">
                @else
                    <img src="{{ URL::asset('images/post.png') }}" alt="">
                @endif

            @else
                <img src="{{ URL::asset('images/post.png') }}" alt="">
            @endif



        </div>

        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li> <a href="/posts">Posts</a></li>
                @if ($category != null)
                    <li>{{ $category->blog_category_name }}</li>
                @endif


            </ul>
        </div>
    </div>
    <form class="searchContainer" id="postSerachForm">
        <div class="cmInputContainer">
            <img id="enterImageSearchPost" class="enterImage" src=" {{ URL::asset('images/enter_black.png') }}" alt="">
            <input type="text" placeholder=" " class="cmInput" id="searchPostName"
                value={{ $postsearchName ?? '' }}>
            <label class="cmLabel"> Search...</label>
        </div>
    </form>
    @if (isset($posts) && count($posts) > 0)
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
                            @if ($post->category->getImage() == '')
                                <img src="{{ URL::asset('images/category.png') }}" alt="">
                            @else
                                <img src="{{ $post->category->getImage() }}" alt="">
                            @endif

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
                        @if (Illuminate\Support\Facades\Auth::check())
                            @if (Illuminate\Support\Facades\Auth::user()->id == $post->user_id)
                                <a href="post_edit/{{ $post->blog_post_id }}" class="gridItemEdit">
                                    <i class="fas fa-pen"></i>
                                </a>

                            @endif
                        @endif

                    </div>
                    <div class="gridItemDetailsDate">
                        {{ $post->blog_post_date }}
                    </div>

                </div>


            @endforeach

        </div>
        <div class="paginationDiv">
            {{ $posts->links() }}
        </div>
    @else
        <div class="cmMessageContainer">
            <i class="far fa-frown"></i>
            <h3>
                No Posts Available
            </h3>
        </div>
    @endif
    <script>
        activeMenuItem("#postMenu");
        scrollDown();
    </script>
@endsection
