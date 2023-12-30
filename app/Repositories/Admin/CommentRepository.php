<?php

namespace App\Repositories\Admin;

use App\Models\Comment\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        $this->setModel($model);
    }

    public function getAll()
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
            ->get();
    }

    public function activeComment($request)
    {
        $comment = $this->find($request->id);
        $comment->is_active = $comment->is_active == 1 ? 0 : 1;
        $comment->save();
        return $comment;
    }

    public function destroy($comment)
    {
        $comment->delete();
    }

}
