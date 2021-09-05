@extends('shared')
@section('body')

    <div class="pageInfo gradient1">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/add.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/posts">Posts</a></li>
                <li>Add Post </li>
            </ul>
        </div>
    </div>
    <div class="bodyLimiter">
        <form action="/savBlog" method="post" class="cmForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="postIdEdit" value={{ $post->blog_post_id ?? 0 }}>
            <div class="cmInputContainer">
                <input type="text" placeholder=" " id="postTitle" class="cmInput"
                    value="{{ $post->blog_post_title ?? '' }}">
                <label class="cmLabel"> Post Title</label>
            </div>
            <div class="cmInputContainer">
                <select id="postCategory" class="cmInput">
                    @isset($categories)
                        @foreach ($categories as $category)
                            @if (isset($post) && $post->blog_category_id == $category->blog_category_id)
                                <option selected value="{{ $category->blog_category_id }}">
                                    {{ $category->blog_category_name }}
                                </option>
                            @else
                                <option value="{{ $category->blog_category_id }}">{{ $category->blog_category_name }}
                                </option>

                            @endif

                        @endforeach
                    @endisset
                </select>
                <label class="cmLabel"> Post Title</label>
            </div>




            <div id="editor" classs="postDesc">
                {!! $post->blog_post_description ?? '' !!}
            </div>


            <div class="cmFileContainer">
                &nbsp;
                <button class="cmButton fillBg" id="uploadFile">
                    <span>Choose Image</span>
                    &nbsp;<i class="fas fa-upload   "></i>
                </button>
                &nbsp; &nbsp;
                <div id="fileNamePreview"></div>
            </div>
            <input type="file" id='files' name="files[]" style="display: none">
            <div class="cmCheckBox">
                <span>
                    Horizontal View
                </span>
                &nbsp;
                @if (isset($post))
                    @if ($post->blog_post_is_horizontal == 1)
                        <input type="checkbox" id="isHorizontal" checked>
                    @else
                        <input type="checkbox" id="isHorizontal">
                    @endif

                @else
                    <input type="checkbox" id="isHorizontal">
                @endif

            </div>
            <div class="previewImagesGrid">
                <div class="previewImage">
                    @isset($post)
                        @if (count($post->images) > 0)
                            <img id="postImageId" src="{{ URL::asset($post->images[0]) }}" alt="">
                        @endif

                    @endisset

                </div>
            </div>

            <button id="blogsPostAdd" class="cmButton" type="submit">

                <span>
                    @if (isset($post))
                        Update
                    @else
                        Save
                    @endif
                </span>
                &nbsp;
                <i class="fas fa-check"></i>

            </button>
            @if (isset($post))
                <button id="appBlogsPostDelet_{{ $post->blog_post_id }}" class=" deletePostBtn cmButton" type="submit">
                    <span>
                        Delete
                    </span>
                    &nbsp;
                    <i class="fas fa-trash"></i>
                </button>

            @endif

            <div id="savePostToast" class="cmToast cmToastHide">
                <span>
                    @if (isset($post))
                        Post Updated
                    @else
                        Post Added
                    @endif

                </span>
                &nbsp; &nbsp;
                <i class="fas fa-check"></i>
            </div>


        </form>

    </div>
    <script>
        scrollDown();
    </script>
@endsection
