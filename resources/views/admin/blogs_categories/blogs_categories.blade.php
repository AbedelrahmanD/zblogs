@extends('admin/shared')

@section('body')
    <div class="pageOptions">
        <a href="/admin/blogs_categories_list" class="listPage">
            <i class="fas fa-list"></i>
        </a>
        |
        <a href="/admin/blogs_categories_add" class="addPage">
            <i class="fas fa-plus"></i>
        </a>
    </div>
    <div class="pageForm">
        @yield('pageForm')
    </div>
    <script>
        activeNavItem("#blogsCategoriesNavItem");
    </script>
@endsection
