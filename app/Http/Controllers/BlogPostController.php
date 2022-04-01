<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{

    public function appPostEdit(Request $r)
    {
        $post = BlogPost::find($r->postId);

        $path = 'uploads/blogs_posts/' . $post->blog_post_id;
        if (file_exists($path)) {
            $images = scandir($path);
            for ($i = 2; $i < count($images); $i++) {
                $post->images[] = url("/") . "/" . $path . "/" . $images[$i];
            }
        }


        $categories = BlogCategory::all();
        return view("blog_post_add", compact("categories", "post"));
    }
    public function appMyPosts(Request $r)
    {

        $userId = $r->userId == null ? Auth::user()->id : $r->userId;
        $posts = BlogPost::where("user_id", $userId)->orderBy('blog_post_date', 'DESC')->paginate(9);

        foreach ($posts as $post) {
            $path = 'uploads/blogs_posts/' . $post->blog_post_id;
            if (file_exists($path)) {
                $images = scandir($path);
                for ($i = 2; $i < count($images); $i++) {
                    $post->images[] = url("/") . "/" . $path . "/" . $images[$i];
                }
            }
        }
        $category = null;
        $postsearchName = $r->postName ?? null;
        return view("blogs_posts", compact("posts", "category", "postsearchName"));
    }
    public function appPostAdd(Request $r)
    {
        $categories = BlogCategory::all();
        return view("blog_post_add", compact("categories"));
    }

    public function getAppHome(Request $r)
    {

        $r->merge(['limit' => 3]);
        $posts = $this->fetchPosts($r);
        $categories = BlogCategory::all()->take(3);
        return view("home", compact("posts", "categories"));
    }

    public function getAppPosts(Request $r)
    {

        $posts = $this->fetchPosts($r);
        $category = null;
        $postsearchName = $r->postName ?? null;

        return view("blogs_posts", compact("posts", "category", "postsearchName"));
    }

    public function getAppPostInfo(Request $r)
    {
        $post = $this->fetchPosts($r);
        return view("blog_post_info", compact("post"));
    }
    public function editPost(Request $r)
    {
        if (Auth::user()->type != "admin") {
            return redirect("/");
        }
        $categories = BlogCategory::all();
        $post = BlogPost::find($r->postId);
        $path = 'uploads/blogs_posts/' . $post->blog_post_id;
        if (file_exists($path)) {
            $images = scandir($path);
            for ($i = 2; $i < count($images); $i++) {
                $post->images[] = $path . "/" . $images[$i];
            }
        }

        return view("admin/blogs_posts/blogs_posts_add", compact("post", "categories"));
    }
    public function deleteCategory(Request $r)
    {


        $post = new BlogPost();
        $post = BlogPost::find($r->blog_post_id);
        $post->delete();
        return "deleted";
    }

    public function blogPostAddView()
    {
        if (Auth::user()->type != "admin") {
            return redirect("/");
        }
        $categories = BlogCategory::all();
        return view("admin/blogs_posts/blogs_posts_add", compact("categories"));
    }

    public function savePost(Request $r)
    {

        $post = new BlogPost();
        if ($r->blog_post_id != 0) {
            $post = BlogPost::find($r->blog_post_id);
        }
        $post->blog_post_title = $r->blog_post_title;
        $post->blog_post_description = $r->blog_post_description;
        $post->blog_category_id = $r->blog_category_id;
        $post->blog_post_is_horizontal = $r->blog_post_is_horizontal;
        $post->blog_post_date = Carbon::now();
        $post->user_id = Auth::user()->id;
        $post->save();

        if ($r->file('files') != null) {
            $path = 'uploads/blogs_posts/' . $post->blog_post_id;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            } else {
                SharedController::deleteDir('uploads/blogs_posts/' . $post->blog_post_id);
                mkdir($path, 0777, true);
            }
            foreach ($r->file('files') as $key => $value) {
                $imageName = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path($path), $imageName);
            }
            return url("/") . "/" . $path . "/" . $imageName;
        }
        return "saved";
    }

    public function fetchPosts(Request $r)
    {
        $limit = $r->limit == null ? 9 : ($r->limit == "all" ? null : $r->limit);
        $single = false;
        if ($r->postCategory != null && $r->postName != null) {
            $posts = BlogCategory::find($r->postCategory)->posts()->where("blog_post_title", "like", "%" . $r->postName . "%")
                ->orderBy('blog_post_date', 'DESC')
                ->paginate($limit);
        } else
        if ($r->postId != null) {
            $single = true;
            $posts = BlogPost::find($r->postId);
        } else    if ($r->postName != null) {
            $posts = BlogPost::where("blog_post_title", "like", "%" . $r->postName . "%")
                ->orderBy('blog_post_date', 'DESC')
                ->paginate($limit);
        } else if ($r->postCategory != null) {
            $posts = BlogCategory::find($r->postCategory)->posts()
                ->orderBy('blog_post_date', 'DESC')
                ->paginate($limit);;
        } else {
            $posts = BlogPost::orderBy('blog_post_date', 'DESC')->paginate($limit);
        }

        if ($posts != null) {
            if ($single == true) {
                $path = 'uploads/blogs_posts/' . $posts->blog_post_id;
                if (file_exists($path)) {
                    $images = scandir($path);
                    for ($i = 2; $i < count($images); $i++) {
                        $posts->images[] = url("/") . "/" . $path . "/" . $images[$i];
                    }
                }
            } else {

                foreach ($posts as $post) {
                    $path = 'uploads/blogs_posts/' . $post->blog_post_id;
                    if (file_exists($path)) {
                        $images = scandir($path);
                        for ($i = 2; $i < count($images); $i++) {
                            $post->images[] = url("/") . "/" . $path . "/" . $images[$i];
                        }
                    }
                }
            }
        }

        return $posts;
    }
    public function getPosts(Request $r)
    {
        if (Auth::user()->type != "admin") {
            return redirect("/");
        }
        $r->merge([
            "limit" => "all"
        ]);
        $posts = $this->fetchPosts($r);
        return view("admin/blogs_posts/blogs_posts_list", compact("posts"));
    }
}
