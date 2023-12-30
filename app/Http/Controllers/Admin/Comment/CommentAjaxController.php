<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CommentRepository;
use Illuminate\Http\Request;


class CommentAjaxController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

//    public function getDatatableData(Request $request)
//    {
//        return $this->commentRepository->getDatatableData($request);
//    }
}
