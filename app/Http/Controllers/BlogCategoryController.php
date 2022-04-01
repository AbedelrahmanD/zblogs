<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{

    public function editCategory(Request $r)
    {
        if (Auth::user()->type != "admin") {
            return redirect("/");
        }
        $category = BlogCategory::find($r->categoryId);
        $path = 'uploads/blogs_categories/' . $category->blog_category_id;
        if (file_exists($path)) {
            $images = scandir($path);
            for ($i = 2; $i < count($images); $i++) {
                $category->images[] = url("/") . "/" . $path . "/" . $images[$i];
            }
        }
        return view("/admin/blogs_categories/blogs_categories_add", compact("category"));
    }
    public function deleteCategory(Request $r)
    {
        $category = new BlogCategory();
        $category = BlogCategory::find($r["blog_category_id"]);
        $category->delete();
        return "deleted";
    }
    public function saveCategory(Request $r)
    {

        $newCategory = new BlogCategory();
        if ($r->blog_category_id != 0) {
            $newCategory = BlogCategory::find($r->blog_category_id);
        }
        $newCategory->blog_category_name = $r->blog_category_name;
        $newCategory->save();



        if ($r->file('files') != null) {
            $path = 'uploads/blogs_categories/' . $newCategory->blog_category_id;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            } else {
                SharedController::deleteDir('uploads/blogs_categories/' . $newCategory->blog_category_id);
                mkdir($path, 0777, true);
            }
            foreach ($r->file('files') as $key => $value) {
                $imageName = time() . $key . '.' . $value->getClientOriginalExtension();
                $value->move(public_path($path), $imageName);
            }
        }


        return "saved";
    }

    public function fetchBlogsCategories(Request $r)
    {
        $limit = $r->limit == null ? 9 : $r->limit;
        if ($r->categoryId != null) {
            $categories = BlogCategory::where("blog_category_id", $r->categoryId)->paginate($limit);
        } else
        if ($r->categoryName != null) {
            $categories = BlogCategory::where("blog_category_name", "like", "%" . $r->categoryName . "%")->paginate($limit);
        } else {
            $categories = BlogCategory::paginate($limit);
        }
        return $categories;
    }
    public function getCategories(Request $r)
    {
        if (Auth::user()->type != "admin") {
            return redirect("/");
        }

        $categories = $this->fetchBlogsCategories($r);
        return view("admin/blogs_categories/blogs_categories_list", compact("categories"));
    }
    public function getAppCategories(Request $r)
    {

        $categories = $this->fetchBlogsCategories($r);
        $categoryNameSearch = null;
        if ($r->categoryName != null) {
            $categoryNameSearch = $r->categoryName;
        }
        return view("blogs_categories", compact("categories", "categoryNameSearch"));
    }
}
