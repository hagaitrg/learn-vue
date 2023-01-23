<?php 
namespace App\Repository;

use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function getAllBlogs();
    public function getDetailBlog($blogId);
    public function createBlog(array $data);
    public function publishBlog($blogId);
    public function deleteBlog($blogId);
    public function editBlog($blogId, $data);
}

class BlogRepository implements BlogRepositoryInterface
{
    public function getAllBlogs()
    {
        return Blog::all();
    }

    public function getDetailBlog($blogId)
    {
        return Blog::findOrFail($blogId);
    }

    public function createBlog(array $data)
    {
        return Blog::create($data);
    }

    public function publishBlog($blogId)
    {
        $blog = Blog::where('id',$blogId)->first();
        $blog->published = true;
        $blog->save();

        return $blog;
    }

    public function deleteBlog($blogId)
    {
        return Blog::whereId($blogId)->delete();
    }

    public function editBlog($blogId, $data)
    {
        $blog = Blog::where('id',$blogId)->first();
        $blog->title = $data->title;
        $blog->content = $data->content;
        $blog->save();
        return $blog;
    }

    public function checkBlog($blogId)
    {
        $blog = Blog::where('id',$blogId)->first();

        if (!$blog) {
            return false;
        }

        return true;
    }
}
