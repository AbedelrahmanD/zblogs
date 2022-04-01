@extends('admin/blogs_categories/blogs_categories')
@section('pageForm')
    <form action="/savBlogsCategory" method="post" class="cmForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="categoryIdEdit" value={{ $category->blog_category_id ?? 0 }}>
        <div class="cmInputContainer">

            <input type="text" placeholder=" " id="categoryName" name="categoryName" class="cmInput"
                value="{{ $category->blog_category_name ?? '' }}">
            <label class="cmLabel">Category Name</label>
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
        @isset($category)
            <div class="previewImagesGrid">
                @foreach ($category->images as $image)
                    <div class="previewImage">
                        <img src="{{ URL::asset($image) }}" alt="">
                    </div>
                @endforeach
            </div>
        @endisset
        <button id="blogsCategoryAdd" class="cmButton" type="submit">

            <span>
                @if (isset($category))
                    Update
                @else
                    Save
                @endif
            </span>
            &nbsp;
            <i class="fas fa-check"></i>
        </button>
        <i class="loadingSpinner fas fa-yin-yang"></i>
        <div id="saveCategoryToast" class="cmToast cmToastHide">
            <span>
                @if (isset($category))
                    Category Updated
                @else
                    Category Added
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
