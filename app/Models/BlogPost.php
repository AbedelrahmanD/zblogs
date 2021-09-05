<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $table = "blog_post";
    protected $primaryKey = "blog_post_id";
    public $timestamps = false;
    public $images = array();
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, "blog_category_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function stripDesc()
    {
        return  html_entity_decode(strip_tags($this->blog_post_description));
    }
}
