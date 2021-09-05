@extends('admin/blogs_categories/blogs_categories')
@section('pageForm')
    <div class="cmForm ">
        <table class="display" style="width:100%">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>

                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr id="singleItemRow_{{ $category->blog_category_id }}" class="singleItemRow">
                        <td>
                            {{ $category->blog_category_name }}
                        </td>


                        <td class="singleItemRowAction">

                            <i id="delete_{{ $category->blog_category_id }}" class=" fas fa-times deleteBtn"></i>
                            <a href="/editCategory/{{ $category->blog_category_id }}">
                                <i class="fas fa-pen"></i>
                            </a>


                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
    <script>
        activeTab(".listPage");
    </script>
@endsection
