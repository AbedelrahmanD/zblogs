@extends('admin/blogs_posts/blogs_posts')
@section('pageForm')
    <div class="cmForm ">

        <table class="display" style="width:100%">
            <thead>
                <tr>
                    <th>
                        Title
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr id="singleItemRow_{{ $post->blog_post_id }}" class="singleItemRow">
                        <td>
                            {{ $post->blog_post_title }}
                        </td>
                        <td>
                            {{ $post->category->blog_category_name }}
                        </td>

                        <td class="singleItemRowAction">

                            <i id="delete_{{ $post->blog_post_id }}" class=" fas fa-times deletePostBtn"></i>
                            <a href="/editPost/{{ $post->blog_post_id }}">
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
