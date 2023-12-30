<?php

namespace App\Repositories\Site;

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        $this->setModel($model);
    }

    public function getComments($request)
    {
        return Comment::query()
            ->select([
                'id',
                'name',
                'user_id',
                'body',
                'commentable_id',
                'commentable_type',
                'parent_id',
                'is_active',
                'created_at'
            ])
            ->with('commentable')
            ->where('commentable_type', Category::class)
            ->where('commentable_id', $request->commentableId)
            ->get();
    }

    public function store($request)
    {
        $userId = Auth::id();
        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->user_id = $userId;
        $comment->body = $request->input('body');
        $comment->parent_id = $request->input('parent_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->commentable_id = $request->input('commentable_id');
        $comment->save();
    }

    public function update($request, $comment)
    {
        $comment->is_active = $comment->is_active == 1 ? 0 : 1;
        $comment->save();
        return $comment;
    }

    public function destroy($comment)
    {
        $comment->delete();
    }

}
