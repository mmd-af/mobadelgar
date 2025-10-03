<?php

namespace App\Http\Controllers\Site\Post;

use App\Http\Controllers\Controller;
use App\Repositories\Site\PostRepository;
use Illuminate\Http\Request;

class PostAjaxController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPosts(Request $request)
    {
        return response()->json([
            'data' => $this->postRepository->getPosts($request)
        ]);
    }

    public function getAllPosts(Request $request)
    {
        return response()->json([
            'data' => $this->postRepository->getAllPosts()
        ]);
    }
}
