@extends('shared')
@section('body')
    <div class="pageInfo gradient1">
        <div class="pageInfoImage">
            <img src="{{ URL::asset('images/category.png') }}" alt="">
        </div>
        <div class="pageInfoText">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li>Categories</li>
            </ul>
        </div>
    </div>
    <form class="searchContainer" id="categorySearchForm">
        <div class="cmInputContainer">
            <input type="text" placeholder=" " class="cmInput" id="searchCategoryName"
                value={{ $categoryNameSearch ?? '' }}>
            <label class="cmLabel"> Search...</label>
        </div>
    </form>
    @if (isset($categories) && count($categories) > 0)
        <div class="gridItems">
            @foreach ($categories as $category)

                <a href="/posts/{{ $category->blog_category_id }}/3" class="gridItemforCategory" data-aos="zoom-in"
                    data-aos-duration="2000">
                    <div class="gridItemImageContainer">
                        @if ($category->getImage() != '')
                            <img src="{{ $category->getImage() }}" alt="" loading="lazy">
                        @else
                            <img src="{{ URL::asset('images/category.png') }}" alt="">
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
        <div class="paginationDiv">
            {{ $categories->links() }}
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
        activeMenuItem("#categoryMenu");
        scrollDown();
    </script>
@endsection
