<?php

namespace App\Http\Controllers\Site\Comment;

use App\Http\Controllers\Controller;
use App\Repositories\Site\CommentRepository;
use Illuminate\Http\Request;

class CommentAjaxController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function storeComments(Request $request)
    {
        return response()->json([
            'data' => $this->commentRepository->storeComments($request)
        ]);
    }

    public function getComments(Request $request)
    {
        return response()->json([
            'data' => $this->commentRepository->getComments($request)
        ]);
    }
}
