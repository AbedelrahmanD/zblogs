<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\SharedController;
use Illuminate\Support\Facades\Auth;

//admin-home
Route::get("/admin", function () {
    if (Auth::user()->type != "admin") {
        return redirect("/");
    }
    return view("admin/shared");
})->middleware('auth');
//admin-post
Route::get("/admin/blogs_posts_add", [BlogPostController::class, "blogPostAddView"])->middleware('auth');
Route::get("/admin/blogs_posts_list", [BlogPostController::class, "getPosts"])->middleware('auth');
Route::post('/savePost', [BlogPostController::class, "savePost"])->middleware('auth');
Route::post('/deletePost', [BlogPostController::class, "deleteCategory"])->middleware('auth');
Route::get('/editPost/{postId}', [BlogPostController::class, "editPost"])->middleware('auth');
//admin-category
Route::view("/admin/blogs_categories_add", "/admin/blogs_categories/blogs_categories_add")->middleware('auth');
Route::get("/admin/blogs_categories_list", [BlogCategoryController::class, "getCategories"])->middleware('auth');
Route::post('/saveBlogCategory', [BlogCategoryController::class, "saveCategory"])->middleware('auth');
Route::post('/deleteCategory', [BlogCategoryController::class, "deleteCategory"])->middleware('auth');
Route::get('/editCategory/{categoryId}', [BlogCategoryController::class, "editCategory"])->middleware('auth');

//app-home
Route::get("/", [BlogPostController::class, "getAppHome"]);
//app-posts
Route::get("/posts/{postCategory}/{limit?}", [BlogPostController::class, "getAppPosts"]);
Route::get("/posts", [BlogPostController::class, "getAppPosts"]);
Route::get("/post/{postId}", [BlogPostController::class, "getAppPostInfo"]);
Route::get("/posts_by_name/{postName}", [BlogPostController::class, "getAppPosts"]);
Route::get("/post_add", [BlogPostController::class, "appPostAdd"])->middleware('auth');
Route::get("/post_edit/{postId}", [BlogPostController::class, "appPostEdit"])->middleware('auth');
Route::get("/my_posts/{userId?}", [BlogPostController::class, "appMyPosts"])->middleware('auth');
Route::get("/posts_by_user/{userId?}", [BlogPostController::class, "appMyPosts"])->middleware('auth');

//app-categories
Route::get("/categories/{categoryName?}", [BlogCategoryController::class, "getAppCategories"]);


require __DIR__ . '/auth.php';
