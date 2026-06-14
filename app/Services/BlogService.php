<?php

namespace App\Services;

use Throwable;
use App\Models\Blog;

class BlogService
{
    // Get all blogs
    public static function getBlogs($param = [])
    {
        $blogs = Blog::select("*")
            ->orderBy("id", "desc");

        if (isset($param['slug']) && !is_null($param['slug'])) {
            return $blogs->where('slug', '=', $param['slug'])->first();
        }
        if (isset($param['blog_id']) && !is_null($param['blog_id'])) {
            $blogs->where('id', '!=', $param['blog_id']);
        }
        if (isset($param['count']) && !is_null($param['count'])) {
            $blogs->limit($param['count']);
        }
        if (isset($param['id']) && !is_null($param['id'])) {
            return $blogs->where('id', '=', $param['id'])->first();
        }
        if (isset($param['paginate']) && !is_null($param['paginate'])) {
            return $blogs->paginate($param['paginate']);
        }
        return $blogs->get();
    }
}
