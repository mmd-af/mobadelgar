<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use App\Repositories\Admin\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $comments = $this->commentRepository->getAll();
        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $this->commentRepository->store($request);
        return redirect()->route('admin.comments.index');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->commentRepository->update($request, $comment);
        return redirect()->route('admin.comments.index');
    }

    public function destroy(Comment $comment)
    {
        $this->commentRepository->destroy($comment);
        return redirect()->route('admin.comments.index');
    }
}
