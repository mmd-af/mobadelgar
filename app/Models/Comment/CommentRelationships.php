<?php

namespace App\Models\Comment;

use App\Models\Category\Category;
use App\Models\User;

trait CommentRelationships
{
    public function commentable()
    {
        return $this->morphTo();
    }
//    TODO delete comment's parent
    public function children()
    {
        return $this->hasMany(Comment::class,  'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'commentable');
    }
}
