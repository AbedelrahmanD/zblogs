<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = "blog_category";
    protected $primaryKey = "blog_category_id";
    public $timestamps = false;
    public $images = array();
    public function getImage()
    {
        $path = 'uploads/blogs_categories/' . $this->blog_category_id;
        if (file_exists($path)) {
            $images = scandir($path);
            return  url("/") . "/" . $path . "/" . $images[2];
        } else {
            return "";
        }
    }
    public function posts()
    {
        return $this->hasMany(BlogPost::class, "blog_category_id");
    }
    public static function getCategories($limit)
    {
        $categories = BlogCategory::all();
        $categories = $limit == null ? $categories : $categories->take($limit);
        return $categories;
    }
}
