@extends('admin/blogs_posts/blogs_posts')
@section('pageForm')

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
                            <option selected value="{{ $category->blog_category_id }}">{{ $category->blog_category_name }}
                            </option>
                        @else
                            <option value="{{ $category->blog_category_id }}">{{ $category->blog_category_name }}</option>

                        @endif

                    @endforeach
                @endisset
            </select>
            <label class="cmLabel"> Post Title</label>
        </div>


        <i id="compressEditer" class="fas fa-compress-arrows-alt"></i>
        <i id="expandEditer" class="fas fa-expand-arrows-alt"></i>
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
        <div class="flexRowCenter">
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
                &nbsp; &nbsp; &nbsp;
                <button id="adminlogsPostDelet_{{ $post->blog_post_id }}" class=" deletePostBtn cmButton" type="submit">
                    <span>
                        Delete
                    </span>
                    &nbsp;
                    <i class="fas fa-trash"></i>
                </button>

            @endif
        </div>
        <i class="loadingSpinner fas fa-yin-yang"></i>
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
    <script>
        activeTab(".addPage");
    </script>

@endsection
