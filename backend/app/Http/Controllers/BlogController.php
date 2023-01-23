<?php

namespace App\Http\Controllers;

use App\Repository\BlogRepository;
use App\Repository\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    private $blog,$response;
    public function __construct(BlogRepository $blog, ResponseRepository $response)
    {
        $this->blog = $blog;
        $this->response = $response;
    }

    public function index()
    {
        try {
            return $this->response->sendSuccess(200, "Successfully get all blog data", $this->blog->getAllBlogs());
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed get all blog data", $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title" => "required|string",
            "content" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->response->sendError(400,$validator->errors(), null);
        }

        try {
            $data = $this->blog->createBlog($request->all());
            return $this->response->sendSuccess(200, "Successfully create blog", $data);
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed create blog", $th->getMessage());
        }
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required",
        ]);

        
        if ($validator->fails()) {
            return $this->response->sendError(400,$validator->errors(), null);
        }

        $checkBlog = $this->blog->checkBlog($request->id);
        if (!$checkBlog) {
            return $this->response->sendError(404, "Blog not found",null);
        }

        try {
            $data = $this->blog->getDetailBlog($request->id);
            return $this->response->sendSuccess(200, "Successfully get blog", $data);
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed create blog", $th->getMessage());
        }
    }

    public function publish(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required",
        ]);

        
        if ($validator->fails()) {
            return $this->response->sendError(400,$validator->errors(), null);
        }

        $checkBlog = $this->blog->checkBlog($request->id);
        if (!$checkBlog) {
            return $this->response->sendError(404, "Blog not found",null);
        }
        
        try {
            $data = $this->blog->publishBlog($request->id);
            return $this->response->sendSuccess(200, "Successfully published blog", $data);
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed create blog", $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title" => "required|string",
            "content" => "required|string",
            "id" => "required",
        ]);

        if ($validator->fails()) {
            return $this->response->sendError(400,$validator->errors(), null);
        }

        $checkBlog = $this->blog->checkBlog($request->id);
        if (!$checkBlog) {
            return $this->response->sendError(404, "Blog not found",null);
        }

        try {
            $data = $this->blog->editBlog($request->id, $request);
            return $this->response->sendSuccess(200, "Successfully update blog", $data);
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed create blog", $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required",
        ]);

        
        if ($validator->fails()) {
            return $this->response->sendError(400,$validator->errors(), null);
        }

        $checkBlog = $this->blog->checkBlog($request->id);
        if (!$checkBlog) {
            return $this->response->sendError(404, "Blog not found",null);
        }

        try {
            $this->blog->deleteBlog($request->id);
            return $this->response->sendSuccess(200, "Successfully deleted blog",null);
        } catch (\Throwable $th) {
            return $this->response->sendError(500, "Failed create blog", $th->getMessage());
        }
    }

}
